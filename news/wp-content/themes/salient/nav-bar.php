
    <ul class='nav-links thumbs'>

            <!-- truck accessories -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand' href="<?php echo DIR_ROOT; ?>pickup-trucks">
                    <img src='<?php echo DIR_IMAGES; ?>_header/truck-accessories-1-rollover.png'/>
                    <h2><span class="hide eleven-twenty">Truck </span>Accessories</h2>
                </a>

                <ul class='nav-list'>

                      <div class='list active' data-list='trucks-pickup' id='list-trucks-pickup'>

                           <div class='wrapper items'>

                                <?php

                                $getSubs = mysql_query('SELECT * FROM product_categories_sub WHERE parent = "trucks-pickup" ORDER BY oid ASC');
                                $num_items = mysql_num_rows($getSubs);
                                while($sub = mysql_fetch_assoc($getSubs)){
                                    $i++;
                                            if($i == 6 ){ ?>
                                                    <a class='items-block one-fourth item' id='truck-bed-caps' href="<?php echo DIR_ROOT; ?>truck-bed-caps">
                                                        <div class='item-block-content'>
                                                            <img class='item-block-thumb' src='<?php echo DIR_IMAGES ?>_products/trucks-pickup/miscellaneous/truck-bed-caps/truck-bed-caps-thumb.jpg' />
                                                            <label>Truck Bed Caps</label>
                                                        </div>
                                                    </a>

                                                    <a class='items-block one-fourth item' id='truck-bed-rails' href="<?php echo DIR_ROOT; ?>truck-bed-rails">
                                                        <div class='item-block-content'>
                                                            <img class='item-block-thumb' src='<?php echo DIR_IMAGES ?>_products/trucks-pickup/miscellaneous/truck-bed-rails/truck-bed-rails-thumb.jpg' />
                                                            <label>Truck Bed Rails</label>
                                                        </div>
                                                    </a>
                                            <?php }
                                    $getItemThumb = mysql_query("SELECT * FROM product_categories_items WHERE parent = '".$sub['selector']."' LIMIT 1");
                                    $itemThumb = mysql_fetch_assoc($getItemThumb); ?>
                                    <a class='items-block one-fourth' id='<?php echo $sub['selector']; ?>'>
                                        <div class='item-block-content'>
                                            <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/' . $sub['parent'] . '/' . $sub['selector'] . '/'. $sub['selector'].'_thumb.jpg'; ?>' />
                                            <label><?php echo $sub['name']; ?></label>
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
                                                    <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/' . $listItemParent['parent'] . '/' . $listItemParent['selector'] . '/' .  $listItem['selector'] . '/' . $listItem['selector'] . '-thumb.jpg'; ?>' />
                                                    <label><?php echo $listItem['name']; ?></label>
                                                </div>
                                            </a>
                                        <?php }

                                        if($sub['selector'] == "truck-tool-boxes") {
                                            echo "<a class='items-block item one-fourth' href='".DIR_ROOT."fifth-wheel-tool-boxes'>
                                                    <div class='item-block-content'>
                                                        <img class='item-block-thumb' src='".DIR_IMAGES . '_products/trucks-pickup/fifth-wheel-tool-boxes/fifth-wheel-tool-boxes_thumb.jpg'."' />
                                                        <label>5th Wheel Tool Boxes</label>
                                                    </div>
                                                  </a>";

                                            echo "<a class='items-block item one-fourth' href='".DIR_ROOT."fuel-tanks'>
                                                    <div class='item-block-content'>
                                                        <img class='item-block-thumb' src='".DIR_IMAGES . '_products/trucks-pickup/fuel-tanks/fuel-tanks_thumb.jpg'."' />
                                                        <label>Fuel Tanks</label>
                                                    </div>
                                                  </a>";

                                        }

                                        if($sub['selector'] == "miscellaneous") {
                                            
                                            echo "<a class='items-block item one-fourth' href='".DIR_ROOT."hunting-accessories'>
                                                    <div class='item-block-content'>
                                                        <img class='item-block-thumb' src='".DIR_IMAGES . '_products/specialty-products/hunting-accessories/hunting-accessories_thumb.jpg'."' />
                                                        <label>Hunting Accessories</label>
                                                    </div>
                                                  </a>";
                                            echo "<a class='items-block item one-fourth' href='".DIR_ROOT."custom-drawers'>
                                                    <div class='item-block-content'>
                                                        <img class='item-block-thumb' src='".DIR_IMAGES . '_products/custom-fabrication/custom-drawers/custom-drawers-thumb.jpg'."' />
                                                        <label>Custom Drawers</label>
                                                    </div>
                                                  </a>";

                                        } ?>
                                    </div>
                                <?php } ?>

                            </div>

                      </div>

                </ul>

            </li>

            <!-- service bodies -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>service-bodies'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/service-bodies-2-rollover.png'/>
                    <h2>Service Bodies</h2>
                </a>

                <ul class='nav-list'>

                      <div class='list active' data-list='service-bodies' id='list-service-bodies'>

                           <div class='wrapper items'>

                                <?php

                                $getItems = mysql_query('SELECT * FROM product_categories_items WHERE parent = "bodies-service" ORDER BY oid ASC');
                                $num_items = mysql_num_rows($getItems);
                                while($item = mysql_fetch_assoc($getItems)){
                                    $getSub = mysql_query("SELECT * FROM product_categories_sub WHERE selector = '".$item['parent']."' LIMIT 1");
                                    $sub = mysql_fetch_assoc($getSub); ?>
                                    <a class='items-block one-fourth item' id='<?php echo $item['selector']; ?>' href="<?php echo DIR_ROOT . $item['selector']; ?>">
                                        <div class='item-block-content'>
                                            <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/' .$sub['parent'] . '/' . $item['parent'] . '/' . $item['selector']. '/' . $item['selector'].'-thumb.jpg'; ?>' />
                                            <label><?php echo $item['name']; ?></label>
                                        </div>
                                    </a>
                                <?php } ?>

                            </div>

                      </div>

                </ul>

            </li>

            <!-- aluminum flatbeds 1 -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>aluminum-flatbeds'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/aluminum-flatbeds-3-rollover.png'/>
                    <h2><span class="hide eleven-twenty">Aluminum </span>Flatbeds</h2>
                </a>

                <ul class='nav-list'>

                      <div class='list active' data-list='flatbeds' id='list-flatbeds'>

                           <div class='wrapper items'>

                                <?php

                                $getItems = mysql_query('SELECT * FROM product_categories_items WHERE parent = "flatbeds" ORDER BY oid ASC');
                                $num_items = mysql_num_rows($getItems);
                                while($item = mysql_fetch_assoc($getItems)){
                                    $getSub = mysql_query("SELECT * FROM product_categories_sub WHERE selector = '".$item['parent']."' LIMIT 1");
                                    $sub = mysql_fetch_assoc($getSub); ?>
                                    <a class='items-block one-fourth item' id='<?php echo $item['selector']; ?>' href="<?php echo DIR_ROOT . $item['selector']; ?>">
                                        <div class='item-block-content'>
                                            <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/' .$sub['parent'] . '/' . $item['parent'] . '/' . $item['selector']. '/' . $item['selector'].'-thumb.jpg'; ?>' />
                                            <label><?php echo $item['name']; ?></label>
                                        </div>
                                    </a>
                                <?php } ?>

                            </div>

                      </div>

                </ul>

            </li>

            <!-- semi accessories -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/semi-accessories-4-rollover.png'/>
                    <h2>Semi Accessories</h2>
                </a>

                <ul class='nav-list'>

                    <div class='list active' data-list='trucks-semi' id='list-trucks-semi'>

                           <div class='wrapper items'>

                                <?php

                                $getSubs = mysql_query('SELECT * FROM product_categories_sub WHERE parent = "trucks-semi" ORDER BY oid ASC');
                                $num_items = mysql_num_rows($getSubs);
                                while($sub = mysql_fetch_assoc($getSubs)){
                                    $getItemThumb = mysql_query("SELECT * FROM product_categories_items WHERE parent = '".$sub['selector']."' LIMIT 1");
                                    $itemThumb = mysql_fetch_assoc($getItemThumb); ?>
                                    <a class='items-block one-fourth' id='<?php echo $sub['selector']; ?>'>
                                        <div class='item-block-content'>
                                            <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/' . $sub['parent'] . '/' . $sub['selector'] . '/' .  $itemThumb['selector'] . '/' . $itemThumb['thumbnail']; ?>' />
                                            <label><?php echo $sub['name']; ?></label>
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
                                                    <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/' . $listItemParent['parent'] . '/' . $listItemParent['selector'] . '/' .  $listItem['selector'] . '/' . $listItem['thumbnail']; ?>' />
                                                    <label><?php echo $listItem['name']; ?></label>
                                                </div>
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>



                            </div>

                      </div>

                </ul>

            </li>

            <!-- custom fabrication -->
            <li class='nav-link drop'>

                <a class='nav-img animate expand'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/custom-fabrication-5-rollover.png'/>
                    <h2>Custom<span class="hide eleven-twenty"> Fabrication</span></h2>
                </a>

                <ul class='nav-list'>

                <div class='wrapper items'>

                <div class='custom-row'>
                    <a class='custom-thumb' href='<?php echo DIR_ROOT; ?>custom-tool-boxes'>
                        <img alt='Highway Products Inc. Custom Tool Boxes' src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-toolbox.jpg' />
                        <label>Custom Tool Boxes</label>
                    </a>
                    <a class='custom-thumb' href='<?php echo DIR_ROOT; ?>custom-service-bodies'>
                        <img alt='Highway Products Inc. Custom Service Bodies' src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-service-body.jpg' />
                        <label>Custom Service Bodies</label>
                    </a>
                    <a class='custom-thumb' href='<?php echo DIR_ROOT; ?>custom-flatbeds'>
                        <img alt='Highway Products Inc. Custom Flatbeds' src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-flatbed.jpg' />
                        <label>Custom Flatbeds</label>
                    </a>
                </div>
                <div class='custom-row'>
                    <a class='custom-thumb' href='<?php echo DIR_ROOT; ?>custom-lockup-boxes'>
                        <img alt='Highway Products Inc. Custom Lockup Boxes' src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-lockup-box.jpg' />
                        <label>Custom Lockup Boxes</label>
                    </a>
                    <a class='custom-thumb' href='<?php echo DIR_ROOT; ?>custom-fire-trucks'>
                        <img alt='Highway Products Inc. Custom Fire Trucks' src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-firetruck.jpg' />
                        <label>Custom Fire Trucks</label>
                    </a>
                    <a class='custom-thumb' href='<?php echo DIR_ROOT; ?>custom-hunting-accessories'>
                        <img alt='Highway Products Inc. Custom Hunting Solutions' src='http://www.highwayproducts.com/images/rollercoaster/cad/custom-hunting-solution.jpg' />
                        <label>Custom Hunting Solutions</label>
                    </a>
                </div>
                <div class='custom-row'>
                    <a class='custom-thumb' href='<?php echo DIR_ROOT; ?>custom-storage-boxes'>
                        <img alt='Highway Products Inc. Custom Storage Boxes' src='<?php echo DIR_IMAGES; ?>_products/custom-fabrication/custom-storage-boxes/custom-storage-boxes-thumb.jpg' />
                        <label>Custom Storage Boxes</label>
                    </a>
                    <a class='custom-thumb' href='<?php echo DIR_ROOT; ?>time-capsules'>
                        <img alt='Highway Products Inc. Time Capsules' src='<?php echo DIR_IMAGES; ?>_products/custom-fabrication/time-capsules/time-capsules-thumb.jpg' />
                        <label>Time Capsules</label>
                    </a>
                    <a class='custom-thumb' href='<?php echo DIR_ROOT; ?>custom-drawers'>
                        <img alt='Highway Products Inc. Custom Drawers' src='<?php echo DIR_IMAGES; ?>_products/custom-fabrication/custom-drawers/custom-drawers-thumb.jpg' />
                        <label>Custom Drawers</label>
                    </a>
                </div>

                </div>

                </ul>

            </li>

            <!-- rv tow bodies -->
            <li class='nav-link'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>body-tow-highwayman'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/RV-tow-bodies-6-rollover.png'/>
                    <h2>RV Tow Bodies</h2>
                </a>

            </li>

     <!-- law enforcement -->
    <li class='nav-link drop'>

                <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>law-enforcement'>
                    <img src='<?php echo DIR_IMAGES; ?>_header/law-enforcement-7-rollover.png'/>
                    <h2>Law Enforcement</h2>
                </a>

                <ul class='nav-list'>

                      <div class='list active' data-list='law-enforcement' id='list-law-enforcement'>

                           <div class='wrapper items'>

                                <?php

                                $getItems = mysql_query('SELECT * FROM product_categories_items WHERE parent = "law-enforcement" ORDER BY oid ASC');
                                $num_items = mysql_num_rows($getItems);
                                while($item = mysql_fetch_assoc($getItems)){
                                    $getSub = mysql_query("SELECT * FROM product_categories_sub WHERE selector = '".$item['parent']."' LIMIT 1");
                                    $sub = mysql_fetch_assoc($getSub); ?>
                                    <a class='items-block one-fourth item' id='<?php echo $item['selector']; ?>' href="<?php echo DIR_ROOT . $item['selector']; ?>">
                                        <div class='item-block-content'>
                                            <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/' .$sub['parent'] . '/' . $item['parent'] . '/' . $item['selector']. '/' . $item['selector'].'-thumb.jpg'; ?>' />
                                            <label><?php echo $item['name']; ?></label>
                                        </div>
                                    </a>
                                <?php } ?>

                            </div>

                      </div>

                </ul>

            </li>

    <!-- pickup packs -->
    <li class='nav-link'>

        <a class='nav-img animate expand' href='<?php echo DIR_ROOT; ?>pickup-packs'>
            <img src='<?php echo DIR_IMAGES; ?>_header/pickup-pack-8-rollerover.png'/>
            <h2>Pickup Packs</h2>
        </a>

        
        <ul class='nav-list'>

              <div class='list active' data-list='pickuppacks' id='list-pickuppacks'>

                   <div class='wrapper items'>

                        <?php

                        $getItems = mysql_query('SELECT * FROM product_categories_items WHERE parent = "packs-pickup" ORDER BY oid ASC');
                        $num_items = mysql_num_rows($getItems);
                        while($item = mysql_fetch_assoc($getItems)){
                            $getSub = mysql_query("SELECT * FROM product_categories_sub WHERE selector = '".$item['parent']."' LIMIT 1");
                            $sub = mysql_fetch_assoc($getSub); ?>
                            <a class='items-block one-fourth item' id='<?php echo $item['selector']; ?>' href="<?php echo DIR_ROOT . $item['selector']; ?>">
                                <div class='item-block-content'>
                                    <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/' .$sub['parent'] . '/' . $item['parent'] . '/' . $item['selector']. '/' . $item['selector'].'-thumb.jpg'; ?>' />
                                    <label><?php echo $item['name']; ?></label>
                                </div>
                            </a>
                        <?php } ?>

                        <a class='items-block one-fourth' id='packages'>
                            <div class='item-block-content'>
                                <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/trucks-pickup/truck-packages/truck-packages_thumb.jpg'; ?>' />
                                <label>Truck Packages</label>
                            </div>
                        </a>
                        <div class='items-listings' id='packages'>
                            <a class='hide-listings'><span class='fa fa-angle-left'></span>Back</a>
                            <h2><?php echo $sub['name']; ?></h2>
                            <?php $getListItems = mysql_query("SELECT * FROM product_categories_items WHERE is_visible = 1 AND parent = 'truck-packages'");
                            while($listItem = mysql_fetch_assoc($getListItems)){
                                $getItemParent = mysql_query("SELECT * FROM product_categories_sub WHERE selector = '".$listItem['parent']."'");
                                $listItemParent = mysql_fetch_assoc($getItemParent); ?>
                                <a class='items-block item one-fourth' href='<?php echo DIR_ROOT . $listItem['selector']; ?>' id='<?php echo $listItem['selector']; ?>'>
                                    <div class='item-block-content'>
                                        <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/' . $listItemParent['parent'] . '/' . $listItemParent['selector'] . '/' .  $listItem['selector'] . '/' . $listItem['selector'] . '-thumb.jpg'; ?>' />
                                        <label><?php echo $listItem['name']; ?></label>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>

                    </div>

              </div>

        </ul>

    </li>

</ul>
