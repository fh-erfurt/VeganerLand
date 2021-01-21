<div class="block-container">
    <table>
        <tr>
            <th>Produkt</th>
            <th>Anzahl</th>
            <th>Preis</th>
            <td></td>
        </tr>
        <? for ($idx = 0; $idx < count($cart); $idx++) { ?>
        <tr>
            <td><? echo ucfirst($prodInfo[$idx][0]['descrip']) ?></td>
            <td><? echo $cart[$idx]['qyt'] ?></td>
            <td><? echo $price[$idx]." €"; ?></td>
            <td><form method = "post"><button name="delete" type="submit" value="<?=$cart[$idx]['itemId']?>">X</button></form></td>
        </tr>
            <?        
        }?>
        <tr>
            <th>Gesamt:</th>
            <td colspan="2" style="text-align: right;"><? echo $ttprice." €" ?></td>
            <td></td>
        </tr>
    </table>
</div>
