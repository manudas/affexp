<?php

class Category extends ExtendedModel {

    public static $definition = array(
        'id' => array (
            'defaultValue' => null
        ),
        'id_parent' => array (
            'defaultValue' => null
        ),
        'active' => array (
            'defaultValue' => false
        )
    );

}