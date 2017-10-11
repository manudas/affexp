<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExtendedController extends CI_Controller {


    public function __construct(){

        parent::__construct();
        $this->load =& load_class('ExtendedLoader', 'core');
        $this->load->initialize();

    }

	protected function genericViewLoader ($view_list, $data = array(), $add_header = true, $add_footer = true, $return_view = false) {

		$result = "";


        foreach ($view_list as $view) {
            $result .= $this -> load -> view ( $view , $data, true );
        }

        if ($add_footer) {
            $footer = $this -> load -> view ( 'footer' , $data, true );
        }
        else {
            $footer = '';
        }


		if ($add_header) {
            /* we defer the header to know the views loaded,
             * so we can look into their respective asset
             * folder to insert the correspondant css and js
             */
            $loaded_view_list = $this -> get_var('loaded_view_list');
            $data['view_list'] = $loaded_view_list;

            $header = $this -> load -> view ( 'head' , $data, true );

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

}
