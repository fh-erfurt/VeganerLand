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
        $this->addToCart();
        $this->addToFavorites(); 
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
        $this->addToCart();
        $this->addToFavorites();
    }

    public function actionBargain() {
        $bargain = Products::find("stdPrice < 1.50", Products::tableName());

        $this->setParams('bargain', $bargain);
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
