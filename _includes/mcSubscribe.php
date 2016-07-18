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
            'FULLNAME' => (isset($_POST['name'])) ? $_POST['name'] : '',
            'ZIP' => (isset($_POST['zip'])) ? $_POST['zip'] : '',
            'PHONE' => (isset($_POST['phone'])) ? $_POST['phone'] : '',
            'MESSAGE' => (isset($_POST['message'])) ? $_POST['message'] : '',
            'CONTACT' => (isset($_POST['contact'])) ? $_POST['contact'] : '',
            'YRMKMODEL' => (isset($_POST['truck'])) ? $_POST['truck'] : '',
        ),
        'interests'  => array( $_POST['mc_group_id'] => true )
    ));
} else {
    $result = $MailChimp->post("lists/$list_id/members", array(
        'email_address' => $_POST['email'],
        'status'        => 'subscribed',
        'merge_fields'  => array(
            'FULLNAME' => (isset($_POST['name'])) ? $_POST['name'] : '',
            'ZIP' => (isset($_POST['zip'])) ? $_POST['zip'] : '',
            'PHONE' => (isset($_POST['phone'])) ? $_POST['phone'] : '',
            'MESSAGE' => (isset($_POST['message'])) ? $_POST['message'] : '',
            'CONTACT' => (isset($_POST['contact'])) ? $_POST['contact'] : '',
            'YRMKMODEL' => (isset($_POST['truck'])) ? $_POST['truck'] : '',
        )
    ));
}
//if the member is already subscribed, update them
if($result['title'] == 'Member Exists') {
    $subscriber_hash = $MailChimp->subscriberHash($_POST['email']);
    if(isset($_POST['mc_group_id'])) {
        $result = $MailChimp->patch("lists/$list_id/members/$subscriber_hash", array(
            'merge_fields'  => array(
                'FULLNAME' => (isset($_POST['name'])) ? $_POST['name'] : '',
                'ZIP' => (isset($_POST['zip'])) ? $_POST['zip'] : '',
                'PHONE' => (isset($_POST['phone'])) ? $_POST['phone'] : '',
                'MESSAGE' => (isset($_POST['message'])) ? $_POST['message'] : '',
                'CONTACT' => (isset($_POST['contact'])) ? $_POST['contact'] : '',
                'YRMKMODEL' => (isset($_POST['truck'])) ? $_POST['truck'] : '',
            ),
            'interests'    => array($_POST['mc_group_id'] => true),
        ));
    } else {
        $result = $MailChimp->patch("lists/$list_id/members/$subscriber_hash", array(
            'merge_fields'  => array(
                'FULLNAME' => (isset($_POST['name'])) ? $_POST['name'] : '',
                'ZIP' => (isset($_POST['zip'])) ? $_POST['zip'] : '',
                'PHONE' => (isset($_POST['phone'])) ? $_POST['phone'] : '',
                'MESSAGE' => (isset($_POST['message'])) ? $_POST['message'] : '',
                'CONTACT' => (isset($_POST['contact'])) ? $_POST['contact'] : '',
                'YRMKMODEL' => (isset($_POST['truck'])) ? $_POST['truck'] : '',
            )
        ));
    }
}  
// diagnostic
// echo '<pre>';
// print_r($result);
// echo '</pre>';
?>