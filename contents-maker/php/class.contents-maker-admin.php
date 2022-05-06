<?php


require_once( dirname( __FILE__ ) .'/class.contents-maker.php' );




class Contents_Maker_Admin Extends Contents_Maker {
	
	// public construct
	public function __construct() {
		
		parent::__construct();
		
	}
	
	
	
	
	// public html_header
	public function html_header() {
		
		$attach_css  = '';
		$reserve_css = '';
		$sort_css    = '';
		$edit_css    = '';
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/attachment-css.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/attachment-css.php' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/reserve/reserve-css.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/reserve/reserve-css.php' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/sort/sort-css.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/sort/sort-css.php' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/edit/edit-css.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/edit/edit-css.php' );
		}
		
		
		echo <<<EOM
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8" />
<title>新着情報更新システム - 管理画面</title>
<meta name="robots" content="noindex,nofollow" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link rel="stylesheet" href="../css/reset.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/admin.css" />
<link rel="stylesheet" href="../css/my_style.css" />
<link rel="stylesheet" href="../css/jquery.datetimepicker.css" />{$attach_css}{$reserve_css}{$sort_css}{$edit_css}
</head>
<body>
EOM;
		
	}
	
	
	
	
	// public header
	public function header() {
		
		echo <<<EOM


<div id="header">
	<ul>
		<li id="new"><div>新規投稿<span>New Post</span></div></li>
		<li id="logout"><div>ログアウト<span>Logout</span></div></li>
	</ul>
</div>
EOM;
		
	}
	
	
	
	
	// public footer
	public function footer() {
		
		$selection_js = '';
		$jquery_ui_js = '';
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/html-tag/selection-js.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/html-tag/selection-js.php' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/sort/jquery-ui.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/sort/jquery-ui.php' );
		}
		
		
		echo <<<EOM


<div id="page-top"><span id="arrow-up"></span></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js" defer></script>{$jquery_ui_js}
<script src="../js/admin-js.php" defer></script>
<script src="../js/jquery.datetimepicker.js" defer></script>
<script src="../js/picker.js" defer></script>{$selection_js}
</body>
</html>
EOM;
		
	}
	
	
	
	
	// public contents_form
	public function contents_form() {
		
		$span_link = '';
		$enctype   = '';
		$input     = '';
		$reserve   = '';
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/html-tag/span-link.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/html-tag/span-link.php' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/attachment-form.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/attachment-form.php' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/reserve/reserve-form.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/reserve/reserve-form.php' );
		}
		
		
		echo <<<EOM


<form action="{$this->admin_url}" method="post" id="contents-maker-form"{$enctype} enctype="multipart/form-data">
	<dl>
		<dt>投稿種別<span>Post Type</span></dt>
		<dd><span class="cancel">閉じる</span>現在は新規投稿モードです。</dd>{$input}
		<dt>日付<span>Date</span></dt>
		<dd class="required"><input type="text" class="date" name="date" value="" readonly="readonly" /></dd>
		<dt>タイトル<span>Title</span></dt>
		<dd class="required"><input type="text" class="title" name="title" value=""/></dd>{$reserve}
		<dt>新規追加する新着情報<span>Add to Contents</span></dt>
		<dd class="required">{$span_link}<textarea class="contents" name="contents" cols="40" rows="5"></textarea></dd>{$reserve}
		<dt>サムネイル画像<span>Thumbnail image</span></dt>
		<dd class="required"><input type="file" class="img" name="img" value="" readonly="readonly" accept="image/*"/></dd>
	</dl>
	<p class="submit"><input type="button" id="write-button" value="新規投稿する" /><input type="hidden" name="token" value="{$this->token}" /></p>
</form>
EOM;
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/edit/edit-form.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/edit/edit-form.php' );
		}
		
	}
	
	
	
	
	// public url_form
	public function url_form() {
		
		if ( $this->html_tag === 0 ) {
			return;
		}
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/html-tag/url-form.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/html-tag/url-form.php' );
		}
		
	}
	
}

?>