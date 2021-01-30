<?

// @author Molham Al-Khodari, @author Jessica Eckardtsberg
// @version 1.0.0

class PagesController extends Controller {

    // public function actionIndex(){
    //     header('Location: index.php?c=pages&a=homepage');
    // }
    
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

    public function actionResetPassword()
    {
        $do = isset($_GET['do']) ? $_GET['do'] : '';

        if ($do == 'identify') 
        {
            // check is User coming from http post
            if (isset($_POST['submit'])) 
            {
                $email = $_POST['email'];
        
                // check if the User Exist in Database

                $stmt = $GLOBALS['db']->prepare("SELECT * FROM customers WHERE email= :email LIMIT 1");
                $stmt->bindParam(":email", $_POST['email']);
                $stmt->execute();
                $count = $stmt->rowCount();

                // if Count > 0 This Mean The Database Cotanin Record About This Email
                if ($count != 0) {
                    $tocken = generateRandomString(25);
                    $stmt = $GLOBALS['db']->prepare("UPDATE customers SET tocken = :tocken WHERE email = :email");
                    $stmt->bindParam(":tocken", $tocken, );
                    $stmt->bindParam(":email", $_POST['email']);
                    $stmt->execute();

                    $mailTo = $_POST['email'];
                    $subject = "Passwort zurücksetzen";
                    $txt = "http://localhost:8085/VeganerLand-main/index.php?a=resetPassword&do=setPassword&tocken=".$tocken;

                    mail($mailTo, $subject, $txt);


                    // mail($_POST["email"], "Passwort zurücksetzen", "http://localhost:8085/VeganerLand-Molham/index.php?a=resetPassword&do=setPassword&tocken=".$tocken);
                    echo '<div class="alert alert-info">Email wurde versendet</div>';
                } else 
                {
                    echo '<div class="alert alert-danger">There is no such Email</div>';
                }
            } 
            elseif ($do == 'setPassword') 
            {
                if (isset($_GET["tocken"])) 
                {
                    $stmt = $GLOBALS['db']->prepare("SELECT * FROM customers WHERE tocken= :tocken LIMIT 1");
                    $stmt->bindParam(":tocken", $_GET['tocken']);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                
                    if ($count != 0) 
                    {
                        if (isset($_POST['submit'])) 
                        {
                            if ($_POST["password1"] == $_POST["password2"]) 
                            {
                                $passwordHash = md5($_POST['password1']);
                                $stmt = $GLOBALS['db']->prepare('UPDATE customers SET password = :password, tocken = null WHERE tocken = :tocken');
                                $stmt->bindParam(':password', $passwordHash);
                                $stmt->bindParam(':tocken', $_GET["tocken"]);
                                $stmt->execute();

                                header('Location: ?a=login');
                            } 
                            else 
                            {
                                echo '<div class="alert alert-danger" die Passwörte stimmen nicht überein</div>';
                            }
                        }
                    }
                    else 
                    {
                        echo '<div class="alert alert-danger">der tocken ist ungültig';
                    }
                }
                else 
                {
                    echo '<div class="alert alert-danger">kein gültige tocken gesendet';
                }
            }
        }
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
                echo "<div class='alert alert-danger'>Es konnte nichts gefunden werden.</div>";
            }
        }
    }

    public function actionAbout()
    {
        // This is a static site. So nothing is to do, but we kind off need the method, I think.
    }

    public function actionSetting() 
    {
        // Customer can look into his given data and change his address, phone number and favorite products.
    
            if (isset($_SESSION['email'])) 
            {
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
    
                $custInfo = Customers::find("email = '$email'");
                $info['custId'] = $custInfo[0]['custId'];
                $info['firstName'] = $custInfo[0]['firstName'];
                $info['lastName'] = $custInfo[0]['lastName'];
                $info['email'] = $custInfo[0]['email'];
                $info['phone'] = $custInfo[0]['phone'];
                $info['password'] = $custInfo[0]['password'];
    
                $addressId = $custInfo[0]['addressId'];
                $info['addressId'] = $addressId;
    
                if (!empty($addressId)) 
                {
                    $addressInfo = Address::find("addressId = '$addressId'", Address::tableName());
                    $info['street'] = $addressInfo[0]['street'];
                    $info['number'] = $addressInfo[0]['number'];
                    $info['zip'] = $addressInfo[0]['zip'];
                    $info['city'] = $addressInfo[0]['city'];
                }
    
                $this->setParams('customerInfo', $info);
    
                if (isset($_POST['submit'])) 
                {
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
    
                    if (!empty($_POST['newPassword'])) 
                    {
                        if (isPasswordSafe($_POST['newPassword'])) 
                        {
                            $newInfo['password'] = md5($_POST['newPassword']);
                        } 
                        else 
                        {
                            $formErrors++;
                        }
                    }
    
                    if (empty($newInfo['email'])) 
                    {
                        $formErrors++;
                    } 
                    else 
                    {
                        // Checks if the email has been changed into another email already existing in the database.
                        if (doesEmailExists($newInfo['email'])
                        &&  $newInfo['email'] !== $email) 
                        {
                            $formErrors++;
                        }
                    }
    
                    // Checks if all fields are filled.
                    if (!empty($newInfo['street'])
                    &&  !empty($newInfo['number'])
                    &&  !empty($newInfo['zip'])
                    &&  !empty($newInfo['city']))
                    {
    
                        $street = $newInfo['street'];
                        $number = $newInfo['number'];
                        $zip = $newInfo['zip'];
                        $city = $newInfo['city'];
                        $addressInfo = Address::find("street = '$street' AND
                                                      number = '$number' AND 
                                                      zip    = '$zip'    AND 
                                                      city   = '$city'");
    
                    } 
                    else if (!empty($newInfo['street'])//Checks if only some fields are filled.
                           ||  !empty($newInfo['number'])
                           ||  !empty($newInfo['zip'])
                           ||  !empty($newInfo['city'])) 
                    {
                        $formErrors++;
                    } 
                    else 
                    {
                        $noNewAddress = true;
                    }
    
                    if ($formErrors !== 0) 
                    {
                        echo '<div class="alert alert-danger">Update konnte nicht ausgeführt werden. Angaben waren unvollständig oder unzulässig.</div>';
                    } 
                    else 
                    {
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
                        header('Location: ?c=pages&a=setting');
                        echo '<div class="alert alert-success">Update erfolgreich!</div>';
                    }
                }
            } else {
                header('Location: ?c=pages&a=homepage');
                echo '<div class="alert alert-danger">Du bist nicht angemeldet! <a href="?login">Anmelden</a></div>';
            }
    }
    
    public function actionLogout()
    {
        $this->setParams('userId', null);
        $this->setParams('password', null);

        header('Location: index.php?c=pages&a=homepage');
    }
}
?>
