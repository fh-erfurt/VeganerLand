<?php

//Molham Al-khodari
//18.12.2020
// 19:30 Uhr

session_start();
$pageTitle='Einstellung';
$do = isset($_GET['do']) ? $_GET['do'] : '';

        if ($do == 'Edit' && isset($_SESSION['email']))  
        {
                require_once '../../assets/statics/header.php'; 
                require_once '../../config/init.php';
                require_once '../../config/database.php';

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
                        <h1>Mitglied bearbeiten</h1>
                        <div class="container">
                                <form clss="from-horizonta" action="?do=Update" method="post">
                                        <input type="hidden" name = "custId" value="<?php echo $custId; ?>" />
                                        <input type="hidden" name = "addressId" value="<?php echo $addressId; ?>" />
                                        <!-- Start Email Field -->
                                        <div class="groub">
                                                <label class="label">Email</label>
                                                <div class="input">
                                                        <input type="text" name="email" class="form-control" value="<?echo $row['email']?>">
                                                </div>
                                        </div>
                                        <!-- End Email Field -->
                                        <!-- Start Password Field -->
                                        <div class="form-groub">
                                                <label class="col-sm-2 control-label">Password</label>
                                                <div class="col-sm-10">
                                                        <input type ="hidden" name="oldPassword" value="<?php echo $row['password']; ?>">
                                                        <input type="password" name="newPassword" class="form-control">
                                                </div>
                                        </div>
                                        <!-- End Password Field -->
                                        <!-- Start Phone Field -->
                                        <div class="form-groub">
                                                <label class="col-sm-2 control-label">Phone</label>
                                                <div class="col-sm-10">
                                                        <input type="text" name="phone" class="form-control" value="<?echo $row['phone']?>">
                                                </div>
                                        </div>
                                        <!-- End Phone Field -->
                                        <!-- Start Street Field -->
                                        <div class="form-groub">
                                                <label class="col-sm-2 control-label">Straße</label>
                                                <div class="col-sm-10">
                                                        <input type="text" name="street" class="form-control" value="<?echo $row2['street']?>">
                                                </div>
                                        </div>
                                        <!-- End Street Field -->
                                        <!-- Start Number Field -->
                                        <div class="form-groub">
                                                <label class="col-sm-2 control-label">Hausnummer</label>
                                                <div class="col-sm-10">
                                                        <input type="text" name="number" class="form-control" value="<?echo $row2['number']?>">
                                                </div>
                                        </div>
                                        <!-- End Number Field -->
                                        <!-- Start ZIP Field -->
                                        <div class="form-groub">
                                                <label class="col-sm-2 control-label">zip</label>
                                                <div class="col-sm-10">
                                                        <input type="text" name="zip" class="form-control" value="<?echo $row2['zip']?>">
                                                </div>
                                        </div>
                                        <!-- End ZIP Field -->
                                        <!-- Start City Field -->
                                        <div class="form-groub">
                                                <label class="col-sm-2 control-label">Stadt</label>
                                                <div class="col-sm-10">
                                                        <input type="text" name="city" class="form-control" value="<?echo $row2['city']?>">
                                                </div>
                                        </div>
                                        <!-- End City Field -->
                                        <div>
                                                <input type="submit" name="submit" value="Save" class="save">
                                        </div>

                                </form>
                        </div>
<?php
                }
                else
                {
                        echo 'There is no such ID';
                }
                include '../../assets/static/footer.php';
        }
        elseif($do == 'Update')
        {
                require_once '../../assets/static/header.php'; 
                require_once '../../config/init.php';
                require_once '../../config/database.php';

                echo "<h1>Mitglied Update</h1>";
                echo "<div calss ='container'>";

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

                        if (empty ($email))        $formErrors[] = 'Email muss eingegeben sein!'; 
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

                        echo 'updated successfully';
                        }
                }
                else {
                        echo 'you can not browse this page directly';
                }

                echo "</div>";
        }
        else
        {
                echo 'Du bist nicht angemeldet! <br>
                <a href="../../views/pages/login.php">Anmelden</a>  ' ;
        }
