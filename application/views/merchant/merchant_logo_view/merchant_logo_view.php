<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
sustituir image url por objetos image asociados con otros que sean imageGroup
con imageGroup->description = 'merchantLogo'. cambiar tipo de tabla de atributo img
a atributo img_group_description y coger primera imagen activa
<section id="HomeMerchantLogos">
    <div>
        <ul>
            <?php 
                for ($i = 0; $i < count($merchant_list); $i++):
                    $merchant_data = $merchant_list[$i];

            ?>
                    <li class="index-<?php echo $i?>">
                        <a href="<?php echo $merchant_data['url']?>">
                            <img class="lazy" src="<?php echo base_url().$merchant_data['img']?>" alt="<?php echo $merchant_data['imgalt']?>" title="<?php echo $merchant_data['imgtitle']?>" width="89" height="89" />
                        </a>
                    </li>
            <?php 
                endfor;
            ?>    
        </ul>
    </div>
</section>