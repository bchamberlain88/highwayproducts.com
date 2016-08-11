<?php
$getNewsCodes = mysql_query('SELECT * FROM newsletter_codes WHERE selector = "'.$product_selector.'"');
$newsCodes = mysql_fetch_assoc($getNewsCodes); 
$host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if(strpos($host,'search') !== false) { 
    $newsFormID = 1999250091;
    $newsEmailID = 79713856;
}

if($host == $_SERVER['SERVER_NAME'] . '/' || $host == $_SERVER['SERVER_NAME'] . '/?requested_quote=sent' || $host == $_SERVER['SERVER_NAME'] . '/?newsletter=sent'
) {
    $newsFormID = 1999250091;
    $newsEmailID = 79713856;
}
if($host == $_SERVER['SERVER_NAME'] . '/accessories/' || $host == $_SERVER['SERVER_NAME'] . '/accessories/?requested_quote=sent' || $host == $_SERVER['SERVER_NAME'] . '/accessories/?newsletter=sent'
) {
    $newsFormID = 2034707916;
    $newsEmailID = 81193238;
} 
if($host == $_SERVER['SERVER_NAME'] . '/reviews/' || $host == $_SERVER['SERVER_NAME'] . '/reviews/?requested_quote=sent' || $host == $_SERVER['SERVER_NAME'] . '/reviews/?newsletter=sent'
) {
    $newsFormID = 408447312;
    $newsEmailID = 81193261;
} 
if($host == $_SERVER['SERVER_NAME'] . '/warranty/' || $host == $_SERVER['SERVER_NAME'] . '/warranty/?requested_quote=sent' || $host == $_SERVER['SERVER_NAME'] . '/warranty/?newsletter=sent'
) {
    $newsFormID = 990561690;
    $newsEmailID = 81193310;
} 
if($host == $_SERVER['SERVER_NAME'] . '/closeout/' || $host == $_SERVER['SERVER_NAME'] . '/closeout/?requested_quote=sent' || $host == $_SERVER['SERVER_NAME'] . '/closeout/?newsletter=sent'
) {
    $newsFormID = 167464020;
    $newsEmailID = 81193375;
} 
if(mysql_num_rows($getNewsCodes) > 0) { 
    $newsFormID = $newsCodes['form_id'];
    $newsEmailID = $newsCodes['email_id'];
} ?>