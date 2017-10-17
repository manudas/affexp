<?php

class MY_Model extends CI_Model {

    protected static $model_table_arr = array();

    public static function getModelTable() {
        if (!empty(self::$model_table_arr[static::class])) {
            return self::$model_table_arr[static::class];
        }
        else {
            return strtolower(static::class);
        }
    }
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

    public function __construct($param = null, $table = null) {
        parent::__construct();
            
        if (!empty($table)) {
            self::$model_table_arr[static::class] = strtolower($table);
        }
        else {
            self::$model_table_arr[static::class] = strtolower(static::class);
        }

        if (!empty($param)) {
            $this -> setData($param);
        }
        else {
            $this -> setDefaultValues();
        }

    }

    public function setData($params = null) {
        if (!empty($params)){
            $this -> setDefaultValues();
            $this -> buildObject($params);
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

        $this -> db -> from ( self::getModelTable() );

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
        $this -> db -> insert( self::getModelTable() );
    }

    private function update(){
        $this -> db -> set($this);
        $this -> db -> update( self::getModelTable() );
    }

    public static function getList($filter = null, $limit = null, $offset = 0, $order_by = null, $ordenation = 'ASC', $table = null){
                
        if (!empty($table)) {
            self::$model_table_arr[static::class] = strtolower($table);
        }

        $instance = &get_instance();

        $instance -> db -> select ( '*' );
        $instance -> db -> where ( $filter );
        $instance -> db -> limit ( $limit, $offset );
        $instance -> db -> from ( self::getModelTable() );
        $instance -> db -> order_by ( $order_by, $ordenation );
        $query_result = $instance -> db -> get() -> result_array();
        return $query_result;
    }

    public static function getObjectList($filter = null, $limit = null, $offset = 0, $order_by = null, $ordenation = 'ASC', $table = null){
        $object_list = array();
        $results = self::getList($filter, $limit, $offset, $order_by, $ordenation, $table);
        foreach ($results as $result) {
            $current_class = static::class;
            $object_list[] = new $current_class($result);
        }
        return $object_list;
    }

    private function makeJoins($join_clausules, $join_type) {
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
                                         $join_clausule['join_type']
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
    }

    /**
    * @param $list_of_joined_classes multidimensional array in the following format:
    *                                      - key: next class to be joined with the
    *                                               current class
    *                                      - value: array of:
    *                                                - 'join_type': type of join
    *                                                - 'sub_list': array of sub list of joined 
    *                                               classes in the same format.
    *                                               Empty or null if no sub list
    */
    public function getAllJoinedData($list_of_joined_classes, $limit = null, $offset = 0, $order_by = null, $ordenation = 'ASC'){
        $join_clausules = static::getJoinClausules($list_of_joined_classes);
        
        $this -> db -> select ( '*' );
        $this -> db -> where ( 'a0.id = ' . $this -> id );
		$this -> db -> limit ( $limit, $offset );
        $this -> db -> from ( self::getModelTable() . ' as a0');
        $this -> db -> order_by ( $order_by, $ordenation );


        $this -> makeJoins($join_clausules);
        
        return $this -> db -> get() -> result_array();
    }



    /**
    * @param $list_of_joined_classes multidimensional array in the following format:
    *                                      - key: next class to be joined with the
    *                                               current class
    *                                      - value: array of:
    *                                                - 'join_type': type of join
    *                                                - 'sub_list': array of sub list of joined 
    *                                               classes in the same format.
    *                                               Empty or null if no sub list
    */
    private static function getJoinClausules($list_of_joined_classes, $current_alias = 0, $table = null){

        if (!empty($table)) {
            $model_table_arr[static::class] = strtolower($table);
        }
        
        $join_clausule_list = array();
        
        $current_joinable_set = self::$joinable;
        
        $array_iterator = new RecursiveArrayIterator($list_of_joined_classes);
        //$tree_iterator = new RecursiveTreeIterator($array_iterator);
        
        foreach( $array_iterator as $class_to_join => $joined_attributes ){
            $is_joinable = false;
            foreach ( $current_joinable_set as $current_joinable ) {
                if ( strtolower($current_joinable['join_with']) == strtolower($class_to_join) ){
                    $is_joinable = true;
                    break;
                }
            }

            if (!$is_joinable) {
                $error_string = 'The class '.get_class().' is not joinable with '. $class_to_join;
                log_message('error', $error_string);
                show_error($error_string, 500); // returns error 500
                throw RuntimeException($error_string);
            }
            else {
                
                $own_alias = 'a'. ( $current_alias );
                $foreign_alias = 'a'. ( $current_alias + 1 );
                
                $operation = $current_joinable['join_operation'];
                $own_table = self::getModelTable() . ' as ' . $own_alias;
                $foreign_table = $class_to_join::getModelTable() . ' as ' . $foreign_alias;

                $current_joining_data = array('aliased_own_table' => $own_table,
                                            'own_alias' => $own_alias,
                                            'own_table' => self::getModelTable(),
                                            'aliased_foreign_table' => $foreign_table, 
                                            'foreign_alias' => $foreign_alias,
                                            'foreign_table' => $class_to_join::getModelTable(),
                                            'aliased_own_join_attribute' => $own_alias.'.'.$current_joinable['own_join_attribute'],
                                            'aliased_foreign_join_attribute' => $foreign_alias.'.'.$current_joinable['foreign_join_attribute'],
                                            'join_operation' => $current_joinable['join_operation'],
                                            'join_type' => $class_to_join['join_type']);
                


                if (!empty($joined_attributes)) {
                    $current_joining_data['join_type'] = $joined_attributes['join_type'];
                }

                $join_clausule_list[] = $current_joining_data;


                if (!empty($joined_attributes)) {

                    $inner_join_clausules = $class_to_join::getAllJoinedData($joined_attributes['sub_list'], $current_alias +1, strtolower($class_to_join));
                    $join_clausule_list = array_merge($join_clausule_list, $inner_join_clausules);
                    $current_alias += count($inner_join_clausules);
                } 

                $current_alias++;
            }
        }
        return $join_clausule_list;
    }


    /**
    * @param $list_of_joined_classes multidimensional array in the following format:
    *                                      - key: next class to be joined with the
    *                                               current class
    *                                      - value: array of:
    *                                                - 'join_type': type of join
    *                                                - 'sub_list': array of sub list of joined 
    *                                               classes in the same format.
    *                                               Empty or null if no sub list
    *
    * @param $join_with string:     classname of which we are going to retrieve the data
    * @param $ocurrence integer:    the ocurrence number into the $list_of_joined_classes.
    *                               to use just in the case we are joining with this class
    *                               more than onece. Default value: FIRST OCURRENCE, 1
    */
    public function getFinalJoinedData($list_of_joined_classes, $join_with, $ocurrence = 1, $limit = null, $offset = 0, $order_by = null, $ordenation = 'ASC') {
        $join_clausules = self::getJoinClausules($list_of_joined_classes);

        $current_ocurrence = 0;

        if(!empty($join_clausules)) {
            foreach($join_clausules as $join_clausule) {
                if (strtolower($join_clausule['foreign_table']) == strtolower($join_with)) {
                    $current_ocurrence++;
                    if ($current_ocurrence == $ocurrence) {
                        $alias = $join_clausule['foreign_alias'];
                        break;
                    }
                }
            }
        }

        if (!empty($alias)) {
            $this -> db -> select ( $alias.'.*' );
            $this -> db -> where ( 'a0.id = ' . $this -> id );
            $this -> db -> limit ( $limit, $offset );
            $this -> db -> from ( self::getModelTable() . ' as a0');
            $this -> db -> order_by ( $order_by, $ordenation );


            $this -> makeJoins($join_clausules);
            
            return $this -> db -> get() -> result_array();
        }
        else {
            $error_string = "Can't join data tables/classes: " . self::getModelTable() . ' with ' . $join_with;
            log_message('error', $error_string);
            show_error($error_string, 500); // returns error 500
            throw RuntimeException($error_string);
        }
    }

    public function getFinalJoinedObjects($list_of_joined_classes, $join_with, $ocurrence = 1, $limit = null, $offset = 0, $order_by = null, $ordenation = 'ASC') {
        $data_list = $this -> getFinalJoinedData($list_of_joined_classes, $join_with, $ocurrence, $limit, $offset, $order_by, $ordenation);
        $result = array();
        foreach ($data_list as $object_data) {
            $result[] = new $join_with($object_data);
        }
        return $result;
    }

}