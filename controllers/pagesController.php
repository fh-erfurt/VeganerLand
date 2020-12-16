<?

// @author Jessica Eckardtsberg
// @version 1.0.0

class PagesController extends Controller {

    public function actionIndex(){
        //Still nothing. I'm trying to figure out for what we need this.
    }
    //Don't know for what we need this. I'm reserving space.

    // Original Code: Molham Al-Khodari
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
            $checkId = 'SELECT custId FROM customers WHERE email=$email AND password=$hashedPassword';
    
            if (!$checkId) {
                echo 'Error: E-Mail oder Passwort nicht korrekt. Bitte erneut eingeben.';
                // Normal Login-Page with the message, all fields should be resetted.
            }
            else {
                // I changed this from email to custId
                $_SESSION['userId'] = $checkId;
                $_SESSION['loggedIn'] = true;
    
                //Redirects the User from the Login to the homepage.
                header('Location: index.php?c=pages&a=homepage');
            }    
            // Give the Login-Information into the $param Array
            $this->setParam('userId', $checkId);
            $this->setParam('password', $hashedPassword);
        }
    }

    // Original Code: Molham Al-Khodari
    public function actionSignUp() {
        $addId = null;

        // Looks if there is something in the fields for the adress.
        if (!empty($_POST['street'])
        && !empty($_POST['number'])
        && !empty($_POST['zip'])
        && !empty($_POST['city'])) {
            $addressParam = [$_POST['street'],
                             $_POST['number'],
                             $_POST['zip'],
                             $_POST['city']];
            
            $addId = $address->findOne('addressId', ['street', 'number', 'zip', 'city'], $addressParam);

            if (!empty($addId)) {
                if ($address->validate()) {
                    $adress->inset();
                    $addId = $address->findOne('addressId', ['street', 'number', 'zip', 'city'], $addressParam);
                }
                else {
                    die('Fehler bei den eingegeben Daten.');
                }
            }
        }

        

        // Validates data given for customer.
        // Input data into customer.
        if ($customers->validate()) {}

        // Automatic Login. → actionLogin()
        // Return to the homepage.
    }

    // public function resetPassword

    // public function addToCart
    // public function removeFromCart

    public function actionLogout() {
        session_destroy();
        header('Location: index.php?c=pages&a=login');
    }
}

?>