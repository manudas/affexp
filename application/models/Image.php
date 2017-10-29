<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 27/10/17
 * Time: 0:02
 */

class Image extends MY_Model {

    public static $definition = array(
        'id' => array (
            'defaultValue' => null
        ),
        'id_image_group' => array (
            'defaultValue' => null
        ),
        'uri' => array(
            'defaultValue' => null
        ),
        'description' => array (
            'defaultValue' => null
        ),
        'order' => array (
            'defaultValue' => 0
        ),
        'active' => array (
            'defaultValue' => false
        )
    );

    public static $joinable = array(
        array('join_with' => 'ImageGroup',
            'own_join_attribute' => 'id_image_group',
            'foreign_join_attribute' => 'id',
            'join_operation' => '=')
    );
}