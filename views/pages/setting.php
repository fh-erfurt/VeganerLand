<?php

//@author Molham Al-khodari
//@version 1.0.0
//16.12.2020

session_start();

$pageTitle='Einstellung';

$do = isset($_GET['do']) ? $_GET['do'] : '';
if ($do == 'Edit' && isset($_SESSION['email']))  
{
        require_once '../../static/header.php'; 
        require_once '../../config/init.php';
        require_once '../../config/database.php';
        $userId = $_SESSION['custId'];
        
        $stmt = $db->prepare("SELECT * FROM customers WHERE custId=? LIMIT 1");
        // $stmt2 = $db->prepare("SELECT * FROM address WHERE addressId=? LIMIT 1");

        $stmt->execute(array($userId));
        $row = $stmt->fetch();  
        $count = $stmt->rowCount();

        if ($stmt->rowCount() > 0) 
        {
        ?>
        <!-- <title>Einstellung</title>
        <link rel="stylesheet" href="../../assets/styles/settingStyle.css"> -->
        <h1>Mitglied bearbeiten</h1>
        <div class="container">
                <form clss="from-horizonta" action="">
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
                                        <input type="password" name="password" class="form-control">
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
                                        <input type="text" name="street" class="form-control" value="<?echo $row['street']?>">
                                </div>
                        </div>
                        <!-- End Street Field -->
                        <!-- Start Number Field -->
                        <div class="form-groub">
                                <label class="col-sm-2 control-label">Hausnummer</label>
                                <div class="col-sm-10">
                                        <input type="text" name="number" class="form-control" value="<?echo $row['number']?>">
                                </div>
                        </div>
                        <!-- End Number Field -->
                        <!-- Start ZIP Field -->
                        <div class="form-groub">
                                <label class="col-sm-2 control-label">zip</label>
                                <div class="col-sm-10">
                                        <input type="text" name="zip" class="form-control" value="<?echo $row['zip']?>">
                                </div>
                        </div>
                        <!-- End ZIP Field -->
                        <!-- Start City Field -->
                        <div class="form-groub">
                                <label class="col-sm-2 control-label">Stadt</label>
                                <div class="col-sm-10">
                                        <input type="text" name="city" class="form-control" value="<?echo $row['city']?>">
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
include '../../static/footer.php';
}
else
{
        echo 'Du bist nicht angemeldet! <br>
              <a href="../../views/pages/login.php">Anmelden</a>  ' ;
}
