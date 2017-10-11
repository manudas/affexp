<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="HomeMerchantLogos">
    <div>
        <ul>
            <?php 
                for ($i = 0; $i < count($merchant_list); $i++):
                    $merchant_data = $merchant_list[$i];   
            ?>
                    <li class="index-<?php echo $i?>">
                        <a href="<?php echo $merchant_data['url']?>">
                            <img class="lazy" src="<?php echo $merchant_data['img']?>" alt="<?php echo $merchant_data['imgalt']?>" title="<?php echo $merchant_data['imgtitle']?>" width="89" height="89" />
                        </a>
                        <?php echo "borrar item?: ".$item;?>
                    </li>
            <?php 
                endfor;
            ?>    
        </ul>
    </div>
</section>