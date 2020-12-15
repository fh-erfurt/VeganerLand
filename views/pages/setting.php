<?php

session_start();

$pageTile='Einstellung';
include '../../config/init.php';
        if (isset($_SESSION['email']))
        {
                ?>
                        <title>Einstellung</title>
                        <link rel="stylesheet" href="../../assets/styles/settingStyle.css">
                        <h1>Mitglied bearbeiten</h1>
                        <div class="container">
                                <form clss="from-horizonta" action="">
                                        <!-- Start Email Field -->
                                        <div class="groub">
                                                <label class="label">Email</label>
                                                <div class="input">
                                                        <input type="text" name="email" class="form-control">
                                                </div>
                                        </div>
                                        <!-- End Email Field -->
                                        <!-- Start Password Field -->
                                        <div class="form-groub">
                                                <label class="col-sm-2 control-label">Password</label>
                                                <div class="col-sm-10">
                                                        <input type="password" name="password" class="form-control">
                                                </div>
                                        </div>
                                        <!-- End Password Field -->
                                        <!-- Start Phone Field -->
                                        <div class="form-groub">
                                                <label class="col-sm-2 control-label">Phone</label>
                                                <div class="col-sm-10">
                                                        <input type="text" name="phone" class="form-control">
                                                </div>
                                        </div>
                                        <!-- End Phone Field -->
                                        <!-- Start Street Field -->
                                        <div class="form-groub">
                                                <label class="col-sm-2 control-label">Straße</label>
                                                <div class="col-sm-10">
                                                        <input type="text" name="street" class="form-control">
                                                </div>
                                        </div>
                                        <!-- End Street Field -->
                                        <!-- Start Number Field -->
                                        <div class="form-groub">
                                                <label class="col-sm-2 control-label">Hausnummer</label>
                                                <div class="col-sm-10">
                                                        <input type="text" name="number" class="form-control">
                                                </div>
                                        </div>
                                        <!-- End Number Field -->
                                        <!-- Start ZIP Field -->
                                        <div class="form-groub">
                                                <label class="col-sm-2 control-label">zip</label>
                                                <div class="col-sm-10">
                                                        <input type="text" name="zip" class="form-control">
                                                </div>
                                        </div>
                                        <!-- End ZIP Field -->
                                        <!-- Start City Field -->
                                        <div class="form-groub">
                                                <label class="col-sm-2 control-label">Stadt</label>
                                                <div class="col-sm-10">
                                                        <input type="text" name="city" class="form-control">
                                                </div>
                                        </div>
                                        <!-- End City Field -->
                                        <div>
                                                <input type="submit" name="submit" value="Save" class="save">
                                        </div>

                                </form>
                        </div>




                <?php
            include '../../static/footer.php';
        }
        else
        {
                header('Location : homepage.php');
        }
