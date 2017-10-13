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
			$this -> index();
		}
		else{
			return call_user_func_array( array( $this, $method_name ), $params );
		}
	}

    /**
     * @param string $class_name        The controller classname that called this method
     * @param string $function_name     The function name that called this method
     * @return array|void               Returns all the data that was fecthed but was
     *                                  not intended to be autoloaded, like views
     */
	protected function auto_init_needed_resources($class_name = '', $function_name = '', $autoload_models = array('configurations', 'models', 'translations', 'links', 'views'), $init_defaults_views = true /*head and footer */) {








	    mirar de eliminar common y de pasar todo a esta clase









	    if (empty($class_name) || empty($function_name)) {
            show_error('Either requested class_name or function_name was empty. Unable to init automatic resources. Classname: ' . $class_name . ', function_name: ' . $function_name);
            log_message('error', 'Either requested class_name or function_name was empty. Unable to init automatic resources. Classname: ' . $class_name . ', function_name: ' . $function_name);
            return;
	    }

        $class = strtolower($class_name);
        $function = strtolower($function_name);

        if (in_array('models', $autoload_models)) {
            $this->load->model('controller_autoloaders/models', 'models_autoload');
            $filter_models = array('model_name' => $class, 'function_name' => $function, 'active' => true);
            $models_modelobj_array = $this->models_autoload->getObjectList($filter_models);

        }

	    if (in_array('configurations', $autoload_models)) {
            $this->load->model('controller_autoloaders/configurations', 'configurations_autoload');
            $filter_configurations = array('model_name' => $class, 'function_name' => $function, 'active' => true);
            $configurations_modelobj_array = $this->configurations_autoload->getObjectList($filter_configurations);
        }

        if (in_array('translations', $autoload_models)) {
            $this->load->model('controller_autoloaders/translations', 'translations_autoload');
            $filter_translations = array('model_name' => $class, 'function_name' => $function, 'active' => true);
            $translations_modelobj_array = $this->translation_autoload->getObjectList($filter_translations);
        }
        if (in_array('views', $autoload_models)) {
            $this->load->model('controller_autoloaders/views', 'views_autoload');
            $filter_views = array('model_name' => $class, 'function_name' => $function, 'active' => true);
            $views_modelobj_array = $this->views_autoload->getObjectList($filter_views, null, 0, 'order');
        }
        if (in_array('links', $autoload_models)) {
            $this->load->model('controller_autoloaders/links', 'links_autoload');
            $filter_links = array('model_name' => $class, 'function_name' => $function, 'active' => true);
            $links_modelobj_array = $this->links_autoload->getObjectList($filter_links, null, 0, 'order');
        }

        if ($init_defaults_views == true) {

            AÑADIMOS DEFAULTS

            $filter_configurations_defaults = array('model_name' => 'default', 'function_name' => 'default', 'active' => true);
            $configurations_defaults_modelobj_array = $this->models_autoload->getObjectList($filter_configurations_defaults);
            if (!empty($configurations_modelobj_array)) {
                $configurations_modelobj_array = array_merge($configurations_modelobj_array, $configurations_defaults_modelobj_array);
            }

            $filter_models_defaults = array('model_name' => 'default', 'function_name' => 'default', 'active' => true);
            $models_defaults_modelobj_array = $this->models_autoload->getObjectList($filter_models_defaults);
            if (!empty($models_modelobj_array)) {
                $models_modelobj_array = array_merge($models_modelobj_array, $models_defaults_modelobj_array);
            }

            $filter_translations_defaults = array('model_name' => 'default', 'function_name' => 'default', 'active' => true);
            $translations_defaults_modelobj_array = $this->translation_autoload->getObjectList($filter_translations_defaults);
            if (!empty($translations_modelobj_array)) {
                $translations_modelobj_array = array_merge($translations_modelobj_array, $translations_defaults_modelobj_array);
            }


            quitar y cogerlo de $configurations defaults ??
            $filter_views_previous_defaults = array('model_name' => 'default', 'function_name' => 'previous', 'active' => true);
            $views_previous_defaults_modelobj_array = $this->views_autoload->getObjectList($filter_views_previous_defaults, null, 0, 'order');


            if (!empty($views_modelobj_array)) {
                $views_modelobj_array = array_merge($views_modelobj_array, $views_defaults_modelobj_array);
            }

            $filter_views_post_defaults = array('model_name' => 'default', 'function_name' => 'post', 'active' => true);
            $views_post_defaults_modelobj_array = $this->views_autoload->getObjectList($filter_views_post_defaults, null, 0, 'order');
    fin quitar??


            $filter_links_defaults = array('model_name' => 'default', 'function_name' => 'default', 'active' => true);
            $links_defaults_modelobj_array = $this->links_autoload->getObjectList($filter_links_defaults, null, 0, 'order');
            if (!empty($links_modelobj_array)) {
                $links_modelobj_array = array_merge($links_modelobj_array, $links_defaults_modelobj_array);
            }
        }

        // Time to do the autoload stuff

        /* loading all the needed models */
        if (!empty($models_modelobj_array)) {
            $models = array();
            foreach ($models_modelobj_array as $model_to_load)
            {
                $this->load->model($model_to_load -> autoloaded_model_name);
                $models[] = $model_to_load -> autoloaded_model_name;
            }
        }
        else {
            $models = null;
        }

        /* loading all the needed translations */
        if (!empty($translations_modelobj_array)) {
            $translations = array();
            $idiom = $this->session->get_userdata('language');
            foreach ($translations_modelobj_array as $translation_to_load) {
                $this->lang->load($translation_to_load -> file_name, $idiom);
                $translations[] = $translation_to_load -> file_name;
            }
        }
        else {
            $translations = null;
        }

        /* loading needed configurations to pass to the views, as title, keywords, metadescription... */
        if (!empty($configurations_modelobj_array)) {
            $configurations = array();
            foreach ($configurations_modelobj_array as $configuration) {
                $configurations[$configuration -> configuration_key] = $configuration -> configuration_value;
            }
        }
        else {
            $configurations = null;
        }

        /* time to build an array with all the initials viws to load */
        if (!empty($views_modelobj_array)) {
            $views = array();
            foreach ($views_modelobj_array as $key => $view_to_load) {
                $views[$key] = $view_to_load -> view_name;
            }
        }
        else {
            $views = null;
        }
        if (($init_defaults_views == true) && ((!empty($configurations['previous_views'])) || (!empty($configurations['post_views'])))){

            quitar y coger default views?? o dejar asi? cual es mejor sistema?
            if ($views == null) {
                $views = array();
            }
            if ( !empty($configurations['previous_views'] ) ) {
                array_unshift($views, $configurations['previous_views']); // añade elemento al principio del array
            }
            if ( !empty($configurations['post_views'] ) ) {
                array_push($views, $configurations['post_views']); // añade elemento al final del array
            }
        }


        if (!empty($links_modelobj_array)) {
            $links = $links_modelobj_array;
        }
        else {
            $links = null;
        }

        return array ('views' => $views,
                        'models' => $models,
                        'translations' => $translations,
                        'configurations' => $configurations,
                        'links' => $links);

    }

    protected function autoload_views($view_array, $data) {

        /* Calling the first level view that will be in charge of
         * calling all the rest of nested views */
        if (!empty($view_array)) {

            $this->genericViewLoader($view_array, $data);

        }
    }

}
