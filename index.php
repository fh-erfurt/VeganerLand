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

// I'm not sure if this is right.
if (file_exists(CONTROLLERSPATH.$controllerName.'Controller.php')) {
    require_once CONTROLLERSPATH.$controllerName.'Controller.php';

    $className = ucfirst($controllerName).'Controller';
    $controller = new $className($controllerName, $actionName); //Error!!

    $actionMethod = 'action'.ucfirst($actionName);
    if (!method_exists($controller, $actionMethod)) {
        // Fehlermeldung.
        die('404 Method you called does not exist.');
    } else {
        $controller->{$actionMethod}();
    }
} else {
    //Fehlermeldung
    die('404 Controller you called does not exist.');
}

switch ($actionName) {
    case 'fruits':
        $pageTitle = 'Obst';
        break;
    case 'vegetables':
        $pageTitle = 'Gemüse';
        break;
    case 'bargain':
        $pageTitle = 'Angebote';
        break;
    case 'login':
        $pageTitle = 'Login';
        break;
    case 'registration':
        $pageTitle = 'Sign Up';
        break;
    case 'setting':
        $pageTitle = 'Einstellungen';
        break;
    case 'resetPassword':
        $pageTitle = 'Passwort zurücksetzen';
        break;
    case 'about':
        $pageTitle = 'Über Uns';
        break;
    default:
        $pageTitle = 'Homepage';
}
?>

<?
    $pageTitle = 'Homepage';
    require_once TEMPLATESPATH.'header.php';
    require_once TEMPLATESPATH.'navbar.php';

    $controller->render();

?>
        <section>
            <?if (isset($error)) : ?>
            <div class="error">
                <?=$error?>
            </div>
            <?endif;?>
        </section>
    </body>
</html>
