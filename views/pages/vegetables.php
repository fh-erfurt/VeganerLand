<?//@author Molham Al-Khodari, Jessica Eckardtsberg?>
<link rel="stylesheet" href="<?=STYLESPATH.'navbarStyle.css'?>">

<nav class="fruit-nav-container">
    <ul class="fruit-nav-list">
        <li><a href="?a=vegetables">Alle</a></li>
        <li><a href="?a=vegetables&cat=potato">Kartoffeln</a></li>
        <li><a href="?a=vegetables&cat=mushroom">Pilze</a></li>
    </ul>
</nav>
<div class="block-container">
    <ul class="cards">
        <? $counter = 0;
        while($counter < count($veggies)): ?>
            <li class="cards__item"> 
                <div class="col">
                    <div class="card">
                        <div class="card-title"><?=$veggies[$counter]['descrip']?></div>
                        <img class='ard__image card__image--fence' src="<?=VEGETABLEPATH.$veggies[$counter]['descrip']?>.jpg" class="card-img-top" alt="Artikel">
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>
                            <hr>
                            <p><?=$veggies[$counter]['stdPrice']?></p>
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
