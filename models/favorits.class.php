<?php 

class Favorits extends BaseModel
{
    const TABLENAME = '`favorits`';

    protected $schema = [
        'prodId' => ['type' => BaseModel::TYPE_INT],
        'custID' => ['type' => BaseModel::TYPE_INT],
    ];

}
?>