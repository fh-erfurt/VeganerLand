<?php 
//Molham Al-khodari
//18.12.2020 
//18:40 Uhr

$noNavbar='';
$status='';
$pageTitle ='Sing Up';

require_once '../../assets/statics/header.php';
require_once '../../config/database.php';
require_once '../../config/init.php';
// include '../../core/functions.php';
//  include '../../models/baseModel.class.php';
//  include '../../models/customers.class.php';

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

         if(!empty($_POST['phone']))
         {
            $phone = $_POST['phone'];
         }
         else {
            $phone = null;
         }
         
         $firstname      = $_POST['firstname'];
         $lastname       = $_POST['lastname'];
         $email          = $_POST['email'];
         $password       = $_POST['password'];
         $passwordagain  = $_POST['passwordagain'];
         $passwordHash   = md5($password);

         // Is this Mail not already registered?
         $availableEmail = isEmailAvailable($db, $email);

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
                        $stmt = $db->prepare("$sql2");
                        $stmt->bindParam(":street", $street);
                        $stmt->bindParam(":number", $number);
                        $stmt->bindParam(":zip", $zip);
                        $stmt->bindParam(":city", $city);
                        $stmt->execute();

                        $lastAddressId = $db->lastInsertId();
                     } else {
                        $lastAddressId = null;
                     }
                     
               
                       // prepare sql and bind parameters
                       $sql = "INSERT INTO customers (firstname, lastname, email, phone, gender, password, addressId)
                              VALUES     (:firstname, :lastname, :email, :phone, :gender, :password, :addressId)";
                           
                       $stmt = $db->prepare("$sql");
                       $stmt->bindParam(':firstname', $firstname);
                       $stmt->bindParam(':lastname', $lastname);
                       $stmt->bindParam(':email', $email);
                       $stmt->bindParam(':phone', $phone);
                       $stmt->bindParam(':gender', $gender);
                       $stmt->bindParam(':password', $passwordHash);
                       $stmt->bindParam(':addressId', $lastAddressId);
               
                       $stmt->execute();
                       echo "<div class='alert alert-success'>New records created successfully</div>";
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
   }
?>
<div class="con">
   <form name="registration" action="" method="post">
      <header class="head-form">
         <h2>Sing Up</h2>
         <p>Es geht schnell und einfach</p>
      </header>
      <div class="field-set">
         <input class="form-input" id="firstname" type="text" name="firstname" placeholder="Vorname" required>
         <input class="form-input" id="lastname"  type="text" name="lastname" placeholder="Nachname" required> <br>

         <input class="form-input" id="email" type="text" name="email" placeholder="Email" required> <br>

         <input class="form-input" id="password"         type="password" name="password" placeholder="Passwort" required>
         <input class="form-input" id="passwordagain"  type="password" name="passwordagain" placeholder="Passwort widerholen" required> <br>

        <div class="gender">
         
         <label for="male">Männlich</label>
         <input type="radio" name="gender" id="male" value="male">
         <label for="female">Weiblich</label>
         <input type="radio" name="gender" id="female" value="female">
         <label for="divers">Divers</label>
         <input type="radio" name="gender" id="divers" value="divers"> <br>
         </div>

         <input class="form-input" type="phone" name="phone" id="phone" placeholder="Phone"> <br>

         <input class="form-input" id="street" type="text" name="street" placeholder="Straße"> <br>
         <input class="form-input" id="number" type="number" name="number" placeholder="Hausnummer"> <br>
                     
         <input class="form-input" id="city" type="text" name="city" placeholder="Stadt">
         <input class="form-input" id="zip" type="text" name="zip" placeholder="ZIP">
         
         <button class="sign-up" type="submit" name="submit"> Register </button> <br>
         <spam id ="login"><a href="login.php"> hast du schon ein Konto! melde dich an</a></spam>
      </div>
   </form>
</div>