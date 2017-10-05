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
        'active' => array (
            'defaultValue' => false
        )
    );
    
}