<?
/*
====================================
== @author Jessica Eckardtsberg
== @author Molham Al-Khodari
== @author Mahmoud Matar
====================================
*/

class PagesController extends Controller
{

    public function actionIndex()
    {
        header('Location: index.php?c=pages&a=homepage');
    }
    
    public function actionHomepage()
    {
        // Does nothing, because there is nothing to do here.
    }

    public function actionLogin()
    {
        if (isset($_SESSION['email'])) 
        {
            header('Location: ?c=pages&a=homepage');
        }
        
        // check if User coming from http post
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $email          = $_POST['email'];
            $password       = $_POST['password'];
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
            else 
            {
                viewError("Ihre Email oder Ihr Passwort sind nicht korrekt.");
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
                if ($count != 0) 
                {
                    $tocken = generateRandomString(25);
                    $stmt = $GLOBALS['db']->prepare("UPDATE customers SET tocken = :tocken WHERE email = :email");
                    $stmt->bindParam(":tocken", $tocken, );
                    $stmt->bindParam(":email", $_POST['email']);
                    $stmt->execute();

                    $mailTo = $_POST['email'];
                    $subject = "Passwort zurücksetzen";
                    $txt = "http://localhost:8085/VeganerLand/?c=pages&a=resetPassword&do=setPassword&tocken=".$tocken;
                    
                    // reset alternative password. the URL link will be right in the returnPassword.txt

                    $file = fopen('data/returnPassword.txt', 'a+');
                    fwrite($file, $txt.PHP_EOL);
                    fclose($file);

                    //mail($mailTo, $subject, $txt);  // macht Probleme aber egal wir habe kein mail server
                    viewInfo("Email wurde versendet");
                } 
                else 
                {
                    viewError("Die Email-Addresse ist nicht korrekt.");
                }
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
                        // Does this password work for our safety standards?
                        $isPasswordSafe = isPasswordSafe($_POST['password1']);

                        if ($_POST["password1"] == $_POST["password2"]) 
                        {
                            if ($isPasswordSafe) 
                            {
                                $passwordHash = md5($_POST['password1']);
                                $stmt = $GLOBALS['db']->prepare('UPDATE customers SET password = :password, tocken = null WHERE tocken = :tocken');
                                $stmt->bindParam(':password', $passwordHash);
                                $stmt->bindParam(':tocken', $_GET["tocken"]);
                                $stmt->execute();

                                header('Location: ?c=pages&a=login');
                            }
                            else{
                                viewError("das Passwort ist nicht sicher genug");
                            }
                        } 
                        else 
                        {
                            viewError("Die Passwörte stimmen nicht überein.");
                        }
                    }
                } 
                else 
                {
                    viewError("Es gab einen Fehler bei der Übertragung.");
                }
            } 
            else 
            {
                viewError("Es gab einen Fehler bei der Übertragung.");
            }
        }
    }

    public function actionAbout()
    {
        // Nothing happens here. Enjoy your break.
    }

    public function actionContact()
    {
        if (isset($_POST['send']))
        {
            $name = $_POST['userName'];
            $email = $_POST['userEmail'];
            $subject = $_POST['subject'];
            $content = $_POST['content'];

            $txt = "Name: ".$name.PHP_EOL;
            $txt .= "Email: " .$email.PHP_EOL;
            $txt .= "Subject: " .$subject.PHP_EOL;
            $txt .= "Content: " .$content.PHP_EOL;


            $file = fopen('data/contact.txt', 'a+');
                    fwrite($file, $txt.PHP_EOL);
                    fclose($file);
        }
    }

    public function actionSetting()
    {        
        // Customer can look into his given data and change his address, phone number and favorite products.
        // update Favorits
        $this->viewFavorites();

        if (isset($_SESSION['custId'])) { // Looks if the user is logged in.
            //An array to store information.
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
            $custId = $_SESSION['custId'];
    
            $custInfo = Customers::find("custId = '$custId'"); //Gets all the information about the customer from the database
            $info['custId'] = $custInfo[0]['custId'];
            $info['firstName'] = $custInfo[0]['firstName'];
            $info['lastName'] = $custInfo[0]['lastName'];
            $info['email'] = $custInfo[0]['email'];
            $info['phone'] = $custInfo[0]['phone'];
            $info['password'] = $custInfo[0]['password'];
    
            $addressId = $custInfo[0]['addressId']; //The adress is saved in a seperate table and can be empty.
            $info['addressId'] = $addressId;
    
            if (!empty($addressId)) { //Checks if the customer has saved the adress in the database.
                $addressInfo = Address::find("addressId = '$addressId'", Address::tableName());
                $info['street'] = $addressInfo[0]['street'];
                $info['number'] = $addressInfo[0]['number'];
                $info['zip'] = $addressInfo[0]['zip'];
                $info['city'] = $addressInfo[0]['city'];
            }
    
            $this->setParams('customerInfo', $info); //The information shown on the setting.php at the left.
    
            if (isset($_POST['submit'])) { //Some action happen if the customer wants to change the infomation
                //Array with the infomation in the form.
                $newInfo = ['custId'    => $_POST['custId'],
                            'email'     => $_POST['email'],
                            'password'  => $_POST['oldPassword'],
                            'phone'     => $_POST['phone'],
                            'addressId' => $_POST['addressId'],
                            'street'    => $_POST['street'],
                            'number'    => $_POST['number'],
                            'zip'       => $_POST['zip'],
                            'city'      => $_POST['city']];

                //Two new variables. One for errors that might occure and one to see if the adress has been changed.
                $formErrors = 0;
                $noNewAddress = false;
    
                if (!empty($_POST['newPassword'])) //Looks if a new password has been entered.
                {
                    if (isPasswordSafe($_POST['newPassword'])) //Looks if the password is safe to use.
                    {
                        $newInfo['password'] = md5($_POST['newPassword']); //Encodes the new password and saves it in the array.
                    } 
                    else 
                    {
                        $formErrors++; //If it isn't save enough there is an error. Because we're (actually I'm) mean the user doesn't get to know this.
                    }
                }
                
                // check whether the email is not specified
                if (empty($newInfo['email'])) 
                {
                    $formErrors++; //The user can't delete their email. Errors 1up.
                } 
                else 
                {
                    // Checks if the email has been changed into another email already existing in the database.
                    if (doesEmailExists($newInfo['email'])
                        &&  $newInfo['email'] !== $email) {
                        $formErrors++; //Errors 1up.
                    }
                }
    
                // Checks if all fields for the adress are filled.
                if (!empty($newInfo['street'])
                    &&  !empty($newInfo['number'])
                    &&  !empty($newInfo['zip'])
                    &&  !empty($newInfo['city'])) 
                    {
                    $street = $newInfo['street'];
                    $number = $newInfo['number'];
                    $zip = $newInfo['zip'];
                    $city = $newInfo['city'];
                    //Looks if the new adress is already in the database.
                    $addressInfo = Address::find("street = '$street' AND
                                                  number = '$number' AND 
                                                  zip    = '$zip'    AND 
                                                  city   = '$city'");
                } 
                elseif (!empty($newInfo['street'])  //Checks if only some fields are filled.
                    ||  !empty($newInfo['number'])
                    ||  !empty($newInfo['zip'])
                    ||  !empty($newInfo['city'])) 
                {
                    $formErrors++; //If it so Errors 1up. The adress has to be complete.
                } 
                else 
                {
                    $noNewAddress = true; //If all are empty then there is no new adress.
                }
    
                if ($formErrors !== 0) //Looks if any errors did happen.
                {
                    viewError("Update konnte nicht ausgeführt werden. Angaben waren unvollständig oder unzulässig.");
                } 
                else 
                {
                    // Update the Database
                        if (empty($addressInfo) && !$noNewAddress) //Creats an new entry in address table if address doesn't exists there.
                        { 
                            try 
                            {
                                $sql1 = "INSERT INTO " . Address::tableName() . " (street, number, zip, city) 
                                         VALUES ('$street', '$number', '$zip', '$city');";
                                
                                $stmt = $GLOBALS['db']->prepare($sql1);
                                $stmt->execute();
    
                                $newInfo['addressId'] = $GLOBALS['db']->lastInsertId();
                            } 
                            catch (\PDOException $e) 
                            {
                                viewError("Update fehlgeschlagen.");
                            }
                        } 
                        elseif (!$noNewAddress) 
                        {
                            $newInfo['addressId'] = $addressInfo[0]['addressId']; //The new adress is already in the database so we only need the id.
                        }
    
                    // Update Customer Entry
                    $email = $newInfo['email'];
                    $phone = $newInfo['phone'];
                    $password = $newInfo['password'];
                    $addressId = $newInfo['addressId'];
                    $id = $newInfo['custId'];
    
                    try 
                    {
                        $sql2 = "UPDATE " . Customers::tableName() . " SET 
                                    email = '$email', phone = '$phone', password = '$password', addressId = '$addressId' 
                                    WHERE custId = $id;";
                            
                        $stmt = $GLOBALS['db']->prepare($sql2);
                        $stmt->execute();
                    } 
                    catch (\PDOException $e) 
                    {
                        viewError("Update fehlgeschlagen.");
                    }

                    header('Location: ?c=pages&a=setting');
                    //echo '<div class="alert alert-success">Update erfolgreich!</div>';
                }
            }
        } 
        else 
        {
            header('Location: ?c=pages&a=homepage');
            //viewError('Du bist nicht angemeldet! <a href="?c=pages&a=login">Anmelden</a>'); // das macht hier kein sinn!
        }
        Products::addToCart();
    }
    
    public function actionLogout()
    {
        $this->setParams('userId', null);
        $this->setParams('password', null);

        header('Location: index.php?c=pages&a=homepage');
    }

    public function viewFavorites()
    {
        // The customer can look at his favorites list, delete entries and quickly order again.

        Products::removeFromfavorits();

        $id = $_SESSION['custId'];
        $favoritsList = Favorits::find("custId = '$id'");
        $productList = array();

        for ($idx = 0; $idx < count($favoritsList); $idx++) 
        {
            $id = $favoritsList[$idx]['prodId'];
            $productInfo = Products::findOne("prodId, descrip, stdPrice", "prodId = '$id'");
            array_push($productList, $productInfo);
        }
    
        $this->setParams('prodInfo', $productList);
    }
}
?>
