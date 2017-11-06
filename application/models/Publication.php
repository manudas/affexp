<?php

class Publication extends MY_Model {

    public static $definition = array(
        'primary' => 'id_publication',
        'properties' => array (
            'id_publication' => array (
                'defaultValue' => null
            ),
            'id_product' => array (
                'defaultValue' => null
            ),
            'price' => array(
                'defaultValue' => null
            ),
            'id_image_group' => array(
                'defaultValue' => null
            ),
            'type' => array (
                'type' => 'enum',
                'values' => array('offer','coupon', 'normal_sale', 'other'),
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
        )
    );

    public static $joinable = array(
        array('join_with' => 'Product', 
               'own_join_attribute' => 'id_product',
               'foreign_join_attribute' => 'id_product',
               'join_operation' => '='),
        array('join_with' => 'Program', 
               'own_join_attribute' => 'id_program',
               'foreign_join_attribute' => 'id_program',
               'join_operation' => '='),
        array('join_with' => 'ImageGroup',
            'own_join_attribute' => 'id_image_group',
            'foreign_join_attribute' => 'id_image_group',
            'join_operation' => '='
        /*
        ,
            'AND' => array(
                'own_join_attribute' => '"publication"',
                'foreign_join_attribute' => 'type',
                'join_operation' => '=',
            )
        */
        )
    ); 

}