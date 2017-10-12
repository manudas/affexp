<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {



	public function index()
	{
        $this -> load_home();
	}


	public function load_home() {

	    // autoload models, translations and return views to be loaded later
        $preprocessed_data =
            $this -> auto_init_needed_resources(__CLASS__, __FUNCTION__);

        /* Starting to prepare data to be passed to the views */
        /* Building up all the needed data to pass to the views */
        $offer_alt_img_text = $this->lang->line('offer_alt_img');
        $offer_title_img_text = $this->lang->line('offer_title_img');

        $merchant_data_list = Merchant::getList(array('active' => true), 20, 0 , 'name');
        foreach ($merchant_data_list as &$merchant_data) {
            $merchant_data['imgalt'] = $offer_alt_img_text . ' ' . $merchant_data['name'];
            $merchant_data['imgtitle'] = $offer_title_img_text . ' ' . $merchant_data['name'];
        }

        /* Collecting all the data all the views need in a $data array */
        $data = array('merchant_list' => $merchant_data_list, 'configurations' => $preprocessed_data['configurations']);
        /* End of data preparation to be passed to the views */

        // autoload views, it couldn't be autoloaded without data in the other method
        $this -> autoload_views($preprocessed_data['views'], $data);

    }

}
