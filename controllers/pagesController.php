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

            $search = $_POST['search'];
            $result = Products::find("descrip LIKE '%$search%'", Products::tableName());

            $this->setParams('search', $result);

        }
    }

    public function actionAbout() {
        // This is a static site. So nothing is to do, but we kind off need the method, I think.
    }

    public function actionSetting() {
    // Customer can look into his given data and change his address, phone number and favorite products.

        if (isset($_SESSION['email'])) {
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

            if (!empty($addressId)) {
                $addressInfo = Address::find("addressId = '$addressId'", Address::tableName());
                var_dump($addressInfo);
                $info['street'] = $addressInfo[0]['street'];
                $info['number'] = $addressInfo[0]['number'];
                $info['zip'] = $addressInfo[0]['zip'];
                $info['city'] = $addressInfo[0]['city'];
            }

            $this->setParams('customerInfo', $info);

            if (isset($_POST['submit'])) {
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
                var_dump($newInfo);

                if (!empty($_POST['newPassword'])) {
                    if (isPasswordSafe($_POST['newPassword'])) {
                        $newInfo['password'] = md5($_POST['newPassword']);
                    } else {
                        $formErrors++;
                    }
                }

                if (empty($newInfo['email'])) {
                    $formErrors++;
                } else {
                    // Checks if the email has been changed into another email already existing in the database.
                    if (doesEmailExists($newInfo['email'])
                    &&  $newInfo['email'] !== $email) {
                        $formErrors++;
                    }
                }

                // Checks if all fields are filled.
                if (!empty($newInfo['street'])
                &&  !empty($newInfo['number'])
                &&  !empty($newInfo['zip'])
                &&  !empty($newInfo['city'])){

                    $street = $newInfo['street'];
                    $number = $newInfo['number'];
                    $zip = $newInfo['zip'];
                    $city = $newInfo['city'];
                    $addressInfo = Address::find("street = '$street' AND
                                                  number = '$number' AND 
                                                  zip    = '$zip'    AND 
                                                  city   = '$city'", 
                                                  Address::tableName());

                } else if (!empty($newInfo['street'])//Checks if only some fields are filled.
                       ||  !empty($newInfo['number'])
                       ||  !empty($newInfo['zip'])
                       ||  !empty($newInfo['city'])) {
                    $formErrors++;
                } else {
                    $noNewAddress = true;
                }

                if ($formErrors !== 0) {
                    echo '<div class="alert alert-danger">Update konnte nicht ausgeführt werden. Angaben waren unvollständig oder unzulässig.</div>';
                    exit();
                } else {
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

                    echo '<div class="alert alert-success">Update erfolgreich!</div>';
                }
            }
        } else {
            header('Location: ?a=homepage');
            echo '<div class="alert alert-danger">Du bist nicht angemeldet! <a href="?login">Anmelden</a></div>';
        }
    }
    public function actionFavorites() {
        // Gives a List of the Customers favorite products. We still need a model for this table.
        $custId = $this->params['userId'];
        $favs = Favorites::find("customerId = '$custId'", Favorites::tableName());

        $this->setParams('favorites', $favs);
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

        $this->setParams('veggies', $veggies);
    }

    public function actionBargain() {
        $bargain = Products::find("stdPrice < 1.50", Products::tableName());

        $this->setParams('bargain', $bargain);
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
