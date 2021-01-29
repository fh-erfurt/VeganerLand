<?php 

class OrderItems extends BaseModel
{
    const TABLENAME = '`orderitems`';

    protected $schema = [
        'itemId'   => ['type' => BaseModel::TYPE_INT],
        'prodId'  => ['type' => BaseModel::TYPE_INT],
        'qyt'    => ['type' => BaseModel::TYPE_INT]
        
    ];

    static public function ItemsCart ()
    {
        if(isset($_SESSION['custId']))
        {
            $custId = $_SESSION['custId'];
            $sql = "SELECT COUNT(prodId) FROM orderitems WHERE custId =".$custId;
            $cartResult = $GLOBALS['db']->query($sql);
            $cartItems = $cartResult->fetchColumn();
            
            return $cartItems;  // anzahl produkte im cart ;)
        }
    }
}
?>