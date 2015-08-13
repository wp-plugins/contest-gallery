<?php
/*
Plugin Name: Contest Gallery
Description: Plugin with ability to upload images in frontend, to manage them in backend, to display them in different ways in frontend and to rate them.
Version: 1.04
Author: Contest Gallery
Author URI: http://www.contest-gallery.com/
*/

/*
error_reporting(E_ALL); 
ini_set('display_errors', 'On');*/

//Create MySQL WP Table

// Register a new shortcode: [book]
add_shortcode( 'cg_gallery', 'frontend_gallery' );
add_shortcode( 'cg_users_upload', 'users_upload' );


//Include feeds






	function frontend_gallery($atts){
	wp_enqueue_script( 'show_gallery_jquery', plugins_url( '/js/show_gallery_jquery.js', __FILE__ ), array('jquery'), false, true );
	wp_enqueue_script( 'show_image_jquery', plugins_url( '/js/show_image_jquery.js', __FILE__ ), array('jquery'), false, true );
	wp_enqueue_script( 'rate_picture', plugins_url( '/js/rate_picture.js', __FILE__ ), array('jquery'), false, true );
	@ob_start();
	include_once 'frontend/frontend-gallery.php';
	$frontend_gallery = @ob_get_clean();
	return $frontend_gallery;
	}


	function users_upload($atts){
	wp_enqueue_script( 'users_upload', plugins_url( '/js/users_upload.js', __FILE__ ), array('jquery'), false, true );
	ob_start();
	include_once 'frontend/users-upload.php';
	$users_upload = ob_get_clean();
	return $users_upload;
	}

