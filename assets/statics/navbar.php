<?php
  /*
  ================================
  == Molham Al-khodari 26.12.2020
  ================================
  */

  $cartItems = 0;
?>

<link rel="stylesheet" href="<?=STYLESPATH.'navbarStyle.css'?>">
<!-- start header of the navbar -->
<header class="navbar-header">
  <h1>Veganer Land</h1>
</header>
<!-- end header of the navbar -->
<!-- start all link  -->
<nav class="nav-container">
  <ul class="nav-list"> 
    <li><a class="active" href="?a=homepage">Startseite</a></li>
    <li><a href="?a=bargain">Angeboten</a></li>
    <li><a href="?a=about">Über uns</a></li>
    <li><a href="?a=fruits">Obst</a></li>
    <li><a href="?a=vegetables">Gemüse</a></li>
    <li><a href="#">Seite3</a></li>
    <li><a href="#">Seite4</a></li>
    <li><a href="#">Seite5</a></li>
    <li><a href="#">Seite6</a></li>
    <!-- warenkorb -->
    <li class = "nav-item"> Warenkorb (<?= $cartItems ?>)</li>
    <!-- Konto dropdown -->
    <li style="float:right" class="dropdown">
      <a href="" class="dropbtn">Konto</a>
      <div class="dropdown-content">
        <a href="?a=login">Login</a>
        <a href="?a=setting">Einstellungen</a>
        <a href="?a=logout">Logout</a>
      </div>
    </li>
    <!-- searchform -->
    <li>
      <div class="search-container">
        <form action="#" name="searchform" method="GET ">
        <input type="text" id="search" placeholder="Search..." maxlength="50">
        <input type="submit" name="search" id="search-submit" value>
        </form>
      </div>
    </li>
    <!-- end searchform -->
  </ul>
  <!-- end all links -->
</nav>
