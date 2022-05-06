<?php


require_once( dirname( __FILE__ ) .'/class.contents-maker.php' );




class Contents_Maker_Login Extends Contents_Maker {
	
	// public construct
	public function __construct() {
		
		parent::__construct();
		
	}
	
	
	
	
	// public html_header
	public function html_header() {
		
		echo <<<EOM
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8" />
<title>新着情報更新システム - ログイン画面</title>
<meta name="robots" content="noindex,nofollow" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link rel="stylesheet" href="../css/reset.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/login.css" />
</head>
<body>
EOM;
		
	}
	
	
	
	
	// public footer
	public function footer() {
		
		echo <<<EOM

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js" defer></script>
<script src="../js/login-js.php" defer></script>
</body>
</html>
EOM;
		
	}
	
	
	
	
	// public login_form
	public function login_form() {
		
		echo <<<EOM


<form action="{$this->login_url}" method="post" id="login-form">
	<h1>CONTENTS MAKER LOGIN</h1>
	<dl>
		<dt>ユーザー名</dt>
		<dd><input type="text" id="user" name="user" value="" /></dd>
		<dt>パスワード</dt>
		<dd><input type="password" id="pass" name="pass" value="" /></dd>
	</dl>
	<p class="submit"><input type="button" id="login-button" value="ログイン" /></p>
</form>
EOM;
		
	}
	
	
	
	
	// public login_check
	public function login_check() {
		
		$post_user = htmlspecialchars( $_POST['user'], ENT_QUOTES, 'UTF-8' );
		$post_pass = htmlspecialchars( $_POST['pass'], ENT_QUOTES, 'UTF-8' );
		
		if ( $post_user === $this->admin_user && $post_pass === $this->admin_pass ) {
			$_SESSION['contents_maker_login'] = 'contents_maker_login_ok';
			session_regenerate_id( true );
			echo 'login_success,'.$this->admin_url;
		} else {
			echo 'login_failed,'.$this->login_url;
		}
		
	}
	
	
	
	
	// public logout_check
	public function logout_check() {
		
		$logout_flag = htmlspecialchars( $_POST['logout'], ENT_QUOTES, 'UTF-8' );
		
		if ( $logout_flag === 'true' ) {
			$_SESSION = array();
			if ( isset( $_COOKIE[session_name()] ) ) {
				setcookie( session_name(), '', time()-1000, '/' );
			}
			session_destroy();
			echo 'logout_success,'.$this->login_url;
		}
		
	}
	
}

?>