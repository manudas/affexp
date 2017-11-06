<?php

class Product extends MY_Model {

    public static $definition = array(
        'primary' => 'id_product',
        'properties' => array (
            'id_product' => array (
                'defaultValue' => null
            ),
            'id_merchant' => array (
                'defaultValue' => null
            ),
            'external_id_product' => array(
                'defaultValue' => null
            ),
            'id_network' => array(
                'defaultValue' => null
            ),
            'active' => array (
                'defaultValue' => false
            )
        ),
        'lang_properties' => array (
            'name',
            'description'
        )
    );


    public static $joinable = array(
        array('join_with' => 'Merchant', 
               'own_join_attribute' => 'id_merchant',
               'foreign_join_attribute' => 'id_merchant',
               'join_operation' => '='),
        array('join_with' => 'Publication', 
               'own_join_attribute' => 'id_product',
               'foreign_join_attribute' => 'id_product',
               'join_operation' => '='),
        array('join_with' => 'Network',
            'own_join_attribute' => 'id_network',
            'foreign_join_attribute' => 'id_network',
            'join_operation' => '=')
    );    
}