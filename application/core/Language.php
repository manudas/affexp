<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Language {
    

    public $filepath = array();

    /**
	 * List of translations
	 *
	 * @var	array
	 */
	public $language =	array();

	/**
	 * List of loaded language files
	 *
	 * @var	array
	 */
	public $is_loaded =	array();

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		log_message('info', 'Language Class Initialized');
	}


    /**
	 * Load a language file
	 *
	 * @param	mixed	$langfile	Language file name
	 * @param	string	$idiom		Language name (english, etc.)
	 * @param	bool	$return		Whether to return the loaded array of translations
	 * @param 	bool	$add_suffix	Whether to add suffix to $langfile
	 * @param 	string	$alt_path	Alternative path to look for the language file
	 *
	 * @return	void|string[]	Array containing translations, if $return is set to TRUE
	 */
	public function load($langfile, $idiom = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '')
	{
		if (is_array($langfile))
		{
			foreach ($langfile as $value)
			{
				$this->load($value, $idiom, $return, $add_suffix, $alt_path);
			}

			return;
		}

		$langfile = str_replace('.php', '', $langfile);

		if ($add_suffix === TRUE)
		{
			$langfile = preg_replace('/_lang$/', '', $langfile).'_lang';
		}

		$langfile .= '.php';

		if (empty($idiom) OR ! preg_match('/^[a-z_-]+$/i', $idiom))
		{
			$config =& get_config();
			$idiom = empty($config['language']) ? 'english' : $config['language'];
		}

		if ($return === FALSE && isset($this->is_loaded[$langfile]) && $this->is_loaded[$langfile] === $idiom)
		{
			return;
		}

		// Load the base file, so any others found can override it
		$basepath = BASEPATH.'language/'.$idiom.'/'.$langfile;

        $final_path = $basepath;

		if (($found = file_exists($basepath)) === TRUE)
		{
			include($basepath);
		}

		// Do we have an alternative path to look in?
		if ($alt_path !== '')
		{
			$alt_path .= 'language/'.$idiom.'/'.$langfile;
			if (file_exists($alt_path))
			{
				include($alt_path);
				$found = TRUE;

                $final_path = $alt_path;
			}
		}
		else
		{
			foreach (get_instance()->load->get_package_paths(TRUE) as $package_path)
			{
				$package_path .= 'language/'.$idiom.'/'.$langfile;
				if ($basepath !== $package_path && file_exists($package_path))
				{
					include($package_path);
					$found = TRUE;

                    $final_path = $package_path;

					break;
				}
			}
		}

		if ($found !== TRUE)
		{
			show_error('Unable to load the requested language file: language/'.$idiom.'/'.$langfile);
		}

		if ( ! isset($lang) OR ! is_array($lang))
		{
			log_message('error', 'Language file contains no data: language/'.$idiom.'/'.$langfile);

			if ($return === TRUE)
			{
				return array();
			}
			return;
		}

		if ($return === TRUE)
		{
			return $lang;
		}

		$this->is_loaded[$langfile] = $idiom;
		//$this->language = array_merge($this->language, $lang);
        $this->language[$langfile] = $lang;

        $this->filepath[$langfile] = $final_path;

		log_message('info', 'Language file loaded: language/'.$idiom.'/'.$langfile);
		return TRUE;
	}


    public function setLine($line, $text, $langfile = null) {
        if (isset($line)) {
            if ($langfile == null) {
                $file_counter = count($this->is_loaded);
                if ($file_counter !== 1)
                {
                    show_error('Unable to set line for the unspecified file. Please select the file in which you want to set the line '. $line .' for the language '.$idiom);
                    return;
                }
                reset($this->is_loaded);
                $langfile = key($this->is_loaded); 
            }
            $this->language[$langfile][$line] = $text;
        }
    }

    public function save($langfile = null) {

        $lang=array();

        if ($langfile == null){

            foreach ($this->is_loaded as $langfile => $idiom) {
                $this -> save ($langfile);
            }
            
            return;
        }

        $idiom = $this -> is_loaded[$langfile]; // here we store the language name
        $filepath = $this -> filepath[$langfile]; // here we have the file where we are going to store the data
        $current_datetime = date('Y-m-d h:i:s');

        $langstr =
            "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
                /**
                *
                * Created:  " . $current_datetime . " by Manu
                *
                * Description:  " . $idiom . " language file for general views
                *
                */"."\n\n\n";

        foreach ($this -> language[$langfile] as $tag => $translated_line){
            //$lang['error_csrf'] = 'This form post did not pass our security checks.';
            $langstr.= "\$lang['".$tag."'] = \"$translated_line\";"."\n";
        }
        // write_file('./application/language/'.$my_lang.'/general_lang.php', $langstr);
        write_file($filepath, $langstr);
    }

    	// --------------------------------------------------------------------

	/**
	 * Language line
	 *
	 * Fetches a single line of text from the language array
	 *
	 * @param	string	$line		Language line key
	 * @param	bool	$log_errors	Whether to log an error message if the line is not found
	 * @return	string	Translation
	 */
	public function line($line, $langfile = '', $log_errors = TRUE)
	{

        if ($langfile == '') {
            $file_counter = count($this->is_loaded);
            if ($file_counter !== 1)
            {
                log_message('error', 'Unable to get the line for the unspecified file. Please select the file from which you want to load the line '. $line .' for the language '.$idiom);
            }
            else {
                reset($this->is_loaded);
                $langfile = key($this->is_loaded);
            } 
        }

		$value = isset($this->language[$langfile][$line]) ? $this->language[$langfile][$line] : FALSE;

		// Because killer robots like unicorns!
		if ($value === FALSE && $log_errors === TRUE)
		{
			log_message('error', 'Could not find the language line "'.$line.'"');
		}

		return $value;
	}
}