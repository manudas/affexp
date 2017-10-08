<?php

class Network extends ExtendedModel {

    public static $definition = array(
        'id' => array (
            'defaultValue' => null
        ),
        'tag' => array (
            'defaultValue' => null
        ),
        'active' => array (
            'defaultValue' => false
        )
    );
    public static $joinable = array(
        array('join_with' => 'Program', 
               'own_join_attribute' => 'id',
               'foreign_join_attribute' => 'id_network',
               'join_operation' => '=')
    );
}