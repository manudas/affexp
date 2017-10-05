<?php

class Network extends CI_Model {

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

}