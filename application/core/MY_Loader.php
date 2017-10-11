<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {
	
    
    public function view($view, $vars = array(), $return = FALSE)
    {

        $loaded_view_list = $this -> get_var('loaded_view_list');
        if (empty($loaded_view_list)) {
            $loaded_view_list = array($view);
        }
        else {
            $loaded_view_list[] = $view;
        }
        $this -> vars('loaded_view_list', $loaded_view_list);

        return parent::view($view, $vars, $return);

	}

}