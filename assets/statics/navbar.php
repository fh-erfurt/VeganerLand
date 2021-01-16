<link rel="stylesheet" href="<?=STYLESPATH.'navbarStyle.css'?>">

<script
  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
  integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
  crossorigin="anonymous">
</script>
<script>

$(function() {
    $(".toggle").on("click", function() {
        if ($(".item").hasClass("active")) {
            $(".item").removeClass("active");
        } else {
            $(".item").addClass("active");
        }
    });
});
</script>

</head>
<nav class="fixed">
    <ul class="menu">
        <li class="logo"><a href="?c=pages&a=homepage">VeganerLand</a></li>
        <li class="item"><a href="?c=pages&a=homepage">Startseite</a></li>
        <li class="item"><a href="?c=pages&a=about">Über uns</a></li>
        <li class="item"><a href="?c=pages&a=bargain">Angeboten</a></li>
        <li class="dropdown item"><a href="?c=pages&a=fruits">Obst</a>
        <div class="dropdown-content">
          <a href="?c=pages&a=fruits">Alle</a>
          <a href="?c=pages&a=fruits&cat=citrus">Zitrus Früchte</a>
          <a href="?c=pages&a=fruits&cat=berry">Beeren</a>
          <a href="?c=pages&a=fruits&cat=nuts">Nüsse</a>
          <a href="?c=pages&a=fruits&cat=exotics">Exotische Früchte</a>
        </div>
      </li>
      <li class="dropdown item"><a href="?c=pages&a=vegetables">Gemüse</a>
        <div class="dropdown-content">
          <a href="?c=pages&a=vegetables">Alle</a>
          <a href="?c=pages&a=vegetables&cat=potato">Kartoffeln</a>
          <a href="?c=pages&a=vegetables&cat=mushroom">Pilze</a>
        </div>
      </li>
        </li>
        <!-- searchform -->
        <li class="item">
          <div class="search-container">
            <form name="search" method="post">
              <input type="text" name="search" placeholder="Suche" maxlength="50">
              <button type="submit" name="submit" formaction="?c=pages&a=search">Suchen</button>
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
        <li class="item button secondary"><a href="#">Warenkorb</a></li>
        <li class="toggle"><span class="bars"></span></li>
    </ul>
</nav>
