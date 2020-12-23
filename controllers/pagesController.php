<?

// @author Molham Al-Khodari, @author Jessica Eckardtsberg
// @version 1.0.0

class PagesController extends Controller {

    public function actionIndex(){
        if ($this->loggedIn()) {
            $controllerId = $this->params['userId'];

            $name = Address::find('custId', $controllerId, Address::tableName());
            $this->setParams('name', $name);

            // Get the data from orderitems for the customer.
            $cart = OrderItems::find('custId', $controllerId, OrderItems::tableName());
            $this->setParams('cart', $cart);
        }
    }

    public function actionLogin() {

        //gets the inputs from the form in login.php
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        //coded Password which is saved in the database
        $hashedPassword = md5($password);

        // Check if Input is valid.
        if ($email === '' || $password === '') {
            echo 'Error: E-Mail oder Passwort sind nicht gegeben.';
            // The field for the forms should be resetted.
            // Normal Login-Page with the message.
            // Using exit()?
        }

        if (isset($_POST['submit'])) {
            // Check if the user is in the database.
            // It will look if there is a customer with that E-Mail and Password and gives back only the custId.
            $checkId = $customers->findOne('custId', ['email', 'password'], [$email, $hashedPassword]);
    
            if (!$checkId) {
                echo 'Error: E-Mail oder Passwort nicht korrekt. Bitte erneut eingeben.';
                // Normal Login-Page with the message, all fields should be resetted.
            }
            else {
                // I changed this from email to custId
                $_SESSION['userId'] = $checkId;
                $_SESSION['loggedIn'] = true;
    
                //Redirects the User from the Login to the homepage.
                header('Location: index.php?c=pages&a=index');
            }    
            // Give the Login-Information into the $param Array
            $this->setParams('userId', $checkId);
            $this->setParams('password', $hashedPassword);
        }
    }

    public function actionSignUp() {
        if (isset($_POST['submit'])) 
        {
            // Checks if all needed fields hold data.
            if(!empty($_POST['firstname'])
            && !empty($_POST['lastname'])
            && !empty($_POST['email'])
            && !empty($_POST['password'])
            && !empty($_POST['passwordagain'])) 
            {
                if (doesEmailExists($_POST['email'])) {
                    die('Ungültige Eingabe');
                }
                
                switch ($_POST['gender']) {
                    case 'female':
                        $gender = 'f';
                    break;
                    case 'male':
                        $gender = 'm';
                    break;
                    case 'divers':
                        $gender = 'd';
                    break;
                    default:
                        $gender = null;
                }

                if ($_POST['password'] !== $_POST['passwordagain']) {
                    die('Ungültige Eingabe.');
                }
                
                $addressId = null;

                // Checks if and Adress has been submitted.
                if(!empty($_POST['street'])
                  && !empty($_POST['number'])
                  && !empty($_POST['zip'])
                  && !empty($_POST['city'])) {

                    $addressParams = [null, $_POST['street'], $_POST['number'], $_POST['zip'], $_POST['city']];

                    //Makes sure that the Address isn't already in the database.
                    $addressId = Address::findOne('addressId', ['street', 'number' , 'zip', 'city'], $addressParams);
                    if (empty($addressId)) {
                        $address = new Address($addressParams);
                        if (!$address->validate()) {
                            die('Ungültige Eingabe.');
                        } else {
                            // If the address doesn't exist already and has the correct values, add it to the database.
                            $address->insert();
                            $addressId = Address::findOne('addressId', ['street', 'number' , 'zip', 'city'], $addressParams);
                            $this->setParams('address', $addressId);
                        }
                    }
                  }

                $hashedPassword = md5($_POST['password']);              
                $customerParams = [null, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['phone'], $gender, $hashedPassword, $addressId];

                $customer = new Customer($customerParams);
                if (!$customer->validate()) {
                    die('Ungültige Eingabe.');
                } else {
                    $customer->insert();
                    $custId = Customers::findOne('custId', ['email'], [$_POST['email']]);
                    $this->setParams('userId', $custId);
                }

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
            $result = Products::find('descrip', $_POST['search'], Products::tableName());
            
            $this->setParams('search', $result);
        }
    }

    public function actionAboutUs() {
        // This is a static site. So nothing is to do, but we kind off need the method, I think.
    }

    public function actionSettings() {
        // Customer can look into his given data and change his address, phone number and favorite products.
        // For password there is a button to the resetPassword.php. (Open for discussion)

        $info = ['firstName' => null,
                 'lastName' => null,
                 'email' => null,
                 'phone' => null,
                 'street' => null,
                 'number' => null,
                 'zip' => null,
                 'city' => null];

        $custInfo = Customers::find('custId', $params['userId'], Customers::tableName());
        $info['firstName'] = $custInfo['firstName'];
        $info['lastName'] = $custInfo['lastName'];
        $info['email'] = $custInfo['email'];
        $info['phone'] = $custInfo['phone'];

        if (!empty($custInfo['addressId'])) {
            $addressInfo = Address::find('addressId', $custInfo['addressId'], Address::tableName());
            $info['street'] = $addressInfo['street'];
            $info['number'] = $addressInfo['number'];
            $info['zip'] = $addressInfo['zip'];
            $info['city'] = $addressInfo['city'];
        }

        $this->setParams('customerInfo', $info);

        // Now only the part where one can change everything is left...
    }

    public function actionFavorites() {
        // Gives a List of the Customers favorite products. We still need a model for this table.
        $custId = $this->params['userId'];
        $favs = Favorites::find('customerId', $custId, Favorites::tableName());

        $this->setParams('favorites', $favs);
    }

    // 20 Products
    public function actionFruits() {
        // Selects all fruits from the products table. Exceptions are citrus fruits (c), berries (b),
        // exotics (e), and nuts (n).
        $fruits = Products::find('cat', 'f', Products::tableName());

        $this->setParams('fruits', $fruits);
    }

    public function actionVeggies() {
        // Selects all veggies from the products table. Exceptions are potatoes (p) and mushrooms (m).
        $veggies = Products::find('cat', 'v', Products::tableName());

        $this->setParams('veggies', $veggies);
    }

    // Some Products
    public function actionCitrus() {
        $citrus = Products::find('cat', 'c', Products::tableName());

        $this->setParams('citrus', $citrus);
    }

    public function actionBerries() {
        $berries = Products::find('cat', 'b', Products::tableName());

        $this->setParams('berries', $berries);
    }

    public function actionExotics() {
        $exotics = Products::find('cat', 'e', Products::tableName());

        $this->setParams('exotics', $exotics);
    }

    public function actionNuts() {
        $nuts = Products::find('cat', 'n', Products::tableName());

        $this->setParams('nuts', $nuts);
    }

    public function actionPotatoes() {
        $potatos = Products::find('cat', 'p', Products::tableName());

        $this->setParams('potatoes', $potatoes);
    }

    public function actionMushrooms() {
        $mushrooms = Products::find('cat', 'm', Products::tableName());

        $this->setParams('mushrooms', $mushrooms);
    }

    public function actionBargain() {
        // A static page. I think. Or we search by the name and add them to an array.
    }

    // Still not sure on how to do the code.
    public static function addToCart() {}

    public static function removeFromCart() {}

    public function actionLogout() {
        $this->setParams('userId', null);
        $this->setParams('password', null);

        header('Location: index.php?c=pages&a=homepage');
    }
}

?>
