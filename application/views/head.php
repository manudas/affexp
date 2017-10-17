<?php

    function get_view_relative_path($view_name) {
        $view_name_arr = explode('/', $view_name);
        array_pop($view_name_arr); // removes the last arr element (the view, to leave the path only)
        $view_path = implode('/', $view_name_arr);
        return $view_path;
    }

    $already_added_style = array();
    $already_added_script = array();
?>

<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>
            <?php
                echo $configurations['title'] . ' - '
                    . (!empty($configurations['sitename']) ? $configurations['sitename'] . ' - ' : '')
                    . (!empty($configurations['siteurl']) ? $configurations['siteurl'] : '') ;
            ?>
        </title>
        <style>

            <?php


                $style_string = "";


                // general styles to load

                $general_css_files = glob(FCPATH.'assets/styles/*.css');

                if (!empty($general_css_files)) {
                    foreach ($general_css_files as $css_file) {
                        $style_string .= file_get_contents($css_file) . PHP_EOL;
                    }
                }

                // end of general styles to load


                foreach ($view_list as $view_name) {

                    $view_path = get_view_relative_path($view_name);

                    $css_files = glob(FCPATH.'assets/styles/'.$view_path.'/*.css');

                    if (!empty($css_files)) {
                        foreach ($css_files as $css_file) {
                            $css_file_md5 = md5_file($css_file);
                            if (!in_array($css_file_md5, $already_added_style) ) {
                                $style_string .= file_get_contents($css_file) . PHP_EOL;
                                $already_added_style[$css_file] = $css_file_md5;
                            }
                        }
                    }
                }

                $style_string = str_replace('{project_url}', base_url(), $style_string);

                echo $style_string;
            ?>

        </style>

        <?php
            // SCRIPT FOR ASYNCHRONOUS CSS LOADING
            if ( !empty($other_css) ) {

            ?>
            <script>

                $js_async_other_css = "'" . implode( "','", $other_css ) . "'";

                function loadAsyncStyleSheets() {
                    var head = document.getElementsByTagName('head')[0];

                    var asyncStyleSheets = [

                        <?php
                            echo $js_async_other_css;
                        ?>

                    ];

                    for (var i = 0; i < asyncStyleSheets.length; i++) {
                        var link = document.createElement('link');
                        var rel = document.createAttribute('rel');
                        var href = document.createAttribute('href');

                        rel.value = 'stylesheet';
                        href.value = asyncStyleSheets[i];

                        link.setAttributeNode(rel);
                        link.setAttributeNode(href);

                        head.appendChild(link);
                    }
                }

                window.addEventListener('load',loadAsyncStyleSheets,false);

            </script>

            <?php
            }
        ?>


        <?php
            $script_string = "";
            foreach ($view_list as $view_name) {

                $view_path = get_view_relative_path($view_name);

                $script_files = glob(FCPATH . 'assets/scripts/' . $view_path . '/*.js');

                if (!empty($script_files)) {
                    foreach ($script_files as $script_file) {


                        // avoid adding the same script
                        $script_file_md5 = md5_file($script_file);
                        if (!in_array($script_file_md5, $already_added_script) ) {
                            $script_string .= file_get_contents($script_file) . PHP_EOL;
                            $already_added_style[$script_file] = $script_file_md5;
                        }

                    }
                }
            }
            if( !empty($script_string) ) {



                $script_string = str_replace('{project_url}', base_url(), $script_string);



                if (ENVIRONMENT == 'production') {
                    $base64_js = 'data:text/javascript;base64,' . base64_encode($script_string);
                    ?>

                    <script src="<?php echo $base64_js ?>" defer />

                    <?php
                }
                else {
                    ?>
                    <script>
                        <?php
                            echo $script_string;
                        ?>
                    </script>
                    <?php
                }
            }

            if ( !empty($other_script) ) {
                foreach ($other_script as $another_script) {
                    ?>
                    <script src="<?php echo $another_script ?>" defer />
                    <?php
                }
            }
        ?>
    </head>
    <body>