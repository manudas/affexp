<?php

class MY_Model extends CI_Model
{

    protected static $model_table_arr = array();

    public static function getModelTable()
    {
        if (!empty(self::$model_table_arr[static::class])) {
            return self::$model_table_arr[static::class];
        } else {
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

    public function __construct($param = null, $table = null)
    {
        parent::__construct();

        if (!empty($table)) {
            self::$model_table_arr[static::class] = strtolower($table);
        } else {
            self::$model_table_arr[static::class] = strtolower(static::class);
        }

        if (!empty($param)) {
            $this->setData($param);
        } else {
            $this->setDefaultValues();
        }

    }

    public function setData($params = null)
    {
        if (!empty($params)) {
            $this->setDefaultValues();
            $this->buildObject($params);
        }
    }

    private function setDefaultValues()
    {
        foreach (self::$definition as $nameProperty => $propertyArray) {
            $this->{$nameProperty} = $propertyArray['defaultValue'];
        }
    }

    private function buildObject($param)
    {
        if (is_array($param)) {
            $this->buildObjectFromArray($param);
        } else if (is_integer($param)) {
            $this->buildObjectFromID($param);
        }
    }

    private function buildObjectFromArray($params)
    {
        foreach ($params as $param_key => $param_value) {
            $this->{$param_key} = $param_value;
        }
    }

    private function buildObjectFromID($id)
    {
        $this->db->select('*');

        $this->db->from(self::getModelTable());

        $this->db->where('id', $id);
        $query_result = $this->db->get()->result_array();
        $this->buildObjectFromArray($query_result);
    }

    public function save()
    {
        if (!empty($this->id)) {
            $this->update();
        } else {
            $this->add();
        }
    }

    private function add()
    {
        $this->db->set($this);
        $this->db->insert(self::getModelTable());
    }

    private function update()
    {
        $this->db->set($this);
        $this->db->update(self::getModelTable());
    }

    /**
     * @param $ordenation: array of quaternions (in this case pairs) in the following format:
     * 'ordenation_column' => column,
     * 'column_table' => name_of_the_table_whose_column_belongs_to
     * 'order_in_join_list' => number of the aparition in the join list. default = 1
     * 'ordenation_type => 'ASC' or 'DESC'
     */
    public static function getList($filter = null, $limit = null, $offset = 0, $ordenation = 'ASC', $table = null)
    {

        if (!empty($table)) {
            self::$model_table_arr[static::class] = strtolower($table);
        }

        $instance = &get_instance();

        $instance->db->select('*');
        $instance->db->where($filter);
        $instance->db->limit($limit, $offset);
        $instance->db->from(self::getModelTable());


        for ($i = 0; $i < count($ordenation); $i++){

            $single_order_by = $ordenation[$i]['ordenation_column'];
            $current_ordenation = $ordenation[$i]['ordenation_type'];

            $instance->db->order_by($single_order_by, $current_ordenation);
        }

        /*
        if (is_array($order_by)) {
            if (is_array($ordenation)) {
                $keys_ordenation = array_keys($ordenation);
            }
            $keys_order_by = array_keys($order_by);
            for ($i = 0; $i < count($order_by); $i++){

                $single_order_by = $order_by[$keys_order_by[$i]];

                if (isset($keys_ordenation[$i])){
                    $current_ordenation = $ordenation[$keys_ordenation[$i]];
                }
                else {
                    $current_ordenation = $ordenation;
                }

                $instance->db->order_by($single_order_by, $current_ordenation);
            }
        }
        else {
            $instance->db->order_by($order_by, $ordenation);
        }
        */

        // $instance->db->order_by($order_by, $ordenation);

        $query_result = $instance->db->get()->result_array();
        return $query_result;
    }

    public static function getObjectList($filter = null, $limit = null, $offset = 0, $order_by = null, $ordenation = 'ASC', $table = null)
    {
        $object_list = array();
        $results = self::getList($filter, $limit, $offset, $order_by, $ordenation, $table);
        foreach ($results as $result) {
            $current_class = static::class;
            $object_list[] = new $current_class($result);
        }
        return $object_list;
    }

    private function makeJoins($join_clausules, $join_type)
    {
        if (!empty($join_clausules)) {
            for ($i = 0; $i < count($join_clausules); $i++) {
                /*
                                $join_clausule_list[] = array('aliased_own_table' => $own_table,
                                            'aliased_foreign_table' => $foreign_table,
                                            'aliased_own_join_attribute' => $own_alias.'.'.$current_joinable['own_join_attribute'],
                                            'aliased_foreign_join_attribute' => $foreign_alias.'.'.$current_joinable['foreign_join_attribute'],
                                            'join_operation' => $current_joinable['join_operation']);
                */
                $join_clausule = $join_clausules[$i];
                $inner_AND_OR_JOIN = $this->getInnerAndORJoin($join_clausule);
                if (!empty($join_type)) {
                    $this->db->join($join_clausule['aliased_foreign_table'],
                        $join_clausule['aliased_own_join_attribute'] .
                        ' ' .
                        $join_clausule['join_operation'] .
                        ' ' .
                        $join_clausule['aliased_foreign_join_attribute'] .
                        $inner_AND_OR_JOIN,
                        $join_clausule['join_type']
                    );
                } else {
                    $this->db->join($join_clausule['aliased_foreign_table'],
                        $join_clausule['aliased_own_join_attribute'] .
                        ' ' .
                        $join_clausule['join_operation'] .
                        ' ' .
                        $join_clausule['aliased_foreign_join_attribute'] .
                        $inner_AND_OR_JOIN
                    );
                }
            }
        }
    }

    private static function getAndArray($join_clausule)
    {
        $result = false;
        if (!empty($join_clausule)) {
            if (isset($join_clausule['and'])) {
                $result = $join_clausule['and'];
            } elseif (isset($join_clausule['anD'])) {
                $result = $join_clausule['anD'];
            } elseif (isset($join_clausule['aNd'])) {
                $result = $join_clausule['aNd'];
            } elseif (isset($join_clausule['And'])) {
                $result = $join_clausule['And'];
            } elseif (isset($join_clausule['aND'])) {
                $result = $join_clausule['aND'];
            } elseif (isset($join_clausule['AnD'])) {
                $result = $join_clausule['AnD'];
            } elseif (isset($join_clausule['ANd'])) {
                $result = $join_clausule['ANd'];
            } elseif (isset($join_clausule['AND'])) {
                $result = $join_clausule['AND'];
            }

        }
        return $result;
    }

    private static function getOrArray($join_clausule)
    {
        $result = false;
        if (!empty($join_clausule)) {
            if (isset($join_clausule['or'])) {
                $result = $join_clausule['or'];
            } elseif (isset($join_clausule['oR'])) {
                $result = $join_clausule['oR'];
            } elseif (isset($join_clausule['Or'])) {
                $result = $join_clausule['Or'];
            } elseif (isset($join_clausule['OR'])) {
                $result = $join_clausule['OR'];
            }
        }
        return $result;
    }

    private function getInnerAndORJoin($main_join_clausule, $subjoin_clausule)
    {

        /*
         *
         *      'foreign_alias' => $foreign_alias,
                'aliased_own_join_attribute' => $aliased_own_join_attribute,
                'aliased_foreign_join_attribute' => $aliased_foreign_join_attribute,
                'join_operation' => $join_operation,
         */
        if (!empty($subjoin_clausule)) {
            $result = '';

            $and = static::getAndArray($main_join_clausule, $subjoin_clausule);
            $or = static::getOrArray($main_join_clausule, $subjoin_clausule);

            if (!empty($and)) {
                $result .= ' AND ( ' .
                    $and['aliased_own_join_attribute'] .
                    $and['join_operation'] .
                    $and['aliased_foreign_join_attribute']
                    . ' )';
            }

            if (!empty($or)) {
                $result .= ' OR ( ' .
                    $or['aliased_own_join_attribute'] .
                    $or['join_operation'] .
                    $or['aliased_foreign_join_attribute']
                    . ' )';
            }
            return $result . $this->getInnerAndORJoin();
        } else {
            return '';
        }

    }

    /**
     * @param $ordenation
     * @param $join_clausules
     * @param $ordenation_list: array of quaternions in the following format:
     * 'ordenation_column' => column,
     * 'column_table' => name_of_the_table_whose_column_belongs_to
     * 'order_in_join_list' => number of the aparition in the join list. default = 1
     * 'ordenation_type => 'ASC' or 'DESC'
     */
    private function getAliasedOrdenation($ordenation_list, $join_clausules) {
        $result = array ();
        if (!empty($ordenation_list)) {
            // getAlias($join_with, $join_clausules_list, $ocurrence)

            foreach ($ordenation_list as $ordenation) {
                $alias = $this -> getAlias($ordenation['column_table'], $join_clausules, $ordenation['order_in_join_list']);
                /*
                    $single_order_by = $aliased_ordenation[$i]['aliased_colum'];
                    $current_ordenation = $aliased_ordenation[$i]['ordenation'];
                */
                $result[] = array(
                    'aliased_column' => $alias.'.'.$ordenation['ordenation_column'],
                    'ordenation' => $ordenation['ordenation_type']
                );
            }

        }
        return $result;
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
     * @param $conditions : multidimensional array with the following format:
     *   array(
     * array( // condition group 1
     * 'condition_table1' => $condition_table1, // table to apply 1º condition, empty if literal
     * 'condition_table2' => $condition_table2, // table to apply 2º condition, empty if literal
     * 'condition_1' => $condition_1, // 1º column or literal to apply
     * 'operation_condition' => $operation_condition, // the condition itself
     * 'condition_2' => $condition_2, // 2º column or literal to apply
     * 'ocurrence_condition_1' => $ocurrence_condition_1, // occurrence number of the table in the join list, default value is 1
     * 'ocurrence_condition_2' => $ocurrence_condition_2 // occurrence number of the table in the join list, default value is 1
     * ),
     *       array ( // condition group 2
     *           ...
     * @param $ordenation: array of quaternions in the following format:
     * 'ordenation_column' => column,
     * 'column_table' => name_of_the_table_whose_column_belongs_to
     * 'order_in_join_list' => number of the aparition in the join list. default = 1
     * 'ordenation_type => 'ASC' or 'DESC'
     */
    public function getAllJoinedData($list_of_joined_classes, $limit = null, $offset = 0,
                                     $ordenation,
                                     $conditions = null)
    {


        $join_clausules = static::getJoinClausules($list_of_joined_classes);


        $sql_where = $this->getWhereSQL($conditions, $join_clausules);
        $aliased_ordenation = $this->getAliasedOrdenation($ordenation, $join_clausules);

        $this->db->select('*');
        $this->db->where('a0.id = ' . $this->id . $sql_where);
        $this->db->limit($limit, $offset);
        $this->db->from(self::getModelTable() . ' as a0');

        for ($i = 0; $i < count($aliased_ordenation); $i++){

            $single_order_by = $aliased_ordenation[$i]['aliased_column'];
            $current_ordenation = $aliased_ordenation[$i]['ordenation'];

            $this->db->order_by($single_order_by, $current_ordenation);
        }

        $this->makeJoins($join_clausules);

        return $this->db->get()->result_array();
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
     *                          a|
     *                         b/ \g
     *                        c/
     *                       d/
     *                      e/\f
     *
     * In this graph a joints with b and g, b with c, c with d, and d with e and f.
     * This structure should be passed as the following array:
     * array(b, array(c, array(d, array(e,f))), g)
     *
     */
    private static function getJoinClausules($list_of_joined_classes, $current_alias = 0, $table = null)
    {

        if (!empty($table)) {
            $model_table_arr[static::class] = strtolower($table);
        }

        $join_clausule_list = array();

        $current_joinable_set = self::$joinable;

        $array_iterator = new RecursiveArrayIterator($list_of_joined_classes);
        //$tree_iterator = new RecursiveTreeIterator($array_iterator);

        foreach ($array_iterator as $class_to_join => $joined_attributes) {
            $is_joinable = false;
            foreach ($current_joinable_set as $current_joinable) {
                if (strtolower($current_joinable['join_with']) == strtolower($class_to_join)) {
                    $is_joinable = true;
                    break;
                }
            }

            if (!$is_joinable) {
                $error_string = 'The class ' . get_class() . ' is not joinable with ' . $class_to_join;
                log_message('error', $error_string);
                show_error($error_string, 500); // returns error 500
                throw RuntimeException($error_string);
            } else {

                $own_alias = 'a' . ($current_alias);
                $foreign_alias = 'a' . ($current_alias + 1);

                $operation = $current_joinable['join_operation'];
                $own_table = self::getModelTable() . ' as ' . $own_alias;
                $foreign_table = $class_to_join::getModelTable() . ' as ' . $foreign_alias;

                $current_joining_data = array('aliased_own_table' => $own_table,
                    'own_alias' => $own_alias,
                    'own_table' => self::getModelTable(),
                    'aliased_foreign_table' => $foreign_table,
                    'foreign_alias' => $foreign_alias,
                    'foreign_table' => $class_to_join::getModelTable(),
                    'aliased_own_join_attribute' => $own_alias . '.' . $current_joinable['own_join_attribute'],
                    'aliased_foreign_join_attribute' => $foreign_alias . '.' . $current_joinable['foreign_join_attribute'],
                    'join_operation' => $operation,
                    'join_type' => $class_to_join['join_type']);


                if (!empty($joined_attributes)) {
                    $current_joining_data['join_type'] = $joined_attributes['join_type'];
                }

                $and = static::getAndJoinedData($current_joinable);
                $or = static::getOrJoinedData($current_joinable);

                $current_joining_data['and'] = $and;
                $current_joining_data['or'] = $or;

                $join_clausule_list[] = $current_joining_data;


                if (!empty($joined_attributes)) {

                    $inner_join_clausules = $class_to_join::getAllJoinedData($joined_attributes['sub_list'], $current_alias + 1, strtolower($class_to_join));
                    $join_clausule_list = array_merge($join_clausule_list, $inner_join_clausules);
                    $current_alias += count($inner_join_clausules);
                }

                $current_alias++;
            }
        }
        return $join_clausule_list;
    }

    private static function getAndJoinedData($current_joinable, $current_alias)
    {
        $and = static::getAndArray($current_joinable);
        $or = static::getOrArray($current_joinable);
        if (!empty($and)) {
            $own_join_attribute = $and['own_join_attribute'];
            $foreign_join_attribute = $and['foreign_join_attribute'];
            $join_operation = $and['join_operation'];
            $own_alias = 'a.' . $current_alias;
            $foreign_alias = 'a.' . ($current_alias + 1);
            $aliased_own_join_attribute = $own_alias . $own_join_attribute;
            $aliased_foreign_join_attribute = $foreign_alias . $foreign_join_attribute;
            return array('own_alias' => $own_alias,
                'foreign_alias' => $foreign_alias,
                'aliased_own_join_attribute' => $aliased_own_join_attribute,
                'aliased_foreign_join_attribute' => $aliased_foreign_join_attribute,
                'join_operation' => $join_operation,
                'and' => static::getAndJoinedData($and, $current_alias),
                'or' => static::getOrJoinedData($or, $current_alias));
        } else {
            return null;
        }

    }

    private static function getOrJoinedData($current_joinable, $current_alias)
    {
        $and = static::getAndArray($current_joinable);
        $or = static::getOrArray($current_joinable);
        if (!empty($or)) {
            $own_join_attribute = $or['own_join_attribute'];
            $foreign_join_attribute = $or['foreign_join_attribute'];
            $join_operation = $or['join_operation'];
            $own_alias = 'a.' . $current_alias;
            $foreign_alias = 'a.' . ($current_alias + 1);
            $aliased_own_join_attribute = $own_alias . $own_join_attribute;
            $aliased_foreign_join_attribute = $foreign_alias . $foreign_join_attribute;
            return array('own_alias' => $own_alias,
                'foreign_alias' => $foreign_alias,
                'aliased_own_join_attribute' => $aliased_own_join_attribute,
                'aliased_foreign_join_attribute' => $aliased_foreign_join_attribute,
                'join_operation' => $join_operation,
                'and' => static::getAndJoinedData($and, $current_alias),
                'or' => static::getOrJoinedData($or, $current_alias));
        } else {
            return null;
        }

    }

    private function getAlias($join_with, $join_clausules_list, $ocurrence = 1)
    {
        $current_ocurrence = 0;
        $alias = '';
        if (!empty($join_clausules_list)) {
            foreach ($join_clausules_list as $join_clausule) {
                if (strtolower($join_clausule['own_table']) == strtolower($join_with)) {
                    $current_ocurrence++;
                    if ($current_ocurrence == $ocurrence) {
                        $alias = $join_clausule['foreign_alias'];
                        break;
                    }
                }
            }
        }
        return $alias;
    }

    private function setDefaultCondtionsVars($condition_list)
    {
        if (!empty($condition_list)) {
            $result = array();
            foreach ($condition_list as $conditions) {
                $condition_table1 = !empty($conditions['condition_table1']) ? $conditions['condition_table1'] : ''; // if empty should be considered as a literal
                $condition_table2 = !empty($conditions['condition_table2']) ? $conditions['condition_table2'] : ''; // if empty should be considered as a literal
                $condition_1 = $conditions['condition_1'];
                $operation_condition = !empty($conditions['operation_condition']) ? $conditions['operation_condition'] : '=';
                $condition_2 = $conditions['condition_2'];
                $ocurrence_condition_1 = !empty($conditions['ocurrence_condition_1']) ? $conditions['ocurrence_condition_1'] : 1;
                $ocurrence_condition_2 = !empty($conditions['ocurrence_condition_2']) ? $conditions['ocurrence_condition_2'] : 1;

                $result[] = array(
                    'condition_table1' => $condition_table1,
                    'condition_table2' => $condition_table2,
                    'condition_1' => $condition_1,
                    'operation_condition' => $operation_condition,
                    'condition_2' => $condition_2,
                    'ocurrence_condition_1' => $ocurrence_condition_1,
                    'ocurrence_condition_2' => $ocurrence_condition_2
                );
            }
            return $result;
        } else {
            return null;
        }
    }

    private function getWhereSQL($condition_list, $join_clausules)
    {

        $conditions_arr_list = static::setDefaultCondtionsVars($condition_list);
        // from here we extract operation_condition, condition1 and 2, ocurrence conditions and tables

        foreach ($conditions_arr_list as $conditions_arr) {
            extract($conditions_arr);

            $sql_where = '';

            if (!empty($condition_1) && !empty($operation_condition) && !empty($condition_2)) {
                // condition_tables could be empty if the condition was made with a literal
                $where = true;
                if (!empty($condition_table1)) {
                    $where_alias1 = $this->getAlias($condition_table1, $join_clausules, $ocurrence_condition_1);
                }
                if (!empty($condition_table2)) {
                    $where_alias2 = $this->getAlias($condition_table2, $join_clausules, $ocurrence_condition_2);
                }
            } else {
                $where = false;
            }


            if ($where == true) {
                $sql_where .= ' AND ' . (!empty ($where_alias1) ? $where_alias1 . '.' : '') . $condition_1 . ' '
                    . $operation_condition . ' '
                    . (!empty($where_alias2) ? $where_alias2 . '.' : '') . $condition_2;
            } else {
                // $sql_where .= ''; no need to concat anything
            }
        }

        return $sql_where;
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
     *
     * @param $conditions : multidimensional array with the following format:
     *   array(
     * array( // condition group 1
     * 'condition_table1' => $condition_table1, // table to apply 1º condition, empty if literal
     * 'condition_table2' => $condition_table2, // table to apply 2º condition, empty if literal
     * 'condition_1' => $condition_1, // 1º column or literal to apply
     * 'operation_condition' => $operation_condition, // the condition itself
     * 'condition_2' => $condition_2, // 2º column or literal to apply
     * 'ocurrence_condition_1' => $ocurrence_condition_1, // occurrence number of the table in the join list, default value is 1
     * 'ocurrence_condition_2' => $ocurrence_condition_2 // occurrence number of the table in the join list, default value is 1
     * ),
     *       array ( // condition group 2
     *           ...
     *
     * @param $ordenation: array of quaternions in the following format:
     * 'ordenation_column' => column,
     * 'column_table' => name_of_the_table_whose_column_belongs_to
     * 'order_in_join_list' => number of the aparition in the join list. default = 1
     * 'ordenation_type => 'ASC' or 'DESC'
     */
    public function getFinalJoinedData($list_of_joined_classes, $join_with, $ocurrence = 1, $limit = null, $offset = 0,
                                       $ordenation,
                                       $conditions = null)
    {

        $join_clausules = self::getJoinClausules($list_of_joined_classes);


        $main_alias = $this->getAlias($join_with, $join_clausules, $ocurrence);

        $sql_where = $this->getWhereSQL($conditions, $join_clausules);

        $aliased_ordenation = $this->getAliasedOrdenation($ordenation, $join_clausules);

        if (!empty($alias)) {
            $this->db->select($main_alias . '.*');
            $this->db->where('a0.id = ' . $this->id . $sql_where);
            $this->db->limit($limit, $offset);
            $this->db->from(self::getModelTable() . ' as a0');
            // $this->db->order_by($order_by, $ordenation);

            for ($i = 0; $i < count($aliased_ordenation); $i++){

                $single_order_by = $aliased_ordenation[$i]['aliased_column'];
                $current_ordenation = $aliased_ordenation[$i]['ordenation'];

                $this->db->order_by($single_order_by, $current_ordenation);
            }

            $this->makeJoins($join_clausules);

            return $this->db->get()->result_array();
        } else {
            $error_string = "Can't join data tables/classes: " . self::getModelTable() . ' with ' . $join_with;
            log_message('error', $error_string);
            show_error($error_string, 500); // returns error 500
            throw RuntimeException($error_string);
        }
    }

    public function getFinalJoinedObjects($list_of_joined_classes, $join_with, $ocurrence = 1, $limit = null, $offset = 0, $order_by = null, $ordenation = 'ASC')
    {
        $data_list = $this->getFinalJoinedData($list_of_joined_classes, $join_with, $ocurrence, $limit, $offset, $order_by, $ordenation);
        $result = array();
        foreach ($data_list as $object_data) {
            $result[] = new $join_with($object_data);
        }
        return $result;
    }

}