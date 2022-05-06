<?php


require_once( dirname( __FILE__ ) .'/class.contents-maker.php' );




class Contents_Maker_Write Extends Contents_Maker {
	
	// property init
	protected $post_time         = '';
	protected $post_date         = '';
	protected $post_contents     = '';
	protected $post_img         = '';
	protected $reserve_date      = '';
	
	
	// attachment addon property
	protected $resize_path_small = '';
	
	
	
	
	// public construct
	public function __construct() {
		
		parent::__construct();
		
	}
	
	
	
	
	// public post_check
	public function post_check() {
		
		$this->post_time = date( 'Y-m-d H:i:s' );
		
		
		if ( isset( $_POST['date'] ) && $_POST['date'] !== '' ) {
			$this->post_date = htmlspecialchars( $_POST['date'], ENT_QUOTES, 'UTF-8' );
		}
		
		if ( isset( $_POST['title'] ) && $_POST['title'] !== '' ) {
			$this->post_title = htmlspecialchars( $_POST['title'], ENT_QUOTES, 'UTF-8' );
		}
		
		if ( isset( $_POST['contents'] ) && $_POST['contents'] !== '' ) {
			$this->post_contents = htmlspecialchars( $_POST['contents'], ENT_QUOTES, 'UTF-8' );
			
			if ( file_exists( dirname( __FILE__ ) .'/../addon/html-tag/post-check.php' ) ) {
				include( dirname( __FILE__ ) .'/../addon/html-tag/post-check.php' );
			}
		}
		
		$this->post_contents = nl2br( $this->post_contents );
		$this->post_contents = str_replace( array( "\n", "\r", "\r\n" ), '', $this->post_contents );
		
		
		if ( isset( $_FILES['img'] ) && $_FILES['img']['tmp_name'] !== '' ) {
			$filepath = pathinfo($_FILES['img']['name']);

			$rand_str = rand(100000000000000, 999999999999999);
			$this->post_img = $rand_str. "." . $filepath['extension'];

			//画像を保存
			move_uploaded_file($_FILES['img']['tmp_name'], '../thumbnail/' . $this->post_img);
		}
		else{
			$this->post_img = "no-image.png";
		}

		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/post-check.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/post-check.php' );
		}
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/reserve/post-check.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/reserve/post-check.php' );
		}
		
	}
	
	
	
	
	// public contents_edit
	public function contents_edit() {
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/edit/edit-number.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/edit/edit-number.php' );
		}
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/exist-attachment.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/exist-attachment.php' );
		}
		
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/edit/edit-success.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/edit/edit-success.php' );
		}
		
	}
	
	
	
	
	// public contents_write
	public function contents_write() {
		
		// $stmt = $this->pdo->prepare( "SELECT * FROM cm_post5 WHERE row = ( SELECT MAX( row ) FROM cm_post5 ) LIMIT 1" );
		// $stmt->execute();
		
		// $row     = $stmt->fetch();
		
		// if ( $row['row'] === '' && $row['row'] === NULL ) {
		// 	$new_row = 0;
		// } else {
		// 	$new_row = (int)$row['row'] + 1;
		// }
		
		
		$stmt = $this->pdo->prepare( "INSERT INTO cm_post5 ( time, date, title, contents, img, small, reserve, row ) VALUES ( :time, :date, :title, :contents, :img, :small, :reserve, :row )" );
		$stmt->bindParam( ':time', $this->post_time );
		$stmt->bindParam( ':date', $this->post_date );
		$stmt->bindParam( ':title', $this->post_title );
		$stmt->bindParam( ':contents', $this->post_contents );
		$stmt->bindParam( ':img', $this->post_img );
		$stmt->bindParam( ':small', $this->resize_path_small );
		$stmt->bindParam( ':reserve', $this->reserve_date );
		$stmt->bindParam( ':row', $new_row );
		$stmt->execute();
		
		if ( $stmt->errorInfo()[0] !== '00000' ) {
			echo 'write_failed,'.$this->admin_url;
		} else {
			echo 'write_success,'.$this->admin_url;
		}
		
	}
	
	
	
	
	// public contents_delete
	public function contents_delete() {
		
		$delete_number = '';
		
		
		if ( isset( $_POST['delete-number'] ) && $_POST['delete-number'] !== '' ) {
			$delete_number = htmlspecialchars( $_POST['delete-number'], ENT_QUOTES, 'UTF-8' );
		}
		
		
		$stmt = $this->pdo->prepare( "DELETE FROM cm_post5 WHERE ( id = :id )" );
		$stmt->bindParam( ':id', $delete_number );
		$stmt->execute();
		
		
		if ( $stmt->errorInfo()[0] !== '00000' ) {
			echo 'delete_failed,'.$this->admin_url;
		} else {
			echo 'delete_success,'.$this->admin_url;
		}
		
	}
	
		// public contents_save
		public function contents_save() {
		
			$save_number = '';
			$date = '';
			$title = '';
			$contents = '';
			$img = '';
		
			if ( isset( $_POST['save-number'] ) && $_POST['save-number'] !== '' ) {
				$save_number = htmlspecialchars( $_POST['save-number'], ENT_QUOTES, 'UTF-8' );
			}
			if ( isset( $_POST['date_save'] ) && $_POST['date_save'] !== '' ) {
				$date = htmlspecialchars( $_POST['date_save'], ENT_QUOTES, 'UTF-8' );
			}
			if ( isset( $_POST['title_save'] ) && $_POST['title_save'] !== '' ) {
				$title = htmlspecialchars( $_POST['title_save'], ENT_QUOTES, 'UTF-8' );
			}
			if ( isset( $_POST['contents_save'] ) && $_POST['contents_save'] !== '' ) {
				$contents = htmlspecialchars( $_POST['contents_save'], ENT_QUOTES, 'UTF-8' );
			}
			if ( isset( $_POST['display_save'] ) && $_POST['display_save'] !== '' ) {
				$display = htmlspecialchars( $_POST['display_save'], ENT_QUOTES, 'UTF-8' );
			}

			if ( isset( $_FILES['img_save']['tmp_name'] ) && $_FILES['img_save']['tmp_name'] !== '' ) {
				$filepath = pathinfo($_FILES['img_save']['name']);

				$rand_str = rand(100000000000000, 999999999999999);
				$img = $rand_str. "." . $filepath['extension'];

				//画像を保存
				move_uploaded_file($_FILES['img_save']['tmp_name'], '../thumbnail/' . $img);
			}
			elseif ( isset( $_POST['img_name'] ) && $_POST['img_name'] !== '' ) {
				$img = $_POST['img_name'];
			}

			$stmt = $this->pdo->prepare( "UPDATE cm_post5 SET  title='$title',contents='$contents',date='$date',img='$img',display='$display' WHERE ( id = :id )" );
			$stmt->bindParam( ':id', $save_number );
			$stmt->execute();
			
			if ( $stmt->errorInfo()[0] !== '00000' ) {
				echo 'save_failed,'.$this->admin_url;
			} else {
				echo 'save_success,'.$this->admin_url;
			}
			
		}
	
	
	// public contents_order
	public function contents_order() {
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/sort/contents-order.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/sort/contents-order.php' );
		}
		
	}
	
	
	
	
	// public canvas_ratio
	public function canvas_ratio( $original_width, $original_height, $resize_width, $resize_height ) {
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/canvas-ratio.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/canvas-ratio.php' );
			return $return_ratio;
		}
		
	}
	
	
	
	
	// public image_resize
	public function image_resize( $attachment_name, $type, $upload_dir, $original_width, $original_height, $canvas_width, $canvas_height ) {
		
		if ( file_exists( dirname( __FILE__ ) .'/../addon/attachment/image-resize.php' ) ) {
			include( dirname( __FILE__ ) .'/../addon/attachment/image-resize.php' );
			return $resize_path;
		}
		
	}
	
}

?>