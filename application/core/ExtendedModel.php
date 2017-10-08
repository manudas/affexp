<?php

class ExtendedModel extends CI_Model {

    public static $model_table = __CLASS__;

    /* array in the following format:
        array (
            'propertyname1' => array ('defaultValue' => 'amount',  // default value, can be null or whatever allowed value  
                                        'type' => 'enum', // or whatever
                                        'values' => array('percentage','amount'), // if enum
                                        ...),
            ...
        )
    */
    protected static $definition = array();
    

    /* array in the following format:
        array('join_with' => 'Publication', 
               'own_join_attribute' => 'id_association',
               'foreign_join_attribute' => 'id',
               'join_operation' => '='),
        array('join_with' => 'Destiny', 
               'own_join_attribute' => 'id_association',
               'foreign_join_attribute' => 'id',
               'join_operation' => '=')
        ...       
    */
    protected static $joinable = array();

    public function __construct($param, $table = __CLASS__) {
        parent::__construct();
              
        if (!empty($table)) {
            static::$model_table = $table;
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

        $this -> db -> from ( strtolower(static::$model_table) );

        $this -> db -> where ( 'id' , $id );
        $query_result = $this -> db -> get() -> result_array();
        $this -> buildObjectFromArray ( $query_result );
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
        $this -> db -> insert( strtolower(static::$model_table) );
    }

    private function update(){
        $this -> db -> set($this);
        $this -> db -> update( strtolower(static::$model_table) );
    }

    public static function getList($filter = null, $limit = null, $offset = 0, $order_by = null, $ordenation = 'ASC', $table = __CLASS__){
                
        if (!empty($table)) {
            static::$model_table = $table;
        }
  
        $this -> db -> select ( '*' );
        $this -> db -> where ( $filter );
		$this -> db -> limit ( $limit, $offset );
        $this -> db -> from ( strtolower(static::$model_table) );
        $this -> db -> order_by ( $order_by, $ordenation );
        $query_result = $this -> db -> get() -> result_array();
        return $query_result;
    }

    public static function getObjectList($filter = null, $limit = null, $offset = 0, $order_by = null, $ordenation = 'ASC', $table = __CLASS__){
        $object_list = array();
        $results = self::getList($filter, $limit, $offset, $order_by, $ordenation, $table);
        foreach ($results as $result) {
            $current_class = get_class();
            $object_list[] = new $current_class($result);
        }
        return $object_list;
    }

    /**
    * @param $list_of_joined_classes multidimensional array in the following format:
    *                                      - key: next class to be joined with the
    *                                               current class
    *                                      - value: array of sub list of joined 
    *                                               classes in the same format.
    *                                               Empty or null if no sub list
    */
    public function getAllJoinedData($list_of_joined_classes, $limit = null, $offset = 0, $order_by = null, $ordenation = 'ASC', $join_type = null){
        $join_clausules = static::getJoinClausules($list_of_joined_classes);
        
        $this -> db -> select ( '*' );
        $this -> db -> where ( 'a0.id = ' . $this -> id );
		$this -> db -> limit ( $limit, $offset );
        $this -> db -> from ( strtolower(static::$model_table) . ' as a0');
        $this -> db -> order_by ( $order_by, $ordenation );

        if (!empty($join_clausules)) {
            for ($i = 0; $i < count($join_clausules); $i++){
/*
                $join_clausule_list[] = array('aliased_own_table' => $own_table,
                            'aliased_foreign_table' => $foreign_table, 
                            'aliased_own_join_attribute' => $own_alias.'.'.$current_joinable['own_join_attribute'],
                            'aliased_foreign_join_attribute' => $foreign_alias.'.'.$current_joinable['foreign_join_attribute'],
                            'join_operation' => $current_joinable['join_operation']);
*/
                $join_clausule = $join_clausules[$i];
                if (!empty($join_type)) {
                    $this->db->join($join_clausule['aliased_foreign_table'], 
                                        $join_clausule['aliased_own_join_attribute'] .
                                         ' ' . 
                                         $join_clausule['join_operation'] .
                                         ' ' .
                                         $join_clausule['aliased_foreign_join_attribute'],
                                         $join_type
                                    );
                }
                else {
                    $this->db->join($join_clausule['aliased_foreign_table'], 
                                        $join_clausule['aliased_own_join_attribute'] .
                                         ' ' . 
                                         $join_clausule['join_operation'] .
                                         ' ' .
                                         $join_clausule['aliased_foreign_join_attribute']
                                    );
                }
            }
        }
        return $this -> db -> get() -> result_array();
    }

    private static function getJoinClausules($list_of_joined_classes, $current_alias = 0, $table = __CLASS__){

        if (!empty($table)) {
            static::$model_table = $table;
        }
        
        $join_clausule_list = array();
        
        $current_joinable_set = self::$joinable;
        
        $array_iterator = new RecursiveArrayIterator($list_of_joined_classes);
        $tree_iterator = new RecursiveTreeIterator($array_iterator);
        
        foreach( $tree_iterator as $class_to_join => $sub_joined_array ){
            $is_joinable = false;
            foreach ( $current_joinable_set as $current_joinable ) {
                if ( strtolower($current_joinable['join_with']) == strtolower($class_to_join) ){
                    $is_joinable = true;
                    break;
                }
            }

            if (!$is_joinable) {
                throw RuntimeException('The class '.get_class().' is not joinable with '. $class_to_join);
            }
            else {
                
                $own_alias = 'a'. ( $current_alias );
                $foreign_alias = 'a'. ( $current_alias + 1 );
                
                $operation = $current_joinable['join_operation'];
                $own_table = static::$model_table . ' as ' . $own_alias;
                $foreign_table = $class_to_join::$model_table . ' as ' . $foreign_alias;

                $join_clausule_list[] = array('aliased_own_table' => $own_table,
                                            'aliased_foreign_table' => $foreign_table, 
                                            'aliased_own_join_attribute' => $own_alias.'.'.$current_joinable['own_join_attribute'],
                                            'aliased_foreign_join_attribute' => $foreign_alias.'.'.$current_joinable['foreign_join_attribute'],
                                            'join_operation' => $current_joinable['join_operation']);
                
                if (!empty($sub_joined_array)) {
                    $inner_join_clausules = $class_to_join::getAllJoinedData($list_of_joined_classes, $current_alias +1, strtolower($class_to_join));
                    $join_clausule_list = array_merge($join_clausule_list, $inner_join_clausules);
                    $current_alias += count($inner_join_clausules);
                }
                
                $current_alias++;
            }
        }
    }

    public function getFinalJoinedData($list_of_joined_classes);

    public function getFinalJoinedObjects($list_of_joined_classes);

}