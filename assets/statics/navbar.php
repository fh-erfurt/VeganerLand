<!-- Molham Al-khodari -->

<link rel="stylesheet" href="<?=STYLESPATH.'navbarStyle.css'?>">

</head>
<nav class="fixed">
  <input type="checkbox" id="check">
  <label for="check" class="checkbtn"><i class="fas fa-bars"></i></label>
  <ul class="menu">
    <li class="logo"><a href="?c=pages&a=homepage">VeganerLand</a></li>
    <li class="item"><a href="?c=pages&a=homepage">Startseite</a></li>
    <li class="dropdown item"> <a>Obst</a>
      <div class="dropdown-content">
        <?
        $fruits = Category::getCategoryName('fruits'); //Dynamic dropdown-menu for fruit-categories
        foreach ($fruits as $cat)
        {
          $name = ($cat[0] === 'alle') ? 'a=fruits' : "a=fruits&cat=$cat[1]"; //creats the right link for all the categories.
          ?>
        <a href="?c=products&<?=$name?>"><? echo ucfirst($cat[0]); ?></a> <? //The 'name' shows up in the dropdown.
        } ?>
      </div>
    </li>
    <li class="dropdown item"><a>Gemüse</a>
      <div class="dropdown-content">
        <?
        $vegetables = Category::getCategoryName('vegetables'); //Same as with fruits.
        foreach ($vegetables as $cat)
        {
          $name = ($cat[0] === 'alle') ? 'a=vegetables' : "a=vegetables&cat=$cat[1]";
          ?>
        <a href="?c=products&<?=$name?>"><? echo ucfirst($cat[0]); ?></a> <?
        } ?>
      </div>
    </li>
    <li class="item"><a href="?c=products&a=bargain">Angebote</a></li>
    <li class="item"><a href="?c=pages&a=about">Über uns</a></li>
    <li class="item"><a href="?c=pages&a=contact">Kontakt</a></li>




    
    <!-- searchform -->
    <li class="item">
      <div class="search-container">
        <form class=search name="search" method="post">
          <input type="text" name="search" placeholder="Suche.." maxlength="50">
          <button type="submit" name="submitSearch" formaction="?c=products&a=search"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </li>

  <!-- Konto dropdown -->
  <?php if(isset($_SESSION['email'])) : ?>
    <li class="dropdown item button secondary"><a href="#">Konto</a>
      <div class="dropdown-content">
        <a href="?c=pages&a=setting">Einstellungen</a>
        <a href="?c=pages&a=logout">Logout</a>
      </div>
    </li>
    <li class="item button secondary"><a id="cart" href="?c=products&a=cart&do=identify">Warenkorb(<span id="cartCount"><?=OrderItems::ItemsCart();?></span>)</a></li>
  <?php else : ?>
    <li class="dropdown item button"><a href="?c=pages&a=login">Log In</a></li>
  <?php endif; ?>

      
  </ul>
</nav>
