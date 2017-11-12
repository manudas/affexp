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

    public function ttuk(){
        $this -> syncNetwork(__FUNCTION__);
    }

    private function syncNetwork($network_tag){
        usar autoinit resources aqui. mirar a ver si autoinit resources carga header y footer, en cuyo caso hay que repensar

        $this -> network -> initByTag($network_tag);
        $network_data_struct = json_decode($this -> network -> sync_encoded_struct, true); // array asociativo
        $sync_url = $this -> network -> sync_url;

        if (!empty ($sync_url) && !emtpy($network_data_struct)) {

            $xml_string_data = $this -> ExternalUrlLoader -> load ($sync_url);
            $xml_document = DOMDocument::loadXML($xml_string_data);
            $data = $this -> getSynchronizationData ($xml_document, $network_data_struct);
            $this -> save_synchronization_data($data);

        }
    }

    /* We start with the root XML element and use
     * this function in a recursive way
     *
     * 11/11/2017: Added the new concept of namespace for
     * the fetched_node JSON array index. If we find
     * a namespace attribute (index) in the array XML
     * definition we return these values into the new
     * index defined by this attribute, or in the
     * last numeric position if the attribute is empty
     */
    private function getSynchronizationData ($xml_element, $network_data_struct) {

        // What's the first(s) node(s) we have to search for into the xml document?
        // The one(s) situated in the root position of the
        // $network_data_struct array (that is the same as the $xml_element object passed)
        $result = array();
        if (!empty($network_data_struct['namespace'])) {
            $hasnamespace = true;
            $namespace_value = $network_data_struct['namespace'];
            if (!empty($namespace_value)) { // associative array
                $result[$namespace_value] = array();
                $key = $namespace_value;
                $masked_result_array = $result[$key];
            }
            else { // numeric array
                $result[] = array();
                $key = key($result);
                $masked_result_array = $result[$key];
            }
        }
        else { // no namespaced XML structure
            $masked_result_array = $result;
        }

        // we check and add the textContent, if specified, of the current node
        if (/*!empty($network_data_struct['node_name'] && */!empty($network_data_struct['fetched_value'])){
            // $parent_node_name = $network_data_struct['node_name']; // not used
            $var_name = $network_data_struct['fetched_value'];
            $masked_result_array[$var_name] = $xml_element -> textContent;
        }

        // we check and add the attributes, if specified, of the current node
        if (!empty($network_data_struct['fetched_attribute'])){
            foreach ($network_data_struct['fetched_attribute'] as $attribute) {
                $attribute_name = $attribute['attribute_name'];
                $var_name = $attribute['destination_var'];
                $masked_result_array[$var_name] = $xml_element->getAttribute($attribute_name);
            }
        }

        // we check for inner nodes, if specified
        foreach ($network_data_struct['fetched_node'] as $node_to_fetch) {
            $node_tag_name = $node_to_fetch['node_name'];
            foreach ( $xml_element -> childNodes as $child ) {
                if ( $child -> nodeName == $node_tag_name ) {
                    $masked_result_array = array_merge($masked_result_array, $this -> getSynchronizationData($child, $node_to_fetch));
                }
            }
        }

        return $result;
    }
}
