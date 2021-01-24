<?
    // @author Jessica Eckardtsberg, @author Molham Al-khodari

    $pages = isset($_GET['a']) ? $_GET['a'] : '';
?>

<div class="block-container">
    <ul class="cards">
        <? 
            $counter = 0;
            while($counter < count($$pages)): 

            if ($$pages[$counter]['cat'] === 'V' || $$pages[$counter]['cat'] === 'P' || $$pages[$counter]['cat'] === 'M') 
            {
                $name = VEGETABLEPATH;
            } 
            else
            {
                $name = FRUITPATH;
            }
        ?>
            <li class="cards__item"> 
                <div class="col">
                    <div class="card">
                        <div class="card-title"><?=$$pages[$counter]['descrip']?></div>
                        <img class='ard__image card__image--fence' src="<?=$name.$$pages[$counter]['descrip']?>.jpg" class="card-img-top" alt="Artikel">
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p> <!--wird später aus dem datenbank gelesen-->
                            <hr>
                            <p><?=$$pages[$counter]['stdPrice']?></p>
                        </div>

                        <div class="card-footer">
                        <form class="card-footer" method="post">
                            <button class="btn btn--block card__btn" name="fav" type="submit" value="<?=$$pages[$counter]['prodId']?>"><?echo $$pages[$counter]['prodId']?></button>
                            <button class="btn btn--block card__btn" name="submit" type="submit" value="<?=$$pages[$counter]['descrip']?>">In den Warenkorb</button>
                            <input name="qty" type="number">
                        </form>
                        </div>
                    </div>
                </div>
            </li>
        <?
            $counter++;
            endwhile; 
        ?>
    </ul>
</div>
