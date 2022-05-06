<?php


error_reporting( E_ALL );




mb_language( 'ja' );
mb_internal_encoding( 'UTF-8' );




include( dirname(__FILE__) .'/class.contents-maker-display.php' );
$contents_maker_display = new Contents_Maker_Display();




$contents_maker_display->get_news_display( false );




?>

