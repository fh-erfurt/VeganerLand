<? 
    /*
    ================================
    == Molham Al-khodari
    == Jessica Eckardtsberg 
    == Mahmoud Matar 
    ================================
    */

    // Load files from the config.
    require_once './config/init.php';
    require_once './config/database.php';

    // Load files from the core.
    require_once COREPATH.'functions.php';
    require_once COREPATH.'controller.class.php';

    // Load all created models.
    require_once MODELSPATH.'baseModel.class.php';
    require_once MODELSPATH.'address.class.php';
    require_once MODELSPATH.'customers.class.php';
    require_once MODELSPATH.'orderitems.class.php';
    require_once MODELSPATH.'orders.class.php';
    require_once MODELSPATH.'products.class.php';
    require_once MODELSPATH.'favorits.class.php';
    require_once MODELSPATH.'category.class.php';

    session_start();

    // Default values for controller and action.
    $controllerName = isset($_GET['c']) ? $_GET['c'] : 'pages';
    $actionName     = isset($_GET['a']) ? $_GET['a'] : 'homepage';

    if (file_exists(CONTROLLERSPATH.$controllerName.'Controller.php')) 
    {
        require_once CONTROLLERSPATH.$controllerName.'Controller.php';

        $className    = ucfirst($controllerName).'Controller';
        $controller   = new $className($controllerName, $actionName);
        $actionMethod = 'action'.ucfirst($actionName);

        if (!method_exists($controller, $actionMethod)) 
        { 
            redirect('index.php?c=errors&a=error404&error=nonaction'); // error, redirect to error page 404 because not found
        }
        else
        {
            $controller->{$actionMethod}();
        }
    }
    else 
    {        
        redirect('index.php?c=errors&a=error404&error=nocontroller');  // error, redirect to error page 404 because not found
    }

    if (isset($_GET['ajax']))
    {
        $ajax = $_GET['ajax'];
        switch ($ajax)
        {
            case (1):
                ProductsController::addToCart();
                break;
            case (2):
                ProductsController::addToFavorites();
                break;
        }
    }

    switch ($actionName) 
    {
        case 'contact':
            $pageTitle = 'Kontakt';
            require_once TEMPLATESPATH.'header.php';
            include TEMPLATESPATH.'navbar.php';
            break;
        case 'error404':
            $pageTitle = '404';
            require_once TEMPLATESPATH.'header.php';
            include TEMPLATESPATH.'navbar.php';
            break;
        case 'fruits':
            $pageTitle = 'Obst';
            require_once TEMPLATESPATH.'header.php';
            include TEMPLATESPATH.'navbar.php';
            break;
        case 'vegetables':
            $pageTitle = 'Gemüse';
            require_once TEMPLATESPATH.'header.php';
            include TEMPLATESPATH.'navbar.php';
            break;
        case 'bargain':
            $pageTitle = 'Angebote';
            require_once TEMPLATESPATH.'header.php';
            include TEMPLATESPATH.'navbar.php';
            break;
        case 'login':
            $pageTitle = 'Login';
            require_once TEMPLATESPATH.'header.php';
            break;
        case 'registration':
            $pageTitle = 'Sing Up';
            require_once TEMPLATESPATH.'header.php';
            break;
        case 'setting':
            $pageTitle = 'Einstellungen';
            require_once TEMPLATESPATH.'header.php';
            include TEMPLATESPATH.'navbar.php';
            break;
        case 'resetPassword':
            $pageTitle = 'Passwort zurücksetzen';
            require_once TEMPLATESPATH.'header.php';
            break;
        case 'about':
            $pageTitle = 'Über uns';
            require_once TEMPLATESPATH.'header.php';
            break;
        case 'search':
            $pageTitle = 'Suchergebnisse';
            require_once TEMPLATESPATH.'header.php';
            include TEMPLATESPATH.'navbar.php';
            break;
        case 'filter':
            $pageTitle = 'Suchergebnisse';
            require_once TEMPLATESPATH.'header.php';
            include TEMPLATESPATH.'navbar.php';
            break;
        case 'cart':
            $pageTitle = 'Warenkorb';
            require_once TEMPLATESPATH.'header.php';
            include TEMPLATESPATH.'navbar.php';
            break;
        case 'logout':
            break;
        default:
            $pageTitle = 'Homepage';
            require_once TEMPLATESPATH.'header.php';
            include TEMPLATESPATH.'navbar.php';
            break;
    }

?>

<!DOCTYPE html>
<html>
    <body>
        <?
            $controller->render();
        ?>

        <!-- include footer on all pages except Login, Sing Up and reset Password -->
        <?
            if($pageTitle != 'Login' and $pageTitle != 'Sing Up' and $pageTitle != 'Passwort zurücksetzen') 
            {
                require_once TEMPLATESPATH.'footer.php';
            }
        ?>
    </body>
</html>
