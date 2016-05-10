<ul class='nav-list'>
                        <div class='list active no-shadow' data-list='flatbeds' id='list-flatbeds'>
                            <div class='wrapper items'>
                                <?php
                                $getItems = mysql_query('SELECT * FROM product_categories_items WHERE parent = "hunting-accessories" ORDER BY oid ASC');
                                $num_items = mysql_num_rows($getItems);
                                while($item = mysql_fetch_assoc($getItems)){
                                    $getSub = mysql_query("SELECT * FROM product_categories_sub WHERE selector = '".$item['parent']."' LIMIT 1");
                                    $sub = mysql_fetch_assoc($getSub); ?>
                                    <a class='items-block one-fourth item' id='<?php echo $item['selector']; ?>' href="<?php echo DIR_ROOT . $item['selector']; ?>">
                                        <div class='item-block-content'>
                                            <img class='item-block-thumb' src='<?php echo DIR_IMAGES . '_products/' .$sub['parent'] . '/' . $item['parent'] . '/' . $item['selector']. '/' . $item['selector'].'-thumb.jpg'; ?>' />
                                            <span><?php echo $item['name']; ?></span>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </ul>