<?php 

class Category extends BaseModel
{
    const TABLENAME = '`category`';

    protected $schema = [
        'catId'     => ['type' => BaseModel::TYPE_INT],
        'descrip'   => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45],
        'name'      => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45], 
    ];

    public static function getCategoryName($mainCat)
    {
        $list = Category::find("descrip LIKE '$mainCat%'");
        $result = array();
        for ($idx = 0; $idx < count($list); $idx++)
        {
            array_push($result, array($list[$idx]['name'], ltrim(strpbrk($list[$idx]['descrip'],"_"),"_")));
        }

        return $result;
    }
}
?>