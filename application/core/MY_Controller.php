<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

/*
    public function __construct(){

        parent::__construct();
        $this->load =& load_class('ExtendedLoader', 'core');
        $this->load->initialize();

    }
*/

    public static $AUTOLOADABLE_RESOURCES = array(
                                                    'configurations',
                                                    'models',
                                                    'translations',
                                                    'links',
                                                    'views',
                                                    'libraries'
    );

    private static $AUTOLOADABLE_RESOURCES_INIT_FUNCTION = array (
            'configurations' => 'build_configuration_array',
            'models' => 'auto_init_models',
            'translations' => 'auto_init_translations',
            'links' => '', // empty if no processing is required
            'views' => 'build_views_array',
            'libraries' => 'auto_load_libraries'
        );

    public static function getOrdenationForAutoloadableResource($autoloadable_resource_model) {

        /**
         * How ordenation is passed to other functions
         * @param $ordenation: array of quaternions (in this case pairs) in the following format:
         * 'ordenation_column' => column,
         * 'column_table' => name_of_the_table_whose_column_belongs_to
         * 'order_in_join_list' => number of the aparition in the join list. default = 1
         * 'ordenation_type => 'ASC' or 'DESC'
         */


        if (($autoloadable_resource_model == 'views') || ($autoloadable_resource_model == 'links')) {

            // being used for autoloadable only (that for now uses the method getList which doesn't use
            // any class join, we only need ordenation_column and ordenation_type

            $ordenation = 'order';
            $ordenation_type = 'ASC';
            $result =
                        array ( // ORDENATION COULD BE DONE BY MORE THAT ONE COLUMN, SO WE NEED A MULTIDIMENSIONAL ARRAY
                            array('ordenation_column' => $ordenation,
                                        'ordenation_type' => $ordenation_type)
                        );
        }
        else {
            /*
            $ordenation = null;
            $ordenation_type = null;
            */
            $result = null;
        }
        return $result;
    }

	protected function genericViewLoader ($view_list, $data = array(), $add_header = true, $add_footer = true, $return_view = false) {

		$result = "";

        // we only need to pass it once: it becomes a "global" var
        // doing it twice or more overwrites the original var,
        // having the exact same value that the original one
        $already_passed_data = false;
        foreach ($view_list as $view) {
            if ($already_passed_data == false) {
                $already_passed_data = true;
                $result .= $this -> load -> view ( $view , $data, true );
            }
            else {
                $result .= $this -> load -> view ( $view , null, true);
            }
        }

        if ($add_footer) {
            if ($already_passed_data == false) {
                $footer = $this->load->view('footer', $data, true);
            }
            else {
                $footer = $this->load->view('footer', null, true);
            }
        }
        else {
            $footer = '';
        }


		if ($add_header) {
            /* we defer the header to know the views loaded,
             * so we can look into their respective asset
             * folder to insert the correspondant css and js
             */
            $loaded_view_list = $this -> load -> get_var('loaded_view_list');
            if ($already_passed_data == false) {
                $data['view_list'] = $loaded_view_list;
                $header_data = $data;
            }
            else {
                $header_data = array();
                $header_data['view_list'] = $loaded_view_list;
            }
            $header = $this -> load -> view ( 'head' , $header_data, true );

		}
		else {
            $header = '';
        }

        $result = $header . $result . $footer;

		if ($return_view == true) {
			return $result;
		}
		else {
		    echo $result;
        }
	}



	public function _remap($method_name = 'index', $params = array()){

		/* Si no existe el metodo, se considera que lo que se
		 * ha pasado no es el método, si no los parámetros,
		 * por lo tanto se llama al método por defecto y se
		 * suma el supuesto nombre del método al array de parámetros
		 */

		if(!method_exists($this, $method_name)){
			return call_user_func_array( array( $this, 'index' ), array_merge( array($method_name), $params ) );
			// $this -> index();
		}
		else{
			return call_user_func_array( array( $this, $method_name ), $params );
		}
	}

    /**
     * @param string $class_name        The controller classname that called this method
     * @param string $function_name     The function name that called this method
     * @return array                    Returns all the data that was fecthed but was
     *                                  not intended to be autoloaded, like views
     */
	protected function auto_init_needed_resources($class_name = '', $function_name = '', $autoload_models = null, $init_defaults_views = true /*head and footer */) {
	    $resources = $this -> getAutoloadableResources($class_name, $function_name, $autoload_models, $init_defaults_views);
        $result = $this -> _auto_init_resources($resources);
        return $result;
	}

	private function _auto_init_resources($resources) {
        $result = null;
	    if (!empty($resources)) {
	        $result = array();
            foreach ($resources as $resource_key => $resource) {
                $function = self::$AUTOLOADABLE_RESOURCES_INIT_FUNCTION[$resource_key];
                if (is_callable(array($this, $function))) {
                    $result [$resource_key] = $this -> $function($resource);
                }
                else { // maybe empty function, and doesn't need processing (like links)
                    $result [$resource_key] = $resource;
                }

            }
        }
        return $result;
    }

    public function auto_load_libraries($libraries) {
        $result_name_arr = null;
        if ( !empty( $libraries ) ) {
            $result_name_arr = array();
            foreach ( $libraries as $library ) {
                $this -> load -> library ( $library -> autoloaded_library_name );
                $result_name_arr[] = $library -> autoloaded_library_name;
            }
        }
        return $result_name_arr;
    }

    public function auto_init_models ( $models ) {
        $result_name_arr = null;
        if ( !empty( $models ) ) {
            $result_name_arr = array();
            foreach ( $models as $model_to_load ) {
                $this -> load -> model ( $model_to_load -> autoloaded_model_name );
                $result_name_arr[] = $model_to_load -> autoloaded_model_name;
            }
        }
        return $result_name_arr;
    }

    public function auto_init_translations ( $translations ) {
        if ( !empty( $translations ) ) {
            $idiom = $this -> session -> get_userdata ( 'language' );
            foreach ( $translations as $translation_to_load ) {
                $this -> lang -> load ( $translation_to_load -> file_name, $idiom );
            }
        }
    }

    public function build_configuration_array ($configurations) {
        $configurations_arr = null;
        if (!empty($configurations)) {
            $configurations_arr = array();
            foreach ($configurations as $configuration) {
                $configurations_arr[$configuration -> configuration_key] = $configuration -> configuration_value;
            }
        }
        return $configurations_arr;
    }

    public function build_views_array ($views) {
        $views_arr = null;
        if (!empty($views)) {
            $previous_views = null;
            $inner_views = null;
            $posterior_views = null;
            foreach ($views as $view) {
                if ( ( $view -> model_name == 'default' ) && ( $view -> function_name == 'previous' ) ) {
                    if (!isset($previous_views)) {
                        $previous_views = array();
                    }
                    $previous_views [ $view -> order ] = $view -> view_name;
                }

                else if ( ( $view -> model_name == 'default' ) && ( $view -> function_name == 'posterior' ) ) {
                    if (!isset($posterior_views)) {
                        $posterior_views = array();
                    }
                    $posterior_views [ $view -> order ] = $view -> view_name;
                }

                else {
                    if (!isset($inner_views)) {
                        $inner_views = array();
                    }
                    $inner_views [ $view -> order ] = $view -> view_name;
                }
            }

            if (!empty($previous_views)) {
                $views_arr = $previous_views;
            }

            if (!empty($views_arr) && !empty($inner_views)) {
                $views_arr = array_merge($views_arr, $inner_views);
            }
            else if (!empty($inner_views)) {
                $views_arr = $inner_views;
            }

            if (!empty($views_arr) && !empty($posterior_views)) {
                $views_arr = array_merge($views_arr, $posterior_views);
            }
            else if (!empty($posterior_views)) {
                $views_arr = $posterior_views;
            }
        }
        return $views_arr;
    }

	protected function getAutoloadableResources($class_name = '', $function_name = '', $autoload_models = null, $init_defaults_views = true /*head and footer */) {

	    if (empty($class_name) || empty($function_name)) {
            show_error('Either requested class_name or function_name was empty. Unable to init automatic resources. Classname: ' . $class_name . ', function_name: ' . $function_name);
            log_message('error', 'Either requested class_name or function_name was empty. Unable to init automatic resources. Classname: ' . $class_name . ', function_name: ' . $function_name);
            return;
	    }

	    if ( empty($autoload_models) ) {
	        $autoload_models = self::$AUTOLOADABLE_RESOURCES;
        }


        $class = strtolower($class_name);
        $function = strtolower($function_name);

        $filter = array('model_name' => $class, 'function_name' => $function, 'active' => true);

        foreach ($autoload_models as $model) {
            $this->load->model('controller_autoloaders/'.$model, $model.'_autoload');
            $ordenation = self::getOrdenationForAutoloadableResource($model);
            ${$model.'_modelobj_array'} = $this -> {$model.'_autoload'} -> getObjectList($filter,
                                                                                            null,
                                                                                            0,
                                                                                            $ordenation);
        }

        if ($init_defaults_views == true) {

            $filter_defaults = array('model_name' => 'default', 'active' => true);

            foreach (self::$AUTOLOADABLE_RESOURCES as $model) {
                if (empty($this -> {$model.'_autoload'})) {
                    $this->load->model('controller_autoloaders/'.$model, $model.'_autoload');
                }
                $ordenation = self::getOrdenationForAutoloadableResource($model);
                ${$model.'_defaults_modelobj_array'} = $this -> {$model.'_autoload'} -> getObjectList($filter_defaults,
                                                                                           null,
                                                                                           0,
                                                                                           $ordenation);
                if (!empty(${$model.'_modelobj_array'})) {
                    ${$model.'_modelobj_array'} = array_merge(${$model.'_modelobj_array'}, ${$model.'_defaults_modelobj_array'});
                }
                else {
                    ${$model.'_modelobj_array'} = ${$model.'_defaults_modelobj_array'};
                }
           }
        }


        $result = array();
        foreach (self::$AUTOLOADABLE_RESOURCES as $resource_model) {
            $result[$resource_model] = (!empty(${$resource_model.'_modelobj_array'})) ? ${$resource_model.'_modelobj_array'} : null;
        }

        return $result;

    }


    protected function autoload_views($view_array, $data) {

        /* Calling the first level view that will be in charge of
         * calling all the rest of nested views */
        if (!empty($view_array)) {

            $this->genericViewLoader($view_array, $data);

        }
    }

}
