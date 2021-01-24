
<!-- @author Molham Al-khodari, @author Jessica Eckardtsberg -->

<div class="con">
        <form class="from-horizonta" method="post">
                <header class="head-form">
                        <h2>Mitglied bearbeiten</h2>
                        <p> bearbeite einfach deine Daten</p>
                </header>

                <div class="field-set">
                        <input class="form-input" type="hidden" name = "custId" value="<?php echo $customerInfo['custId']; ?>" />
                        <input class="form-input" type="hidden" name = "addressId" value="<?php echo $customerInfo['addressId']; ?>" />


                        <div class="form-group">
                                <label class="label">Email</label>
                                <input class="form-input" type="text" name="email" value="<?echo $customerInfo['email']?>">
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <input class="form-input" type ="hidden" name="oldPassword" value="<?php echo $customerInfo['password']; ?>">
                                <input class="form-input" type="password" name="newPassword">
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Phone</label>
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

                        <div>
                                <button class="save" type="submit" name="submit">Save</button>
                        </div>
        </form>
</div>