if(!function_exists('contest_gal1ery_create_table')){
	function contest_gal1ery_create_table(){
	global $wpdb;

	$tablename = $wpdb->prefix . "contest_gal1ery";
	$tablename_ip = $wpdb->prefix . "contest_gal1ery_ip";
	$tablename_comments = $wpdb->prefix . "contest_gal1ery_comments";
	$tablename_options = $wpdb->prefix . "contest_gal1ery_options";
	$tablename_options_input = $wpdb->prefix . "contest_gal1ery_options_input";
	$tablename_email = $wpdb->prefix . "contest_gal1ery_mail";
	$tablename_entries = $wpdb->prefix . "contest_gal1ery_entries";
	$tablename_form_input = $wpdb->prefix . "contest_gal1ery_f_input";
	$tablename_form_output = $wpdb->prefix . "contest_gal1ery_f_output";

		if($wpdb->get_var('SHOW TABLES LIKE ' . $tablename) != $tablename){
		$sql = "CREATE TABLE $tablename (
		id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		rowid INT(99),
		Timestamp INT(20),
		NamePic VARCHAR(100),
		ImgType VARCHAR(5),
		CountC VARCHAR(7),
		CountR VARCHAR(7),
		Rating VARCHAR(13),
		GalleryID INT(99),
		Active INT(1),
		Informed INT(1)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			}

		if($wpdb->get_var('SHOW TABLES LIKE ' . $tablename_ip) != $tablename_ip){
		$sql = "CREATE TABLE $tablename_ip (
		id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		pid INT (99),
		IP VARCHAR (40),
		GalleryID INT (99),
		Rating INT (1)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
				}

		if($wpdb->get_var('SHOW TABLES LIKE ' . $tablename_comments) != $tablename_comments){
		$sql = "CREATE TABLE $tablename_comments (
		id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		pid INT (99),
		GalleryID INT (6),
		Name VARCHAR(35),
		Date VARCHAR(50),
		Comment TEXT,
		Timestamp VARCHAR(20)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);	
		}
		
		if($wpdb->get_var('SHOW TABLES LIKE ' . $tablename_email) != $tablename_email){
		$sql = "CREATE TABLE $tablename_email (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		GalleryID INT (99),
		Admin VARCHAR(200),
		Header VARCHAR(200),
		Reply VARCHAR(200),
		CC VARCHAR(200),
		BCC VARCHAR(200),
		URL VARCHAR(200),
		Content VARCHAR (2000)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		
		}

		if($wpdb->get_var('SHOW TABLES LIKE ' . $tablename_options) != $tablename_options){
		$sql = "CREATE TABLE $tablename_options(
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		GalleryName VARCHAR(200),
		PicsPerSite INT (3),
		WidthThumb INT (5),
		HeightThumb INT (5),
		WidthGallery INT (5),
		HeightGallery INT (5),
		DistancePics INT (5),
		DistancePicsV INT (5),
		MaxResJPGon INT(1),
		MaxResPNGon INT(1),
		MaxResGIFon INT(1),
		MaxResJPG INT(20),
		MaxResPNG INT(20),
		MaxResGIF INT(20),
		ScaleOnly TINYINT,
		ScaleAndCut TINYINT,
		FullSize TINYINT,
		AllowSort TINYINT,
		AllowComments TINYINT,
		AllowRating TINYINT,
		IpBlock TINYINT,
		FbLike TINYINT,
		AllowGalleryScript TINYINT,
		Inform TINYINT,
		TimestampPicDownload VARCHAR(20),
		ThumbLook TINYINT,
		HeightLook TINYINT,
		RowLook TINYINT,
		ThumbLookOrder TINYINT,
		HeightLookOrder TINYINT,
		RowLookOrder TINYINT,
		HeightLookHeight INT(3),
		ThumbsInRow TINYINT,
		PicsInRow TINYINT,
		LastRow TINYINT	
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			
		}
		
		
		if($wpdb->get_var('SHOW TABLES LIKE ' . $tablename_options_input) != $tablename_options_input){
		$sql = "CREATE TABLE $tablename_options_input(
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		GalleryID INT(99),
		Forward TINYINT,
		Forward_URL VARCHAR(999),
		Confirmation_Text VARCHAR(65535)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			
		}
		
				
		if($wpdb->get_var('SHOW TABLES LIKE ' . $tablename_entries) != $tablename_entries){
		$sql = "CREATE TABLE $tablename_entries (
		id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		pid INT(99),
		f_input_id INT (99),
		GalleryID INT(99),
		Field_Type VARCHAR(10),
		Field_Order INT(3),
		Short_Text VARCHAR(999),
		Long_Text VARCHAR(65535)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			
		}
			
			
		if($wpdb->get_var('SHOW TABLES LIKE ' . $tablename_form_input) != $tablename_form_input){
		$sql = "CREATE TABLE $tablename_form_input (
		id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		GalleryID INT(99),
		Field_Type VARCHAR(10),
		Field_Order INT(3),
		Field_Content VARCHAR(65535)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
		
		
		if($wpdb->get_var('SHOW TABLES LIKE ' . $tablename_form_output) != $tablename_form_output){
		$sql = "CREATE TABLE $tablename_form_output (
		id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		f_input_id INT (99),
		GalleryID INT(99),
		Field_Type VARCHAR(10),
		Field_Order INT(3),
		Field_Content VARCHAR(65535)
		) DEFAULT CHARACTER SET utf8";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
		

		//ADD first first Galery
		
$uploads = wp_upload_dir();
$checkUploads = $uploads['basedir'].'/contest-gal1ery';

	if(!file_exists($checkUploads)){
	mkdir($checkUploads,0777,true);
	}

		
}
}

register_activation_hook( __FILE__, 'contest_gal1ery_create_table' );

// Add a top level menu to wordpress

// page_title â€” The title of the page as shown in the <title> tags
// menu_title â€” The name of your menu displayed on the dashboard
// capability â€” Minimum capability required to view the menu
// menu_slug â€” Slug name to refer to the menu; should be a unique name
// function : Function to be called to display the page content for the item
// icon_url â€” URL to a custom image to use as the Menu icon
// position â€” Location in the menu order where it should appear

//create submenu items

// parent_slug : Slug name for the parent menu ( menu_slug previously defi ned)
// page_title : The title of the page as shown in the <title> tags
// menu_title : The name of your submenu displayed on the dashboard
// capability : Minimum capability required to view the submenu
// menu_slug : Slug name to refer to the submenu; should be a unique name
// function : Function to be called to display the page content for the item


/*

add_action( 'wp_enqueue_scripts', 'ajax_test_enqueue_scripts1' );
if(!function_exists('ajax_test_enqueue_scripts1')){
function ajax_test_enqueue_scripts1() {
	if( is_single() ) {
		wp_enqueue_style( 'love1', plugins_url( '/love1.css', __FILE__ ) );
	}

	wp_enqueue_script( 'cg_rate', plugins_url( '/cg_rate.js', __FILE__ ), array('jquery'), '1.0', true );

	wp_localize_script( 'cg_rate', 'postlove1', array(
		'ajax_url1' => admin_url( 'admin-ajax.php' )
	));

}
}*/

