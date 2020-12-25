<?php 
    // Molham Alkhodari
    // 25.12.2020

    session_start();
    $pageTitle = 'Obst';
    require_once '../../assets/statics/navbar.php';
    require_once '../../assets/statics/header.php';
    require_once '../../config/database.php';

    // $sql = "SELECT prodId, descrip, cat, stdPrice FROM products WHERE cat = 'F'";

    // $result = $db->query($sql);

    // $cartItems=0;

    // $custId = random_int(0, time());

    // if(isset($_COOKIE['cartId']))
    // {
    //     $custId = (int) $_COOKIE['cartId'];
    // }

    // if(isset($_SESSION['custId']))
    // {
    //     $custId = (int) $_SESSION['custId'];
    // }

    // setcookie('custId', $custId, strtotime('+30 days'));   // random custId soll 30 tage lange bleiben, es funktioniert aber nicht!
    // var_dump($custId);                                      // muss gelöscht
    // var_dump($_SERVER['REQUEST_URI']);                      // muss gelöscht

    // $url = $_SERVER['REQUEST_URI'];
    // $indexPHPPosition = strpos($url, 'fruit.php');
    // $route = substr($url, $indexPHPPosition);
    // $route = str_replace('/project/views/pages/fruit.php', '',$route);

    // if (strpos($route, '/cart/add/') !== false) 
    // {
    //     $routeParts = explode('/', $route);
    //     $prodId = (int) $routeParts[3];
    //     $sql = "INSERT INTO cart SET custId = :custId, prodId = :prodId";
    //     $stmt = $db->prepare($sql);
        
    //     $stmt->execute([':custId' => $custId, ':prodId' => $prodId]);
        
    //     header("Location: ../../views/pages/fruit.php");
    //     exit();
    // }

    // $sql = "SELECT COUNT(id) FROM cart WHERE custId =".$custId;
    // $cartResult = $db->query($sql);

    // $cartItems = $cartResult->fetchColumn();
?>

    <div class="block-container">
        <ul class="cards">
            <div class="col">
                <li class="cards__item"> 
                    <div class ="card">
                        <div class="card-title">Apfel</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/apfel-rot.jpg" class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Apricots</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/apricots.jpg" class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Banana</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/banana.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">blueberries</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/blueberries.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">cherries</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/cherries.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Birnen</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/birne.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Orangen</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/orangen.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Strawberry</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/strawberry.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Ananas</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/ananas.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Apfel-grün</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/apfel-grün.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Clementine</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/clementine.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Granatäpfel</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/granatäpfel.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Grapefruit</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/grapefruit.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Himbeere</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/himbeere.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Kaki</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/kaki.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Kiwi</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/kiwi.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Mango</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/mango.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">trauben-dunkel</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/trauben-dunkel.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">trauben-hell</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/trauben-hell.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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
                        <div class="card-title">Wassermelone</div>  <!--wird aus datenbank gelesen-->
                        <img class='ard__image card__image--fence' src="../../assets/images/fruits/wassermelone.jpg"   class="card-img-top" alt="Artikal">   <!--Statics Bilder-->
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