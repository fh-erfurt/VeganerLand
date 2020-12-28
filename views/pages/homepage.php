<?php
//Molham Al-khodari
//18.12.2020
//21:30 Uhr

if (isset($_SESSION['email']))
{
    echo 'email: ' . $_SESSION['email'] . '<br>';
    echo 'custId: ' . $_SESSION['custId'] . '<br>';
    echo 'addressId' . $_SESSION['addressId'] . '<br>';
}
else
{
    echo 'You are gast <br>';
}
?>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php  require_once TEMPLATESPATH.'/footer.php'; ?>

    
