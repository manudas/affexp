<?php

class Product extends CI_Model {

    public static $definition = array(
        'id' => array (
            'defaultValue' => null
        ),
        'active' => array (
            'defaultValue' => false
        )
    );
    
}