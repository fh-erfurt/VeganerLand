<?

/**
 * @author Molham Al khodari
 * @version 1.0.0
 */

class ErrorsController extends Controller
{

    public function actionError404()
    {
        $errorMessage = 'Unknown error, please check your code!';

        if(isset($_GET['error']))
        {
            switch($_GET['error'])
            {
                case 'nocontroller':
                    $errorMessage = 'Controller konnte nicht gefunden werden.';
                    break;
                case 'viewpath':
                    $errorMessage = 'View konnte nicht gefunden werden.';
                    break;
            }
        }

        // though the error message variable to the view, so we can show it to our customers
        $this->setParams('errorMessage', $errorMessage);
    }
}