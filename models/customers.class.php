<?php 

class Customers extends BaseModel
{
    const TABLENAME = '`customers`';

    protected $schema = [
        'custId'    => ['type' => BaseModel::TYPE_INT],
        'firstName' => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45],
        'lastName'  => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 45], 
        'email'     => ['type' => BaseModel::TYPE_STRING],
        'phone'     => ['type' => BaseModel::TYPE_STRING],
        'gender'    => ['type' => BaseModel::TYPE_STRING, 'min' => 1, 'max' => 1],
        'password'  => ['type' => BaseModel::TYPE_STRING],
        'addressId'   => ['type' => BaseModel::TYPE_INT]
        
    ];

}
?>