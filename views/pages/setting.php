<?php

//Molham Al-khodari
//18.12.2020
// 19:30 Uhr

        session_start();
        $pageTitle='Einstellung';
        require_once '../../assets/statics/header.php'; 
        require_once '../../config/init.php';
        require_once '../../config/database.php';
        require_once '../../core/functions.php';

        $do = isset($_GET['do']) ? $_GET['do'] : '';

        if ($do == 'Edit' && isset($_SESSION['email']))  
        {
                // require_once '../../assets/statics/header.php'; 
                // require_once '../../config/init.php';
                // require_once '../../config/database.php';

                $custId = $_SESSION['custId'];
                $addressId = $_SESSION['addressId']; 
                
                $stmt = $db->prepare("SELECT * FROM customers WHERE custId=? LIMIT 1");
                
                $stmt->execute(array($custId));
                $row = $stmt->fetch();  
                $count = $stmt->rowCount();

                $stmt2 = $db->prepare("SELECT * FROM address WHERE addressId=? LIMIT 1");
                $stmt2->execute(array($addressId));
                $row2 = $stmt2->fetch();
                $count2 = $stmt2->rowCount();
                
                if ($stmt->rowCount() > 0)
                {
?>
                        <div class="con">
                                <form class="from-horizonta" action="?do=Update" method="post">
                                        <header class="head-form">
                                                <h2>Mitglied bearbeiten</h2>
                                                <p> bearbeite einfach deine Daten</p>
                                        </header>
                                        <div class="field-set">
                                                <input class="form-input" type="hidden" name = "custId" value="<?php echo $custId; ?>" />
                                                <input class="form-input" type="hidden" name = "addressId" value="<?php echo $addressId; ?>" />
                                                <div class="form-group">
                                                <label class="label">Email</label>
                                                <input class="form-input" type="text" name="email" value="<?echo $row['email']?>">
                                                </div>
                                                <div class="form-group">
                                                <label class="col-sm-2 control-label">Password</label>
                                                <input class="form-input" type ="hidden" name="oldPassword" value="<?php echo $row['password']; ?>">
                                                <input class="form-input" type="password" name="newPassword">
                                                </div>
                                                <div class="form-group">
                                                <label class="col-sm-2 control-label">Phone</label>
                                                <input class="form-input" type="text" name="phone" value="<?echo $row['phone']?>">
                                                </div>
                                                <div class="form-group">
                                                <label class="col-sm-2 control-label">Straße</label>
                                                <input class="form-input" type="text" name="street" value="<?echo $row2['street']?>">
                                                </div>
                                                <div class="form-group">
                                                <label class="col-sm-2 control-label">Hausnummer</label>
                                                <input class="form-input" type="text" name="number" value="<?echo $row2['number']?>">
                                                </div>
                                                <div class="form-group">
                                                <label class="col-sm-2 control-label">zip</label>
                                                <input class="form-input" type="text" name="zip" value="<?echo $row2['zip']?>">
                                                </div>
                                                <div class="form-group">
                                                <label class="col-sm-2 control-label">Stadt</label>
                                                <input class="form-input" type="text" name="city" value="<?echo $row2['city']?>">
                                                </div>
                                        </div>
                                        <div>
                                                <button class="save" type="submit" name="submit">Save</button>
                                        </div>

                                </form>
                        </div>
<?php
                }
                else
                {
                        echo '<div class="alert alert-danger">There is no such ID</div>';       // das kann eigentlich nicht passieren 
                }
                include '../../assets/statics/footer.php';                                      // das macht vielleicht hier kein sinn 
        }
        elseif($do == 'Update')
        {
                // require_once '../../assets/statics/header.php'; 
                // require_once '../../config/init.php';
                // require_once '../../config/database.php';

                echo "<h1>Mitglied Update</h1>";
                echo "<div class ='container'>";

                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                        // Get Variable from from

                        $addressId      = $_POST['addressId'];       
                        $custId         = $_POST['custId'];
                        $email          = $_POST['email'];
                        $phone          = $_POST['phone'];
                        $street         = $_POST['street'];
                        $number         = $_POST['number'];
                        $zip            = $_POST['zip'];
                        $city           = $_POST['city'];

                        // Password Trick

                        $password = empty($_POST['newPassword']) ? $password = $_POST['oldPassword'] : $password = md5($_POST['newPassword']);

                        // Validate The from

                        $formErrors = array();

                        if (empty ($email))        $formErrors[] = '<div class="alert alert-danger">Email muss eingegeben sein!</div>'; 
                        // if (empty ($street))    $formErrors[] = 'Straße muss eingegeben sein!'; 
                        // if (empty ($number))    $formErrors[] = 'Hausnummer muss eingegeben sein!'; 
                        // if (empty ($zip))       $formErrors[] = 'zip muss eingegeben sein!'; 
                        // if (empty ($city))      $formErrors[] = 'Stadt muss eingegeben sein!'; 

                        foreach($formErrors as $error) 
                        {
                                echo $error . '<br>';
                        }

                        if (empty ($formErrors))
                        {
                        // Update the Datebase with this Info

                        $stmt1 = $db->prepare("UPDATE customers SET email = ?, phone = ?, password = ? WHERE custId = ?");
                        $stmt1->execute(array($email, $phone, $password, $custId));

                        $stmt2 = $db->prepare("UPDATE address SET street = ?, number = ?, zip = ?, city = ? WHERE addressId = ?");
                        $stmt2->execute(array($street, $number, $zip, $city, $addressId));

                        // echo success message

                        $theMessage = '<div class="alert alert-success">updated successfully</div>';
                        redirectHome($theMessage, 'back');
                        }
                }
                else {
                        $theMessage = '<div class="alert alert-danger">you can not browse this page directly!</div>';
                        redirectHome($theMessage, 5);
                }

                echo "</div>";  // end container css Style
        }
        else
        {
                $theMessage = '<div class="alert alert-danger">Du bist nicht angemeldet! <a href="../../views/pages/login.php">Anmelden</a></div>';
                redirectHome($theMessage, 5);
        }