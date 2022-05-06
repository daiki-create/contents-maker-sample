<?php


session_start();
error_reporting( E_ALL );




mb_language( 'ja' );
mb_internal_encoding( 'UTF-8' );




require_once( dirname( __FILE__ ) .'/class.admin-js.php' );
$contents_maker_admin_js = new Contents_Maker_Admin_Js();




?>