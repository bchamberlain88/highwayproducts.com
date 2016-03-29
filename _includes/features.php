            <h1>Product Features</h1>
            <?php
            if($product['is_base'] == 1) { 
                    features( 'base_product', $product_selector, SET_LIMIT_PRODUCT_FEATURES );
                } else {
                    features( 'product', $product_selector, SET_LIMIT_PRODUCT_FEATURES );
                } ?>
            <?php if($product['no_lightweight'] == 1) { } else { ?>
                <li class='feature' data-feature="lightweight" id="feature-<?php $GLOBALS['feat_data_id']++; echo $GLOBALS['feat_data_id']; ?>">
                    <div class='media-container ft small animate'>
                        <a class="image-container animate">
                            <img class="animate lb lazy mag-feature" alt="Half the Weight of Steel" data-id="<?php echo $GLOBALS['feat_data_id']; ?>" data-group="<?php echo $product_selector;  ?>-features" data-source='<?php echo DIR_IMAGES; ?>_misc/lightweight.jpg' data-mfp-src='<?php echo DIR_IMAGES; ?>_misc/lightweight.jpg' src='<?php echo DIR_IMAGES; ?>_misc/lightweight.jpg' />
                        </a>
                    </div>
                    <div class='feature-info'>
                        <h2>Half the Weight of Steel</h2>
                        <p>Aluminum is half the weight of steel; allowing a heavier load which gives better fuel economy while carrying additional cargo.</p>
                    </div>
                </li>
            <?php } ?>
            <?php if($product['no_shipping'] == 1) { } else { ?>
            <li class='feature' data-feature="shipping" id="feature-<?php $GLOBALS['feat_data_id']++; echo $GLOBALS['feat_data_id']; ?>">
                <div class='media-container ft small animate'>
                    <a class="image-container animate">
                        <img class="animate lb lazy mag-feature" alt="Shipping" data-id="<?php echo $GLOBALS['feat_data_id']; ?>" data-group="<?php echo $product_selector;  ?>-features" data-source='<?php echo DIR_IMAGES; ?>_misc/shipping.jpg' data-mfp-src='<?php echo DIR_IMAGES; ?>_misc/shipping.jpg' src='<?php echo DIR_IMAGES; ?>_misc/shipping.jpg' />
                    </a>
                </div>
                <div class='feature-info'>
                    <h2>Shipping</h2>
                    <p>Many of our high quality products can be shipped via common carrier truck. We can ship this package to your door or to your favorite up fitter, body shop, or weld shop.</p>
                </div>
            </li>
            <?php } ?>
            <li class='feature' data-feature="alcoa" id="feature-<?php $GLOBALS['feat_data_id']++; echo $GLOBALS['feat_data_id']; ?>">
                <div class='media-container ft small animate'>
                    <a class="image-container animate">
                        <img class="animate lb lazy mag-feature" alt="Alcoa Aluminum" data-id="<?php echo $GLOBALS['feat_data_id']; ?>" data-group="<?php echo $product_selector;  ?>-features" data-source='<?php echo DIR_IMAGES; ?>_misc/alcoa.jpg' data-mfp-src='<?php echo DIR_IMAGES; ?>_misc/alcoa.jpg' src='<?php echo DIR_IMAGES; ?>_misc/alcoa.jpg' />
                    </a>
                </div>
                <div class='feature-info'>
                    <h2>Alcoa Aluminum</h2>
                    <p>Highway Products proudly uses premium Alcoa aluminum to build the highest quality American made metal products available.</p>
                </div>
            </li>
            <?php if($product['five_year_warranty'] == 1) { ?>
                <li class='feature' data-feature="warranty" id="feature-<?php $GLOBALS['feat_data_id']++; echo $GLOBALS['feat_data_id']; ?>">
                    <div class='media-container ft small animate'>
                        <a class="image-container animate">
                            <img class="animate lb lazy mag-feature" alt="Lifetime Warranty" data-id="<?php echo $GLOBALS['feat_data_id']; ?>" data-group="<?php echo $product_selector;  ?>-features" data-source='<?php echo DIR_IMAGES; ?>_misc/warranty_5year.jpg' data-mfp-src='<?php echo DIR_IMAGES; ?>_misc/warranty_5year.jpg' src='<?php echo DIR_IMAGES; ?>_misc/warranty_5year.jpg' />
                        </a>
                    </div>
                    <div class='feature-info'>
                        <h2>Five Year Warranty</h2>
                        <p>Our semi truck tool boxes come with a five year warranty against defects in workmanship. Your warranty includes locking mechanisms,
                        hinges, gas props, weather stripping, and any other materials we use.</p>
                    </div>
                </li>
            <?php } else { ?>
                <li class='feature' data-feature="warranty" id="feature-<?php $GLOBALS['feat_data_id']++; echo $GLOBALS['feat_data_id']; ?>">
                    <div class='media-container ft small animate'>
                        <a class="image-container animate">
                            <img class="animate lb lazy mag-feature" alt="Lifetime Warranty" data-id="<?php echo $GLOBALS['feat_data_id']; ?>" data-group="<?php echo $product_selector;  ?>-features" data-source='<?php echo DIR_IMAGES; ?>_misc/lifetime-warranty.png' data-mfp-src='<?php echo DIR_IMAGES; ?>_misc/lifetime-warranty.png' src='<?php echo DIR_IMAGES; ?>_misc/lifetime-warranty.png' />
                        </a>
                    </div>
                    <div class='feature-info'>
                        <h2>Lifetime Warranty</h2>
                        <p>All of our standard products come with a Lifetime Warranty against defects in workmanship. Your warranty includes locking mechanisms,
                        hinges, gas props, weather stripping, and any other materials we use.</p>
                    </div>
                </li>
            <?php } ?>
        </ul>