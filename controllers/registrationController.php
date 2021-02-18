<?

/**
 * @author Molham Alkhodari
 * @version 2.0.0
 */

class RegistrationController extends Controller
{
    public function actionRegistration()
    {
        // If form submitted, insert values into the database.
        if (isset($_POST['submit'])) 
        {
            if (!empty($_POST['firstname'])
            && !empty($_POST['lastname'])
            && !empty($_POST['email'])
            && !empty($_POST['password'])) 
            {
                if (!empty($_POST['gender'])) {
                    switch ($_POST['gender']) {

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
                else 
                {
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

                // is the firstname and lastname valid?
                $check = [',','<','>','=','*','/','$','%','§','!','(',')','?','&','|','@','€','~'];
                $availableFirstname = validateInput($firstname, $check);
                $availableLastname  = validateInput($lastname, $check);

                if ($availableFirstname == true) 
                {
                    if ($availableLastname == true) 
                    {
                        if ($availableEmail == true) 
                        {
                            if ($password === $passwordagain) 
                            {
                                if ($isPasswordSafe == true) 
                                {
                                    try 
                                    {
                                        $addressInfo = Address::findOne('addressId', "street = '$street' AND 
                                                                                          number = '$number' AND 
                                                                                          zip    = '$zip' AND 
                                                                                          city   = '$city'");
                                            
                                        if (empty($addressInfo))
                                        {
                                            // prepare sql and bind parameters
                                            $sql2 = "INSERT INTO " . Address::tableName() . "(street, number, zip, city) 
                                             VALUES (:street, :number, :zip, :city)";
                                            $stmt = $GLOBALS['db']->prepare("$sql2");
                                            $stmt->bindParam(":street", $street);
                                            $stmt->bindParam(":number", $number);
                                            $stmt->bindParam(":zip", $zip);
                                            $stmt->bindParam(":city", $city);
                                            $stmt->execute();

                                            $lastAddressId = $GLOBALS['db']->lastInsertId();
                                        }
                                        else
                                        {
                                            $lastAddressId = $addressInfo[0]['addressId'];
                                        }
                                        }
                                        else 
                                        {
                                            $lastAddressId = null;
                                        }

                                        // prepare sql and bind parameters 
                                        $sql = "INSERT INTO " . Customers::tableName() . " (firstname, lastname, email, tocken, phone, gender, password, addressId) 
                                        VALUES (:firstname, :lastname, :email, null, :phone, :gender, :password, :addressId);";
                               
                                        $stmt = $GLOBALS['db']->prepare("$sql");
                                        $stmt->bindParam(':firstname', $firstname);
                                        $stmt->bindParam(':lastname', $lastname);
                                        $stmt->bindParam(':email', $email);
                                        $stmt->bindParam(':phone', $phone);
                                        $stmt->bindParam(':gender', $gender);
                                        $stmt->bindParam(':password', $passwordHash);
                                        $stmt->bindParam(':addressId', $lastAddressId);
                                        $stmt->execute();

                                        // check if the User Exist in Database for direkt login 
                                        $stmt2 = $GLOBALS['db']->prepare("SELECT custId, addressId FROM customers WHERE email=?");
                                        $stmt2->execute(array($email));
                                        $row = $stmt2->fetch();
                            
                                        $stmt2->execute();
                                        $_SESSION['email'] = $email;                    // Register Session Email
                                        $_SESSION['custId']= $row['custId'];            // Register Customer ID
                                        $_SESSION['addressId']= $row['addressId'];      // Register Address ID

                                        if (isset($_GET['ajax'])) 
                                        {
                                            http_response_code(200);                    // OK
                                            echo "<div class='alert alert-success'>login success</div>";
                                        }
                                        header('Location: ?c=pages&a=homepage');
                                        exit();
                                    } 
                                    catch (PDOException $e)
                                    {
                                        echo "Error: " . $e->getMessage();
                                    }
                                } 
                                else 
                                {
                                    viewError('Password not safe enough');

                                    if (isset($_GET['ajax'])) 
                                    {
                                        http_response_code(404); // NOT Found
                                        viewError($status);
                                        exit(0);
                                    }
                                }
                            } 
                            else 
                            {
                                viewError('Password and Repeat Password must be the same!!');
                            }
                        } else 
                        {
                            viewError("Email already beeing used");
                        }
                    }
                    else
                    {
                        viewError("lastname not found");
                    }
                }
                else
                {
                    viewError("firstname not found");
                }
            } 
            else 
            {
                viewError('All fields must be filled');
            }
        } 
    }
}
