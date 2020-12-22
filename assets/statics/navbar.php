
<!-- 
     //@author Molham Al-khodari
     //20.12.2020
     // 00:00 Uhr
     -->
<?php $cartItems = 0;?>

     <link rel="stylesheet" href="<?=STYLESPATH.'navbarStyle.css'?>">
<header class="navbar-header">
  <h1>Veganer Land</h1>
</header>
<nav class="nav-container">
  <ul class="nav-list"> 
    <!-- <li><a href="#Homepage"><img src="../../assets/images/logo.png" alt="logo" width="50px" height="50px"></a></li> -->
    <li><a class="active" href="<?=$_SERVER['SCRIPT_NAME']?>/?a=homepage">Startseite</a></li>
    <li><a href="#news">Angeboten</a></li>
    <li><a href="<?=$_SERVER['SCRIPT_NAME']?>/?a=about">Über uns</a></li>
    <li><a href="<?=$_SERVER['SCRIPT_NAME']?>/?a=fruits">Obst</a></li>
    <li><a href="<?=$_SERVER['SCRIPT_NAME']?>/?a=vegetables">Gemüse</a></li>
    <li><a href="#about">Seite3</a></li>
    <li><a href="#about">Seite4</a></li>
    <li><a href="#about">Seite5</a></li>
    <li><a href="#about">Seite6</a></li>
    <li class = "nav-item"> Warenkorb (<?= $cartItems ?>)</li>
    <li style="float:right" class="dropdown">
      <a href="" class="dropbtn">Konto</a>
      <div class="dropdown-content">
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?a=login">Login</a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?a=setting">Einstellungen</a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?a=logout">Logout</a>
      </div>
    </li>
    <li>
      <div class="search-container">
        <form action="#" name="searchform" method="GET ">
        <input type="text" id="search" placeholder="Search..." maxlength="50">
        <input type="submit" name="search" id="search-submit" value>
        </form>
      </div>
    </li>
  </ul>
</nav>
