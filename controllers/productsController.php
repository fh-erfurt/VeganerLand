<?

class ProductsController extends Controller
{
    private function getProductsByCategory()
    {
        $cat = isset($_GET['cat']) ? $_GET['cat'] : ''; //looks if we're on a sub-site
        $page = $_GET['a']; //gets the name of the site
    
        $result = array(); //an empty array for saving informations
        //looks if we are on a sub-site. If not it gets all categories related to the page (in the database: main_sub)
        $catList = (!empty($cat)) ? Category::findOne('catId', "descrip LIKE '%$cat'") : Category::findOne('catId', "descrip LIKE '$page%'");
        
        for ($idx = 0; $idx < count($catList); $idx++) //given there can be a bunch of entries → start of the for-loop
        {
            $catId      = $catList[$idx]["catId"];
            $info       = Products::find("catId = '$catId'"); //finds all products that have the category and...
            array_push($result, $info); // ...pushes them into the array.
        }

        $this->setParams('products', $result); // Note: To get the name of the product one has to ask for $products[0][0]['descrip'] to get the first entry.
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

        $info = Products::find("stdPrice < 1.50"); //This in and out itself would be fine, but bargain.php uses the include so the products need an extra push.
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
            setcookie("search", $search); //Sets a cookie in case the site reloads and the POST disappears.
        }
        else
        {
            $search = $_COOKIE['search']; //Here is the cookie again.
        }
        $result = array();
        
        $info = Products::find("descrip LIKE '%$search%'"); //Same as with actionBargain()
        if (!empty($info)) //Looks if there is something similar in the database
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
        if (isset($_SESSION['custId'])) //Technically speaking one can only access the Cart when logged in, but some might try to get around it.
        {
            switch ($do) 
            {
                case 'identify': //Gets the information for the List

                    Products::removeFromCart();
            
                    $id = $_SESSION['custId'];
                    
                    $cartList = OrderItems::find("custId = '$id' AND isSend = 'f'"); //Looks if the customer has any products in the cart. If the products have been send then isSend has the value 't'.
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
        
                    for ($idx = 0; $idx < count($cartList); $idx++) //Loop to get the information on the products.
                    {
                        $id = $cartList[$idx]['prodId'];
                        $productInfo = Products::find("prodId = '$id'");
                        array_push($productList, $productInfo);
        
                        $price = number_format($cartList[$idx]['qyt']*$productList[$idx][0]['stdPrice'], 2); //number_format to get the 0 behind the point
                        array_push($priceList, $price);
                        $ttPrice += $price;
                    }
                    
                    $this->setParams('cart', $cartList);
                    $this->setParams('prodInfo', $productList);
                    $this->setParams('price', $priceList);
                    $this->setParams('ttprice', number_format($ttPrice, 2)); //I wanted to do the number_format on line 118, but it didn't work.

                    break;
                case 'others': //Stuff to do when getting the delivery address
                    $idC = $_SESSION['custId'];
    
                    // Information on the customer.
                    $custInfo = Customers::find("custId = '$idC'"); // Gets all information on the customer.
    
                    // Information on the order.
                    $orderInfo = OrderItems::find("custId = '$idC' AND isSend = 'f'"); //Get all product-references needed.
    
                    $idA = $custInfo[0]['addressId'];
                    
                    // Check if there is an adressId
                    if (!empty($idA)) //Looks if there is an address for the customer registered.
                    {
                        $addressInfo = Address::find("addressId = '$idA'"); //gets the information on it and shows them in the form.
                        $this->setParams('addressInfo', $addressInfo);
                    }
        
                    if (isset($_POST['address'])) //The send-button has been pushed.
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
                            
                            if (empty($address)) //New entry in the database if the address doesn't exists.
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
                                for ($idx = 0; $idx < count($orderInfo); $idx++) //A loop for a mass-INSERT into orders and a mass-UPDATE of orderitem's isSend
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
                default: //Do nothing on default.
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
                $info = Products::find("comment LIKE '%$bioFilter%'"); //Same as with actionBargain()
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

            if (!empty($info)) //Looks if there is something similar in the database
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
