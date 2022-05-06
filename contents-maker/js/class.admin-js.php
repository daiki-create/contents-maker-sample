<?php

class Contents_Maker_Admin_Js {
	
	// property init
	protected $session_id     = '';
	protected $token          = '';
	
	
	// html tag addon property
	protected $html_tag       = 0;
	
	
	
	
	// public construct
	public function __construct() {
		
		include( dirname( __FILE__ ) .'/../php/config.php' );
		
		$this->session_id     = htmlspecialchars( session_id(), ENT_QUOTES, 'UTF-8' );
		$this->token          = sha1( $this->session_id );
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/html-tag/tag-config.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/html-tag/tag-config.php' );
			include( dirname( __FILE__ ) .'/../addon/html-tag/config-include.php' );
		}
		
		
		header( 'Content-Type: application/javascript' );
		
		
		echo <<<EOM
(function( $ ) {
	
	// global variable init
	
	
	
	
	// function slice_method
	function slice_method( el ) {
		var dt      = el.parents( 'dd' ).prev( 'dt' );
		var dt_name = dt.html().replace( /<span>.*<\/span>/gi, '' );
		dt_name     = dt_name.replace( /^<span\s.*<\/span>/gi, '' );
		dt_name     = dt_name.replace( /<br>|<br \/>/gi, '' );
		return dt_name;
	}
	
	
	
	
	// function error_span
	function error_span( e, dt, comment, bool ) {
		if ( bool === true ) {
			e.parents( 'dd' ).find( 'span.error-blank' ).text( dt + 'が' + comment + 'されていません' );
		} else {
			e.parents( 'dd' ).find( 'span.error-blank' ).text( '' );
		}
	}
	
	
	
	
	// function compare_method
	function compare_method( s, e ) {
		if ( s > e ) {
			return e;
		} else {
			return s;
		}
	}
	
	
	
	
	// function hidden_append
	function hidden_append( name, value, element ){
		
		$( '<input />' )
			.attr({
				type: 'hidden',
				id: name,
				name: name,
				value: value
			})
			.appendTo( element );
		
	}
	
	
	
	
	// function pagetop_click
	function pagetop_click() {
		
		$( 'html, body' ).animate({
			scrollTop : 0
		}, 500 );
		
	}
EOM;
		
		
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/file-change.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/file-change.js' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/reserve/reserve-change.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/reserve/reserve-change.js' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/sort/sortable-send.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/sort/sortable-send.js' );
		}
		
		
		
		
		echo <<<EOM

	
	
	
	
	// function new_click
	function new_click() {
		
		if ( $( 'form#contents-maker-edit-form' ).css( 'display' ) === 'block' ) {
			$( 'form#contents-maker-edit-form' ).fadeOut( 'fast', function() {
				$( 'form#contents-maker-form' ).fadeIn( 'fast' );
			});
		} else {
			$( 'form#contents-maker-form' ).slideDown( 'normal' );
		}
		
	}
	
	
	
	
	// function cancel_click
	function cancel_click() {
		
		$( 'form#contents-maker-form, form#contents-maker-edit-form' ).slideUp( 'normal' );
		
	}
	
	
	
	
	// function logout_click
	function logout_click() {
		
		if ( window.confirm( 'ログアウトしますか？' ) ) {
			
			$.ajax({
				type: 'POST',
				url: window.location.href,
				cache: false,
				dataType: 'text',
				data: 'logout=true&javascript_action=true',
				
				success: function( res ) {
					var response = res.split( ',' );
					if( response[0] === 'logout_success' ){
						window.location.href = response[1];
					} else {
						window.alert( 'ログアウトが失敗しました。' );
						location.reload();
					}
				},
				
				error: function( res ) {
					window.alert( 'Ajax通信が失敗しました。\\nページの再読み込みをしてからもう一度お試しください。' );
				}
			});
			
		}
		
	}
	
	
	// function edit_click
	function edit_click() {
EOM;
		
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/exist-reset.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/exist-reset.js' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/edit/edit-date.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/edit/edit-date.js' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/reserve/reserve-checked.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/reserve/reserve-checked.js' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/edit/edit-contents.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/edit/edit-contents.js' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/exist-image.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/exist-image.js' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/edit/edit-scroll.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/edit/edit-scroll.js' );
		}
		
		
		
		
		echo <<<EOM

		var edit_number = $( this ).attr( 'data-edit' );

		var date = $('#input-date-'+edit_number).text();

