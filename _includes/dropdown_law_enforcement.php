<ul class='nav-list'>
  <li>
    <div class='list active no-shadow' data-list='law-enforcement' id='list-law-enforcement'>
      <div class='wrapper items'>
        <?php
        $getItems = mysql_query('SELECT * FROM product_categories_items WHERE parent = "aluminum-law-enforcement-accessories" ORDER BY oid ASC');
        $num_items = mysql_num_rows($getItems);
        while($item = mysql_fetch_assoc($getItems)){
          $getMain = mysql_query("SELECT * FROM product_categories_main WHERE selector = '".$item['parent']."' LIMIT 1");
            $main = mysql_fetch_assoc($getMain); ?>
            <a class='items-block one-fourth item' id='<?php echo $item['selector']; ?>' href="<?php echo DIR_ROOT . $item['selector']; ?>">
              <div class='item-block-content'>
                <img class='item-block-thumb' alt='<?php echo $item['meta_keywords'] ?>' title='<?php echo $item['meta_keywords'] ?>' src='<?php echo DIR_IMAGES . '_products/' .$main['selector'] . '/' . $item['selector']. '/' . $item['selector'].'-thumb.jpg'; ?>' />
                <span><?php echo $item['name']; ?></span>
              </div>
            </a>
        <?php } ?>
      </div>
    </div>
  </li>
</ul>