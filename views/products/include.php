<?
/*
================================
== @author Molham Al-khodari
== @author Jessica Eckardtsberg
================================ 
*/
?>

<div class="">

    <div class="filter">
        <form method="post">
            <h3>Filter</h3>

                <label for="bio">Bio</label>
                <input type="checkbox" name="bio" id="bio" value="bio" /> <br>

                <label for="regional">Regional</label>
                <input type="checkbox" name="regional" id="regional" value="regional" /> <br>

                <label for="price">price</label>
                <input type="text" name="price" id="price" placeholder="mindest price" /> <br>

                <label for="weight">Wähle ein Gewicht:</label>
                <select name="weight" id="weight">
                    <option value="Stück">Stück</option>
                    <option value="100g">100g</option>
                    <option value="250g">250g</option>
                    <option value="500g">500g</option>
                    <option value="1kg">1kg</option>
                </select> <br>

                <input type="submit" name="submitFilter" formaction="?c=products&a=filter">

        </form>
    </div>

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
                            <img class='ard__image card__image--fence' src="<?=FRUITPATH.$products[$idx][$prodidx]["descrip"]?>.jpg" class="card-img-top" alt="Artikel">
                            <div class="card__text">
                                <p><? echo strtr($products[$idx][$prodidx]["comment"],"_"," ")?></p>
                                <hr>
                                <p><?=$products[$idx][$prodidx]['stdPrice']?></p>
                            </div>

                            <div class="card-footer">
                            <?
                            if (!empty($_SESSION['email']))
                            { ?>
                            <form class="card-footer" method="post">
                                <button class="btn btn--block card__btn" name="fav" type="submit" value="<?=$products[$idx][$prodidx]['prodId']?>">Favorit</button>
                                <button class="btn btn--block card__btn" name="submit" type="submit" value="<?=$products[$idx][$prodidx]['prodId']?>">In den Warenkorb</button>
                                <label  class="qty" for="qty">Menge Eingeben!</label>
                                <input  class="qty" id="qty" name="qty" type="number" min="1">
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

</div>
