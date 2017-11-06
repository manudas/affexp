<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 11/10/17
 * Time: 23:10
 */

class Views extends MY_Model {

    public static $definition = array(
        'primary' => 'id_view',
        'properties' => array (
            'id_view' => array (
                'defaultValue' => null
            ),
            'model_name' => array (
                'defaultValue' => null
            ),
            'function_name' => array (
                'defaultValue' => null
            ),
            'view_name' => array (
                'defaultValue' => null
            ),
            'order' => array (
                'defaultValue' => 0
            ),
            'active' => array (
                'defaultValue' => false
            )
        )
    );
}