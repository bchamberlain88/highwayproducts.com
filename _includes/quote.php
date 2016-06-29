<?php

$checkMainQuote = mysql_query('SELECT * FROM product_categories_main where url = "'.$product_selector.'" and quote_form = 1');
$checkSubQuote = mysql_query('SELECT * FROM product_categories_sub where url = "'.$product_selector.'" and quote_form = 1');
$checkItemQuote = mysql_query('SELECT * FROM product_categories_items where selector = "'.$product_selector.'" and quote_form = 1');
$getItemInfo = mysql_query('SELECT * FROM product_categories_items where selector = "'.$product_selector.'" and quote_form = 0');
$rItemInfo = mysql_fetch_assoc($getItemInfo);
$getSubInfo = mysql_query('SELECT * FROM product_categories_sub where url = "'.$product_selector.'" and quote_form = 0');
$rSubInfo = mysql_fetch_assoc($getSubInfo);
$rMainQuote = mysql_fetch_assoc($checkMainQuote);
$rSubQuote = mysql_fetch_assoc($checkSubQuote);
$rItemQuote = mysql_fetch_assoc($checkItemQuote);

//run various checks to narrow down the appropriate quote code
if (mysql_num_rows($checkMainQuote) > 0) {
    $getQuoteCodes = mysql_query('SELECT * FROM quote_codes WHERE selector = "'.$rMainQuote['url'].'"');
    $rQuoteCodes = mysql_fetch_assoc($getQuoteCodes);
    $name_id = $rQuoteCodes['name_id'];
    $form_id = $rQuoteCodes['form_id'];
    $list_id = $rQuoteCodes['list_id'];
}
if (mysql_num_rows($checkSubQuote) > 0) {
    $getQuoteCodes = mysql_query('SELECT * FROM quote_codes WHERE selector = "'.$rSubQuote['url'].'"');
    $rQuoteCodes = mysql_fetch_assoc($getQuoteCodes);
    $name_id = $rQuoteCodes['name_id'];
    $form_id = $rQuoteCodes['form_id'];
    $list_id = $rQuoteCodes['list_id'];
}
if (mysql_num_rows($checkItemQuote) > 0) {
    $getQuoteCodes = mysql_query('SELECT * FROM quote_codes WHERE selector = "'.$product_selector.'"');
    $rQuoteCodes = mysql_fetch_assoc($getQuoteCodes); 
    $name_id = $rQuoteCodes['name_id'];
    $form_id = $rQuoteCodes['form_id'];
    $list_id = $rQuoteCodes['list_id'];
}
//if the item isn't directly set with a quote form, check the parent
if (mysql_num_rows($getItemInfo) > 0) {
    //if the item is directly from a main category
    if ($rItemInfo['is_base'] == 1) {
        $CheckItemSubParent = mysql_query('SELECT * FROM product_categories_main WHERE selector = "'.$rItemInfo['parent'].'" and quote_form = 1');
        $getItemSubParent = mysql_query('SELECT * FROM product_categories_main WHERE selector = "'.$rItemInfo['parent'].'"');
        $rItemSubParent = mysql_fetch_assoc($getItemSubParent);
    } else {
        $CheckItemSubParent = mysql_query('SELECT * FROM product_categories_sub WHERE selector = "'.$rItemInfo['parent'].'" and quote_form = 1');
        $getItemSubParent = mysql_query('SELECT * FROM product_categories_sub WHERE selector = "'.$rItemInfo['parent'].'"');
        $rItemSubParent = mysql_fetch_assoc($getItemSubParent); 
    }
    if (mysql_num_rows($CheckItemSubParent) > 0) {
        //if the parent sub has a quote form, populate codes
        $getQuoteCodes = mysql_query('SELECT * FROM quote_codes WHERE selector = "'.$rItemSubParent['url'].'"');
        $rQuoteCodes = mysql_fetch_assoc($getQuoteCodes); 
        $name_id = $rQuoteCodes['name_id'];
        $form_id = $rQuoteCodes['form_id'];
        $list_id = $rQuoteCodes['list_id'];
    } else {
        //if the item's sub has no quote form, get main
        $getItemMainParent = mysql_query('SELECT * FROM product_categories_main WHERE selector = "'.$rItemSubParent['parent'].'"');
        $rItemMainParent = mysql_fetch_assoc($getItemMainParent);
        $getQuoteCodes = mysql_query('SELECT * FROM quote_codes WHERE selector = "'.$rItemMainParent['url'].'"');
        $rQuoteCodes = mysql_fetch_assoc($getQuoteCodes); 
        $name_id = $rQuoteCodes['name_id'];
        $form_id = $rQuoteCodes['form_id']; 
        $list_id = $rQuoteCodes['list_id'];
    }
}
//if the sub isn't directly set with a quote form, get the parent
if (mysql_num_rows($getSubInfo) > 0) {
    echo 'sub parent: ' . $rSubInfo['parent'];
    $getSubParent =  mysql_query('SELECT * FROM product_categories_main WHERE selector = "'.$rSubInfo['parent'].'"');
    $rSubParent = mysql_fetch_assoc($getSubParent);
    $getQuoteCodes = mysql_query('SELECT * FROM quote_codes WHERE selector = "'.$rSubParent['url'].'"');
    $rQuoteCodes = mysql_fetch_assoc($getQuoteCodes); 
    $name_id = $rQuoteCodes['name_id'];
    $form_id = $rQuoteCodes['form_id'];
    $list_id = $rQuoteCodes['list_id'];
}

//calculate other quote codes based off name id
$math_email = $name_id + 1;
$math_phone = $name_id + 2;
$math_zip = $name_id + 3;
$math_msg = $name_id + 4;
$math_contact = $name_id + 5;
$math_truck = $name_id + 6;

