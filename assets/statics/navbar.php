<!-- Molham Al-khodari -->

<link rel="stylesheet" href="<?=STYLESPATH.'navbarStyle.css'?>">
<script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- nur das menu icorn -->

</head>
<nav class="fixed">
  <input type="checkbox" id="check">
  <label for="check" class="checkbtn"><i class="fas fa-bars"></i></label>
  <ul class="menu">
    <li class="logo"><a href="?c=pages&a=homepage">VeganerLand</a></li>
    <li class="item"><a href="?c=pages&a=homepage">Startseite</a></li>
    <li class="item"><a href="?c=pages&a=about">Über uns</a></li>
    <li class="item"><a href="?c=products&a=bargain">Angebote</a></li>

    <li class="dropdown item"> <a>Obst</a>
      <div class="dropdown-content">
        <?
        $fruits = Category::getCategoryName('fruits');
        foreach ($fruits as $cat)
        {
          $name = ($cat[0] === 'alle') ? 'a=fruits' : "a=fruits&cat=$cat[1]";
          ?>
        <a href="?c=products&<?=$name?>"><? echo ucfirst($cat[0]); ?></a> <?
        } ?>
      </div>
    </li>
    <li class="dropdown item"><a>Gemüse</a>
      <div class="dropdown-content">
        <?
        $vegetables = Category::getCategoryName('vegetables');
        foreach ($vegetables as $cat)
        {
          $name = ($cat[0] === 'alle') ? 'a=vegetables' : "a=vegetables&cat=$cat[1]";
          ?>
        <a href="?c=products&<?=$name?>"><? echo ucfirst($cat[0]); ?></a> <?
        } ?>
      </div>
    </li>
    
    <!-- searchform -->
    <li class="item">
      <div class="search-container">
        <form class=search name="search" method="post">
          <input type="text" name="search" placeholder="Suche.." maxlength="50">
          <button type="submit" name="submit" formaction="?c=products&a=search"><i class="fa fa-search"></i></button>
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
  <?php else : ?>
    <li class="dropdown item button"><a href="?c=pages&a=login">Log In</a></li>
  <?php endif; ?>

      <li class="item button secondary"><a id="cart" href="?c=products&a=cart">Warenkorb(<? echo OrderItems::ItemsCart();?>)</a></li>
  </ul>
</nav>

<div id="popover" class="popover" style="width: 100vw; height: 100vw; display: none; background: rgba(0,0,0,0.8); position: absolute; top: 0; left: 0;">
  <div id="close" style="position: absolute; top: 0; left: 0; height: 44px; width: 44px; background: white;">X</div>    
  <? 
      include VIEWSPATH.'pages'.DIRECTORY_SEPARATOR.'cart.php'  // Controller Probleme 
  ?>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function(){
    var btnCartPage = document.getElementById('cart');
    var btnPopoverClose = document.getElementById('close');
    if(btnCartPage)
    {
      btnCartPage.addEventListener('click', function(event){
        event.preventDefault();

        var elmPopover = document.getElementById('popover');
        elmPopover.style.display = 'block';
      });
    }

    if(btnCartPage)
    {
      btnPopoverClose.addEventListener('click', function(){
        event.preventDefault();

        var elmPopover = document.getElementById('popover');
        elmPopover.style.display = 'none';
      });
    }

  });
</script>