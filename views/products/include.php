<?
/*
================================
== @author Molham Al-khodari
== @author Jessica Eckardtsberg
================================ 
*/
?>

<div>

    <div class="filter">
        <form method="post" id="form">
            <h3>Filter</h3>

                <label for="bio">Bio</label>
                <input class="form-control" type="checkbox" name="bio" id="bio" value="bio" />

                <label for="regional">Regional</label>
                <input class="form-control" type="checkbox" name="regional" id="regional" value="regional" />

                <label for="price">price</label>
                <input class="form-control" type="text" name="price" id="price" placeholder="mindest price" />

                <label for="weight">Wähle ein Gewicht:</label>
                <select class="form-control" name="weight" id="weight">
                    <option value="">-</option>
                    <option value="Stück">Stück</option>
                    <option value="100g">100g</option>
                    <option value="250g">250g</option>
                    <option value="500g">500g</option>
                    <option value="1kg">1kg</option>
                </select>

                <input class="submitFilter" type="submit" name="submitFilter" formaction="?c=products&a=filter" value="Filtern">

        </form>
    </div>

    <div class="block-container" id="products">
        <?
        for ($idx = 0; $idx < count($products); $idx++) 
        {
            for ($prodidx = 0; $prodidx < count($products[$idx]); $prodidx++)
            { ?>
                <li class="cards"> 
                    <div class="col">
                        <div class="card">
                            <div class="card-title"><?=strtr($products[$idx][$prodidx]["descrip"],"_"," ")?></div>
                            <img class="card-image" src="<?=FRUITPATH.$products[$idx][$prodidx]["descrip"]?>.jpg" class="card-img-top" alt="Artikel">
                            <div class="card-text">
                                <p><? echo "&nbsp;" . strtr($products[$idx][$prodidx]["comment"],"_"," ")?></p>
                                <hr>
                                <p><span class="price"><?="&nbsp" . $products[$idx][$prodidx]['stdPrice'] . " €"?> </span></p>
                            </div>

                            <div class="card-footer">
                                <?
                                if (!empty($_SESSION['email']))
                                { ?>
                                <form class = "card-footer" method="post" id = "<?=$products[$idx][$prodidx]['prodId']?>_Fav">
                                    <button class="btn" onclick="sendProductData(event, '<?=$products[$idx][$prodidx]['prodId']?>_Fav')" id="fav" name="fav" type="submit" value="<?=$products[$idx][$prodidx]['prodId']?>">Favorit</button>
                                    <input class="form-input" type="hidden" name = "fav" value="<?=$products[$idx][$prodidx]['prodId']?>">
                                </form>
                                <form class="card-footer" method="post" id="<?=$products[$idx][$prodidx]['prodId']?>_Cart">
                                    <button class="btn" onclick="sendProductData(event, '<?=$products[$idx][$prodidx]['prodId']?>_Cart')" id="submit" name="submit" type="submit" value="<?=$products[$idx][$prodidx]['prodId']?>">In den Warenkorb</button>
                                    <input type = "hidden" name = "submit" value = "<?=$products[$idx][$prodidx]['prodId']?>">
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
