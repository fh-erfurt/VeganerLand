<?php 
<?php 
// Molham Alkhodari, Jessica Eckardtsberg
// 27.12.2020
// 00:00 Uhr

/*$pageTitle = 'Obst';
require_once TEMPLATESPATH.'header.php';
require_once TEMPLATESPATH.'navbar.php';
require_once CONFIGPATH.'database.php';*/
?>

<div class="block-container">
    <ul class="cards">
        <? $counter = 0;
        while($counter < count($fruits)): ?>
            <li class="cards__item"> 
                <div class="col">
                    <div class="card">
                        <div class="card-title"><?=$fruits[$counter]['descrip']?></div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="http://placekitten.com/271/180" class="card-img-top" alt="Artikal">   <!--Static Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen-->
                            <hr>
                            <p><?=$fruits[$counter]['stdPrice']?></p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <button class="btn btn--block card__btn">details</button>
                            <button class="btn btn--block card__btn">In den Warenkorb</button>
                        </div>
                    </div>
                </div>
            </li>
        <?  $counter++;
        endwhile; ?>
    </ul>
</div>

    // $sql = "SELECT prodId, descrip, cat, stdPrice FROM products WHERE cat = 'F'";

    // $result = $db->query($sql);

    // $cartItems=0;

    // $custId = random_int(0, time());

    // if(isset($_COOKIE['cartId']))
    // {
    //     $custId = (int) $_COOKIE['cartId'];
    // }

    // if(isset($_SESSION['custId']))
    // {
    //     $custId = (int) $_SESSION['custId'];
    // }

    // setcookie('custId', $custId, strtotime('+30 days'));   // random custId soll 30 tage lange bleiben, es funktioniert aber nicht!
    // var_dump($custId);                                      // muss gelöscht
    // var_dump($_SERVER['REQUEST_URI']);                      // muss gelöscht

    // $url = $_SERVER['REQUEST_URI'];
    // $indexPHPPosition = strpos($url, 'fruit.php');
    // $route = substr($url, $indexPHPPosition);
    // $route = str_replace('/project/views/pages/fruit.php', '',$route);

    // if (strpos($route, '/cart/add/') !== false) 
    // {
    //     $routeParts = explode('/', $route);
    //     $prodId = (int) $routeParts[3];
    //     $sql = "INSERT INTO cart SET custId = :custId, prodId = :prodId";
    //     $stmt = $db->prepare($sql);
        
    //     $stmt->execute([':custId' => $custId, ':prodId' => $prodId]);
        
    //     header("Location: ../../views/pages/fruit.php");
    //     exit();
    // }

    // $sql = "SELECT COUNT(id) FROM cart WHERE custId =".$custId;
    // $cartResult = $db->query($sql);

    // $cartItems = $cartResult->fetchColumn();
?>
