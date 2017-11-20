<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 11/10/17
 * Time: 23:10
 */

class Libraries extends MY_Model {

    public static $definition = array(
        'primary' => 'id_model',
        'properties' => array (
            'id_library' => array (
                'defaultValue' => null
            ),
            'model_name' => array (
                'defaultValue' => null
            ),
            'function_name' => array (
                'defaultValue' => null
            ),
            'autoloaded_library_name' => array (
                'defaultValue' => null
            ),
            'active' => array (
                'defaultValue' => false
            )
        )
    );
}