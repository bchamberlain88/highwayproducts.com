<ul class='nav-list'>
    <li>
        <div class='list active no-shadow' data-list='semi-accessories' id='list-semi-accessories'>
            <div class='wrapper items'>
                <?php
                $getItems = mysql_query('SELECT * FROM product_categories_items WHERE parent = "trucks-semi" ORDER BY oid ASC');
                $num_items = mysql_num_rows($getItems);
                while($item = mysql_fetch_assoc($getItems)){
                    $getSub = mysql_query("SELECT * FROM product_categories_sub WHERE selector = '".$item['parent']."' LIMIT 1");
                    $sub = mysql_fetch_assoc($getSub); ?>
                    <a class='items-block one-fourth item' id='<?php echo $item['selector']; ?>' href="<?php echo DIR_ROOT . $item['selector']; ?>">
                        <div class='item-block-content'>
                            <img class='item-block-thumb' alt='<?php echo $item['meta_keywords'] ?>' title='<?php echo $item['meta_keywords'] ?>' src='
                            <?php 
                            if($item['is_base'] == 1) {
                            //if it's an item from a base category, remove unneccessary dir
                            echo DIR_IMAGES . '_products/' . $sub['parent'] . '/' .  $item['selector']. '/' . $item['selector'].'-thumb.jpg'; 
                            } else {
                            echo DIR_IMAGES . '_products/' .$sub['parent'] . '/' . $item['parent'] . '/' . $item['selector']. '/' . $item['selector'].'-thumb.jpg';  
                            }?>'/>
                            <span><?php echo $item['name']; ?></span>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </li>
</ul>