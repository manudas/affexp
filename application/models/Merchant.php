<?php


class Merchant extends ExtendedModel {

    public static $definition = array(
        'id' => array (
            'defaultValue' => null
        ),
        'id_category' => array (
            'defaultValue' => null
        ),
        'name' => array (
            'defaultValue' => null
        ),
        'img' => array (
            'defaultValue' => null
        ),
        'url' => array (
            'defaultValue' => null
        )
        'active' => array (
            'defaultValue' => false
        )
    );
    public static $joinable = array(
        array('join_with' => 'Product', 
               'own_join_attribute' => 'id',
               'foreign_join_attribute' => 'id_merchant',
               'join_operation' => '='),
        array('join_with' => 'Program', 
               'own_join_attribute' => 'id',
               'foreign_join_attribute' => 'id_merchant',
               'join_operation' => '=')
    );
}