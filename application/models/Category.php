<?php

class Category extends MY_Model {

    public static $definition = array(
        'id' => array (
            'defaultValue' => null
        ),
        'id_parent' => array (
            'defaultValue' => null
        ),
        'img_id_group' => array (
            'defaultValue' => null
        ),
        'active' => array (
            'defaultValue' => false
        )
    );
    public static $joinable = array(
        array('join_with' => 'Category', 
               'own_join_attribute' => 'id',
               'foreign_join_attribute' => 'id',
               'join_operation' => '='),
        array('join_with' => 'ImageGroup',
            'own_join_attribute' => 'img_id_group',
            'foreign_join_attribute' => 'id',
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