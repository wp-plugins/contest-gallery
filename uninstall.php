<?php
// If uninstall not called from WordPress exit
if( !defined( 'WP_UNINSTALL_PLUGIN' ) )
exit ();
// Delete option from options table
// delete_option( 'boj_myplugin_options' );
// delete_option( 'boj_myplugin_option' );
//remove any additional options and custom tables


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


// Löschen aller Dateien zuerst

	// Auswählen aller noch vorhanden option ids
	
	$selectOptionIds = $wpdb->get_results( "SELECT id FROM $tablename_options ORDER BY id ASC" );
	
	$upload_dir = wp_upload_dir();
	echo $upload_dir['basedir'];

		foreach($selectOptionIds as $value){
			
			$optionID = $value->id;
	
			/*
			
			// delete cached sites
			
			$deleteCachedSiteFiles = $upload_dir['basedir'].'/contest-gal1ery/gallery-id-'.$optionID.'/cache/sites/*';
			// echo "<br>deleteCachedSiteFiles: $deleteCachedSiteFiles<br>";
			$deleteCachedSiteFiles = glob($deleteCachedSiteFiles); // get all file names
			foreach($deleteCachedSiteFiles as $file1){ // iterate files
			if(is_file($file1))
			unlink($file1); // delete file
			}
			
			// delete cached picture sites folder
			$deleteCachedSiteFilesFolder = $upload_dir['basedir'].'/contest-gal1ery/gallery-id-'.$optionID.'/cache/sites';
			rmdir($deleteCachedSiteFilesFolder);
			
			
			$deleteCachedGalleryFiles = $upload_dir['basedir'].'/contest-gal1ery/gallery-id-'.$optionID.'/cache/gallery/*';
			// echo "<br>deleteCachedGalleryFiles: $deleteCachedGalleryFiles<br>";

			$deleteCachedGalleryFiles = glob($deleteCachedGalleryFiles); // get all file names
			foreach($deleteCachedGalleryFiles as $file2){ // iterate files
			if(is_file($file2))
			unlink($file2); // delete file
			}
			
			// delete cached gallery folder
			$deleteCachedGalleryFilesFolder = $upload_dir['basedir'].'/contest-gal1ery/gallery-id-'.$optionID.'/cache/gallery';
			rmdir($deleteCachedGalleryFilesFolder);
			
			// delete cache folder
			$deleteCacheFolder = $upload_dir['basedir'].'/contest-gal1ery/gallery-id-'.$optionID.'/cache';
			rmdir($deleteCacheFolder);
			
			// delete cached sites --- END
			*/
			// delete pictures
			
			$deletePictureFiles = $upload_dir['basedir'].'/contest-gal1ery/gallery-id-'.$optionID.'/*';
			// echo "<br>deleteCachedGalleryFiles: $deleteCachedGalleryFiles<br>";

			$deletePictureFiles = glob($deletePictureFiles); // get all file names
			foreach($deletePictureFiles as $file3){ // iterate files
			if(is_file($file3))
			unlink($file3); // delete file
			}
			
			$deletePictureFilesFolder = $upload_dir['basedir'].'/contest-gal1ery/gallery-id-'.$optionID.'';
			
			// echo "<br>deletePictureFilesFolder: $deletePictureFilesFolder <br>";
			
			rmdir($deletePictureFilesFolder);
			
			}
			
			$deleteContestGalleryUploadFolder = $upload_dir['basedir'].'/contest-gal1ery';
			
			// echo "<br>deletePictureFilesFolder: $deletePictureFilesFolder <br>";
			
			rmdir($deleteContestGalleryUploadFolder);
		
		

// Löschen aller Dateien zuerst --- ENDE








function drop_tables(){

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

$sql = "DROP TABLE $tablename";
$sql1 = "DROP TABLE $tablename_ip";
$sql2 = "DROP TABLE $tablename_comments";
$sql4 = "DROP TABLE $tablename_options";
$sql5 = "DROP TABLE $tablename_options_input";
$sql6 = "DROP TABLE $tablename_email";
$sql7 = "DROP TABLE $tablename_entries";
$sql8 = "DROP TABLE $tablename_form_input";
$sql9 = "DROP TABLE $tablename_form_output";

$wpdb->query($sql);
$wpdb->query($sql1);
$wpdb->query($sql2);
$wpdb->query($sql3);
$wpdb->query($sql4);
$wpdb->query($sql5);
$wpdb->query($sql6);
$wpdb->query($sql7);
$wpdb->query($sql8);
$wpdb->query($sql9);

}	

drop_tables();
	  
?>