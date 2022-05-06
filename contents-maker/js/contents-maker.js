function contents_maker() {
	
	var news = document.getElementById( 'news' );
	var js   = document.getElementById( 'contents-maker-js' );
	var href = js.getAttribute( 'src' ).replace( /js\/contents-maker\.js/gi, 'php/index.php' );
	
	var xhr = new XMLHttpRequest();
	xhr.open( 'GET', href, true );
	
	xhr.onreadystatechange = function() {
		if ( xhr.readyState === 4 && xhr.status === 200 ) {
			news.innerHTML = xhr.responseText;
		} else {
			news.innerHTML = '新着情報取得中...'
		}
	}
	
	xhr.send( null );
	
}




if ( document.readyState == 'loading' ) {
	document.addEventListener( 'DOMContentLoaded', function() {
		contents_maker();
	}, false );
} else {
	contents_maker();
}