<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 5/11/17
 * Time: 11:32
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Synchronization extends MY_Controller
{
    public function index(){
        $this->output->set_status_header(400, "Bad request");
        $data = array();
        $data['heading'] = 'Unable to synchronize';
        $data['message'] = 'Please specify network';
        $this->load->view('errors/html/error_general', $data);
    }

    private function syncNetwork($network_tag){
        $this -> network -> initByTag($network_tag);
        $network_data_struct = json_decode($this -> network -> sync_encoded_struct, true); // array asociativo
        $sync_url = $this -> network -> sync_url;

        if (!empty ($sync_url) && !emtpy($network_data_struct)) {

            $xml_string_data = $this -> ExternalUrlLoader -> load ($sync_url);
            $xml_document = DOMDocument::loadXML($xml_string_data);
            $data = $this -> getSynchronizationData ($xml_document);
            $this -> save_synchronization_data($data);

        }
    }

    private function getSynchronizationData ($xml_document, $network_data_struct) {

        // What's the first(s) node(s) we have to search for into the xml document?
        // The one(s) situated in the root position of the $network_data_struct array

        foreach ($network_data_struct ) {
            aki
        }
        akistamos
    }
}
