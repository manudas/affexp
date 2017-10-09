<?php

class Category extends ExtendedModel {

    public static $definition = array(
        'id' => array (
            'defaultValue' => null
        ),
        'id_parent' => array (
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
               'join_operation' => '=')
    );
}