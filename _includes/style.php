<?php if($product['no_style'] == 1) { } else { 
            if($product['id'] == 30 || $product['id'] == 31) { 
                include_once('./_includes/truckslide_style.php');
                 } else { ?>
            <ul class='product-styles'>
                <h1>Color &amp; Style Options</h1><br />
                <h4>Please click one of the boxes for more information</h4><br />
                <li class='style-option' data-name='Silverback' data-description='Our smooth aluminum finish makes quick work of sliding equipment in and sweeping debris out. Aluminum only requires minimal polishing to keep it looking like brand new.' data-style='silver'>
                    <img alt='Highway Products stlye options: Silverback' src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-silverback.jpg' />
                </li>
                <li class='style-option' data-name='Flat Black' data-description='Powder coated Flat Black The flat black finish is a handsome finishing touch, highly respected, and is always a regular choice among lots of semi and pickup truck drivers.' data-style='black'>
                    <img alt='Highway Products stlye options: Flat Black' src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-black.jpg' />
                </li>
                <li class='style-option' data-name='Black &amp; Silver' data-description="The new black and silver edition is a popular style.  The finish adds a luxurious touch to your vehicle." data-style='silver_black'>
                    <img alt='Highway Products stlye options: Black and Silver' src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-silver-black.jpg' />
                </li>
                <li class='style-option' data-name='Gladiator' data-description='The Gladiator is the newest edition to our arsenal. It offers a baked on powder coated finish with a smooth body and unique dimpled lids.' data-style='gladiator'>
                    <img alt='Highway Products stlye options: Gladiator Style' src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-gladiator.jpg' />
                </li>
                <li class='style-option' data-name='Leopard' data-description='The Leopard edition features our trademark (powder coated and shaved) diamond plate finish. Unsurpassed in looks, this finish will turn heads and attract followers with questions. Be prepared!' data-style='leopard'>
                    <img alt='Highway Products stlye options: Leopard Style' src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-leopard.jpg' />
                </li>
                <li class='style-option' data-name='Diamond Plate' data-description='Diamond plate, also known as checker plate or tread plate, is a regular pattern of raised diamonds on one side which combines the looks of toughness and durability. Sharp and Clean!' data-style='diamond'>
                    <img alt='Highway Products stlye options: Diamond Plate' src='<?php echo DIR_IMAGES; ?>_misc/_colors/color-style-diamond-plate.jpg' />
                </li>
                <li class='style-option' data-name='Custom Colors' data-description="Please call us at 1-800-866-5269 to discuss exactly what you have in mind. We cater for any customized fabrication you need, just drop us a line and ask for our sales manager and explain in detail your ideas and dreams; we'll make it a reality." data-style='custom'>
                    <span class='fa fa-eyedropper'></span>
                    <div class='custom-colors'></div>
                </li>
                <div class='selected-style'></div>
            </ul>
        <?php } } ?>