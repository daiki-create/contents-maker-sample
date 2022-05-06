<?php


session_start();
error_reporting( E_ALL );




mb_language( 'ja' );
mb_internal_encoding( 'UTF-8' );




if ( isset( $_POST['logout'] ) && $_POST['logout'] !== '' ) {
	include( dirname( __FILE__ ) .'/class.contents-maker-login.php' );
	$contents_maker_login = new Contents_Maker_Login();
	
	$contents_maker_login->javascript_action_check();
	$contents_maker_login->referer_check();
	$contents_maker_login->session_check();
	$contents_maker_login->logout_check();
	exit;
}




if ( file_exists( dirname( __FILE__ ) .'/../addon/sort/sort.php' ) ) {
	include( dirname( __FILE__ ) .'/../addon/sort/sort.php' );
}




if ( file_exists( dirname( __FILE__ ) .'/../addon/edit/edit.php' ) ) {
	include( dirname( __FILE__ ) .'/../addon/edit/edit.php' );
}




if ( ( isset( $_POST['date'] ) && $_POST['date'] !== '' ) || ( isset( $_POST['contents'] ) && $_POST['contents'] !== '' ) || ( isset( $_POST['img'] ) && $_POST['img'] !== '' ) ) {
	include( dirname( __FILE__ ) .'/class.contents-maker-write.php' );
	$contents_maker_write = new Contents_Maker_Write();
	
	$contents_maker_write->javascript_action_check();
	$contents_maker_write->referer_check();
	$contents_maker_write->session_check();
	$contents_maker_write->token_check();
	$contents_maker_write->post_check();
	$contents_maker_write->contents_write();
	exit;
}




if ( isset( $_POST['delete-number'] ) && $_POST['delete-number'] !== '' ) {
	include( dirname( __FILE__ ) .'/class.contents-maker-write.php' );
	$contents_maker_write = new Contents_Maker_Write();
	
	$contents_maker_write->javascript_action_check();
	$contents_maker_write->referer_check();
	$contents_maker_write->session_check();
	$contents_maker_write->token_check();
	$contents_maker_write->contents_delete();
	exit;
}

if ( isset( $_POST['save-number'] ) && $_POST['save-number'] !== '' ) {
	include( dirname( __FILE__ ) .'/class.contents-maker-write.php' );
	$contents_maker_write = new Contents_Maker_Write();
	
	$contents_maker_write->javascript_action_check();
	$contents_maker_write->referer_check();
	$contents_maker_write->session_check();
	$contents_maker_write->token_check();
	$contents_maker_write->contents_save();
	exit;
}


if ( isset( $_SESSION['contents_maker_login'] ) && $_SESSION['contents_maker_login'] === 'contents_maker_login_ok' ) {
	include( dirname( __FILE__ ) .'/class.contents-maker-admin.php' );
	$contents_maker_admin = new Contents_Maker_Admin();
	
	$contents_maker_admin->html_header();
	$contents_maker_admin->header();
	$contents_maker_admin->contents_form();
	$contents_maker_admin->url_form();
	$contents_maker_admin->get_news( true );
	$contents_maker_admin->footer();
} else {
	header( 'Location: login.php' );
}








?>
<script>
	function show_contents(id){
        var contents = document.getElementById('input-contents-'+id);
        contents.style.WebkitLineClamp = '1000';
    }
</script>