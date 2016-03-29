<ul class='nav-list'>
    <li>
        <div class='list active no-shadow' data-list='pickuppacks' id='list-pickuppacks'>
            <div class='wrapper items'>
            <?php
            $getItems = mysql_query('SELECT * FROM product_categories_items WHERE parent = "packs-pickup" ORDER BY oid ASC');
            $num_items = mysql_num_rows($getItems);
            while($item = mysql_fetch_assoc($getItems)){
                $getSub = mysql_query("SELECT * FROM product_categories_sub WHERE selector = '".$item['parent']."' LIMIT 1");
                $sub = mysql_fetch_assoc($getSub); ?>
                <a class='items-block one-fourth item' id='<?php echo $item['selector']; ?>' href="<?php echo DIR_ROOT . $item['selector']; ?>">
                    <div class='item-block-content'>
                        <img class='item-block-thumb' alt='<?php echo $item['meta_keywords'] ?>' title='<?php echo $item['meta_keywords'] ?>' src='<?php echo DIR_IMAGES . '_products/' .$sub['parent'] . '/' . $item['parent'] . '/' . $item['selector']. '/' . $item['selector'].'-thumb.jpg'; ?>' />
                        <span><?php echo $item['name']; ?></span>
                    </div>
                </a>
            <?php } 
            echo "<a class='items-block item one-fourth' href='".DIR_ROOT."xt-2000-truckslide'>
                        <div class='item-block-content'>
                            <img class='item-block-thumb' alt='XT-2000 Truckslide' title='XT-2000 Truckslide' src='".DIR_IMAGES . '_products/trucks-pickup/truckslides/xt-2000-truckslide/xt-2000-truckslide-thumb.jpg'."' />
                            <span>XT-2000 Truckslide&trade;</span>
                        </div>
                      </a>";

            echo "<a class='items-block item one-fourth' href='".DIR_ROOT."xt-4000-truckslide'>
                        <div class='item-block-content'>
                            <img class='item-block-thumb' alt='XT-4000 Truckslide' title='XT-4000 Truckslide' src='".DIR_IMAGES . '_products/trucks-pickup/truckslides/xt-4000-truckslide/xt-4000-truckslide-thumb.jpg'."' />
                            <span>XT-4000 Truckslide&trade;</span>
                        </div>
                      </a>";

            echo "<a class='items-block item one-fourth' href='".DIR_ROOT."standard-surveyor-pack'>
                        <div class='item-block-content'>
                            <img class='item-block-thumb' alt='Standard Surveyor Pack' title='Standard Surveyor Pack' src='".DIR_IMAGES . '_products/trucks-pickup/packs-surveyor/standard-surveyor-pack/standard-surveyor-pack-thumb.jpg'."' />
                            <span>Standard Surveyor Pack&trade;</span>
                        </div>
                      </a>";

            echo "<a class='items-block item one-fourth' href='".DIR_ROOT."pro-surveyor-pack'>
                        <div class='item-block-content'>
                            <img class='item-block-thumb' alt='Pro Surveyor Pack' title='Pro Surveyor Pack' src='".DIR_IMAGES . '_products/trucks-pickup/packs-surveyor/pro-surveyor-pack/pro-surveyor-pack-thumb.jpg'."' />
                            <span>Pro Surveyor Pack&trade;</span>
                        </div>
                      </a>";
            ?>
            </div>
        </div>
    </li>
</ul>