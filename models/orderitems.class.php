<?php 

class orderItems extends BaseModel
{
    const TABLENAME = '`orderitems`';

    protected $schema = [
        'itemId'   => ['type' => BaseModel::TYPE_INT],
        'prodId'  => ['type' => BaseModel::TYPE_INT],
        'qyt'    => ['type' => BaseModel::TYPE_INT]
        
    ];

}
?>