// Register CSS

add_action( 'wp_enqueue_scripts', 'cg_frontend_style' );	

function cg_frontend_style() {
       /* Register our stylesheet. */
       wp_enqueue_style( 'cg_frontend_style', plugins_url('/frontend/cg_frontend_style.css', __FILE__) );
   }
   
   add_action( 'wp_enqueue_scripts', 'cg_frontend_singe_image_style' );	

function cg_frontend_singe_image_style() {
       /* Register our stylesheet. */
       wp_enqueue_style( 'cg_frontend_singe_image_style', plugins_url('/frontend/cg_frontend_singe_image_style.css', __FILE__) );
   }
   
   add_action( 'admin_enqueue_scripts', 'cg_options_tabcontent' );	

function cg_options_tabcontent() {
       /* Register our stylesheet. */
       wp_enqueue_style( 'cg_options_tabcontent', plugins_url('/admin/options/cg_options_tabcontent.css', __FILE__) );
   }



// AJAX Script für rate picture

add_action( 'wp_enqueue_scripts', 'cg_rate_ajax_enqueue_scripts' );
function cg_rate_ajax_enqueue_scripts() {
	/*if( is_single() ) {
		wp_enqueue_style( 'love', plugins_url( '/js/love.css', __FILE__ ) );
	}*/

	wp_enqueue_script( 'cg_rate', plugins_url( '/js/cg_rate.js', __FILE__ ), array('jquery'), false, true );

	wp_localize_script( 'cg_rate', 'post_cg_rate_wordpress_ajax_script_function_name', array(
		'cg_rate_ajax_url' => admin_url( 'admin-ajax.php' )
	));

}


add_action( 'wp_ajax_nopriv_post_cg_rate', 'post_cg_rate' );
add_action( 'wp_ajax_post_cg_rate', 'post_cg_rate' );

function post_cg_rate() {
	
	global $wpdb;

$ip = $_SERVER['REMOTE_ADDR'];


	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {

		require_once('frontend/rate-picture.php');

		die();
	}
	else {

		exit();
	}
}


// AJAX Script für rate picture ---- ENDE


// AJAX Script für set comment

add_action( 'wp_enqueue_scripts', 'cg_comment_ajax_enqueue_scripts' );
function cg_comment_ajax_enqueue_scripts() {
	/*if( is_single() ) {
		wp_enqueue_style( 'love', plugins_url( '/js/love.css', __FILE__ ) );
	}*/

	wp_enqueue_script( 'cg_comment', plugins_url( '/js/cg_comment.js', __FILE__ ), array('jquery'), false, true );

	wp_localize_script( 'cg_comment', 'post_cg_comment_wordpress_ajax_script_function_name', array(
		'cg_comment_ajax_url' => admin_url( 'admin-ajax.php' )
	));

}


add_action( 'wp_ajax_nopriv_post_cg_comment', 'post_cg_comment' );
add_action( 'wp_ajax_post_cg_comment', 'post_cg_comment' );

function post_cg_comment() {
	
	
	global $wpdb;


	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
	
		require_once('frontend/set-comment.php');
		die();
	}
	else {

		exit();
	}
}


// AJAX Script für set comment ---- ENDE

// localize Scripts















// localize Scripts --- ENDE


add_action('admin_menu', 'contest_gallery_add_page');
if(!function_exists('contest_gallery_add_page')){
	function contest_gallery_add_page() {
		add_menu_page( 'Contest-Gallery uploads', 'Contest Gallery', 'manage_options', __FILE__, 'contest_gallery_action', plugins_url('css/star_48_reduced.png', __FILE__ ));
	}
}

/*function boj_myplugin_add_page() {
	add_options_page( 'My Plugin', 'My Plugin', 'manage_options', 'boj_myplugin', 'boj_myplugin_option_page' );
}*/ 


//CSS Frontend file

if(!function_exists('my_scripts')){
function my_scripts() {
//wp_enqueue_script( 'jquery' );
wp_register_style( 'contest-style', plugins_url('css/style.css', __FILE__) );
wp_enqueue_style( 'contest-style',  plugins_url('css/style.css', __FILE__) );
}
}

