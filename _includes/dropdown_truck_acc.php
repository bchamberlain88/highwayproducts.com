<ul class='nav-list'>
    <li>
        <div class='list active' data-list='trucks-pickup' id='list-trucks-pickup'>
            <div class='wrapper items'>
            <?php
            $getSubs = mysql_query('SELECT * FROM product_categories_sub WHERE parent = \'trucks-pickup\' and selector not like \'bodies-tow\' and selector not like \'miscellaneous\' ORDER BY oid ASC');
            $num_items = mysql_num_rows($getSubs);
            while($sub = mysql_fetch_assoc($getSubs)){
                $i++;
                if($i == 6 ){ ?>
                    <a class='items-block one-fourth item' id='truck-bed-caps' href="<?php echo DIR_ROOT; ?>bed-covers">
                        <div class='item-block-content'>    
                            <img class='item-block-thumb' title="Aluminum Bed Covers" alt="Aluminum Bed Covers" src='<?php echo DIR_IMAGES ?>_products/trucks-pickup/miscellaneous/bed-covers/bed-covers-thumb.jpg' />
                            <span>Bed Covers</span>
                        </div>
                    </a>
                    <a class='items-block one-fourth item' id='truck-bed-rails' href="<?php echo DIR_ROOT; ?>truck-bed-rails">
                        <div class='item-block-content'>
                            <img class='item-block-thumb' alt="Aluminum Truck Bed Rails" title="Aluminum Truck Bed Rails" src='<?php echo DIR_IMAGES ?>_products/trucks-pickup/miscellaneous/truck-bed-rails/truck-bed-rails-thumb.jpg' />
                            <span>Truck Bed Rails</span>
                        </div>
                    </a>
                <?php } ?>
                <?php if($i == 11 ){ ?>
                    <a class='items-block item one-fourth' href="<?php echo DIR_ROOT; ?>highwayman-rv-hauler-tow-body">
                        <div class='item-block-content'>
                            <img class='item-block-thumb' alt="Highwayman RV Hauler Tow Body" title="Highwayman RV Hauler Tow Body" src='<?php echo DIR_IMAGES ?>_products/trucks-pickup/bodies-tow/highwayman-rv-hauler-tow-body/highwayman-rv-hauler-tow-body-thumb.jpg' />
                            <span>Highwayman&trade; RV Hauler</span>
                        </div>
                    </a>
                    <a class='items-block item one-fourth' href='<?php echo DIR_ROOT; ?>hunting-accessories'>
                    <div class='item-block-content'>
                        <img class='item-block-thumb' alt='Hunting Accessories for Trucks' title='Hunting Accessories for Trucks' src='<?php echo DIR_IMAGES ?>_products/hunting-accessories/hunting-accessories_thumb.jpg' />
                        <span>Hunting Accessories</span>
                    </div>
                  </a>
                <?php } if($i == 12 ){ ?>
                    <a class='items-block item one-fourth' href='<?php echo DIR_ROOT; ?>closeout'>
                    <div class='item-block-content'>
                        <img class='item-block-thumb' alt='Closeout Section' title='Closeout Section' src='<?php echo DIR_IMAGES ?>_header/closeout.jpg' />
                        <span>Closeout Section</span>
                    </div>
                  </a>
                <?php continue; } 
                $getItemThumb = mysql_query("SELECT * FROM product_categories_items WHERE parent = '".$sub['selector']."' LIMIT 1");
                $itemThumb = mysql_fetch_assoc($getItemThumb); ?>
                <a class='items-block one-fourth' id='<?php echo $sub['selector']; ?>'>
                    <div class='item-block-content'>
                        <img class='item-block-thumb' alt='<?php echo $sub['meta_keywords'] ?>' title='<?php echo $sub['meta_keywords'] ?>' src='<?php echo DIR_IMAGES . '_products/' . $sub['parent'] . '/' . $sub['selector'] . '/'. $sub['selector'].'_thumb.jpg'; ?>' />
                        <span><?php echo $sub['name']; ?></span>
                    </div>
                </a>
                <div class='items-listings' id='<?php echo $sub['selector']; ?>'>
                    <a class='hide-listings'><span class='fa fa-angle-left'></span>Back</a>
                        <h2><?php echo $sub['name']; ?></h2>
                        <?php $getListItems = mysql_query("SELECT * FROM product_categories_items WHERE is_visible = 1 AND parent = '".$sub['selector']."'");
                        while($listItem = mysql_fetch_assoc($getListItems)){
                        $getItemParent = mysql_query("SELECT * FROM product_categories_sub WHERE selector = '".$listItem['parent']."'");
                        $listItemParent = mysql_fetch_assoc($getItemParent); ?>
                        <a class='items-block item one-fourth' href='<?php echo DIR_ROOT . $listItem['selector']; ?>' id='<?php echo $listItem['selector']; ?>'>
                            <div class='item-block-content'>
                                <img class='item-block-thumb' alt='<?php echo $listItem['meta_keywords']; ?>' title='<?php echo $listItem['meta_keywords']; ?>' src='<?php echo DIR_IMAGES . '_products/' . $listItemParent['parent'] . '/' . $listItemParent['selector'] . '/' .  $listItem['selector'] . '/' . $listItem['selector'] . '-thumb.jpg'; ?>' />
                                <span><?php echo $listItem['name']; ?></span>
                            </div>
                        </a>
            <?php }
            if($sub['selector'] == "aluminum-truck-tool-boxes") {
              echo "<a class='items-block item one-fourth' href='".DIR_ROOT."fifth-wheel-tool-boxes'>
                        <div class='item-block-content'>
                            <img class='item-block-thumb' alt='Fifth Wheel Tool Boxes' title='Fifth Wheel Tool Boxes' src='".DIR_IMAGES . '_products/trucks-pickup/fifth-wheel-tool-boxes/fifth-wheel-tool-boxes_thumb.jpg'."' />
                            <span>5th Wheel Tool Boxes</span>
                        </div>
                    </a>";
              echo "<a class='items-block item one-fourth' href='".DIR_ROOT."fuel-tanks'>
                      <div class='item-block-content'>
                          <img class='item-block-thumb' alt='Fuel & Tool Tanks' title='Fuel & Tool Tanks' src='".DIR_IMAGES . '_products/trucks-pickup/fuel-tanks/fuel-tanks_thumb.jpg'."' />
                          <span>Fuel &amp; Tool Tanks</span>
                      </div>
                    </a>";
            }
            if($sub['selector'] == "bodies-service") {
                echo "<a class='items-block item one-fourth' href='".DIR_ROOT."cargo-baskets'>
                        <div class='item-block-content'>
                            <img class='item-block-thumb' alt='Cargo Baskets' title='Cargo Baskets' src='".DIR_IMAGES . '_products/trucks-pickup/miscellaneous/cargo-baskets/cargo-baskets-thumb.jpg'."' />
                            <span>Cargo Baskets</span>
                        </div>
                      </a>";
                echo "<a class='items-block item one-fourth' href='".DIR_ROOT."custom-drawers'>
                        <div class='item-block-content'>
                            <img class='item-block-thumb' alt='Custom Drawers for Trucks' title='Custom Drawers for Trucks' src='".DIR_IMAGES . '_products/custom-aluminum-fabrication/custom-drawers/custom-drawers-thumb.jpg'."' />
                            <span>Custom Drawers</span>
                        </div>
                      </a>";
            }
            if($sub['selector'] == "truck-storage-boxes") {
                echo "<a class='items-block item one-fourth' href='".DIR_ROOT."custom-drawers'>
                        <div class='item-block-content'>
                            <img class='item-block-thumb' alt='Custom Drawers for Trucks' title='Custom Drawers for Trucks' src='".DIR_IMAGES . '_products/custom-aluminum-fabrication/custom-drawers/custom-drawers-thumb.jpg'."' />
                            <span>Custom Drawers</span>
                        </div>
                      </a>";
            } ?>
                </div>
    <?php } unset($i); ?>
            </div>
        </div>
    </li>    
</ul>