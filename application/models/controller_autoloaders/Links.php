<?php
/**
 * Created by PhpStorm.
 * User: manuel.pulgar
 * Date: 13/10/17
 * Time: 10:28
 */

class Links extends MY_Model {

    public static $definition = array(
        'primary' => 'id_link',
        'properties' => array (
            'id_link' => array (
                'defaultValue' => null
            ),
            'name' => array (
                'defaultValue' => null
            ),
            'url' => array (
                'defaultValue' => null
            ),
            'category_token' => array (
                'defaultValue' => null
            ),
            'order' => array (
                'defaultValue' => 0
            ),
            'model_name' => array (
                'defaultValue' => null
            ),
            'function_name' => array (
                'defaultValue' => null
            ),
            'active' => array (
                'defaultValue' => false
            )
        )
    );

}