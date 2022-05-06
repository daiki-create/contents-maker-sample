<?php


error_reporting( E_ALL );




mb_language( 'ja' );
mb_internal_encoding( 'UTF-8' );




require_once( dirname( __FILE__ ) .'/class.login-js.php' );
$contents_maker_login_js = new Contents_Maker_Login_Js();




?>