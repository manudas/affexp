<?php

class Publication extends ExtendedModel {

    public static $definition = array(
        'id' => array (
            'defaultValue' => null
        ),
        'id_product' => array (
            'defaultValue' => null
        ),
        'type' => array (
            'type' => 'enum',
            'values' => array('offer','coupon'),
            'defaultValue' => 'offer'
        ),
        'discount_code' => array (
            'defaultValue' => null
        ),
        'discount' => array (
            'defaultValue' => null
        ),
        'discount_type' => array (
            'type' => 'enum',
            'values' => array('percentage','amount'),
            'defaultValue' => 'amount'
        ),
        'id_program' => array (
            'defaultValue' => null
        ),
        'url' => array (
            'defaultValue' => null
        ),
        'active' => array (
            'defaultValue' => false
        )
    );

    public static $joinable = array(
        array('join_with' => 'Product', 
               'own_join_attribute' => 'id_product',
               'foreign_join_attribute' => 'id',
               'join_operation' => '='),
        array('join_with' => 'Program', 
               'own_join_attribute' => 'id_program',
               'foreign_join_attribute' => 'id',
               'join_operation' => '=')
    ); 

}