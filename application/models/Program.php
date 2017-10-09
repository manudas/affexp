<?php

class Program extends ExtendedModel {

    public static $definition = array(
        'id' => array (
            'defaultValue' => null
        ),
        'id_network' => array (
            'defaultValue' => null
        ),
        'id_merchant' => array (
            'defaultValue' => null
        ),
        'active' => array (
            'defaultValue' => false
        )
    );
    public static $joinable = array(
        array('join_with' => 'Network', 
               'own_join_attribute' => 'id_network',
               'foreign_join_attribute' => 'id',
               'join_operation' => '='),
        array('join_with' => 'Merchant', 
               'own_join_attribute' => 'id_merchant',
               'foreign_join_attribute' => 'id',
               'join_operation' => '='),
        array('join_with' => 'Publication', 
               'own_join_attribute' => 'id',
               'foreign_join_attribute' => 'id_program',
               'join_operation' => '=')
    );    
}