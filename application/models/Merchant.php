<?php


class Merchant extends MY_Model {

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
        'img_id_group' => array (
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
               'own_join_attribute' => 'id',
               'foreign_join_attribute' => 'id_merchant',
               'join_operation' => '='),
        array('join_with' => 'Program', 
               'own_join_attribute' => 'id',
               'foreign_join_attribute' => 'id_merchant',
               'join_operation' => '='),
        array('join_with' => 'Category',
                'own_join_attribute' => 'id_category',
                'foreign_join_attribute' => 'id',
                'join_operation' => '='),
        array('join_with' => 'ImageGroup',
                'own_join_attribute' => 'img_id_group',
                'foreign_join_attribute' => 'id',
                'join_operation' => '=',
                /*
                'AND' => array(
                    'own_join_attribute' => '"merchant"',
                    'foreign_join_attribute' => 'type',
                    'join_operation' => '=',
                )
                */
                )
    );
}