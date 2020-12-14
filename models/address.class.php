<?php 

class Address extends BaseModel
{
    const TABLENAME = '`address`';

    protected $schema = [
        'addressId' => ['type' => BaseModel::TYPE_INT],
        'street'    => ['type' => BaseModel::TYPE_STRING],
        'number'    => ['type' => BaseModel::TYPE_STRING], 
        'zip'       => ['type' => BaseModel::TYPE_STRING, 'min' => 5, 'max' => 5],
        'city'      => ['type' => BaseModel::TYPE_STRING]
        
    ];

}
?>