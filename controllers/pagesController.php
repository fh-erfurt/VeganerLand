<?

// @author Molham Al-Khodari, @author Jessica Eckardtsberg
// @version 1.0.0

class PagesController extends Controller {

    // public function actionIndex(){
    //     header('Location: index.php?c=pages&a=homepage');
    // }
    
    public static function getCategoryName($mainCat)
    {
        $list = Category::find("descrip LIKE '$mainCat%'", Category::tableName());
        $result = array();
        for ($idx = 0; $idx < count($list); $idx++)
        {
            array_push($result, array($list[$idx]['name'], ltrim(strpbrk($list[$idx]['descrip'],"_"),"_")));
        }

        return $result;
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
    
    public function actionSearch()
    {
        // Input whta to search in field (Name of fruit of veggie)
        if (isset($_POST['submit'])) {

            $search = $_POST['search'];
            $result = array();

            $info = Products::find("descrip LIKE '%$search%'", Products::tableName());
            if (!empty($info))
            {
                array_push($result, $info);

                $this->setParams('products', $result);
            }
            else
            {
                $this->setParams('products', array());
                echo "<div class='alert alert-danger'>Es konnte nichts gefunden werden.</div>";
            }
        }
    }

    public function actionAbout()
    {
        // This is a static site. So nothing is to do, but we kind off need the method, I think.
    }

    public function actionSetting() 
    {
        // Customer can look into his given data and change his address, phone number and favorite products.
    
            if (isset($_SESSION['email'])) 
            {
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
    
                if (!empty($addressId)) 
                {
                    $addressInfo = Address::find("addressId = '$addressId'", Address::tableName());
                    $info['street'] = $addressInfo[0]['street'];
                    $info['number'] = $addressInfo[0]['number'];
                    $info['zip'] = $addressInfo[0]['zip'];
                    $info['city'] = $addressInfo[0]['city'];
                }
    
                $this->setParams('customerInfo', $info);
    
                if (isset($_POST['submit'])) 
                {
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
    
                    if (!empty($_POST['newPassword'])) 
                    {
                        if (isPasswordSafe($_POST['newPassword'])) 
                        {
                            $newInfo['password'] = md5($_POST['newPassword']);
                        } 
                        else 
                        {
                            $formErrors++;
                        }
                    }
    
                    if (empty($newInfo['email'])) 
                    {
                        $formErrors++;
                    } 
                    else 
                    {
                        // Checks if the email has been changed into another email already existing in the database.
                        if (doesEmailExists($newInfo['email'])
                        &&  $newInfo['email'] !== $email) 
                        {
                            $formErrors++;
                        }
                    }
    
                    // Checks if all fields are filled.
                    if (!empty($newInfo['street'])
                    &&  !empty($newInfo['number'])
                    &&  !empty($newInfo['zip'])
                    &&  !empty($newInfo['city']))
                    {
    
                        $street = $newInfo['street'];
                        $number = $newInfo['number'];
                        $zip = $newInfo['zip'];
                        $city = $newInfo['city'];
                        $addressInfo = Address::find("street = '$street' AND
                                                      number = '$number' AND 
                                                      zip    = '$zip'    AND 
                                                      city   = '$city'", 
                                                      Address::tableName());
    
                    } 
                    else if (!empty($newInfo['street'])//Checks if only some fields are filled.
                           ||  !empty($newInfo['number'])
                           ||  !empty($newInfo['zip'])
                           ||  !empty($newInfo['city'])) 
                    {
                        $formErrors++;
                    } 
                    else 
                    {
                        $noNewAddress = true;
                    }
    
                    if ($formErrors !== 0) 
                    {
                        echo '<div class="alert alert-danger">Update konnte nicht ausgeführt werden. Angaben waren unvollständig oder unzulässig.</div>';
                    } 
                    else 
                    {
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
    
    private function getProductsByCategory()
    {
        $cat = isset($_GET['cat']) ? $_GET['cat'] : '';
        $page = $_GET['a'];
    
        $result = array();
        $catList = (!empty($cat)) ? Products::find("descrip LIKE '%$cat'", Category::tableName()) : Products::find("descrip LIKE '$page%'", Category::tableName());
        
        for ($idx = 0; $idx < count($catList); $idx++)
        {
            $catId      = $catList[$idx]['catId'];
            $info  = Products::find("catId = '$catId'", Products::tableName());
            array_push($result, $info);
        }

        $this->setParams('products', $result);
    }

    public function actionFruits()
    {
        $this->getProductsByCategory();
        
        $this->addToCart();
        $this->addToFavorites();
    }

    public function actionVegetables()
    {
        $this->getProductsByCategory();
        
        $this->addToCart();
        $this->addToFavorites();
    }

    public function actionBargain()
    {
        $bargain = array();

        $info = Products::find("stdPrice < 1.50", Products::tableName());
        array_push($bargain, $info);

        $this->setParams('products', $bargain);
        $this->addToCart();
        $this->addToFavorites();
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
                        $idI = $check[0]['itemId'];
                        try {
                            $sql = "UPDATE " . OrderItems::tableName() . " SET isSend = 'f' WHERE itemId = $idI;";
                            $stmt = $GLOBALS['db']->prepare($sql);
                            $stmt->execute();
                        } catch (\PDOException $e) {
                            echo '<div class="alert alert-danger">Bestellung fehlgeschlagen.</div>';
                            echo 'Update fehlgeschlagen: ' . $e->getMessage();
                        }
                    }
                } else {
                    echo '<div class="alert alert-danger">Bitte gib die gewünschte Menge an!</div>';
                }
            } else {
                // Nothing happens :P
            }
        } else {}
    }
    
    public function actionCart() {

        if (isset($_SESSION['custId'])) {
            $this->removeFromCart();
            
            $id = $_SESSION['custId'];
            
            $cartList = OrderItems::find("custId = '$id' AND isSend = 'f'", OrderItems::tableName());
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
            $this->setParams('itemSend', false);
            
            if (isset($_POST['send'])) {
                $this->setParams('itemSend', true);

                $idC = $_SESSION['custId'];
                $custInfo = Customers::find("custId = '$idC'", Customers::tableName());
                $orderInfo = OrderItems::find("custId = '$idC'", OrderItems::tableName());
                $idA = $custInfo[0]['addressId'];
                
                // Check if there is an adressId
                if (!empty($idA)) {
                    $addressInfo = Address::find("addressId = '$idA'", Address::tableName());
                    $this->setParams('addressInfo', $addressInfo);
                }

                if (isset($_POST['address'])) {
                    // Check if the address is valid.
                    if (!empty($_POST['street'])
                     && !empty($_POST['number'])
                     && !empty($_POST['zip'])
                     && !empty($_POST['city'])) {
                         // Check if the address is already in the database and give back the id.
                         $street = $_POST['street'];
                         $number = $_POST['number'];
                         $zip = $_POST['zip'];
                         $city = $_POST['city'];

                         $address = Address::find("street = '$street' AND number = '$number' AND zip = '$zip' AND city = '$city'", Address::tableName());
                        var_dump($address);
                         // → If not create a new entry in the database and get the id.
                         // Ready to order!!
                         /* try {
                             for ($idx = 0; $idx < count($orderInfo); $idx++) {
                                 $idI = $orderInfo[$idx]['itemId'];
                                 
                                 $sql1 = "INSERT INTO ". Orders::tableName() . " (itemId, addressId) VALUES ('$idI', '$idA');";
                                 $stmt = $GLOBALS['db']->prepare($sql1);
                                 $stmt->execute();
         
                                 $sql2 = "UPDATE " . OrderItems::tableName() . " SET isSend = 't' WHERE itemId = $idI;";
                                 $stmt = $GLOBALS['db']->prepare($sql2);
                                 $stmt->execute();
         
                                 header('Location: index.php?c=pages&a=homepage');
                             }
                         } catch (\PDOException $e) {
                             echo '<div class="alert alert-danger">Bestellung fehlgeschlagen.</div>';
                             echo 'Update fehlgeschlagen: ' . $e->getMessage();
                         } */
                     } else {
                        echo '<div class="alert alert-danger">Empfangsadresse unvollständig.</div>';
                     }
                }
            }

        } else {
            header('Location: index.php?c=pages&a=homepage');
        }
    }
    
    protected function removeFromCart() {
        if (isset($_POST['delete'])) {
            $id = $_POST['delete'];

            $sql = "DELETE FROM " . OrderItems::tableName() . " WHERE itemId = $id";
            $stmt = $GLOBALS['db']->prepare($sql);
            $stmt->execute();
        }
    }

    public function actionLogout() {
        $this->setParams('userId', null);
        $this->setParams('password', null);

        header('Location: index.php?c=pages&a=homepage');
    }
    
     protected function addToFavorites() {
        if (!empty($_POST['fav'])) {
            if (isset($_SESSION['custId'])) {
                $idP = $_POST['fav'];
                $idC = $_SESSION['custId'];

                $check = Favorits::find("prodId = '$idP' AND custID = '$idC'", Favorits::tableName());
                if (empty($check)) {
                    try {
                        $sql = "INSERT INTO " . Favorits::tableName() . "(prodId, custId) VALUES ('$idP', '$idC')";
                        $stmt = $GLOBALS['db']->prepare($sql);
                        $stmt->execute();
                    } catch (\PDOException $e) {
                        echo '<div class="alert alert-danger">Fehlgeschlag.</div>';
                        echo 'Update fehlgeschlagen: ' . $e->getMessage();
                    }
                } else {
                    echo '<div class="alert alert-danger">Dieses Produkt ist bereits in den Favoriten eingetragen.</div>';
                }


            } else {
                echo '<div class="alert alert-danger">Sie sind nicht angemeldet!</div>';
            }
        }
    }

    public static function removeFromfavorits() {}
}
?>
