<?php 

// Molham Al-khodari
// 18.22.2020
// 18:50 Uhr

    require '../../config/database.php';

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
                $url = VIEWSPATH.'/pages/homepage.php';
                $link = 'Homepage';
            }
            else {
                if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '')
                {
                    $url = $_SERVER['HTTP_REFERER'];
                    $link = 'Previous Page';
                }
                else {
                    $url = VIEWSPATH.'pages/homepage.php';
                    $link = 'Homepage'; 
                }
            }
            echo $theMessage;
            echo "<div class = 'alert alert-info'>You will be Redirected to $link After $seconds Seconds</div>";

            header("refresh:$seconds;url=$url");
            exit();
        }

        function doesEmailExists($email) {
            $result = Customers::find('email', $email, Customers::tableName());
            return (!empty($result)) ? true : false;
        }
