<?php

class Program extends MY_Model {

    public static $definition = array(
        'primary' => 'id_program',
        'properties' => array (
            'id_program' => array (
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
        )
    );
    public static $joinable = array(
        array('join_with' => 'Network', 
               'own_join_attribute' => 'id_network',
               'foreign_join_attribute' => 'id_network',
               'join_operation' => '='),
        array('join_with' => 'Merchant', 
               'own_join_attribute' => 'id_merchant',
               'foreign_join_attribute' => 'id_merchant',
               'join_operation' => '='),
        array('join_with' => 'Publication', 
               'own_join_attribute' => 'id_program',
               'foreign_join_attribute' => 'id_program',
               'join_operation' => '=')
    );    
}