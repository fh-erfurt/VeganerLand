<?php 

class Category extends BaseModel
{
    const TABLENAME = '`category`';

    protected $schema = [
        'catId'     => ['type' => BaseModel::TYPE_INT],
        'descrip'   => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45],
        'name'      => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45], 
    ];

    public static function getCategoryName($mainCat) //$mainCat is either 'fruits' or 'vegetables'
    {
        $list = Category::find("descrip LIKE '$mainCat%'"); //Finds the relevant information in the database.
        $result = array();
        for ($idx = 0; $idx < count($list); $idx++)
        {
            //Pushes the name and the last part of the description in $results.
            array_push($result, array($list[$idx]['name'], ltrim(strpbrk($list[$idx]['descrip'],"_"),"_")));
        }

        return $result;
    }
}
?>
