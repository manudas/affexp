<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 12/10/17
 * Time: 21:30
 */
class Configurations extends MY_Model {

    public static $definition = array(
        'id' => array (
            'defaultValue' => null
        ),
        'model_name' => array (
            'defaultValue' => null
        ),
        'function_name' => array (
            'defaultValue' => null
        ),
        'configuration_key' => array (
            'defaultValue' => null
        ),
        'configuration_value' => array (
            'defaultValue' => null
        ),
        'active' => array (
            'defaultValue' => false
        )
    );
}
