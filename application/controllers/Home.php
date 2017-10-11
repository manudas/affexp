<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {


	public function index()
	{
        $this -> home();
	}


	private function home() {

	    /* loading all the needed models */
        $this->load->model('merchant');

        /* loading all the needed translations */
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('merchant_logo', $idiom);

        /* Building up all the needed data to pass to the views */
        $offer_alt_img_text = $this->lang->line('offer_alt_img');
        $offer_title_img_text = $this->lang->line('offer_title_img');

        $merchant_data_list = Merchant::getList(array('active' => true), 20, 0 , 'name');

        foreach ($merchant_data_list as $merchant_data) {
            $merchant_data['imgalt'] = $offer_alt_img_text . ' ' . $merchant_data['name'];
            $merchant_data['imgtitle'] = $offer_title_img_text . ' ' . $merchant_data['name'];
        }

        /* Collecting all the data all the views need in a $data array */
        $data = array('merchant_data' => $merchant_data);

        /* Calling the first level view that will be in charge of
         * calling all the rest of nested views */
        $this -> genericViewLoader('home/home', $data);
    }

}
