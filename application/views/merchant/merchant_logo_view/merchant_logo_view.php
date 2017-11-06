<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section id="HomeMerchantLogos">
    <div>
        <ul>
            <?php

                $already_printed_merchant = array();

                for ($i = 0; $i < count($merchant_list); $i++):

                    $merchant_data = $merchant_list[$i];
                    if (!empty($merchant_data['imgsrc'])) {

                        if (in_array($merchant_data['id_merchant'], $already_printed_merchant)) {
                            // we already printed one image of this merchant, skipping any more of the same merchant
                            continue;
                        }
                        else {
                            $already_printed_merchant[] = $merchant_data['id_merchant'];
                        }

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