		var title = $('#input-title-'+edit_number).text();
		var contents = $('#input-contents-'+edit_number).text();
		var img_name = $('#input-img-'+edit_number).children('img').attr('src');
		img_name = img_name.replace('../thumbnail/', '');


		$('#'+edit_number).hide();
		$('#'+edit_number).after("<span class='save' data-save='"+edit_number+"'>保存する</span>");

		$('#center-'+edit_number).hide();
		//$('#input-title-'+edit_number).hide();
		//$('#input-contents-'+edit_number).hide();

		$('#left-'+edit_number).after(
			"<form id='edit-form-"+edit_number+"' style='width:60%;padding-top:30px;'>"+
				"<input class='date' type='text' name='date_save' value='"+date+"' style=''><br>"+
				"<input type='text' name='title_save' value='"+title+"' placeholder='タイトル'>"+
				"<textarea name='contents_save' style='margin:10px 0'>"+contents+"</textarea>"+
				"<span style='color:#3377ff'>サムネイル画像</span><input type='file' name='img_save' value='' readonly='readonly' accept='image/*' style='margin-bottom:20px;'/><br>"+
				"<input type='hidden' name='img_name' value='"+img_name+"'/>"+
				"<input type='hidden' name='save-number' value='"+edit_number+"'/>"+
				"<input type='hidden' name='javascript_action' value='true'/>"+
				"<input type='hidden' name='token' value='{$this->token}'/>"+

				"<input type='radio' name='display_save' value='1' checked/>表示"+
				"<input type='radio' name='display_save' value='0' style='margin-left:20px;'/>非表示"+
			"</form>");

		var input_display = $('#input-display-'+edit_number).text();
		if(input_display == 1)
		{
			$('input[name=display_save]:eq(0)').prop('checked', true);
		}
		else
		{
			$('input[name=display_save]:eq(1)').prop('checked', true);
		}

		(function( $ ) {

			$( '.date' ).datetimepicker({
				lang: 'ja',
				timepicker: false,
				format: 'Y/m/d',
				closeOnDateSelect: true,
				scrollMonth: false
			});
		})( jQuery );


		$( 'span.save' ).on( 'click', save_click );

	}

	function save_click() {
		var save_number = $( this ).attr( 'data-save' );
		var fd = new FormData($('#edit-form-'+save_number).get(0));

		$( '<div>' )
		.addClass( 'loading-layer' )
		.appendTo( 'body' )
		.css({
			'width': $( window ).width() + 'px',
			'height': $( window ).height() + 'px',
			'background': 'rgba( 0, 0, 0, 0.7 )',
			'position': 'fixed',
			'left': '0',
			'top': '0',
			'z-index': '999',
		})
		.append( '<span class="loading"></span>' );

		setTimeout(function(){
				
			$.ajax({
				type: 'POST',
				url: $( 'form#contents-maker-form' ).attr( 'action' ),
				cache: false,
        		contentType : false,
				processData : false,
				data		: fd,
				
				success: function( res ) {
					$( 'div.loading-layer, span.loading' ).remove();
					var response = res.split( ',' );
					console.log(response);
					if( response[0] === 'save_success' ){
						window.alert( '保存が完了しました。' );
						window.location.href = response[1];
					} else {
						window.alert( '保存に失敗しました。' );
						location.reload();
					}
				},
				
				error: function( res ) {
					$( 'div.loading-layer, span.loading' ).remove();
					window.alert( 'Ajax通信が失敗しました。\\nページの再読み込みをしてからもう一度お試しください。' );
				}
			});
				
		}, 1000 );
	}
