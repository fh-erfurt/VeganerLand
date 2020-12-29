<?//@author Molham Al-Khodari, Jessica Eckardtsberg?>
<link rel="stylesheet" href="<?=STYLESPATH.'navbarStyle.css'?>">

<div class="block-container">
    <nav class="nav-container">
        <ul class="nav-list">
            <li><a href="?a=fruits"></a>Alle</li>
            <li><a href="?a=fruits&cat=citrus">Zitrus Früchte</a></li>
            <li><a href="?a=fruits&cat=berry">Beeren</a></li>
            <li><a href="?a=fruits&cat=nuts">Nüsse</a></li>
            <li><a href="?a=fruits&cat=exotics">Exotische Früchte</a></li>
        </ul>
    </nav>
    <ul class="cards">
        <? $counter = 0;
        while($counter < count($fruits)): ?>
            <li class="cards__item"> 
                <div class="col">
                    <div class="card">
                        <div class="card-title"><?=$fruits[$counter]['descrip']?></div>
                        <img class='ard__image card__image--fence' src="<?=FRUITPATH.$fruits[$counter]['descrip']?>.jpg" class="card-img-top" alt="Artikel">
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>
                            <hr>
                            <p><?=$fruits[$counter]['stdPrice']?></p>
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
