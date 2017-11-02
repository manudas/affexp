<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section id="HomeMerchantLogos">
    <div>
        <ul>
            <?php

                for ($i = 0; $i < count($merchant_list); $i++):

                    $merchant_data = $merchant_list[$i];
                    if (!empty($merchant_data['imgsrc'])) {

                        $img_group_description = !empty($merchant_data['img_group_description']) ? $merchant_data['img_group_description'] : '';
                        $img_description = !empty($merchant_data['img_description']) ? $merchant_data['img_description'] : '';

                        ?>

                        <li class="index-<?php echo $i ?>">
                            <a href="<?php echo $merchant_data['url'] ?>">
                                <img class="lazy" src="<?php echo base_url() . $merchant_data['imgsrc'] ?>"
                                     alt="<?php echo $img_group_description . ' - ' . $img_description ?>"
                                     title="<?php echo $img_group_description . ' - ' . $img_description ?>" width="89" height="89"/>
                            </a>
                        </li>
                        <?php
                    }
                endfor;
            ?>    
        </ul>
    </div>
</section>