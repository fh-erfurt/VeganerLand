<?php 
    // Molham Alkhodari
    // 19.12.2020
    // 00:00 Uhr

    $pageTitle = 'Obst';
    require_once '../../assets/statics/navbar.php';
    require_once '../../assets/statics/header.php';
    require_once '../../config/database.php';

    // $sql = "SELECT prodId, descrip, cat, stdPrice FROM products WHERE cat = 'V'";

    // $result = $db->query($sql);
?>

    <!-- <div class="block-container">
        <ul class="cards">
            <?php // while($row = $result->fetch()): ?>
            <li class="cards__item"> 

                <div class="col">
                    <?php // include 'vegetablesCard.php'?>
                </div>
            </li>
            <?php // endwhile; ?>
        </ul>
    </div> -->

<div class="block-container">
    <ul class="cards">
        <? $counter = 0;
        while($counter < count($veggies)): ?>
            <li class="cards__item"> 
                <div class="col">
                    <div class="card">
                        <div class="card-title"><?=$veggies[$counter]['descrip']?></div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="http://placekitten.com/271/180" class="card-img-top" alt="Artikal">   <!--Static Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen-->
                            <hr>
                            <p><?=$veggies[$counter]['stdPrice']?></p>                                                                <!--wird aus dem datenbank gelesen-->
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
