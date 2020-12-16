<?php 

class Customers extends BaseModel
{
    const TABLENAME = '`customers`';

    protected $schema = [
        'custId'    => ['type' => BaseModel::TYPE_INT],
        'firstName' => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45],
        'lastName'  => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45], 
        'phone'     => ['type' => BaseModel::TYPE_STRING],
        'email'     => ['type' => BaseModel::TYPE_STRING],
        'password'  => ['type' => BaseModel::TYPE_STRING],
        'addressId'   => ['type' => BaseModel::TYPE_INT]
        
    ];

}
?>