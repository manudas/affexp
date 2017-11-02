<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{


    public function index()
    {
        $this->load_home();
    }


    public function load_home()
    {

        // autoload models, translations and return views to be loaded later.
        // We only need configurations, models, views and tranlations here.
        $preprocessed_data =
            $this->auto_init_needed_resources(__CLASS__, __FUNCTION__, array('configurations', 'models', 'translations', 'views'));

        /* Starting to prepare data to be passed to the views */
        /* Building up all the needed data to pass to the views */
        $offer_alt_img_text = $this->lang->line('offer_alt_img');
        $offer_title_img_text = $this->lang->line('offer_title_img');


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
         */
        /*
        public function getAllJoinedData($list_of_joined_classes, $limit = null, $offset = 0,
                                         $order_by = null, $ordenation = 'ASC',
                                         $conditions = null){

        */
        //  $merchant_data_list = Merchant::getList(array('active' => true), 20, 0 , 'name');

        $join_list = array('ImageGroup' =>
            array('join_type' => 'inner',
                'sub_list' =>
                    array('Image' => array('join_type' => 'inner')
                    )
            )
        );
        $conditions = array(
            array( // condition group 1
                'condition_table1' => 'Image',
                'condition_table2' => '', // literal
                'condition_1' => 'active',
                'condition_2' => 'true',
                'operation_condition' => '=',
                'ocurrence_condition_1' => 1, // not needed
                // (not passed ocurrence_condition_2 as not needed in order to test)
            ),
            array( // condition group 1
                'condition_table1' => 'ImageGroup',
                'condition_table2' => '', // literal
                'condition_1' => 'active',
                'condition_2' => 'true',
                'operation_condition' => '=',
                // 'ocurrence_condition_1' => 1, // ommited in order to test
                // (not passed ocurrence_condition_2 as not needed in order to test)
            ),
            array( // condition group 1
                'condition_table1' => 'Merchant',
                'condition_table2' => '', // literal
                'condition_1' => 'active',
                'condition_2' => 'true',
                'operation_condition' => '=',
                // 'ocurrence_condition_1' => 1, // ommited in order to test
                // (not passed ocurrence_condition_2 as not needed in order to test)
            )
        );
        /*
         * @param $ordenation: array of quaternions in the following format:
         * 'ordenation_column' => column,
         * 'column_table' => name_of_the_table_whose_column_belongs_to
         * 'order_in_join_list' => number of the aparition in the join list. default = 1
         * 'ordenation_type => 'ASC' or 'DESC'
         *
         */
        $ordenation = array( // stacked ordenations are possible, they have to be ordered in this array
            array(
                'ordenation_column' => 'name',
                'ordenation_type' => 'ASC',
                'column_table' => 'merchant',
                'order_in_join_list' => 1
            )
        );

        /*
        public function getAllJoinedData($list_of_joined_classes, $limit = null, $offset = 0,
                                         $ordenation,
                                         $conditions = null){

        */
        $merchant_data_list = Merchant::getAllJoinedData($join_list, 20, 0, $ordenation, $conditions);


        foreach ($merchant_data_list as &$merchant_data) {
            $merchant_data['imgalt'] = $offer_alt_img_text . ' ' . $merchant_data['name'];
            $merchant_data['imgtitle'] = $offer_title_img_text . ' ' . $merchant_data['name'];
        }

        /* Collecting all the data all the views need in a $data array */
        $data = array('merchant_list' => $merchant_data_list, 'configurations' => $preprocessed_data['configurations']);
        /* End of data preparation to be passed to the views */

        // autoload views, it couldn't be autoloaded without data in the other method
        $this->autoload_views($preprocessed_data['views'], $data);

    }

}
