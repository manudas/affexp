<?php

class Association extends MY_Model {

    public static $definition = array(
        'primary' => 'id_association',
        'properties' => array (
            'id_association' => array (
                'defaultValue' => null
            ),
            'type' => array (
                'type' => 'enum',
                'values' => array('destiny','publication', 'others'), // to be expanded
                'defaultValue' => 'others'
            ),
            'id_association' => array (
                'defaultValue' => null
            ),
            'active' => array (
                'defaultValue' => false
            )
        )
    );
    public static $joinable = array(
        array('join_with' => 'Publication', 
               'own_join_attribute' => 'id_association',
               'foreign_join_attribute' => 'id_publication',
               'join_operation' => '='),
        array('join_with' => 'Destiny', 
               'own_join_attribute' => 'id_association',
               'foreign_join_attribute' => 'id_destiny',
               'join_operation' => '=')
    );
}