add_action('wp_enqueue_scripts','my_scripts');

add_action('admin_enqueue_scripts','my_scripts');



//CSS Frontend file --- END


// Add editor 


/*function editor_admin_init() {

  wp_enqueue_script('word-count');

  wp_enqueue_script('post');


  wp_enqueue_script('media-upload'); 

}

function editor_admin_head() {

  wp_tiny_mce();
  
  }
  
add_action('admin_init', 'editor_admin_init');

add_action('admin_head', 'editor_admin_head');  */

// Add editor style

//add_editor_style(plugins_url('css/style.css', __FILE__));


// Add editor END


//------------------------------------------------------------
// ----------------------------------------------------------- Hauptseite fÃ¼r hochgeladene Bilder ----------------------------------------------------------
//------------------------------------------------------------

if(!function_exists('contest_gallery_action')){
function contest_gallery_action() {

$path = dirname(__FILE__) . "/admin/gallery/license.txt";

$fh = fopen($path, 'r');
$contents = fread($fh,filesize($path));
//echo "<br><br><b>You are using a $contents</b><br><br>";
fclose($fh);	
//------------------------------------------------------------
// ----------------------------------------------------------- Edit CSS file ----------------------------------------------------------
//------------------------------------------------------------	
	
/*if ($_GET['editCSSsend'] == true) {

require('admin/change-css.php');
require_once('admin/gallery/gallery.php');

exit('');
	
}		*/
		
//------------------------------------------------------------
// ----------------------------------------------------------- Change Size of thumbs or galery ----------------------------------------------------------
//------------------------------------------------------------

if($_POST['changeSize']==true OR $_GET['reset_ips'] == true){

require_once('admin/options/change-options-and-sizes.php');

}


//------------------------------------------------------------
// ----------------------------------------------------------- Change options of gallery ---------------------------------------------------------- 
//------------------------------------------------------------	
	
if ($_GET['edit_options'] == true OR $_POST['edit_options']==true OR $_POST['changeSize']==true OR $_GET['reset_ips'] == true ) {
wp_enqueue_script( 'edit_options', plugins_url( '/js/edit_options.js', __FILE__ ), array('jquery'), false, true );
wp_enqueue_script( 'cg_options_tabcontent_js', plugins_url( '/admin/options/cg_options_tabcontent.js', __FILE__ ), array('jquery'), false, true );
wp_enqueue_script( 'jquery-ui-sortable' );
require_once('admin/options/edit-options.php');
	
}

//------------------------------------------------------------
// ----------------------------------------------------------- Create an Upload Form ----------------------------------------------------------
//------------------------------------------------------------	

	
if ($_GET['define_upload'] == true) {
wp_enqueue_script( 'create_upload', plugins_url( '/js/create_upload.js', __FILE__ ), array('jquery'), false, true );
wp_enqueue_script( 'jquery-ui-sortable' );
require_once('admin/upload/create-upload.php');
	
}	


//------------------------------------------------------------
// ----------------------------------------------------------- Define an output of a pic ----------------------------------------------------------
//------------------------------------------------------------	
	
if ($_GET['define_output'] == true) {
wp_enqueue_script( 'define_output', plugins_url( '/js/define_output.js', __FILE__ ), array('jquery'), false, true );
wp_enqueue_script( 'jquery-ui-sortable' );
require_once('admin/upload/define-output.php');
	
}			
		
		
		
//------------------------------------------------------------
// ----------------------------------------------------------- Change email text for informing users ----------------------------------------------------------
//------------------------------------------------------------	
	
if ($_POST['inform_user'] == true OR $_GET['inform_user'] == true) {
wp_enqueue_script( 'change_text_inform_user', plugins_url( '/js/change_text_inform_user.js', __FILE__ ), array('jquery'), false, true );
require_once('admin/email/change-text-inform-user.php');
	
}

	
//------------------------------------------------------------
// ----------------------------------------------------------- Neue Galerie lÃ¶schen ----------------------------------------------------------
//------------------------------------------------------------

if($_GET['option_id']==true AND $_GET['delete']==true){

require_once('admin/delete-gallery.php');
require_once('admin/main-menu.php');

}		
	
//------------------------------------------------------------
// ----------------------------------------------------------- AuswahlmenÃ¼ zum Anzeigen und Erstellen von Galerien ----------------------------------------------------------
//------------------------------------------------------------		
	
if($_GET['option_id']==false and $_POST['option_id']==false){	

//require('css/style.php');
require_once('admin/main-menu.php');

}	


//------------------------------------------------------------
// ----------------------------------------------------------- User per Email informieren oder nicht informieren Ã¤ndern/ SPEICHERN ----------------------------------------------------------
//------------------------------------------------------------	
	
//if ($_POST['submit'] == true AND $_POST['informId'] == true) {

//require_once('admin/email/inform-user.php');
	
//}






//------------------------------------------------------------
// ----------------------------------------------------------- Upload several pics to a certain galery ----------------------------------------------------------
//------------------------------------------------------------

if($_GET['option_id']==true AND $_GET['upload_pics']==true){

require_once('admin/gallery/upload-pics.php');

}

//------------------------------------------------------------
// ----------------------------------------------------------- Reset informed for all pictures ----------------------------------------------------------
//------------------------------------------------------------

if($_POST['reset_all']==true){

require_once('admin/gallery/reset_all.php');

}


//------------------------------------------------------------
// ----------------------------------------------------------- Edit certain galery ----------------------------------------------------------
//------------------------------------------------------------	
	
if ($_GET['edit_gallery'] == true) {


		//------------------------------------------------------------
		// ----------------------------------------------------------- Hochgeladene Bilder anzeigen oder nicht anzeigen Ã¤ndern und Comments Ã¤ndern oder Informieren oder Informierte reseten SPEICHERN ----------------------------------------------------------
		//------------------------------------------------------------	
			
		if ($_POST['submit'] == true AND $_POST['changeGalery'] == true AND ($_POST['chooseAction1'] == 1 OR $_POST['chooseAction1'] == 3)) {
		wp_enqueue_script( 'gallery_admin', plugins_url( '/js/gallery_admin.js', __FILE__ ), array('jquery'), false, true );
		wp_enqueue_script( 'jquery-ui-sortable' );
		require_once('admin/gallery/change-gallery.php');
		require_once('admin/gallery/gallery.php');
			
		}
		
		//------------------------------------------------------------
		// ----------------------------------------------------------- Delete pics of certain galery ----------------------------------------------------------
		//------------------------------------------------------------	
			
		elseif ($_POST['submit'] == true AND $_POST['chooseAction1'] == 2) {
		wp_enqueue_script( 'gallery_admin', plugins_url( '/js/gallery_admin.js', __FILE__ ), array('jquery'), false, true );
		wp_enqueue_script( 'jquery-ui-sortable' );
		//echo "DELETE PICS!<br>";
		require_once('admin/gallery/delete-pics.php');
		require_once('admin/gallery/gallery.php');

		}
		
		//------------------------------------------------------------
		// ----------------------------------------------------------- Neue Galerie kreieren ----------------------------------------------------------
		//------------------------------------------------------------

		elseif($_GET['option_id']==true AND $_GET['create']==true AND $_GET['edit_gallery'] == true ){
		wp_enqueue_script( 'gallery_admin', plugins_url( '/js/gallery_admin.js', __FILE__ ), array('jquery'), false, true );
		wp_enqueue_script( 'jquery-ui-sortable' );
		require_once('admin/create-gallery.php');
		require_once('admin/gallery/gallery.php');

		}
				
		//------------------------------------------------------------
		// ----------------------------------------------------------- Edit certain galery ----------------------------------------------------------
		//------------------------------------------------------------	

		
		else{
		wp_enqueue_script( 'gallery_admin', plugins_url( '/js/gallery_admin.js', __FILE__ ), array('jquery'), false, true );
		wp_enqueue_script( 'jquery-ui-sortable' );	
		require_once('admin/gallery/gallery.php');
		}		
		
		
		
}






//------------------------------------------------------------ 
// ----------------------------------------------------------- Kommentare anzeigen oder nicht anzeigen Ã¤ndern ----------------------------------------------------------
//------------------------------------------------------------	
	
 if ($_POST['submitcomments'] == true) {

require_once('change-show-comments.php');

}	

//------------------------------------------------------------
// ----------------------------------------------------------- Kommentare eines einzelnen Bildes anzeigen ----------------------------------------------------------
//------------------------------------------------------------

if($_GET['show_comments']==true){

require_once('admin/gallery/show-comments.php');	

}
}
}
?>