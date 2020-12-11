<?php 
$pageTitle ='Sing Up';
$noNavbar='';
?>

<div class="con">
   <form name="registration" action="addCustomer.php" method="post">
      <header class="head-form">
         <h2>Sing Up</h2>
         <p>Es geht schnell und einfach</p>
      </header>
      <div class="field-set">
         <input class="form-input" id="firstname" type="text" name="firstname" placeholder="Vorname" required>
         <input class="form-input" id="lastname"  type="text" name="lastname" placeholder="Nachname" required> <br>

         <input class="form-input" id="email" type="text" name="email" placeholder="Email" required> <br>

         <input class="form-input" id="password"         type="password" name="password" placeholder="Passwort" required>
         <input class="form-input" id="password_repeat"  type="password" name="password_repeat" placeholder="Passwort widerholen" required> <br>

        <div class="gender">
         
         <label for="male">Männlich</label>
         <input type="radio" name="gender" id="male" value="male">
         <label for="female">Weiblich</label>
         <input type="radio" name="gender" id="female" value="female">
         <label for="divers">Divers</label>
         <input type="radio" name="gender" id="divers" value=""> <br>
         </div>

         <input class="form-input" type="phone" name="phone" id="phone" placeholder="Phone"> <br>

         <input class="form-input" id="street" type="text" name="street" placeholder="Straße"> <br>
         <input class="form-input" id="number" type="number" name="number" placeholder="Hausnummer"> <br>
                     
         <input class="form-input" id="city" type="text" name="city" placeholder="Stadt">
         <input class="form-input" id="zip" type="text" name="zip" placeholder="ZIP">
         
         <button class="log-in" type="submit" name="submit"> Register </button>
         <spam id ="login"><a href="login.php"> hast du schon ein Konto! melde dich an</a></spam>
      </div>
</form>
</div>

<?php



// If form submitted, insert values into the database.
if (isset($_POST['submit'])) 
{
    if(!empty($_POST['firstname'])
    && !empty($_POST['lastname'])
    && !empty($_POST['email'])
    && !empty($_POST['password'])) 
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

        $firstname      = $_POST['firstname'];
        $lastname       = $_POST['lastname'];
        $email          = $_POST['email'];
        $phone          = $_POST['phone'];
        $password       = $_POST['password'];
        $password_hash  = md5($password);
        $street         = $_POST['street'];
        $number         = $_POST['number'];
        $zip            = $_POST['zip'];
        $city           = $_POST['city'];

    }
    else
    {
        $error = 'Alle Felde müssen ausgefüllt sein!';
    }

    try {

        // prepare sql and bind parameters
        $sql = "INSERT INTO customers (firstname, lastname, email, phone, gender, password, street, number, zip, city)
                VALUES     (:firstname, :lastname, :email, :phone, :gender, :password, :street, :number, :zip, :city)";

        $stmt = $db->prepare("$sql");
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':number', $number);
        $stmt->bindParam(':zip', $zip);
        $stmt->bindParam(':city', $city);
        $stmt->execute();
        echo "New records created successfully";

    }
        catch (PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $db = null;
    }
?>