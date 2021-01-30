<div class="block-container">
    <?
    if (!empty($cart) && !$itemSend) { ?>
    <table class="table-cart">
        <tr>
            <th>Produkt</th>
            <th>Anzahl</th>
            <th colspan="2">Preis</th>
        </tr>
        <? 
        for ($idx = 0; $idx < count($cart); $idx++) { ?>
        <tr>
            <td><? echo ucfirst($prodInfo[$idx][0]['descrip']) ?></td>
            <td><? echo $cart[$idx]['qyt'] ?></td>
            <td><? echo $price[$idx]." €"; ?></td>
            <td><form method = "post"><button name="delete" type="submit" value="<?=$cart[$idx]['itemId']?>">X</button></form></td>
        </tr>
            <?        
            }
        ?>
    </table>
    <br>
        <hr>
    <table class = "table-cart">
        <tr>
            <th>Gesamt:</th>
            <td style="text-align: center;"><? echo $ttprice." €" ?></td>
        </tr>
    </table>
    <form method = "post"><button class="send" name="send" type="submit">Versenden</button></form>
    <? } else if (!empty($cart) && $itemSend) { ?>

    <form name="DeliveryAddress" method="post">
        <header class="head-form">
            <h2>Adresse bearbeiten</h2>
            <p> Bitte geben sie die gewünschte Adresse ein.</p>
        </header>

        <div class="field-set">
            <div class="form-group">
                <label class="label">Straße</label>
                <input class="form-input" id="street" type="text" name="street" placeholder="Straße" value="<?=$addressInfo[0]['street'] ?? htmlspecialchars($_POST['street'] ?? '')?>" >
            </div>

            <div class="form-group">
                <label class="label">Hausnummer</label>
                <input class="form-input" id="number" type="number" name="number" placeholder="Hausnummer" value="<?=$addressInfo[0]['number'] ?? htmlspecialchars($_POST['number'] ?? '')?>" > <br>

            </div>
            
            <div class="form-group">
                <label class="label">zip</label>
                <input class="form-input" id="zip" type="text" name="zip" placeholder="ZIP" value="<?=$addressInfo[0]['zip'] ?? htmlspecialchars($_POST['zip'] ?? '')?>">
            </div>
        
            <div class="form-group">
                <label class="label">Stadt</label>
                <input class="form-input" id="city" type="text" name="city" placeholder="Stadt" value="<?=$addressInfo[0]['city'] ?? htmlspecialchars($_POST['city'] ?? '')?>"><br>
            </div>
        </div>
       
        <button class="send" type="submit" name="address"> Senden </button> 
    </form>
    <? } else {
        echo "Warenkorb ist leer.";
    }?>
</div>
