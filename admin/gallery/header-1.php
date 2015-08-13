<?php

//$GalleryID = $_GET['option_id'];
	
			
	echo "<table style='border: 1px solid #DFDFDF;background-color:#ffffff;margin-bottom:12px;' width='937px;'>";
	echo "<tr>";
	echo "<td style='padding-left:20px;width:353px;' colspan='2'>";
	echo "<br/>Allowed file types: <strong>Jpg, Png, Gif</strong><br/>";
	echo "Actual maximum upload size per file<br/>configurated in php.ini: <strong>$max_post MB</strong>";
	echo <<<HEREDOC
<form action="?page=contest-gal1ery/index.php&option_id=$GalleryID&upload_pics=true&edit_gallery=true" method="POST" enctype="multipart/form-data">
	<input type="file" name="files[]" multiple />
	<input type="submit" value="Upload" style='text-align:center;width:95px;'/><br/><br/>
</form>
HEREDOC;
	echo "</td>";	
	
	echo "<td align='center'><div>";
	
//	print_r( $_POST['informId']);
	
	//echo "teasdtfsdf";
	
	//	print_r($_POST['resetInformId']);
	
	if ($_POST['create_zip']==true or ($_POST['chooseAction1'] == 4 and ($_POST['informId']==true or $_POST['resetInformId']==true))) {
	
	//echo "actions";
	
	$allPics=array();
	//$pfad = $_SERVER['DOCUMENT_ROOT'];
	$uploadFolder = wp_upload_dir();
	
	$pfad = $uploadFolder['basedir'];
	$pfad1 = $uploadFolder['url'];
	
		if($_POST['create_zip']==true){
		
		$selectSQLall = $wpdb->get_results( "SELECT * FROM $tablename WHERE GalleryID = '$GalleryID'");
		
		//print_r($selectSQLall);
		
			foreach($selectSQLall as $value){
			$dl_image_original = $pfad.'/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'.'.$value->ImgType.'';
			//echo "<br>$dl_image_original<br>";
			//$imageGalery = $pfad.'/wp-content/uploads/contest-gal1ery/'.$value->ImageGalery;	
			//$imageThumb = $pfad.'/wp-content/uploads/contest-gal1ery/'.$value->ImageThumb;		
			$allPics[] = $dl_image_original;
			//$allPics[] = $imageGalery;
			//$allPics[] = $imageThumb;
			
			}
			//print_r($allPics);
		}
		
	
		
		
		if($_POST['chooseAction1'] == 4 and ($_POST['informId']==true or $_POST['resetInformId'])){
		
		//echo "2131242131243";
		
		$informId = $_POST['informId'];
		$resetInformId = $_POST['resetInformId'];
		
		$selectPICS = "SELECT * FROM $tablename WHERE ";
		
		//$wpdb->get_results( );
		
			foreach(@$informId as $key => $value){
			
			$selectPICS .= "id=$value or ";	
			
			}	
			
			foreach(@$resetInformId as $key => $value){
			
			$selectPICS .= "id=$value or ";	
			
			}	
		
			$selectPICS = substr($selectPICS,0,-4);
			
			//print_r($selectPICS);
			
			$selectPICSzip = $wpdb->get_results("$selectPICS");
		
			foreach($selectPICSzip as $value){
			$dl_image_original = $pfad.'/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'.'.$value->ImgType.'';
			//$imageGalery = $pfad.'/wp-content/uploads/contest-gal1ery/'.$value->ImageGalery;	
			//$imageThumb = $pfad.'/wp-content/uploads/contest-gal1ery/'.$value->ImageThumb;		
			$allPics[] = $dl_image_original;
			//$allPics[] = $imageGalery;
			//$allPics[] = $imageThumb;
			}
					
		}
	
	 
     $code = $wpdb->prefix; // database prefix
	 $code = md5($code);

	if (file_exists(''.$pfad.'/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$code.'_images_download.zip')) {
	unlink(''.$pfad.'/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$code.'_images_download.zip');
	}
	
	create_zip($allPics,''.$pfad.'/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$code.'_images_download.zip');	
	echo '<p style="text-align:center;width:180px;"><a href="'.$pfad1.'/../../contest-gal1ery/gallery-id-'.$GalleryID.'/'.$code.'_images_download.zip">Download zip file</a></p>';
	echo '<p style="text-align:center;width:180px;"><a href="?page=contest-gal1ery/index.php&option_id='.$GalleryID.'&delete_zip=true&edit_gallery=true">Delete zip file</a></p>';
	
	}
	
	else {
	
	if($_GET['delete_zip']==true){
	$code = $wpdb->prefix; // database prefix
	$code = md5($code);
	$uploadFolder = wp_upload_dir();	
	$pfad = $uploadFolder['basedir'];
	unlink(''.$pfad.'/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$code.'_images_download.zip');
	?><script>alert('Zip file deleted.');</script><?php
	}
	
	echo "<form method='POST' action='?page=contest-gal1ery/index.php&option_id=$GalleryID&step=$step&start=$start&edit_gallery=true'><input type='hidden' name='create_zip' value='true'/><input type='submit' value='Zip all pictures' style='text-align:center;width:180px;' /></form></a>";
	}
	echo "</div></td>";
	
	echo "<td align='center'><div>";

	echo "<form method='POST' action='?page=contest-gal1ery/index.php&option_id=$GalleryID&step=$step&start=$start'><input type='submit' value='Reset all informed' style='text-align:center;width:180px;'/>";
	echo "<input type='hidden'  name='reset_all' value='true'>";
	echo "</form></a>";

	echo "</div></td>";
	
	
	echo "</tr>";
	
	echo "</table>";	

	///////////// SHOW Pictures of certain galery


		


?>