<?

//@author Molham Al-khodari
//@version 1.0.0
//16.12.2020

$pageTitle = "Homepage";
require_once '../../assets/static/header.php';
require_once "../../config/init.php";
// include '../../core/functions.php';  in header zu sehen.

session_start();
if (isset($_SESSION['email']))
{
        echo 'welcome your Email: ' . $_SESSION['email'] . ' this is Homepage <br>';
        echo 'welcome your ID: ' . $_SESSION['custId'] . '<br>';
}
else
{
        echo 'you are not logged in';
}
?>
<title>Homepage</title>
<link rel="stylesheet" type="text/css" href="../../assets/styles/homepageStyle.css">
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php  require_once '../../assets/static/footer.php'; ?>

    
