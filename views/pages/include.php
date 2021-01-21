<?php 

// $sql = "SELECT 	prodId, descrip, cat, stdPrice FROM products";

// $result = $GLOBALS['db']->query($sql);

// $GLOBALS['castId'] = 0;
// $GLOBALS['favoritItems'] = 0;

// if(strpos($route, '/favorit/add/')!== false)
// {
//     $routeParts = explode('/',$route);
//     $productId = (int)$routeParts[3];

//     $sql = "INSERT INTO favorits SET custId = :custId, prodId = :prodId";
//     $stmt = $GLOBALS['db']->prepare($sql);

//     $stmt->execute([
//         ':custId' => $GLOBALS['custId'],
//         ':prodId' => $productId
//     ]);

//     header("Location: c=pages&a=fruits");
//     exit();
     
// }

// $sql = "SELECT COUNT(prodId) FROM favorit WHERE custId = ".$GLOBALS['castId'];
// $favoritResult = $GLOBALS['db']->query($sql);

// $GLOBALS['favoritItems'] = $favoritResult->fetchColumn();

// echo "favorit:" . $GLOBALS['favoritItems'];

?>

<?
// @author Jessica Eckardtsberg
$pages = isset($_GET['a']) ? $_GET['a'] : '';
?>

<div class="block-container">
    <ul class="cards">
        <? $counter = 0;
        while($counter < count($$pages)): 
            if ($$pages[$counter]['cat'] === 'V' || $$pages[$counter]['cat'] === 'P' || $$pages[$counter]['cat'] === 'M') {
                $name = VEGETABLEPATH;
            } else {
                $name = FRUITPATH;
            }?>
            <li class="cards__item"> 
                <div class="col">
                    <div class="card">
                        <div class="card-title"><?=$$pages[$counter]['descrip']?></div>
                        <img class='ard__image card__image--fence' src="<?=$name.$$pages[$counter]['descrip']?>.jpg" class="card-img-top" alt="Artikel">
                        <div class="card__text">
                            <p>test product, hier eine tolle lange beschreibung</p>
                            <hr>
                            <p><?=$$pages[$counter]['stdPrice']?></p>
                        </div>
                        <div class="card-footer">
                        <form action="" method="POST">
                            <button class="btn btn--block card__btn" type="submit" name="submit" value="<?$$pages[$counter]['prodId']?>"><?echo $$pages[$counter]['prodId']?></button> <!-- zu den Favoriten hinzufügen -->
                            <button class="btn btn--block card__btn">In den Warenkorb</button>
                        </form>
                        </div>
                    </div>
                </div>
            </li>
        <?  $counter++;
        endwhile; ?>
    </ul>
</div>

<?php 
    if(isset($_POST['submit']))
    {
        $prodId = (int)$_POST['submit']; 
    
        if (isset($_SESSION['custId'])) {
            $castId  = $_SESSION['custId'];

            echo $prodId . ' prodId <br>';
            echo $castId . ' custId <br>';
        }
            
        //     try
        //     {
        //         $sql = "INSERT INTO favorits (prodId, custId) VALUES ('$prodId', '$castId')";
        //         // $sql = "INSERT INTO favorits SET custId = :custId, prodId = :prodId";
        //         // $stmt = $GLOBALS['db']->prepare($sql);

        //         // $stmt->execute([
        //         //              ':custId' => $GLOBALS['custId'],
        //         //              ':prodId' => $prodId
        //         //          ]);
        //         $stmt = $GLOBALS['db']->prepare($sql);
        //         $stmt->execute();

        //         // header("Location: c=pages&a=fruits");
        //         // exit();

        //     } catch (\PDOException $e) {
        //         echo '<div class="alert alert-danger">fehlgeschlagen db Fehler</div>';
        //         echo 'Update fehlgeschlagen: ' . $e->getMessage();
        //     }
        // } else{
        //     echo '<div class="alert alert-danger">fehlgeschlagen no custId</div>';
        // }

    }
    else
    {
        // nothing kann happening 
    }
?>