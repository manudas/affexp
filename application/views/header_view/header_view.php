<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 22/10/17
 * Time: 19:09
 */
?>
<?php
    // as this is a inner view, there is no need to pass data, as it's already passed
    $this -> view ('page_container/page_container' /*, $data*/);
?>

    <header class="Header-wrap site-header" itemscope="" itemtype="http://schema.org/Organization">

<?php
    $this -> view ('top_menu/top_menu' /*, $data*/);
    $this -> view ('header_desktop/header_desktop');
?>

    </header>

<?php

    $this -> view('page_container/page_main_container');
    $this -> view ('header_mobile/header_mobile');
    $this -> view ('page_content/page_content_opening');