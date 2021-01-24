<? 

// @author Molham Al-Kodari, @author Jessica Eckardtsberg
// @version 1.0.0

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

session_start();

// Default values for controller and action.
$controllerName = 'pages';
$actionName = 'homepage';

if (isset($_GET['c'])) {
    $controllerName = $_GET['c'];
}
if (isset($_GET['a'])) {
    $actionName = $_GET['a'];
}

if (file_exists(CONTROLLERSPATH.$controllerName.'Controller.php')) {
    require_once CONTROLLERSPATH.$controllerName.'Controller.php';

    $className = ucfirst($controllerName).'Controller';
    $controller = new $className($controllerName, $actionName);

    $actionMethod = 'action'.ucfirst($actionName);
    if (!method_exists($controller, $actionMethod)) {
        // Fehlermeldung.
        // redirect to error page 404 because not found
        redirect('index.php?c=errors&a=error404&error=nonaction');
    } else {
        $controller->{$actionMethod}();
    }
} else {
    //Fehlermeldung
    // redirect to error page 404 because not found
    redirect('index.php?c=errors&a=error404&error=nocontroller');
}

switch ($actionName) {
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
<head>
</head>
<body>
    <?
        $controller->render();
    ?>
    <section>
        <?if (isset($error)) : ?>
        <div class="error">
            <?=$error?>
        </div>
        <?endif;?>
    </section>
    <?
    if($pageTitle != 'Login' and $pageTitle != 'Sing Up' and $pageTitle != 'Passwort zurücksetzen') 
    {
        require_once TEMPLATESPATH.'footer.php';
    }
    ?>
</body>
</html>
