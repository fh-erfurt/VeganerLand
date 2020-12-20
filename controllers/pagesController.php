<?

// @author Molham Al-Khodari, @author Jessica Eckardtsberg
// @version 1.0.0

class PagesController extends Controller {

    public function actionIndex(){
        if ($this->loggedIn()) {
            $controllerId = $this->params['userId'];

            $name = Address::find('custId', $controllerId, self::tableName());
            $this->setParam('name', $name);

            // Get the data from orderitems for the customer.
            $cart = OrderItems::find('custId', $controllerId, self::tableName());
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
            $this->setParam('userId', $checkId);
            $this->setParam('password', $hashedPassword);
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

                    $addressParams = [$_POST['street'], $_POST['number'], $_POST['zip'], $_POST['city']];

                    //Makes sure that the Address isn't already in the database.
                    $addressId = Address::findOne('addressId', ['street', 'number' , 'zip', 'city'], $addressParams);
                    if (empty($addressId)) {
                        $address = new Adress($addressParams);
                        if (!$address->validate()) {
                            die('Ungültige Eingabe.');
                        } else {
                            // If the address doesn't exist already and has the correct values, add it to the database.
                            $address->insert();
                            $addressId = Address::findOne('addressId', ['street', 'number' , 'zip', 'city'], $addressParams);
                        }
                    }
                  }

                $hashedPassword = md5($_POST['password']);              
                $customerParams = [null, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['phone'], $gender, $hashedPassword, $addressId]
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
            $result = Products::find('descrip', $_POST['search'], self::tableName());
            setParams('search', $result);
            // Display $result.
        }
    }

    public function actionAboutUs() {
        // This is a static site. So nothing is to do, but we kind off need the method, I think.
    }

    public function actionConfig() {
        // Customer can look into his given data and change his address, phone number and favorite products.
        // For password there is a button to the resetPassword.php. (Open for discussion)
    }

    public function actionFavorites() {
        // Gives a List of the Customers favorite products. We still need a model for this table.
        $custId = $this->params['userId'];
        $favs = Favorites::find('customerId', $custId, self::tableName());
        // Display $fav.
    }

    // 20 Products
    public function actionFruits() {
        // Selects all fruits from the products table.
        $fruits = Products::find('cat', 'f', self::tableName());
    }

    public function actionVeggies() {
        // Selects all fruits from the products table.
        $veggies = Products::find('cat', 'v', self::tableName());
    }

    // Some Products
    public function actionCitrus() {}

    public function actionBerries() {}

    public function actionExotics() {}

    public function actionNuts() {}

    public function actionPotatoes() {}

    public function actionMushrooms() {}

    public function actionBargain() {}


    public static function addToCart() {}

    public static function removeFromCart() {}

    public function actionLogout() {
        header('Location: index.php?c=pages&a=homepage');
    }
}

?>