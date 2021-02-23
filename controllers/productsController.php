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
        
        Products::addToCart();
        Products::addToFavorites();
    }

    public function actionVegetables()
    {
        $this->getProductsByCategory();
        
        Products::addToCart();
        Products::addToFavorites();
    }

    public function actionBargain()
    {
        $bargain = array();

        $info = Products::find("stdPrice < 1.50");
        array_push($bargain, $info);

        $this->setParams('products', $bargain);
        Products::addToCart();
        Products::addToFavorites();
    }

    public function actionSearch()
    {
        // Input whta to search in field (Name of fruit of veggie)
        if (isset($_POST['submitSearch'])) 
        {
            $search = $_POST['search'];
            setcookie("search", $search);
        }
        else
        {
            $search = $_COOKIE['search'];
        }
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
        Products::addToCart();
        Products::addToFavorites();
    }

    public function actionCart()
    {
        $do = isset($_GET['do']) ? $_GET['do'] : ''; 
        if (isset($_SESSION['custId'])) 
        {
            switch ($do) 
            {
                case 'identify':

                    Products::removeFromCart();
            
                    $id = $_SESSION['custId'];
                    
                    $cartList = OrderItems::find("custId = '$id' AND isSend = 'f'");
                    if (empty($cartList))
                    {
                        $this->setParams('emptyList', true);
                        break;
                    }
                    else
                    {
                        $this->setParams('emptyList', false);
                    }

                    $productList = array();
                    $priceList = array();
                    $ttPrice = 0;
        
                    for ($idx = 0; $idx < count($cartList); $idx++) 
                    {
                        $id = $cartList[$idx]['prodId'];
                        $productInfo = Products::find("prodId = '$id'");
                        array_push($productList, $productInfo);
        
                        $price = number_format($cartList[$idx]['qyt']*$productList[$idx][0]['stdPrice'], 2);
                        array_push($priceList, $price);
                        $ttPrice += $price;
                    }
                    
                    $this->setParams('cart', $cartList);
                    $this->setParams('prodInfo', $productList);
                    $this->setParams('price', $priceList);
                    $this->setParams('ttprice', number_format($ttPrice, 2));

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
            redirectHome("Du solltest dich erst anmelden.");
        }
    }

    public function actionFilter()
    {
        // check if the user has filtered
        if (isset($_POST['submitFilter'])) 
        {
            // filter by bio
            if(!empty($_POST['bio']))
            {
                $bioFilter = $_POST['bio'];
                $info = Products::find("comment LIKE '%$bioFilter%'"); 
            }
            // filter by regional
            if(!empty($_POST['regional']))
            { 
                $regionalFilter = $_POST['regional'];
                $info = Products::find("comment LIKE '%$regionalFilter%'");
            }
            // filter by price
            if(!empty($_POST['price']))
            { 
                $priceFilter = $_POST['price'];
                $info = Products::find("stdPrice <= '$priceFilter'");
            }
            // filter by weight
            if(!empty($_POST['weight']))
            { 
                $weightFilter = $_POST['weight'];
                $info = Products::find("comment LIKE '%$weightFilter%'");
            }

            // filter by regional & bio
            if(!empty($_POST['regional']) && !empty($_POST['bio']))
            { 
                $bioFilter = $_POST['bio'];
                $regionalFilter = $_POST['regional'];
                $info = Products::find("comment LIKE '%$regionalFilter%' AND comment LIKE '%$bioFilter%'");
            }
            // filter by price & bio
            if(!empty($_POST['price']) && !empty($_POST['bio']))
            { 
                $bioFilter = $_POST['bio'];
                $priceFilter = $_POST['price'];
                $info = Products::find("comment LIKE '%$bioFilter%' AND stdPrice <= '$priceFilter'");
            }
            // filter by weight & bio
            if(!empty($_POST['weight']) && !empty($_POST['bio']))
            { 
                $bioFilter = $_POST['bio'];
                $weightFilter = $_POST['weight'];
                $info = Products::find("comment LIKE '%$bioFilter%' AND comment LIKE '%$weightFilter%'");
            }
            // filter by weight & regional
            if(!empty($_POST['weight']) && !empty($_POST['regional']))
            { 
                $regionalFilter = $_POST['regional'];
                $weightFilter = $_POST['weight'];
                $info = Products::find("comment LIKE '%$regionalFilter%' AND comment LIKE '%$weightFilter%'");
            }
            // filter by price & regional
            if(!empty($_POST['price']) && !empty($_POST['regional']))
            { 
                $regionalFilter = $_POST['regional'];
                $priceFilter = $_POST['price'];
                $info = Products::find("comment LIKE '%$regionalFilter%' AND stdPrice <= '$priceFilter'");
            }
            // filter by price & weight
            if(!empty($_POST['price']) && !empty($_POST['weight']))
            { 
                $weightFilter = $_POST['weight'];
                $priceFilter = $_POST['price'];
                $info = Products::find("comment LIKE '%$weightFilter%' AND stdPrice <= '$priceFilter'");
            }

            // filter by regional & bio & price
            if(!empty($_POST['regional']) && !empty($_POST['bio']) && !empty($_POST['price']))
            { 
                $bioFilter = $_POST['bio'];
                $regionalFilter = $_POST['regional'];
                $priceFilter = $_POST['price'];
                $info = Products::find("comment LIKE '%$regionalFilter%' AND comment LIKE '%$bioFilter%' AND stdPrice <= '$priceFilter'");
            }
            // filter by regional & bio & weight
            if(!empty($_POST['regional']) && !empty($_POST['bio']) && !empty($_POST['weight']))
            { 
                $bioFilter = $_POST['bio'];
                $regionalFilter = $_POST['regional'];
                $weightFilter = $_POST['weight'];
                $info = Products::find("comment LIKE '%$regionalFilter%' AND comment LIKE '%$bioFilter%' AND comment LIKE '%$weightFilter%'");
            }
            // filter by regional & bio & price
            if(!empty($_POST['weight']) && !empty($_POST['bio']) && !empty($_POST['price']))
            { 
                $bioFilter = $_POST['bio'];
                $weightFilter = $_POST['weight'];
                $priceFilter = $_POST['price'];
                $info = Products::find("comment LIKE '%$bioFilter%' AND comment LIKE '%$weightFilter%' AND stdPrice <= '$priceFilter'");
            }
            // filter by regional & price & weight
            if(!empty($_POST['regional']) && !empty($_POST['price']) && !empty($_POST['weight']))
            { 
                $priceFilter = $_POST['price'];
                $regionalFilter = $_POST['regional'];
                $weightFilter = $_POST['weight'];
                $info = Products::find("comment LIKE '%$regionalFilter%' AND comment LIKE '%$weightFilter%' AND stdPrice <= '$priceFilter'");
            }
            // filter by regional & price & weight & bio
            if(!empty($_POST['regional']) && !empty($_POST['price']) && !empty($_POST['weight'])&& !empty($_POST['bio']))
            { 
                $priceFilter = $_POST['price'];
                $regionalFilter = $_POST['regional'];
                $weightFilter = $_POST['weight'];
                $bioFilter = $_POST['bio'];
                $info = Products::find("comment LIKE '%$regionalFilter%' AND comment LIKE '%$bioFilter%' AND comment LIKE '%$weightFilter%' AND stdPrice <= '$priceFilter'");
            }

            // save the info from the database in the array
            $result = array();

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
}
?>
