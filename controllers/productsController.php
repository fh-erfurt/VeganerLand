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
        if (isset($_POST['submit'])) 
        {

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
                viewError("Es konnte nichts gefunden werden.");
            }
        }
    }

    protected function addToCart()
    {
        if (isset($_SESSION['custId'])) 
        {
            $idC = $_SESSION['custId'];
            if (isset($_POST['submit'])) 
            {
                // $_POST['submit'] → Id of product.
                if (!empty($_POST['qty']))
                {
                    $item = $_POST['submit'];
                    $itemdata = Products::find("prodId = '$item'");
                    $qty = $_POST['qty'];
                    $check = OrderItems::find("custId = '$idC' AND prodId = '$item' AND qyt = '$qty'");
                    if (empty($check)) 
                    {
                        try 
                        {
                            $sql = "INSERT INTO ". OrderItems::tableName() . " (custId, prodId, qyt) VALUES ('$idC', '$item', '$qty')";
                            $stmt = $GLOBALS['db']->prepare($sql);
                            $stmt->execute();
                        } 
                        catch (\PDOException $e) 
                        {
                            viewError("Bestellung fehlgeschlagen.");
                            echo 'Update fehlgeschlagen: ' . $e->getMessage();
                        }
                    }
                    else
                    {
                        $idI = $check[0]['itemId'];
                        try 
                        {
                            $sql = "UPDATE " . OrderItems::tableName() . " SET isSend = 'f' WHERE itemId = $idI;";
                            $stmt = $GLOBALS['db']->prepare($sql);
                            $stmt->execute();
                        } 
                        catch (\PDOException $e) {
                            viewError("Bestellung fehlgeschlagen.");
                            echo 'Update fehlgeschlagen: ' . $e->getMessage();
                        }
                    }
                } 
                else 
                {
                    viewError("Bitte gib die gewünschte Menge an!");
                }
            } 
        } 
    }

    public function actionCart()
    {
        $do = isset($_GET['do']) ? $_GET['do'] : ''; 
        if (isset($_SESSION['custId'])) 
        {
            switch ($do) 
            {
                case 'identify':

                    $this->removeFromCart();
            
                    $id = $_SESSION['custId'];
                    
                    $cartList = OrderItems::find("custId = '$id' AND isSend = 'f'");
                    $productList = array();
                    $priceList = array();
                    $ttPrice = 0;
        
                    for ($idx = 0; $idx < count($cartList); $idx++) 
                    {
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

                    break;
                case 'others':
                    $idC = $_SESSION['custId'];
    
                    // Information on the customer.
                    $custInfo = Customers::find("custId = '$idC'");
    
                    // Information on the order.
                    $orderInfo = OrderItems::find("custId = '$idC'");
    
                    $idA = $custInfo[0]['addressId'];
                    
                    // Check if there is an adressId
                    if (!empty($idA)) 
                    {
                        $addressInfo = Address::find("addressId = '$idA'");
                        $this->setParams('addressInfo', $addressInfo);
                    }
        
                    if (isset($_POST['address'])) 
                    {
                        // Check if the address is valid.
                        if (!empty($_POST['street'])
                         && !empty($_POST['number'])
                         && !empty($_POST['zip'])
                         && !empty($_POST['city'])) 
                         {
                             // Check if the address is already in the database and give back the id.
                             $street = $_POST['street'];
                             $number = $_POST['number'];
                             $zip = $_POST['zip'];
                             $city = $_POST['city'];
    
                             $address = Address::find("street = '$street' AND number = '$number' AND zip = '$zip' AND city = '$city'");
                            
                            if (empty($address))
                            {
                                try
                                {
                                    $sql = "INSERT INTO " . Address::tableName() . " (street, number, zip, city) VALUES ('$street', '$number', '$zip', '$city');";
                                    $stmt = $GLOBALS['db']->prepare($sql);
                                    $stmt->execute();
                                }
                                catch (\PDOException $e)
                                {
                                    viewError("Eintrag fehlgeschlagen.");
                                    echo 'Update fehlgeschlagen: ' . $e->getMessage();
                                }

                                $address = Address::find("street = '$street' AND number = '$number' AND zip = '$zip' AND city = '$city'");
                            }

                            $idA = $address[0]['addressId'];
                             // → If not create a new entry in the database and get the id.
                             // Ready to order!!
                            try 
                            {
                                for ($idx = 0; $idx < count($orderInfo); $idx++) 
                                {
                                    $idI = $orderInfo[$idx]['itemId'];
                                    
                                    $sql1 = "INSERT INTO ". Orders::tableName() . " (itemId, addressId) VALUES ('$idI', '$idA');";
                                    $stmt = $GLOBALS['db']->prepare($sql1);
                                    $stmt->execute();
            
                                    $sql2 = "UPDATE " . OrderItems::tableName() . " SET isSend = 't' WHERE itemId = $idI;";
                                    $stmt = $GLOBALS['db']->prepare($sql2);
                                    $stmt->execute();
            
                                    header('Location: index.php?c=products&a=cart');
                                }
                            } 
                            catch (\PDOException $e) 
                            {
                                viewError("Bestellung fehlgeschlagen.");
                                echo 'Update fehlgeschlagen: ' . $e->getMessage();
                            }
                         } 
                         else 
                         {
                            viewError("Empfangsadresse unvollständig.");
                         }
                    } 
                    break;
            }
            
        }
         else 
        {
            viewErrors("you should first register");
            redirectHome($error);
        }
    }
    
    protected function removeFromCart()
    {
        if (isset($_POST['delete'])) 
        {
            $id = $_POST['delete'];

            $sql = "DELETE FROM " . OrderItems::tableName() . " WHERE itemId = $id";
            $stmt = $GLOBALS['db']->prepare($sql);
            $stmt->execute();
        }
    }
    
    protected function addToFavorites()
    {
        if (!empty($_POST['fav'])) 
        {
            if (isset($_SESSION['custId'])) 
            {
                $idP = $_POST['fav'];
                $idC = $_SESSION['custId'];

                $check = Favorits::find("prodId = '$idP' AND custID = '$idC'");
                if (empty($check)) 
                {
                    try 
                    {
                        $sql = "INSERT INTO " . Favorits::tableName() . "(prodId, custId) VALUES ('$idP', '$idC')";
                        $stmt = $GLOBALS['db']->prepare($sql);
                        $stmt->execute();
                    } 
                    catch (\PDOException $e) 
                    {
                        viewError("Fehlgeschlag.");
                        echo 'Update fehlgeschlagen: ' . $e->getMessage();
                    }
                } 
                else 
                {
                    viewError("Dieses Produkt ist bereits in den Favoriten eingetragen.");
                }
            } 
            else 
            {
                    viewError("Sie sind nicht angemeldet!");
            }
        }
    }
}

?>