<?

// @author Molham Al-Khodari, @author Jessica Eckardtsberg
// @version 1.0.0

class PagesController extends Controller {

    public function actionIndex(){
        header('Location: index.php?c=pages&a=homepage');
    }
    
    public function actionHomepage() {
        // Here is nothing to do.
    }

    public function actionLogin() 
    {
        if(isset($_SESSION['email']))
        {
            header('Location: ?c=pages&a=homepage');
        }
        
        // check if User coming from http post
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $email      = $_POST['email'];
            $password   = $_POST['password'];
            $hashedPassword = md5($password);  
    
            // check if the User Exist in Database
    
            $stmt = $GLOBALS['db']->prepare("SELECT custId, email, password, addressId FROM customers WHERE email=? AND password=?");
            $stmt->execute(array($email,$hashedPassword));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
    
            // if Count > 0 This Mean The Database Cotanin Record About This Email
    
            if ($count > 0)
            {
                $_SESSION['email'] = $email;                    // Register Session Email
                $_SESSION['custId']= $row['custId'];            // Register Customer ID
                $_SESSION['addressId']= $row['addressId'];      // Register Address ID
                header('Location: ?c=pages&a=homepage');
                exit();
            }
            else {
                echo '<div class="alert alert-danger">You Email or Password is incorrect</div>';
            }
        }
    }
    
    public function actionResetPassword() {
        // Customer as forgotten Password. → Customer gets an E-Mail with a new password.
        // Customer wants to change Password. → Customer gives old password and 2x new password.
    }
    
    public function actionSearch() {
        // Input whta to search in field (Name of fruit of veggie)
        if (isset($_POST['submit'])) {

            $search = $_POST['search'];
            $result = Products::find("descrip LIKE '%$search%'", Products::tableName());

            $this->setParams('search', $result);

        }
    }

    public function actionAbout() {
        // This is a static site. So nothing is to do, but we kind off need the method, I think.
    }

    public function actionSetting() {
    // Customer can look into his given data and change his address, phone number and favorite products.

        if (isset($_SESSION['email'])) {
            $info = ['custId'   => null,
                    'firstName' => null,
                    'lastName'  => null,
                    'email'     => null,
                    'phone'     => null,
                    'password'  => null,
                    'addressId' => null,
                    'street'    => null,
                    'number'    => null,
                    'zip'       => null,
                    'city'      => null];
            $email = $_SESSION['email'];

            $custInfo = Customers::find("email = '$email'", Customers::tableName());
            $info['custId'] = $custInfo[0]['custId'];
            $info['firstName'] = $custInfo[0]['firstName'];
            $info['lastName'] = $custInfo[0]['lastName'];
            $info['email'] = $custInfo[0]['email'];
            $info['phone'] = $custInfo[0]['phone'];
            $info['password'] = $custInfo[0]['password'];

            $addressId = $custInfo[0]['addressId'];
            $info['addressId'] = $addressId;

            if (!empty($addressId)) {
                $addressInfo = Address::find("addressId = '$addressId'", Address::tableName());
                $info['street'] = $addressInfo[0]['street'];
                $info['number'] = $addressInfo[0]['number'];
                $info['zip'] = $addressInfo[0]['zip'];
                $info['city'] = $addressInfo[0]['city'];
            }

            $this->setParams('customerInfo', $info);

            if (isset($_POST['submit'])) {
                $newInfo = ['custId'    => $_POST['custId'],
                            'email'     => $_POST['email'],
                            'password'  => $_POST['oldPassword'],
                            'phone'     => $_POST['phone'],
                            'addressId' => $_POST['addressId'],
                            'street'    => $_POST['street'],
                            'number'    => $_POST['number'],
                            'zip'       => $_POST['zip'],
                            'city'      => $_POST['city']];
                $formErrors = 0;
                $noNewAddress = false;

                if (!empty($_POST['newPassword'])) {
                    if (isPasswordSafe($_POST['newPassword'])) {
                        $newInfo['password'] = md5($_POST['newPassword']);
                    } else {
                        $formErrors++;
                    }
                }

                if (empty($newInfo['email'])) {
                    $formErrors++;
                } else {
                    // Checks if the email has been changed into another email already existing in the database.
                    if (doesEmailExists($newInfo['email'])
                    &&  $newInfo['email'] !== $email) {
                        $formErrors++;
                    }
                }

                // Checks if all fields are filled.
                if (!empty($newInfo['street'])
                &&  !empty($newInfo['number'])
                &&  !empty($newInfo['zip'])
                &&  !empty($newInfo['city'])){

                    $street = $newInfo['street'];
                    $number = $newInfo['number'];
                    $zip = $newInfo['zip'];
                    $city = $newInfo['city'];
                    $addressInfo = Address::find("street = '$street' AND
                                                  number = '$number' AND 
                                                  zip    = '$zip'    AND 
                                                  city   = '$city'", 
                                                  Address::tableName());

                } else if (!empty($newInfo['street'])//Checks if only some fields are filled.
                       ||  !empty($newInfo['number'])
                       ||  !empty($newInfo['zip'])
                       ||  !empty($newInfo['city'])) {
                    $formErrors++;
                } else {
                    $noNewAddress = true;
                }

                if ($formErrors !== 0) {
                    echo '<div class="alert alert-danger">Update konnte nicht ausgeführt werden. Angaben waren unvollständig oder unzulässig.</div>';
                    exit();
                } else {
                    // Update the Database
                    if (empty($addressInfo) && !$noNewAddress){ //Creats an new entry in sddress table if address doesn't exists there.
                        try {
                            $sql1 = "INSERT INTO " . Address::tableName() . " (street, number, zip, city) 
                                     VALUES ('$street', '$number', '$zip', '$city');";
                            
                            $stmt = $GLOBALS['db']->prepare($sql1);
                            $stmt->execute();

                            $newInfo['addressId'] = $GLOBALS['db']->lastInsertId();
                        } catch (\PDOException $e){
                            echo 'Fehlschlag: ' . $e->getMessage();
                        }
                    } else if (!$noNewAddress){
                        $newInfo['addressId'] = $addressInfo[0]['addressId'];
                    }

                    // Update Customer Entry
                    $email = $newInfo['email'];
                    $phone = $newInfo['phone'];
                    $password = $newInfo['password'];
                    $addressId = $newInfo['addressId'];
                    $id = $newInfo['custId'];

                    try {
                        $sql2 = "UPDATE " . Customers::tableName() . " SET 
                                email = '$email', phone = '$phone', password = '$password', addressId = '$addressId' 
                                WHERE custId = $id;";
                        
                        $stmt = $GLOBALS['db']->prepare($sql2);
                        $stmt->execute();
                    } catch (\PDOException $e) {
                        echo 'Update fehlgeschlagen: ' . $e->getMessage();
                    }
                    header('Location: ?c=pages&a=setting');
                    echo '<div class="alert alert-success">Update erfolgreich!</div>';
                }
            }
        } else {
            header('Location: ?c=pages&a=homepage');
            echo '<div class="alert alert-danger">Du bist nicht angemeldet! <a href="?login">Anmelden</a></div>';
        }
    }
    public function actionFavorites() {
        // Gives a List of the Customers favorite products. We still need a model for this table.
        $custId = $this->params['userId'];
        $favs = Favorites::find("customerId = '$custId'", Favorites::tableName());

        $this->setParams('favorites', $favs);
    }

    public function actionFruits() {

        $cat = isset($_GET['cat']) ? $_GET['cat'] : '';
        
        switch ($cat) {
            case 'citrus':
                $fruits = Products::find("cat = 'C'", Products::tableName());
                break;
            case 'berry':
                $fruits = Products::find("cat = 'B'", Products::tableName());
                break;
            case 'nuts':
                $fruits = Products::find("cat = 'N'", Products::tableName());
                break;
            case 'exotics':
                $fruits = Products::find("cat = 'E'", Products::tableName());
                break;
            default:
                $fruits = Products::find("cat = 'F' OR cat = 'C' OR cat = 'B' OR cat = 'E' OR cat = 'N'", Products::tableName());
                break;
        }

        $this->setParams('fruits', $fruits);
    }

    public function actionVegetables() {

        $cat = isset($_GET['cat']) ? $_GET['cat'] : '';

        switch ($cat) {
            case 'potato':
                $veggies = Products::find("cat = 'P'", Products::tableName());
                break;
            case 'mushroom':
                $veggies = Products::find("cat = 'M'", Products::tableName());
                break;
            default:
                $veggies = Products::find("cat = 'V' OR cat = 'P' OR cat = 'M'", Products::tableName());
                break;
        }

        $this->setParams('vegetables', $veggies);
    }

    public function actionBargain() {
        $bargain = Products::find("stdPrice < 1.50", Products::tableName());

        $this->setParams('bargain', $bargain);
    }

        protected function addToCart() {
        if (isset($_SESSION['custId'])) {
            $idC = $_SESSION['custId'];
            if (isset($_POST['submit'])) {
                // $_POST['submit'] → Name of the product
                if (!empty($_POST['qty'])){
                    $item = $_POST['submit'];
                    $itemdata = Products::find("descrip = '$item'", Products::tableName());
                    $idP = $itemdata[0]['prodId'];
                    $qty = $_POST['qty'];
                    $check = OrderItems::find("custId = '$idC' AND prodId = '$idP' AND qyt = '$qty'", OrderItems::tableName());
                    if (empty($check)) {
                        try {
                            $sql = "INSERT INTO ". OrderItems::tableName() . " (custId, prodId, qyt) VALUES ('$idC', '$idP', '$qty')";
                            $stmt = $GLOBALS['db']->prepare($sql);
                            $stmt->execute();
                        } catch (\PDOException $e) {
                            echo '<div class="alert alert-danger">Bestellung fehlgeschlagen.</div>';
                            echo 'Update fehlgeschlagen: ' . $e->getMessage();
                        }
                    } else {
                        // Maybe get back the itemId.
                    }
                } else {
                    //echo '<div class="alert alert-danger">Bitte gib die gewünschte Menge an!</div>';
                }
            } else {
                // Nothing happens :P
            }
        } else {}
    }

    public function actionCart() {
        if (isset($_SESSION['custId'])) {
            $id = $_SESSION['custId'];
            
            $cartList = OrderItems::find("custId = '$id'", OrderItems::tableName());
            $productList = array();
            $priceList = array();
            $ttPrice = 0;

            for ($idx = 0; $idx < count($cartList); $idx++) {
                $id = $cartList[$idx]['prodId'];
                $productInfo = Products::find("prodId = '$id'", Products::tableName());
                array_push($productList, $productInfo);

                $price = $cartList[$idx]['qyt']*$productList[$idx][0]['stdPrice'];
                array_push($priceList, $price);
                $ttPrice += $price;
            }

            $this->setParams('cart', $cartList);
            $this->setParams('prodInfo', $productList);
            $this->setParams('price', $priceList);
            $this->setParams('ttprice', $ttPrice);
        } else {
            header('Location: index.php?c=pages&a=homepage');
        }
    }
    public static function removeFromCart() {}

    public function actionLogout() {
        $this->setParams('userId', null);
        $this->setParams('password', null);

        header('Location: index.php?c=pages&a=homepage');
    }
}
?>
