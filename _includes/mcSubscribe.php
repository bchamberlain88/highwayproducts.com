<?php
session_start(); 
use \DrewM\MailChimp\MailChimp;
include('MailChimp.php'); 
$MailChimp = new MailChimp('a47cb28d7b1e11095e9b5e0ff0b9e959-us12');
$list_id = 'ad3a7fd861';
//if the quote form has the hidden input for an interest group
if(isset($_POST['mc_group_id'])) {
    $result = $MailChimp->post("lists/$list_id/members", array(
        'email_address' => $_POST['email'],
        'status'        => 'subscribed',
        'merge_fields'  => array(
            'FULLNAME' => $_POST['name'],
            'ZIP' => $_POST['zip'],
            'PHONE' => $_POST['phone'],
            'MESSAGE' => $_POST['message'],
            'CONTACT' => $_POST['contact'],
            'YRMKMODEL' => $_POST['truck'],
        ),
        'interests'  => array( $_POST['mc_group_id'] => true )
    ));
} else {
    $result = $MailChimp->post("lists/$list_id/members", array(
        'email_address' => $_POST['email'],
        'status'        => 'subscribed',
        'merge_fields'  => array(
            'FULLNAME' => $_POST['name'],
            'ZIP' => $_POST['zip'],
            'PHONE' => $_POST['phone'],
            'MESSAGE' => $_POST['message'],
            'CONTACT' => $_POST['contact'],
            'YRMKMODEL' => $_POST['truck'],
        )
    ));
}
//if the member is already subscribed, update them
if($result['title'] == 'Member Exists') {
    $subscriber_hash = $MailChimp->subscriberHash($_POST['email']);
    $result = $MailChimp->patch("lists/$list_id/members/$subscriber_hash", array(
        'merge_fields'  => array(
            'FULLNAME' => $_POST['name'],
            'ZIP' => $_POST['zip'],
            'PHONE' => $_POST['phone'],
            'MESSAGE' => $_POST['message'],
            'CONTACT' => $_POST['contact'],
            'YRMKMODEL' => $_POST['truck'],
        ),
        'interests'    => array($_POST['mc_group_id'] => true),
    ));
}
// diagnostic
// echo '<pre>';
// print_r($result);
// echo '</pre>';
?>