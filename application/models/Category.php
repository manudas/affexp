<?php

class Category extends MY_Model {

    public static $definition = array(
        'primary' => 'id_category',
        'properties' => array (
            'id_category' => array (
                'defaultValue' => null
            ),
            'id_parent' => array (
                'defaultValue' => null
            ),
            'id_image_group' => array (
                'defaultValue' => null
            ),
            'active' => array (
                'defaultValue' => false
            )
        )
    );
    public static $joinable = array(
        array('join_with' => 'Category', 
               'own_join_attribute' => 'id_category',
               'foreign_join_attribute' => 'id_category',
               'join_operation' => '='),
        array('join_with' => 'ImageGroup',
            'own_join_attribute' => 'id_image_group',
            'foreign_join_attribute' => 'id_image_group',
            'join_operation' => '='
        /*
        ,
            'AND' => array(
                'own_join_attribute' => '"category"',
                'foreign_join_attribute' => 'type',
                'join_operation' => '=',
            )
        */
        )
    );
}