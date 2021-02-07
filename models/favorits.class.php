<?php 

class Favorits extends BaseModel
{
    const TABLENAME = '`favorits`';

    protected $schema = [
        'prodId' => ['type' => BaseModel::TYPE_INT],
        'custID' => ['type' => BaseModel::TYPE_INT],
    ];

    static public function ItemsFavorits ()
    {
        if(isset($_SESSION['custId']))
        {
            $custId = $_SESSION['custId'];
            $sql = "SELECT COUNT(prodId) FROM favorits WHERE custId =".$custId;
            $favoritsResult = $GLOBALS['db']->query($sql);
            $favoritsItems = $favoritsResult->fetchColumn();
            
            return $favoritsItems;  // anzahl produkte im favorits list ;)
        }
    }

}
?>
