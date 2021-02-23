<?php 

class Products extends BaseModel
{
    const TABLENAME = '`products`';

    protected $schema = [
        'prodId'    => ['type' => BaseModel::TYPE_INT],
        'descrip'   => ['type' => BaseModel::TYPE_STRING],
        'cat'       => ['type' => BaseModel::TYPE_STRING], 
        'stdPrice'  => ['type' => BaseModel::TYPE_FLOAT],
    ];

    // Deleting and adding products from the favorite list and shoping cart would be used in different controllers
    
    public static function addToCart()
    {
        if (isset($_SESSION['custId'])) // user should be logged in first
        {
            $idC = $_SESSION['custId'];
            if (isset($_POST['addCart'])) // user put a product into cart
            {
                if (!empty($_POST['qty'])) // Number is necessary
                {
                    $item = $_POST['addCart'];
                    $itemdata = self::find("prodId = '$item'");
                    $qty = $_POST['qty'];
                    $check = OrderItems::find("custId = '$idC' AND prodId = '$item' AND qyt = '$qty'");
                    if (empty($check)) // if the products are not in database table cart -> insert
                    {
                        try 
                        {
                            $sql = "INSERT INTO ". OrderItems::tableName() . " (custId, prodId, qyt) VALUES ('$idC', '$item', '$qty')";
                            $stmt = $GLOBALS['db']->prepare($sql);
                            $stmt->execute();
                        } 
                        catch (\PDOException $e) 
                        {
                            viewError("Bestellung fehlgeschlagen.");
                            echo 'Update fehlgeschlagen: ' . $e->getMessage();
                        }
                    }
                    else // // if the products are in database table cart -> update
                    {
                        $idI = $check[0]['itemId'];
                        try 
                        {
                            $sql = "UPDATE " . OrderItems::tableName() . " SET isSend = 'f' WHERE itemId = $idI;";
                            $stmt = $GLOBALS['db']->prepare($sql);
                            $stmt->execute();
                        } 
                        catch (\PDOException $e) {
                            viewError("Bestellung fehlgeschlagen.");
                            echo 'Update fehlgeschlagen: ' . $e->getMessage();
                        }
                    }
                } 
                else 
                {
                    viewError("Bitte gib die gewünschte Menge an!");
                }
            } 
        } 
    }
    
    public static function removeFromCart()
    {
        if (isset($_POST['delete'])) // check if the user wants to delete a product from cart
        {
            $id = $_POST['delete']; 
            $check = Orders::find("itemId = '$id'");

            if (empty($check))
            {
                $sql1 = "DELETE FROM " . OrderItems::tableName() . " WHERE itemId = $id";
                $stmt = $GLOBALS['db']->prepare($sql1);
                $stmt->execute();
            }
            else
            {
                $sql2 = "UPDATE " . OrderItems::tableName() . " SET isSend = 't' WHERE itemId = $id;";
                $stmt = $GLOBALS['db']->prepare($sql2);
                $stmt->execute();
            }
        }
    }

    public static function addToFavorites()
    {
        if (!empty($_POST['fav'])) 
        {
            if (isset($_SESSION['custId'])) 
            {
                $idP = $_POST['fav'];
                $idC = $_SESSION['custId'];

                $check = Favorits::find("prodId = '$idP' AND custID = '$idC'");
                if (empty($check)) 
                {
                    try 
                    {
                        $sql = "INSERT INTO " . Favorits::tableName() . "(prodId, custId) VALUES ('$idP', '$idC')";
                        $stmt = $GLOBALS['db']->prepare($sql);
                        $stmt->execute();
                    } 
                    catch (\PDOException $e) 
                    {
                        viewError("Fehlgeschlag.");
                        echo 'Update fehlgeschlagen: ' . $e->getMessage();
                    }
                } 
                else 
                {
                    viewError("Dieses Produkt ist bereits in den Favoriten eingetragen.");
                }
            } 
            else 
            {
                    viewError("Sie sind nicht angemeldet!");
            }
        }
    }
  
    public static function removeFromfavorits()
    {
        if (isset($_POST['delete'])) 
        {
            $id = $_POST['delete'];

            $sql = "DELETE FROM " . Favorits::tableName() . " WHERE prodId = $id";
            $stmt = $GLOBALS['db']->prepare($sql);
            $stmt->execute();
        }
    }
}
?>
