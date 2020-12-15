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
                                                WHERE eMail = ? ");
            $request->execute(array($email)); 

            if($request->rowCount() > 0){
                return false;
            }
            else{
                return true;
            }
        }
