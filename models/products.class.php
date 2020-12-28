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

}
?>
