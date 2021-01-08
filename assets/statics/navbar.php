<?php
  /*
  ================================
  == Molham Al-khodari 26.12.2020
  ================================
  */

  $cartItems = 0; // wichtig für einkaufskorb 
?>

<link rel="stylesheet" href="<?=STYLESPATH.'navbarStyle.css'?>">

<div class = "fixed">
  <!-- start header of the navbar -->
  <header class="navbar-header">
    <h1>Veganer Land</h1>
  </header>
  <!-- end header of the navbar -->

  <!-- start all link  -->
  <nav class="nav-container">
    <ul class="nav-list"> 
      <li><a class="active" href="?c=pages&a=homepage">Startseite</a></li>
      <li><a href="?c=pages&a=bargain">Angeboten</a></li>
      <li><a href="?c=pages&a=about">Über uns</a></li>
      <li><a href="?c=pages&a=fruits">Obst</a></li>
      <li><a href="?c=pages&a=vegetables">Gemüse</a></li>
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
          <a href="?c=pages&a=login">Login</a>
          <a href="?c=pages&a=setting">Einstellungen</a>
          <a href="?c=pages&a=logout">Logout</a>
        </div>
      </li>
      <!-- searchform -->
      <li>
        <div class="search-container">
          <form name="search" method="post">
             <input type="text" name="search" placeholder="Suche" maxlength="50">
             <button type="submit" name="submit" formaction="?c=pages&a=search">Suchen</button>
          </form>
        </div>
      </li>
      <!-- end searchform -->
    </ul>
    <!-- end all links -->
  </nav>
</div>
