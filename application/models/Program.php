<?php

class Program extends CI_Model {

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

}