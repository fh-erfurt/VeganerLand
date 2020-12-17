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
$actionName = 'index';

if (isset($_GET['c'])) {
    $controllerName = $_GET['c'];
}
if (isset($_GET['a'])) {
    $actionName = $_GET['a'];
}

// I'm not sure if this is right.
if (file_exists(CONTROLLERSPATH.$controllerName.'pagesController.php')) {
    require_once CONTROLLERSPATH.$controllerName.'pagesController.php';

    $className = ucfirst($controllerName).'pagesController';
    $controller = new $className($controllerName, $actionName);

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

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?$title?></title>
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
    </body>
</html>
