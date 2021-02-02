<?php 

/*
================================
== Molham Al-khodari 26.12.2020
================================
*/

        /*
        ** Title Function that echo the page Title in case the page
        ** has the Variable $pageTitle and echo defult Title for other pages
        */
        
        function getTitle() 
        {
            global $pageTitle;

            if(isset($pageTitle))
            {
                echo $pageTitle;
            }
            else
            {
                echo 'Default Title';
            }
        }

        /*
        ** Returns a true if a there are not Registered Users with that email
        */

        function isEmailAvailable( $db, $email) {
            $request =  $GLOBALS['db']->prepare(" SELECT * 
                                                FROM customers 
                                                WHERE email = ? ");
            $request->execute(array($email)); 

            if($request->rowCount() > 0){
                return false;
            }
            else{
                return true;
            }
        }

                /*
        ** Returns true if the password is safe 
        */

        function isPasswordSafe ( $candidate ) {
            $r1='/[A-Z]/';  //Uppercase
            $r2='/[a-z]/';  //lowercase
            $r3='/[!@#$%^&*()\-_=+{};:,<.>]/';  //special char
            $r4='/[0-9]/';  //numbers
            
            if(preg_match_all($r1,$candidate, $o) < 1) return false;
            
            if(preg_match_all($r2,$candidate, $o) < 1) return false;
            
            if(preg_match_all($r3,$candidate, $o) < 1) return false;
            
            if(preg_match_all($r4,$candidate, $o) < 1) return false;
            
            if(strlen($candidate) < 8) return false;
            
            return true;
        }

        /*
        ** Home Redirect Function v2.0
        ** This Function Accept Parameters
        ** $theMessage = Echo this Message [Error | Success]
        ** $url = the Link you want to redirect to
        ** $seconds = Seconds befor Redirecting
        */

        function redirectHome($theMessage, $url = null, $seconds = 3)
        {
            if ($url === null) 
            {
                $url = '?c=pages&a=homepage';
                $link = 'Homepage';
            }
            else {
                if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '')
                {
                    $url = $_SERVER['HTTP_REFERER'];
                    $link = 'Previous Page';
                }
                else {
                    $url = '?c=pages&a=homepage';
                    $link = 'Homepage'; 
                }
            }
            echo $theMessage;
            echo "<div class = 'alert alert-info'>You will be Redirected to $link After $seconds Seconds</div>";

            header("refresh:$seconds;url=$url");
            exit();
        }

        /*
        =========================================================================
        == redirect is good to leave the page with the wrong action or controller
        =========================================================================
        */

        function redirect($url)
        {
            header('Location: '.$url);
            exit(0);
        }

        function doesEmailExists($email) {
            $result = Customers::find("email = '$email'", Customers::tableName());
            return (!empty($result)) ? true : false;
        }

        /*
        ============================================================
        == generateRandomString gemacht für Tocken (Forgot Password)
        ============================================================
        */

        function generateRandomString($length = 10) 
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        /*
        ============================================================
        == generateRandomString gemacht für Tocken (Forgot Password)
        ============================================================
        */

        function viewError($errorMessage)
        {
            echo "<div class='alert alert-danger'>$errorMessage</div>"; 
        }