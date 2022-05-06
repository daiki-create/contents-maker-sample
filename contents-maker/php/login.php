<?php


session_start();
error_reporting( E_ALL );




mb_language( 'ja' );
mb_internal_encoding( 'UTF-8' );




include( dirname(__FILE__) .'/class.contents-maker-login.php' );
$contents_maker_login = new Contents_Maker_Login();




if ( isset( $_POST['user'] ) && $_POST['user'] !== '' ) {
if ( isset( $_POST['pass'] ) && $_POST['pass'] !== '' ) {
	$contents_maker_login->javascript_action_check();
	$contents_maker_login->referer_check();
	$contents_maker_login->login_check();
	exit;
}
}




if ( isset( $_SESSION['contents_maker_login'] ) && $_SESSION['contents_maker_login'] === 'contents_maker_login_ok' ) {
	header( 'Location: admin.php' );
} else {
	$contents_maker_login->html_header();
	$contents_maker_login->login_form();
	$contents_maker_login->footer();
}








?>