<?php 

// Molham Al-khodari
// 15.22.2020

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