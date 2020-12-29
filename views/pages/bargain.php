<?
// @author Jessica Eckardtsberg
?>

<div class="block-container">
    <ul class="cards">
        <? $counter = 0;
        while($counter < count($bargain)): 
            if ($bargain[$counter]['cat'] === 'V' || $bargain[$counter]['cat'] === 'P' || $bargain[$counter]['cat'] === 'M') {
                $name = VEGETABLEPATH;
            } else {
                $name = FRUITPATH;
            }?>
            <li class="cards__item"> 
                <div class="col">
                    <div class="card">
                        <div class="card-title"><?=$bargain[$counter]['descrip']?></div>
                        <img class='ard__image card__image--fence' src="<?=$name.$bargain[$counter]['descrip']?>.jpg" class="card-img-top" alt="Artikel">
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>
                            <hr>
                            <p><?=$bargain[$counter]['stdPrice']?></p>
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