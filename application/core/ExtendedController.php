<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExtendedController extends CI_Controller {

	protected function genericViewLoader ($view_list, $data = array(), $add_header = true, $add_footer = true, $return_view = false) {
		
		if ($return_view) {
			$result = "";
		}
		$data['view_list'] = $view_list;

		if ($add_header) {
			if ($return_view) {
				$result .= $this -> load -> view ( 'head' , $data, $return_view );
			}
			else {
				$this -> load -> view ( 'head' , $data );
			}
		}
		
		foreach ($view_list as $view) {
			if ($return_view) {
				$result .= $this -> load -> view ( $view , $data, $return_view );
			}
			else {
				$this -> load -> view ( $view , $data );
			}
		}
		
		if ($add_footer) {
			if ($return_view) {
				$result .= $this -> load -> view ( 'head' , $data, $return_view );
			}
			else {
				$this -> load -> view ( 'head' , $data );
			}
		}

		if ($return_view == true) {
			return $result;
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
