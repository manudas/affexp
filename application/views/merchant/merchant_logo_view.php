<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="HomeMerchantLogos">
    <div>
        <ul>
            <?php 
                for ($i = 0; $i < count($merchant_list); $i++):
                    $info_merchant = $merchant_list[$i];   
            ?>
                    <li class="index-<?php echo $i?>">
                        <a href="<?php echo $info_merchant['url']?>">
                            <img class="lazy" src="<?php echo $info_merchant['img']?>" alt="<?php echo $info_merchant['imgalt']?>" title="<?php echo $info_merchant['imgtitle']?>" width="89" height="89" />
                        </a>
                        <?php echo $item;?>
                    </li>
            <?php 
                endfor;
            ?>    
        </ul>
    </div>
</section>