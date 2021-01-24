<?php 

class Category extends BaseModel
{
    const TABLENAME = '`category`';

    protected $schema = [
        'catId'     => ['type' => BaseModel::TYPE_INT],
        'descrip'   => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45],
        'name'      => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45], 
    ];

}
?>