<!-- 
================================
== Molham Al-khodari 
== Jessica Eckardtsberg 
== Mahmoud Matar
================================
-->

<div class="con">
        <form class="form-horizontal" method="post">
                <header class="head-form"> <!--some text-->
                        <h2>Konto bearbeiten</h2>
                        <p>Geben Sie einfach Ihre neuen Daten ein.</p>
                        <p>(Adresse und Telefonnummer sind nicht notwendig.)</p>
                </header>

                <div class="field-set"> <!--inputs-->
                        <input class="form-input" type="hidden" name = "custId" value="<?php echo $customerInfo['custId']; ?>" />
                        <input class="form-input" type="hidden" name = "addressId" value="<?php echo $customerInfo['addressId']; ?>" />


                        <div class="form-group">
                                <label class="label">Email</label>
                                <input class="form-input" id="email" type="text" name="email" value="<?echo $customerInfo['email']?>" required>
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Passwort</label>
                                <input class="form-input" type ="hidden" name="oldPassword" value="<?php echo $customerInfo['password']; ?>">
                                <input class="form-input" id="password" type="password" name="newPassword">
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Telefonnummer</label>
                                <input class="form-input" type="text" name="phone" value="<?echo $customerInfo['phone']?>">
                        </div>

                        <br>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Straße</label>
                                <input class="form-input" type="text" name="street" value="<?echo $customerInfo['street']?>">
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Hausnummer</label>
                                <input class="form-input" type="text" name="number" value="<?echo $customerInfo['number']?>">
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Postleitzahl</label>
                                <input class="form-input" type="text" name="zip" value="<?echo $customerInfo['zip']?>">
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Stadt</label>
                                <input class="form-input" type="text" name="city" value="<?echo $customerInfo['city']?>">
                        </div>

                </div>

                        <div> <!--submit-->
                                <button class="save" id="submit" type="submit" name="submit">Speichern</button>
                        </div>
        </form>

        <!-- start favotit list in setting -->

        <div class="favorit-list">
                <h3>Favoritlist (<?echo Favorits::ItemsFavorits();?>)</h3>
                <table class="table-favorit">
                        <tr>
                                <th></th>
                                <th>Produkt</th>
                                <th>Preis</th>
                        </tr>
                        <? for ($idx = 0; $idx < count($prodInfo); $idx++) { ?> <!--start for-->
                        <tr>
                                <td><form method = "post"><button name="delete" type="submit" value="<?=$prodInfo[$idx][0]['prodId']?>">X</button></form></td>
                                <td><?=ucfirst(strtr($prodInfo[$idx][0]['descrip'],"_"," "))?></td>
                                <td><? echo $prodInfo[$idx][0]['stdPrice']." €"; ?></td>
                                <td>
                                        <form method = "post">
                                                <input  class="qty" id="qty" name="qty" type="number" min="1">
                                                <button name="toCart" type="submit" value="<?=$prodInfo[$idx][0]['prodId']?>">In den Warenkorb</button>
                                        </form>
                                </td>
                        </tr>
                        <? } ?> <!--end for-->
                </table>
        </div>
</div>
