<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <title>
        <?php
            echo $title . ' - ' . $sitename;
        ?>
    </title>
    <style>

        <?php
            $style_string = "";

            $css_files = glob(FCPATH.'/assets/css/'.$view.'/*.css');

            if (!empty($css_files)) {
                foreach ($css_files as $css_file) {
                    $style_string .= file_get_contents($css_file).'\n';
                }
            }

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

        $script_files = glob(FCPATH.'/assets/css/'.$view.'/*.js');

        if (!empty($script_files)) {
            foreach ($script_files as $script_file) {
                $script_string .= file_get_contents($script_file).'\n';
            }
        }

        if( !empty($script_string) ) {

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
  