if(mysql_num_rows($getQuoteCodes) > 0) {
    //if the quote codes are set in the table 
    if($rQuoteCodes['use_static_codes'] == 1) { ?>
        <div class='get-quote-wrapper'>
            <div class='get-quote-content'>
                <h2>Fill out <span class='hide six_hundred'>the form below </span>for a free quote</h2>
                <span class='animate close-quote fa fa-close'></span>   
                <form class='aweber-form' data-submit='<?php echo $form_id ?>'>   
                    <input required spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $name_id ?>' name='fillname' placeholder='Full name' type='text' />    
                    <input required spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $rQuoteCodes['email_id'] ?>' name='email' placeholder='Email address' type='email' />    
                    <input spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $rQuoteCodes['phone_id'] ?>' name='phone' placeholder='Phone number' />   
                    <input spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $rQuoteCodes['zip_id'] ?>' name='zip' placeholder='ZIP code' type='text' />    
                    <textarea spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $rQuoteCodes['msg_id'] ?>' name='message' placeholder='Message'></textarea>   
                    <input spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $rQuoteCodes['contact_id'] ?>' name='contact' placeholder='When to contact' type='text'/>
                    <input spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $rQuoteCodes['truck_id'] ?>' name='truck' placeholder='Vehicle year, make, and model'    type='text' />
                    <button class='button large secondary animate submit' type='submit'>Send me a free quote!</button>
                    <input class='mc_group_id' type='hidden' value="<?php echo $rQuoteCodes['mc_group_id'] ?>" /> 
                </form>
                <div class="AW-Form-<?php echo $form_id ?>" style='left:-99999px;position:absolute;top:-99999px;display:none;'>
                </div>
                <script type="text/javascript">(function(d, s, id) {
                             var js, fjs = d.getElementsByTagName(s)[0];
                             if (d.getElementById(id)) return;
                             js = d.createElement(s); js.id = id;
                             js.src = "//forms.aweber.com/form/<?php echo $list_id . '/' . $form_id ?>.js";
                             fjs.parentNode.insertBefore(js, fjs);
                             }(document, "script", "aweber-wjs-04m0nw0rp"));
                </script>
            </div>
        </div>
    <?php } else { ?>
        <div class='get-quote-wrapper'>
            <div class='get-quote-content'>
                <h2>Fill out <span class='hide six_hundred'>the form below </span>for a free quote</h2>
                <span class='animate close-quote fa fa-close'></span>   
                <form class='aweber-form' data-submit='<?php echo $form_id ?>'>   
                    <input required spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $name_id ?>' name='fillname' placeholder='Full name' type='text' />    
                    <input required spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $math_email ?>' name='email' placeholder='Email address' type='email' />    
                    <input spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $math_phone ?>' name='phone' placeholder='Phone number' />   
                    <input spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $math_zip ?>' name='zip' placeholder='ZIP code' type='text' />    
                    <textarea spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $math_msg ?>' name='message' placeholder='Message'></textarea>   
                    <input spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $math_contact ?>' name='contact' placeholder='When to contact' type='text'/>
                    <input spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-<?php echo $math_truck ?>' name='truck' placeholder='Vehicle year, make, and model'    type='text' />
                    <button class='button large secondary animate submit' type='submit'>Send me a free quote!</button>
                    <input class='mc_group_id' type='hidden' value="<?php echo $rQuoteCodes['mc_group_id'] ?>" />
                </form>
                <div class="AW-Form-<?php echo $form_id ?>" style='left:-99999px;position:absolute;top:-99999px;display:none;'>
                </div>
                <script type="text/javascript">(function(d, s, id) {
                     var js, fjs = d.getElementsByTagName(s)[0];
                     if (d.getElementById(id)) return;
                     js = d.createElement(s); js.id = id;
                     js.src = "//forms.aweber.com/form/<?php if($rQuoteCodes['selector'] == 'aluminum-law-enforcement-accessories') {$list_id = '00';} echo $list_id . '/' . $form_id; ?>.js";
                     fjs.parentNode.insertBefore(js, fjs);
                     }(document, "script", "aweber-wjs-04m0nw0rp"));
                </script>
            </div>
        </div><?php
    } 
} else { 
//if selector not associated with quote form, show default directory quote form as fallback
    ?>
    <div class='get-quote-wrapper'>
  <div class='get-quote-content'>
     <h2>Fill out <span class='hide six_hundred'>the form below </span>for a free quote</h2> 
     <span class='animate close-quote fa fa-close'></span>   
      <form class='aweber-form' data-submit='1135703801'>   
        <input required spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-80148804' name='fillname' placeholder='Full name' type='text' />    
        <input required spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-80148805' name='email' placeholder='Email address' type='email' />    
        <input spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-80148806' name='phone' placeholder='Phone number' />   
        <input spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-80148807' name='zip' placeholder='ZIP code' type='text' />    
        <textarea spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-80148808' name='message' placeholder='Message'></textarea>   
        <input spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-80148809' name='contact' placeholder='When to contact' type='text'/>
        <input spellcheck='false' class='input-text large sidebar-input animate form-input aweber-input' data-aweber='awf_field-80148810' name='truck' placeholder='Vehicle year, make, and model'    type='text' />
        <button class='button large secondary animate submit' type='submit'>Send me a free quote!</button>
      </form>
     <div class="AW-Form-1135703801" style='left:-99999px;position:absolute;top:-99999px;display:none;'></div>
     <script type="text/javascript">(function(d, s, id) {
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) return;
         js = d.createElement(s); js.id = id;
         js.src = "//forms.aweber.com/form/01/1135703801.js";
         fjs.parentNode.insertBefore(js, fjs);
         }(document, "script", "aweber-wjs-04m0nw0rp"));
     </script>
  </div>
</div> 
<?php
}
?>