<?

// @author Molham Al-Khodari, @author Jessica Eckardtsberg
// @version 1.0.0

class PagesController extends Controller {

    public function actionIndex(){
        header('Location: index.php?a=homepage');
    }
    
    public function actionHomepage() {
        // Here is nothing to do.
    }

    public function actionLogin() 
    {
        if(isset($_SESSION['email']))
        {
            header('Location: ?a=homepage');
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
                header('Location: ?a=homepage');
                exit();
            }
            else {
                echo '<div class="alert alert-danger">You Email or Password is incorrect</div>';
            }
        }
    }

    //This function doesn't work. There are still several errors.
    public function actionRegistration() 
    {
        // If form submitted, insert values into the database.
        if (isset($_POST['submit'])) 
        {
            if(!empty($_POST['firstname'])
            && !empty($_POST['lastname'])
            && !empty($_POST['email'])
            && !empty($_POST['password'])) 
            {

                if(isset($_POST['gender']))
                {
                    switch ($_POST['gender'])
                    {
                    case 'female':
                    $gender = 'f';
                    break;
                    case 'male':
                    $gender = 'm';
                    break;
                    default:
                    $gender = 'd';
                    break;
                    }
                }
                else {
                    $gender = null;
                }

                $phone = !empty($_POST['phone']) ? $_POST['phone'] : null;
                
                $firstname      = $_POST['firstname'];
                $lastname       = $_POST['lastname'];
                $email          = $_POST['email'];
                $password       = $_POST['password'];
                $passwordagain  = $_POST['passwordagain'];
                $passwordHash   = md5($password);

                // Is this Mail not already registered?
                $availableEmail = isEmailAvailable($GLOBALS['db'], $email);

                // Does this password work for our safety standards?
                $isPasswordSafe = isPasswordSafe($password);

                if($availableEmail == true) 
                {
                    if($password === $passwordagain)
                    {
                    if ($isPasswordSafe == true) 
                    {
                        try 
                        {
                            if (!empty($_POST['street'])
                            && !empty($_POST['number'])
                            && !empty($_POST['zip'])
                            && !empty($_POST['city'])) 
                            {
                                $street         = $_POST['street'];
                                $number         = $_POST['number'];
                                $zip            = $_POST['zip'];
                                $city           = $_POST['city'];

                                // prepare sql and bind parameters
                                $sql2 = "INSERT INTO address (street, number, zip, city) 
                                VALUES (:street, :number, :zip, :city)";
                                $stmt = $GLOBALS['db']->prepare("$sql2");
                                $stmt->bindParam(":street", $street);
                                $stmt->bindParam(":number", $number);
                                $stmt->bindParam(":zip", $zip);
                                $stmt->bindParam(":city", $city);
                                $stmt->execute();

                                $lastAddressId = $GLOBALS['db']->lastInsertId();
                            } else {
                                $lastAddressId = null;
                            }
                            
                            // prepare sql and bind parameters
                            $sql = "INSERT INTO customers (firstname, lastname, email, tocken, phone, gender, password, addressId)
                                    VALUES     (:firstname, :lastname, :email, null, :phone, :gender, :password, :addressId)";
                                
                            $stmt = $GLOBALS['db']->prepare("$sql");
                            $stmt->bindParam(':firstname', $firstname);
                            $stmt->bindParam(':lastname', $lastname);
                            $stmt->bindParam(':email', $email);
                            $stmt->bindParam(':phone', $phone);
                            $stmt->bindParam(':gender', $gender);
                            $stmt->bindParam(':password', $passwordHash);
                            $stmt->bindParam(':addressId', $lastAddressId);
                    
                            $stmt->execute();
                            echo "<div class='alert alert-success'>New records created successfully</div>";
                            
                            header('Location: ?homepage');
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    }
                    else {
                        $status = 'Password not safe enough';
                        echo "<div class='alert alert-danger'>Password not safe enough!</div>";
                    }
                    }
                    else {
                    $status = 'Password and Repeat Password must be the same!!';
                    echo "<div class='alert alert-danger'>Password and Repeat Password must be the same!</div>";

                    }
                }
                else{
                    $status = 'Email already beeing used';
                    echo "<div class='alert alert-danger'>Email already beeing used!</div>";
                }
            }
            else{
                $status = 'All fields must be filled';
                echo "<div class='alert alert-danger'>All fields must be filled!</div>";

            }

        }
        else{
            // da kann michts schilmmes passieren :D
        }    
    }
    
    public function actionResetPassword() {
        // Customer as forgotten Password. → Customer gets an E-Mail with a new password.
        // Customer wants to change Password. → Customer gives old password and 2x new password.
    }
    
    public function actionSearch() {
        // Input whta to search in field (Name of fruit of veggie)
        if (isset($_POST['submit'])) {
            $result = Products::find("descrip = '{$_POST}['search']'", Products::tableName());
            
            $this->setParams('search', $result);
        }
    }

    public function actionAbout() {
        // This is a static site. So nothing is to do, but we kind off need the method, I think.
    }

    public function actionSetting() {
        // Customer can look into his given data and change his address, phone number and favorite products.
        // For password there is a button to the resetPassword.php. (Open for discussion)

        $info = ['firstName' => null,
                 'lastName' => null,
                 'email' => null,
                 'phone' => null,
                 'password' => null,
                 'street' => null,
                 'number' => null,
                 'zip' => null,
                 'city' => null];
        $email = $_SESSION['email'];

        $custInfo = Customers::find("email = '$email'", Customers::tableName());
        $info['firstName'] = $custInfo[0]['firstName'];
        $info['lastName'] = $custInfo[0]['lastName'];
        $info['email'] = $custInfo[0]['email'];
        $info['phone'] = $custInfo[0]['phone'];
        $info['password'] = $custInfo[0]['password'];

        $addressId = $custInfo[0]['addressId'];

        if (!empty($custInfo['addressId'])) {
            $addressInfo = Address::find("addressId = '$addressId'", Address::tableName());
            $info['street'] = $addressInfo[0]['street'];
            $info['number'] = $addressInfo[0]['number'];
            $info['zip'] = $addressInfo[0]['zip'];
            $info['city'] = $addressInfo[0]['city'];
        }

        $this->setParams('customerInfo', $info);

        // Now only the part where one can change everything is left... save-button
    }

    public function actionFavorites() {
        // Gives a List of the Customers favorite products. We still need a model for this table.
        $custId = $this->params['userId'];
        $favs = Favorites::find("customerId = '$custId'", Favorites::tableName());

        $this->setParams('favorites', $favs);
    }

    // 20 Products
    public function actionFruits() {
        // Selects all fruits from the products table. Exceptions are citrus fruits (c), berries (b),
        // exotics (e), and nuts (n).
        $fruits = Products::find("cat = 'F'", Products::tableName());

        $this->setParams('fruits', $fruits);
    }

    public function actionVegetables() {
        // Selects all veggies from the products table. Exceptions are potatoes (p) and mushrooms (m).
        $veggies = Products::find("cat = 'V'", Products::tableName());

        $this->setParams('veggies', $veggies);
    }

    // Some Products
    public function actionCitrus() {
        $citrus = Products::find("cat = 'C'", Products::tableName());

        $this->setParams('citrus', $citrus);
    }

    public function actionBerries() {
        $berries = Products::find("cat = 'B'", Products::tableName());

        $this->setParams('berries', $berries);
    }

    public function actionExotics() {
        $exotics = Products::find("cat = 'E'", Products::tableName());

        $this->setParams('exotics', $exotics);
    }

    public function actionNuts() {
        $nuts = Products::find("cat = 'N'", Products::tableName());

        $this->setParams('nuts', $nuts);
    }

    public function actionPotatoes() {
        $potatos = Products::find("cat = 'P'", Products::tableName());

        $this->setParams('potatoes', $potatoes);
    }

    public function actionMushrooms() {
        $mushrooms = Products::find("cat = 'M'", Products::tableName());

        $this->setParams('mushrooms', $mushrooms);
    }

    public function actionBargain() {
        // A static page. I think. Or we search by the name and add them to an array.
        // All products under 1€
    }

    // Still not sure on how to do the code.
    public static function addToCart() {}

    public static function removeFromCart() {}

    public function actionLogout() {
        $this->setParams('userId', null);
        $this->setParams('password', null);

        header('Location: index.php?a=homepage');
    }
}

?>
