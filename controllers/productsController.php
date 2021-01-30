<?

class ProductsController extends Controller
{
    private function getProductsByCategory()
    {
        $cat = isset($_GET['cat']) ? $_GET['cat'] : '';
        $page = $_GET['a'];
    
        $result = array();
        $catList = (!empty($cat)) ? Category::findOne('catId', "descrip LIKE '%$cat'") : Category::findOne('catId', "descrip LIKE '$page%'");
        
        for ($idx = 0; $idx < count($catList); $idx++)
        {
            $catId      = $catList[$idx]["catId"];
            $info       = Products::find("catId = '$catId'");
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

        $info = Products::find("stdPrice < 1.50");
        array_push($bargain, $info);

        $this->setParams('products', $bargain);
        $this->addToCart();
        $this->addToFavorites();
    }

    public function actionSearch()
    {
        // Input whta to search in field (Name of fruit of veggie)
        if (isset($_POST['submit'])) {

            $search = $_POST['search'];
            $result = array();

            $info = Products::find("descrip LIKE '%$search%'");
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

    protected function addToCart()
    {
        if (isset($_SESSION['custId'])) {
            $idC = $_SESSION['custId'];
            if (isset($_POST['submit'])) {
                // $_POST['submit'] → Name of the product
                if (!empty($_POST['qty'])){
                    $item = $_POST['submit'];
                    $itemdata = Products::find("descrip = '$item'");
                    $idP = $itemdata[0]['prodId'];
                    $qty = $_POST['qty'];
                    $check = OrderItems::find("custId = '$idC' AND prodId = '$idP' AND qyt = '$qty'");
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

    public function actionCart()
    {

        if (isset($_SESSION['custId'])) {
            $this->removeFromCart();
            
            $id = $_SESSION['custId'];
            
            $cartList = OrderItems::find("custId = '$id' AND isSend = 'f'");
            $productList = array();
            $priceList = array();
            $ttPrice = 0;

            for ($idx = 0; $idx < count($cartList); $idx++) {
                $id = $cartList[$idx]['prodId'];
                $productInfo = Products::find("prodId = '$id'");
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
                $custInfo = Customers::find("custId = '$idC'");
                $orderInfo = OrderItems::find("custId = '$idC'");
                $idA = $custInfo[0]['addressId'];
                
                // Check if there is an adressId
                if (!empty($idA)) {
                    $addressInfo = Address::find("addressId = '$idA'");
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

                         $address = Address::find("street = '$street' AND number = '$number' AND zip = '$zip' AND city = '$city'");
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
    
    protected function removeFromCart()
    {
        if (isset($_POST['delete'])) {
            $id = $_POST['delete'];

            $sql = "DELETE FROM " . OrderItems::tableName() . " WHERE itemId = $id";
            $stmt = $GLOBALS['db']->prepare($sql);
            $stmt->execute();
        }
    }
    
    protected function addToFavorites()
    {
        if (!empty($_POST['fav'])) {
            if (isset($_SESSION['custId'])) {
                $idP = $_POST['fav'];
                $idC = $_SESSION['custId'];

                $check = Favorits::find("prodId = '$idP' AND custID = '$idC'");
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