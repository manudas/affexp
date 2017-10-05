<?php

class ExtendedModel extends CI_Model {

    /* array in the following format:
        array (
            'propertyname1' => array ('defaultValue' => ..., ...),
            ...
        )
    */
    protected static $definition = array();
    protected static $table = null;

    public function __construct($param) {
        parent::__construct();

        if (!defined(get_class().'_model_table')){
            define(get_class().'_model_table', 
                isset(self::$table) ? self::$table : strtolower(get_class()));
        }

        if (!empty($param)){
            $this -> setDefaultValues();
            $this -> buildObject($param);
        }
    }

    private function setDefaultValues(){
        foreach (self::$definition as $nameProperty => $propertyArray){
            $this -> {$nameProperty} = $propertyArray['defaultValue'];
        }
    }

    private function buildObject($param){
        if (is_array($param)) {
            $this -> buildObjectFromArray($param);
        }
        else if (is_integer($param)) {
            $this -> buildObjectFromID($param);
        }
    }

    private function buildObjectFromArray($params){
        foreach ($params as $param_key => $param_value) {
            $this -> {$param_key} = $param_value;
        } 
    }

    private function buildObjectFromID($id){
        $this -> db -> select ( '*' );
        $this -> db -> from ( constant(get_class().'_model_table') );
        $this -> db -> where ( 'id' , $id );
        $query = $this -> db -> get();
        $this -> buildObjectFromArray ( $query );
    }

    public function save(){
        if (!empty($this -> id)) {
            $this -> update();
        }
        else {
            $this -> add();
        }
    }

    private function add(){
        $this -> db -> set($this);
        $this -> db -> insert( constant(get_class().'_model_table') );
    }

    private function update(){
        $this -> db -> set($this);
        $this -> db -> update( constant(get_class().'_model_table') );
    }
}