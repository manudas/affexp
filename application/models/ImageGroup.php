<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 27/10/17
 * Time: 0:03
 */


class ImageGroup extends MY_Model {

    public static $definition = array(
        'id' => array (
            'defaultValue' => null
        ),
        'type' => array (
            'type' => 'enum',
            'values' => array('merchant','publication', 'category', 'other'),
            'defaultValue' => 'other'
        ),
        'active' => array (
            'defaultValue' => false
        )
    );

    public static $joinable = array(
        array('join_with' => 'Image',
            'own_join_attribute' => 'id',
            'foreign_join_attribute' => 'id_image_group',
            'join_operation' => '=')
    );

}