<?

//@author Jessica Eckardtsberg
//@version 1.0.0

class Controller {
    protected $controller = null; // Stores the name of the controller.
    protected $action = null; // Stores the action the controller takes.
    protected $currentUser = null; // Stores the currently logged in User.

    protected $params = []; // Array that stores params for view rendering.

    public function __construct($controller, $action) {
        $this->controller = $controller; // Gives the passed over informations to the
                                         // class var $controller.
        $this->action = $action;         //Does the same as the above but with the action.

        if ($this->loggedIn()) {
            // Copies the custId from the login to the $currentUser.
            $this->currentUser = $_SESSION['userId'];
        }
    }

    public function loggedIn() {
        return (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true);
    }

    public function render() {

        $viewPath = VIEWSPATH.$this->controller.DIRECTORY_SEPARATOR.$this->action.'.php';
        
        if (!file_exists($viewPath)) {
            // This should lead to an Error-Page.
            die('404 Diese Seite existiert nicht.');
        }

        // Gets all param(eters) in order to create the view.
        extract($this->params);

        // $viewPath is the path for the page that needs to be called.
        include $viewPath;
    }

    // This function gives the data in $value to the array params with the position
    // being $key.
    protected function setParam($key, $value = null) {
        $this->params[$key] = $value;
    }

    public function __destruct() {
        $this->controller = null;
        $this->action = null;
        $this->params = null;
    }
}

?>