<?
    // @author Jessica Eckardtsberg, @author Molham Al-khodari
?>

<div class="block-container">
    <?
    for ($idx = 0; $idx < count($products); $idx++) 
    {
        for ($prodidx = 0; $prodidx < count($products[$idx]); $prodidx++)
        { ?>
            <li class="cards__item"> 
                <div class="col">
                    <div class="card">
                        <div class="card-title"><?=strtr($products[$idx][$prodidx]["descrip"],"_"," ")?></div>
                        <img class='ard__image card__image--fence' src="<?=IMAGEPATH.$products[$idx][$prodidx]["descrip"]?>.jpg" class="card-img-top" alt="Artikel">
                        <div class="card__text">
                            <p><? echo strtr($products[$idx][$prodidx]["comment"],"_"," ")?></p> <!--wird später aus dem datenbank gelesen-->
                            <hr>
                            <p><?=$products[$idx][$prodidx]['stdPrice']?></p>
                        </div>

                        <div class="card-footer">
                        <?
                        if (!empty($_SESSION['email']))
                        { ?>
                        <form class="card-footer" method="post">
                            <button class="btn btn--block card__btn" name="fav" type="submit" value="<?=$products[$idx][$prodidx]['prodId']?>">Favorit</button>
                            <button class="btn btn--block card__btn" name="submit" type="submit" value="<?=$products[$idx][$prodidx]['descrip']?>">In den Warenkorb</button>
                            <input name="qty" type="number">
                        </form>
                        <? } ?>
                        </div>
                    </div>
                </div>
            </li>
          <?
        }
    }?>
</div>
