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
            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">aubergine</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/aubergine.jpg" class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">blumenkohl</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/blumenkohl.jpg" class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">broccoli</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/broccoli.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">fenchel</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/fenchel.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">gurke</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/gurke.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">ingwer</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/ingwer.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">karotten</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/karotten.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">kartoffel</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/kartoffel.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">knoblauch</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/knoblauch.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">kohlrabi</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/kohlrabi.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">lauchzwiebeln</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/lauchzwiebeln.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">paprika</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/paprika.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">porree</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/porree.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">radieschen</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/radieschen.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">salat</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/salat.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">süßkartoffel</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/süßkartoffel.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">tomaten</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/tomaten.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">zucchini</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/zucchini.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">zwiebeln</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/zwiebelnhell.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>

            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">champignons</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/vegetables/champignons.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>                     <!--wird aus dem datenbank gelesen,wir haben noch kein spalte!-->
                            <hr>
                            <p>1.99$</p>                                                                <!--wird aus dem datenbank gelesen-->
                        </div>
                        <div class="card-footer">
                            <a href="#"><button class="btn btn--block card__btn">details</button></a>
                            <a href="#"><button class="btn btn--block card__btn">In den Warenkorb</button></a>
                        </div>
                    </div>
                </li>
            </div>
        </ul>
    </div>