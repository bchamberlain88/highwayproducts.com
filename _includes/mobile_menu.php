<aside class='mobile-nav'>
    <a class='m_number' href='tel:18008665269'>
        <span class='fa fa-phone'></span>1-800-866-5269
    </a>
    <div class='m_quote'>
        <span class='fa fa-paper-plane'></span>Get a free quote
    </div>
    <nav>
        <ul class='m_master_list'>
            <li class='m_master_list_link'>
                <a href='<?php echo DIR_ROOT; ?>'>Home</a>
            </li>
            <li class='m_master_list_link collapsable'>
                <a>
                    <span class='fa fa-caret-right'></span>Products
                </a>
                <ul class='m_master_list_sub_list'>
                    <li>
                        <?php
                        $m_cats = mysql_query('SELECT * FROM product_categories_main');
                        ?>
                    </li>
                    <?php
                    while($m_cat = mysql_fetch_assoc($m_cats)){
                            echo "<ul class='m_sub_list collapsable'>";
                            echo "<a href='" . DIR_ROOT . $m_cat['url'] . "'>".$m_cat['category']."</a>";
                            echo "</ul>";
                    }
                    ?>
                </ul>

            </li>

            <li class='m_master_list_link'>
                <a href='<?php echo DIR_ROOT; ?>about/'>About Us</a>
            </li>

            <!--
            <li class='m_master_list_link'>
                <a href='<?php echo DIR_ROOT; ?>support/'>Product Support</a>
            </li>
            -->

            <li class='m_master_list_link'>
                <a href='<?php echo DIR_ROOT; ?>contact/'>Contact</a>
            </li>
            <li>
                <ul class='m_socials'>
                    <li class='m_social m_facebook'>
                        <a><span class='fa fa-facebook'></span></a>
                    </li>
                    <li class='m_social m_twitter'>
                        <a><span class='fa fa-twitter'></span></a>
                    </li>
                    <li class='m_social m_google'>
                        <a><span class='fa fa-google-plus'></span></a>
                    </li>
                    <li class='m_social m_youtube'>
                        <a><span class='fa fa-youtube'></span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>
