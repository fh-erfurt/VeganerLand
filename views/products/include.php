<?
/*
================================
== @author Molham Al-khodari
== @author Jessica Eckardtsberg
================================ 
*/
?>

<div>

    <div class="filter">    <!--start Filter-->
        <form method="post" id="form">
            <h3>Filter</h3> <!--title-->

                <!--inputs-->
                <label for="bio">Bio</label>
                <input class="form-control" type="checkbox" name="bio" id="bio" value="bio" />

                <label for="regional">Regional</label>
                <input class="form-control" type="checkbox" name="regional" id="regional" value="regional" />

                <label for="price">Preis</label>
                <input class="form-control" type="text" name="price" id="price" placeholder="max. Preis" />

                <label for="weight">Wähle ein Gewicht:</label>
                <select class="form-control" name="weight" id="weight">
                    <option value="">-</option>
                    <option value="Stück">Stück</option>
                    <option value="100g">100g</option>
                    <option value="150g">150g</option>
                    <option value="250g">250g</option>
                    <option value="500g">500g</option>
                    <option value="1kg">1kg</option>
                </select>

                <!--submit-->
                <input class="submitFilter" onclick="reload(event)" type="submit" name="submitFilter" formaction="?c=products&a=filter" value="Filtern">

        </form>
    </div>  <!--end Filter-->

    <div class="block-container" id="products"> <!--begin products-->
        <p id="alert"></p> <!--random <p>-tag for an alert message-->
        <?
        for ($idx = 0; $idx < count($products); $idx++) //for1 - needed because of the build from $products
        {
            for ($prodidx = 0; $prodidx < count($products[$idx]); $prodidx++) //for2 - star listing up the products
            { ?>
                <li class="cards"> 
                    <div class="col">
                        <div class="card">
                            <div class="card-title"><?=strtr($products[$idx][$prodidx]["descrip"],"_"," ")?></div> <!--name of the product*-->
                            <img class="card-image" src="<?=FRUITPATH.$products[$idx][$prodidx]["descrip"]?>.jpg" class="card-img-top" alt="Artikel"> <!--image of the product-->
                            <div class="card-text">
                                <p><? echo "&nbsp;" . strtr($products[$idx][$prodidx]["comment"],"_"," ")?></p> <!--comment on the products*-->
                                <hr>
                                <p><span class="price"><?="&nbsp" . $products[$idx][$prodidx]['stdPrice'] . " €"?> </span></p> <!--price of the product*-->
                            </div>
                            <!--*Directly dilivered from the database. The name of the image as well.-->

                            <div class="card-footer">
                                <?
                                if (!empty($_SESSION['email'])) // checks if the user is logged in
                                { ?>
                                <form class = "card-footer" method="post" id = "<?=$products[$idx][$prodidx]['prodId']?>_Fav"> <!--form for the favorit-button; gets id from teh database-->
                                    <button class="btn" onclick="sendProductData(event, '<?=$products[$idx][$prodidx]['prodId']?>_Fav')" id="fav" name="fav" type="submit" value="<?=$products[$idx][$prodidx]['prodId']?>">Favorit</button>
                                    <input class="form-input" type="hidden" name = "fav" value="<?=$products[$idx][$prodidx]['prodId']?>"> <!--repeats the value of the field for JS/AJAX-->
                                </form>
                                <form class="card-footer" method="post" id="<?=$products[$idx][$prodidx]['prodId']?>_Cart"> <!--form for the addToCart; gets the id from the database as well-->
                                    <button class="btn" onclick="sendProductData(event, '<?=$products[$idx][$prodidx]['prodId']?>_Cart')" id="addCart" name="addCart" type="submit" value="<?=$products[$idx][$prodidx]['prodId']?>">In den Warenkorb</button>
                                    <input type = "hidden" name = "addCart" value = "<?=$products[$idx][$prodidx]['prodId']?>"> <!--another extra field for JS/AJAX so that the form has a value-->
                                    <input  class="qty" id="qty" name="qty" type="number" min="1">
                                </form>
                                <? } ?> <!--end if-->
                            </div>
                        </div>
                    </div>
                </li>
              <?
            } //end for2
        }?> <!--end for1-->
    </div>

</div>
