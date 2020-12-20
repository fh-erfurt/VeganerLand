<?php 

// Molham Al-khodari
// 18.22.2020
// 18:50 Uhr

    require '../../config/database.php';

        // Title Function that echo the page Title in case the page
        
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

        // Returns a true if a there are not Registered Users with that email
        function isEmailAvailable ( $db, $email) {
            $request =  $db->prepare(" SELECT * 
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
                $url = '../../views/pages/homepage.php';
                $link = 'Homepage';
            }
            else {
                if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '')
                {
                    $url = $_SERVER['HTTP_REFERER'];
                    $link = 'Previous Page';
                }
                else {
                    $url = '../../views/pages/homepage.php';
                    $link = 'Homepage'; 
                }
            }
            echo $theMessage;
            echo "<div class = 'alert alert-info'>You will be Redirected to $link After $seconds Seconds</div>";

            header("refresh:$seconds;url=$url");
            exit();
        }

        function doesEmailExists($email) {
            $result = Customers::find('email', $email, self::tableName());
            return (!empty($result)) ? true : false;
        }

<<<<<<< Updated upstream
=======
<<<<<<< HEAD
        // Other possible check for unique E-Mail.
        function doesEmailExists ($email) {
            $result = Customers::find('email', $email, self::tableName());
            return (!empty($result)) ? true : false;
        }
=======
>>>>>>> Stashed changes
        // Returns true if the password is safe
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
<<<<<<< Updated upstream
=======
>>>>>>> 4f6cb271738fdeb4b14d4bbf28da77411d8162f2
>>>>>>> Stashed changes
