<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common
{


    CREO Q NO SE NECESITA ESTA LIBRERIA. SE PUEDE AÑADIR A MI CONTROLLER Y Y USAR

$this -> auto_init_needed_resources(self::class, __FUNCTION__, array('configurations', 'translations', 'views'));

    INSTEAD OF

$this -> auto_init_needed_resources(static::class, __FUNCTION__, array('configurations', 'translations', 'views'));

    PARA OBTENER TODOS LOS RECURSOS NECESARIOS COMUNES A TODAS LAS PAGINAS







    protected $CI;

    // We'll use a constructor, as you can't directly call a function
    // from a property definition.
    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
    }

    public function load_head($current_controller) {
        $preprocessed_data =
            $this -> auto_init_needed_resources(__CLASS__, __FUNCTION__, array('configurations', 'translations', 'views'));
    }

    public function load_loginbar($current_controller)
    {
        // autoload models, translations and return views to be loaded later
        $preprocessed_data =
            $current_controller -> auto_init_needed_resources(__CLASS__, __FUNCTION__, array('links', 'views', 'translations'));

        /* Starting to prepare data to be passed to the views */
        /* Building up all the needed data to pass to the views */
        $offer_alt_img_text = $this->CI->lang->line('offer_alt_img');
        $offer_title_img_text = $this->CI->lang->line('offer_title_img');

        $links_data_list = $preprocessed_data['links'];
        foreach ($links_data_list as &$link_data) {
            $text = $this->CI->lang->line($link_data -> name .'_text');
            $title = $this->CI->lang->line($link_data -> name .'_title');
            $link_data -> title = $title;
            $link_data -> text = $text;
        }

        /* Collecting all the data all the views need in a $data array */
        $data = array('liks' => $links_data_list);
        /* End of data preparation to be passed to the views */

        // autoload views, it couldn't be autoloaded without data in the other method
        $current_controller -> autoload_views($preprocessed_data['views'], $data);
    }

    public function load_footer($current_controller) {

    }
}