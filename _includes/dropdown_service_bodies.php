<ul class='nav-list'>
    <li>
        <div class='list active no-shadow' data-list='service-bodies' id='list-service-bodies'>
            <div class='wrapper items'>
                <?php
                $getItems = mysql_query('SELECT * FROM product_categories_items WHERE parent = "bodies-service" ORDER BY oid ASC');
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
                 ?>
            </div>
        </div>
    </li>
</ul>