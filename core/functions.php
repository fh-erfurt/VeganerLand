<?php 

    // Title Function that echo the page Title in case the page
    echo 'Function <br>';
    
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