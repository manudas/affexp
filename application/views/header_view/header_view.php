<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 22/10/17
 * Time: 19:09
 */
?>
<?php

    die('que toca hacer? buscar MobileHeader--fixed en layout.js para poner el mobileheader fixed cuando hay scroll en mobile.
    mirar tb cuando se hace scroll hacia abajo y mobileheader esta puesto con fixed como
    page-main recibe el atributo top:-????px
    podemos mirar layout.js en webarchive si lo he olvidado de copiar aqui
    tb hay que irar porque el footer queda por delante del menú desplegado en movil');

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
