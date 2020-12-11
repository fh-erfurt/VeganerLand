<?php 

class Bike extends BaseModel
{
    const TABLENAME = '`orders`';

    protected $schema = [
        'orderId'   => ['type' => BaseModel::TYPE_INT],
        'itemldId'  => ['type' => BaseModel::TYPE_INT],
        'custId'    => ['type' => BaseModel::TYPE_INT],
        'orderDate' => ['type' => BaseModel::TYPE_STRING], 
        'shipDate'  => ['type' => BaseModel::TYPE_STRING],
        'addressId' => ['type' => BaseModel::TYPE_INT]
        
    ];

}
?>