EOM;
		
		
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/reset-click.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/reset-click.js' );
		}
		
		
		
		
		echo <<<EOM

	
	
	
	
	// function delete_click
	function delete_click() {
		
		var delete_number = $( this ).attr( 'data-delete' );
		
		if ( window.confirm( '削除してもよろしいですか？' ) ) {
			
			$( '<div>' )
				.addClass( 'loading-layer' )
				.appendTo( 'body' )
				.css({
					'width': $( window ).width() + 'px',
					'height': $( window ).height() + 'px',
					'background': 'rgba( 0, 0, 0, 0.7 )',
					'position': 'fixed',
					'left': '0',
					'top': '0',
					'z-index': '999',
				})
				.append( '<span class="loading"></span>' );
				
			setTimeout(function(){
				
				$.ajax({
					type: 'POST',
					url: $( 'form#contents-maker-form' ).attr( 'action' ),
					cache: false,
					dataType: 'text',
					data: 'delete-number='+ delete_number +'&javascript_action=true&token={$this->token}',
					
					success: function( res ) {
						$( 'div.loading-layer, span.loading' ).remove();
						var response = res.split( ',' );
						if( response[0] === 'delete_success' ){
							window.alert( '削除が完了しました。' );
							window.location.href = response[1];
						} else {
							window.alert( '削除に失敗しました。' );
							location.reload();
						}
					},
					
					error: function( res ) {
						$( 'div.loading-layer, span.loading' ).remove();
						window.alert( 'Ajax通信が失敗しました。\\nページの再読み込みをしてからもう一度お試しください。' );
					}
				});
					
			}, 1000 );
			
		}
		
	}
	
	
	
	
	// function write_click
	function write_click() {
		
		var form         = '';
		var date         = '';
		var attach       = '';
		var contents     = '';
		var label        = '';
		
		var error        = 0;
		var scroll_point = $( 'body' ).height();
		
		
		if ( $( this ).attr( 'id' ) === 'write-button' ) {
			
			form     = $( 'form#contents-maker-form' );
			date     = form.find( 'input.date' );
			attach   = form.find( 'input.attachment' );
			contents = form.find( 'textarea.contents' );
			label    = '新規投稿';
EOM;
		
		
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/edit/edit-element.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/edit/edit-element.js' );
		}
		
		
		
		
		echo <<<EOM

			
		}
		
		
		if ( $( '.required' ).find( date ).length ) {
			var element = $( '.required' ).find( date );
			var dt_name = slice_method( element );
			if ( element.val() === '' ) {
				error_span( element, dt_name, '入力', true );
				error++;
				scroll_point = compare_method( scroll_point, element.offset().top );
			} else {
				error_span( element, dt_name, '', false );
			}
		}
EOM;
		
		
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/required-check.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/required-check.js' );
		}
		
		
		
		
		echo <<<EOM

		
		
		if ( $( '.required' ).find( contents ).length ) {
			var element = $( '.required' ).find( contents );
			var dt_name = slice_method( element );
			if ( element.val() === '' ) {
				error_span( element, dt_name, '入力', true );
				error++;
				scroll_point = compare_method( scroll_point, element.offset().top );
			} else {
				error_span( element, dt_name, '', false );
			}
		}
EOM;
		
		
		
		
		if ( $this->html_tag === 0 ) {
		echo <<<EOM

		
		
		if ( contents.val().indexOf( '<' ) !== -1 ) {
			contents.parents( 'dd' ).find( 'span.url-check' ).text( 'HTMLタグの書き込みは禁止されています。' );
			error++;
			scroll_point = compare_method( scroll_point, contents.offset().top );
		} else {
			contents.parents( 'dd' ).find( 'span.url-check' ).text( '' );
		}
EOM;
		}
		
		
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/filetype-check.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/filetype-check.js' );
		}
		
		
		
		
		echo <<<EOM

		
		
		if ( error === 0 ) {
			if ( window.confirm( label +'をしてもよろしいですか？' ) ) {
				
				hidden_append( 'javascript_action', true, form.find( 'p.submit' ) );
EOM;
		
		
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/ios-bugfix-1.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/ios-bugfix-1.js' );
		}
		
		
		
		
		echo <<<EOM

				
				$( '<div>' )
					.addClass( 'loading-layer' )
					.appendTo( 'body' )
					.css({
						'width': $( window ).width() + 'px',
						'height': $( window ).height() + 'px',
						'background': 'rgba( 0, 0, 0, 0.7 )',
						'position': 'fixed',
						'left': '0',
						'top': '0',
						'z-index': '999',
					})
					.append( '<span class="loading"></span>' );
				
				setTimeout(function(){
					
					var form_data = new FormData( form.get(0) );
					
					$.ajax({
						type: form.attr( 'method' ),
						url: form.attr( 'action' ),
						cache: false,
						dataType: 'html',
						data: form_data,
						contentType: false,
						processData: false,
						
						success: function( res ) {
							$( 'div.loading-layer, span.loading' ).remove();
							var response = res.split( ',' );
							if( response[0] === 'write_success' ){
								window.alert( label +'が完了しました。' );
								location.reload();
							} else {
								$( 'input#javascript_action' ).remove();
								ios_bugfix();
								window.alert( label +'が失敗しました。' );
							}
						},
						
						error: function( res ) {
							$( 'div.loading-layer, span.loading' ).remove();
							window.alert( 'Ajax通信が失敗しました。\\nページの再読み込みをしてからもう一度お試しください。' );
						}
					});
					
				}, 1000 );
				
			}
		} else {
			$( 'html, body' ).animate({
				scrollTop: scroll_point - 70
			}, 500 );
		}
		
	}
	
	
	
	
	// function ios_bugfix
	function ios_bugfix() {
		
EOM;
		
		
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/ios-bugfix-2.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/ios-bugfix-2.js' );
		}
		
		
		
		
		echo <<<EOM

	}
	
	
	
	
	// function label_insert
	function label_insert( cmf_dd, bool ) {
		
		for ( var i = 1; i < cmf_dd.length; i++ ) {
			if ( cmf_dd.eq(i).attr( 'class' ) === 'required' ) {
				$( '<span/>' )
					.text( '必須' )
					.addClass( 'required' )
					.prependTo( cmf_dd.eq(i).prev( 'dt' ) );
			} else {
				$( '<span/>' )
					.text( '任意' )
					.addClass( 'optional' )
					.prependTo( cmf_dd.eq(i).prev( 'dt' ) );
			}
			
			$( '<span/>' )
				.addClass( 'error-blank' )
				.appendTo( cmf_dd.eq(i) );
EOM;
		
		
		
		
		if ( $this->html_tag === 0 ) {
		echo <<<EOM

			
			if ( cmf_dd.eq(i).find( 'textarea' ).length ) {
				$( '<span/>' )
					.addClass( 'url-check' )
					.appendTo( cmf_dd.eq(i) );
			}
EOM;
		}
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/error-filetype.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/error-filetype.js' );
		}
		
		
		
		
		echo <<<EOM

		}
		
	}
	
	
	
	
	// DOM
	$( 'input' ).on( 'keydown', function( e ) {
		if ( ( e.which && e.which === 13 ) || ( e.keyCode && e.keyCode === 13 ) ) {
			return false;
		} else {
			return true;
		}
	});
	
	
	var cmf_dd = $( 'form#contents-maker-form dl dd' );
	label_insert( cmf_dd, false );
