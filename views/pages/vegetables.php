<?php 
    // Molham Alkhodari
    // 19.12.2020
    // 00:00 Uhr

    $pageTitle = 'Obst';
    require_once '../../assets/statics/navbar.php';
    require_once '../../assets/statics/header.php';
    require_once '../../config/database.php';

    $sql = "SELECT prodId, descrip, cat, stdPrice FROM products WHERE cat = 'V'";

    $result = $db->query($sql);
?>

    <div class="block-container">
        <ul class="cards">
            <?php while($row = $result->fetch()): ?>
            <li class="cards__item"> 

                <div class="col">
                    <?php include 'vegetablesCard.php'?>
                </div>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>