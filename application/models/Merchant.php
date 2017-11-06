<?php


class Merchant extends MY_Model {

    public static $definition = array(
        'primary' => 'id_merchant',
        'properties' => array (
            'id_merchant' => array (
                'defaultValue' => null
            ),
            'id_category' => array (
                'defaultValue' => null
            ),
            'name' => array (
                'defaultValue' => null
            ),
            'id_image_group' => array (
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
               'own_join_attribute' => 'id_merchant',
               'foreign_join_attribute' => 'id_merchant',
               'join_operation' => '='),
        array('join_with' => 'Program', 
               'own_join_attribute' => 'id_merchant',
               'foreign_join_attribute' => 'id_merchant',
               'join_operation' => '='),
        array('join_with' => 'Category',
                'own_join_attribute' => 'id_category',
                'foreign_join_attribute' => 'id_category',
                'join_operation' => '='),
        array('join_with' => 'ImageGroup',
                'own_join_attribute' => 'id_image_group',
                'foreign_join_attribute' => 'id_image_group',
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