EOM;
		
		
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/edit/edit-dd.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/edit/edit-dd.js' );
		}
		
		
		
		
		echo <<<EOM

	
	
	$( window ).on( 'scroll', function() {
		if( 150 < $( window ).scrollTop() ) {
			$( 'div#page-top' ).fadeIn( 'fast' );
		}else{
			$( 'div#page-top' ).fadeOut( 'fast' );
		}
	});
	
	
	if ( ! ( $( 'div#information' ).find( 'dl' ).length ) ) {
		$( 'div#information' ).css({
			'border': 'none',
			'padding': '0',
			'box-shadow': 'none'
		});
	}
EOM;
		
		
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/sort/sortable-method.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/sort/sortable-method.js' );
		}
		
		
		
		
		echo <<<EOM

	
	
	$( 'li#new div' ).on({
		
		'mouseenter': function() {
			if ( $( 'form#contents-maker-form' ).css( 'display' ) === 'block' ) {
				$( this ).css({
					'cursor' : 'default',
					'color' : 'inherit',
					'background' : 'none'
				});
			} else {
				$( this ).css({
					'cursor' : 'pointer',
					'color' : '#106dff',
					'background' : 'rgba( 0, 0, 0, 0.1 )'
				});
			}
		},
		
		'mouseleave': function() {
			$( this ).css({
				'cursor' : 'default',
				'color' : 'inherit',
				'background' : 'none'
			});
		}
		
	});
	
	
	$( 'div#page-top' ).on( 'click', pagetop_click );
	
	$( 'li#new div' ).on( 'click', new_click );
	
	$( 'li#logout div' ).on( 'click', logout_click );
	
	$( 'span.cancel' ).on( 'click', cancel_click );
EOM;
		
		
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/span-reset.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/span-reset.js' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/input-change.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/input-change.js' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/reserve/input-reserve.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/reserve/input-reserve.js' );
		}
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/edit/class-edit.js' ) ) {
			include( dirname( __FILE__ ) .'/../addon/edit/class-edit.js' );
		}
		
		
		
		
		echo <<<EOM

	$( 'span.delete' ).on( 'click', delete_click );
	$( 'span.edit' ).on( 'click', edit_click );
	
	$( 'input#write-button, input#edit-button' ).on( 'click', write_click );
	
})( jQuery );
EOM;
		
	}
	
}

?>