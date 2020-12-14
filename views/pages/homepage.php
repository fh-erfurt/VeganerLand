<?
        $pageTitle = "Homepage";
        include "../../config/init.php";

        session_start();
        if (isset($_SESSION['email']))
        {
                echo 'welcome ' . $_SESSION['email'] . 'This is Homepage';
        }
        else
        {
                echo 'you are not logged in';
        }
?>
<title>Homepage</title>
<link rel="stylesheet" type="text/css" href="../../assets/styles/homepageStyle.css">

    
