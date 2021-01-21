<div class="block-container">
    <table>
        <tr>
            <th>Produkt</th>
            <th>Anzahl</th>
            <th>Preis</th>
        </tr>
        <? for ($idx = 0; $idx < count($cart); $idx++) { ?>
        <tr>
            <td><? echo ucfirst($prodInfo[$idx][0]['descrip']) ?></td>
            <td><? echo $cart[$idx]['qyt'] ?></td>
            <td><? echo $price[$idx]." €"; ?></td>
        </tr>
            <?        
        }?>
        <tr>
            <th>Gesamt:</th>
            <td colspan="2" style="text-align: right;"><? echo $ttprice." €" ?></td>
        </tr>
    </table>
</div>