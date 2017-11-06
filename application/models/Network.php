<?php

class Network extends MY_Model {

    public static $definition = array(
        'primary' => 'id_network',
        'properties' => array (
            'id_network' => array (
                'defaultValue' => null
            ),
            'tag' => array (
                'defaultValue' => null
            ),
            'sync_encoded_struct' => array (
                'defaultValue' => null
            ),
            'sync_url' => array (
                'defaultValue' => null
            ),
            'active' => array (
                'defaultValue' => false
            )
        )
    );
    public static $joinable = array(
        array('join_with' => 'Program', 
               'own_join_attribute' => 'id_network',
               'foreign_join_attribute' => 'id_network',
               'join_operation' => '=')
    );

    public function initByTag($network_tag) {
        $filter = array(
            'tag' => $network_tag
        );
        $networkData = Network::getList($filter, 1);
        $this -> init ($networkData);

    }
}