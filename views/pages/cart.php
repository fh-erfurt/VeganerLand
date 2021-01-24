<div class="block-container">
    <?
    if (!empty($cart) && !$itemSend) { ?>
    <table>
        <tr>
            <th>Produkt</th>
            <th>Anzahl</th>
            <th>Preis</th>
            <td></td>
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
        <tr>
            <th>Gesamt:</th>
            <td colspan="2" style="text-align: right;"><? echo $ttprice." €" ?></td>
            <td></td>
        </tr>
    </table>
    <form method = "post"><button name="send" type="submit">Versenden</button></form>
    <? } else if (!empty($cart) && $itemSend) { ?>
    Bitte geben sie die gewünschte Adresse ein.
    <form name="DeliveryAddress" method="post">
        <input class="form-input" id="street" type="text" name="street" placeholder="Straße" value="<?=$addressInfo[0]['street'] ?? htmlspecialchars($_POST['street'] ?? '')?>" >
        <input class="form-input" id="number" type="number" name="number" placeholder="Hausnummer" value="<?=$addressInfo[0]['number'] ?? htmlspecialchars($_POST['number'] ?? '')?>" > <br>
                     
        <input class="form-input" id="zip" type="text" name="zip" placeholder="ZIP" value="<?=$addressInfo[0]['zip'] ?? htmlspecialchars($_POST['zip'] ?? '')?>">
        <input class="form-input" id="city" type="text" name="city" placeholder="Stadt" value="<?=$addressInfo[0]['city'] ?? htmlspecialchars($_POST['city'] ?? '')?>"><br>
        <button class="sign-up" type="submit" name="address"> Senden </button> 
    </form>
    <? } else {
        echo "Warenkorb ist leer.";
    }?>
</div>
