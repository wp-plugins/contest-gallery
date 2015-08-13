 <?php
 
 			// rausfinden wie viel Mega-/Kilobyte hochgeladen werden können und es anzeigen lassen

				
		/*		function return_bytes($val) {
				$val = trim($val);
				$last = strtolower($val[strlen($val)-1]);
				switch($last) {
					// The 'G' modifier is available since PHP 5.1.0
					case 'g':
						$val *= 1024;
					case 'm':
						$val *= 1024;
					case 'k':
						$val *= 1024;
				}

				return $val;
			}

			$maxsize = return_bytes(ini_get('post_max_size'));

			function formatBytes($bytes, $precision = 2) { 
				$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

				$bytes = max($bytes, 0); 
				$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
				$pow = min($pow, count($units) - 1); 

				$bytes /= pow(1024, $pow); 

				return round($bytes, $precision) . ' ' . $units[$pow]; 
			}

			$maxsizeConverted = formatBytes($maxsize,2);
			
			echo "<br/><b>";
			
			echo formatBytes(memory_get_peak_usage(),2);
			
			echo "<br/>";
			
			echo formatBytes(memory_get_usage(),2);
			
			echo "</b><br/>"; */
			

			// rausfinden wie viel Mega-/Kilobyte hochgeladen werden können und es anzeigen lassen ---- ENDE 

			
			
 $id = $_GET['option_id'];
 //$id = $_POST['option_id'];
 
 
 //echo "<br>id: $id<br>";
 
global $wpdb;

$tablename = $wpdb->prefix . "contest_gal1ery";
$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
$tablenameOptionsInput = $wpdb->prefix . "contest_gal1ery_options_input";
$tablename_ip = $wpdb->prefix . "contest_gal1ery_ip";

// reset IPs if send


if($_GET['reset_ips']){


//echo "id11133333: $id";
//$deleteQueryIps = "DELETE FROM $tablename_ip WHERE GalleryID = '$id'";
//$wpdb->query($deleteQueryIps);

$wpdb->delete( $tablename_ip, array( 'GalleryID' => $id ), array( '%d' ) );

?>
<script>
alert('All IPs were deleted. Pictures can be rated again now.');
</script>

<?php

//$sql1 = "DELETE FROM $tablename WHERE GaleryNr = '$optionID' ";

//echo "<br>$deleteQueryIps<br>";


}



if($_POST['changeSize']==true){


/*
// löschen von allen gecachten Files

$upload_dir = wp_upload_dir();

// echo $upload_dir['basedir'];

$deleteCachedSiteFiles = $upload_dir['basedir'].'/contest-gal1ery/gallery-id-'.$id.'/cache/sites/*';
// echo "<br>deleteCachedSiteFiles: $deleteCachedSiteFiles<br>";
$deleteCachedSiteFiles = glob($deleteCachedSiteFiles); // get all file names
foreach($deleteCachedSiteFiles as $file1){ // iterate files
  if(is_file($file1))
    unlink($file1); // delete file
}





$deleteCachedGalleryFiles = $upload_dir['basedir'].'/contest-gal1ery/gallery-id-'.$id.'/cache/gallery/*';
// echo "<br>deleteCachedGalleryFiles: $deleteCachedGalleryFiles<br>";

$deleteCachedGalleryFiles = glob($deleteCachedGalleryFiles); // get all file names
foreach($deleteCachedGalleryFiles as $file2){ // iterate files
  if(is_file($file2))
    unlink($file2); // delete file
}


// löschen von allen gecachten Files --- ENDE

*/






// reset IPs if send --- ENDE


// Ermittel die gesendeten Werte für die Größe der Bilder
/*
$selectSqlWidthGalery = $wpdb->get_var( "SELECT WidthGalery FROM $tablenameOptions WHERE id = '$id'" );
$WidthGalery = ($_POST['WidthGalery']) ? $_POST['WidthGalery'] : $selectSqlWidthGalery ;

$selectSqlHeightGalery = $wpdb->get_var( "SELECT HeightGalery FROM $tablenameOptions WHERE id = '$id'" );
$HeightGalery = ($_POST['HeightGalery']) ? $_POST['HeightGalery'] : $selectSqlHeightGalery ;*/

// $WidthThumb = ($_POST['WidthThumb']) ? "WidthThumb='".$_POST['WidthThumb']."'," : "";
// $HeightThumb = ($_POST['HeightThumb']) ? "HeightThumb='".$_POST['HeightThumb']."'," : "";
// $WidthGallery = ($_POST['WidthGallery']) ? "WidthGallery='".$_POST['WidthGallery']."'," : "";
// $HeightGallery = ($_POST['HeightGallery']) ? "HeightGallery='".$_POST['HeightGallery']."'," : "";

$WidthThumb = ($_POST['WidthThumb']) ? $_POST['WidthThumb'] : "";
$HeightThumb = ($_POST['HeightThumb']) ? $_POST['HeightThumb'] : "";
$WidthGallery = ($_POST['WidthGallery']) ? $_POST['WidthGallery'] : "";
$HeightGallery = ($_POST['HeightGallery']) ? $_POST['HeightGallery'] : "";



 // echo "<br>WidthGalery: $WidthGalery<br>";
 // echo "<br>HeightGalery: $HeightGalery<br>";

// Ermittel die gesendeten Werte für die Größe der Bilder --- ENDE


// Ermittel zuerst die gesendeten Zahlenwerte der Einstellungen



//$DistancePics = ($_POST['DistancePics']) ? "DistancePics='".$_POST['DistancePics']."'," : "DistancePics='0',";
//$DistancePicsV = ($_POST['DistancePicsV']) ? "DistancePicsV='".$_POST['DistancePicsV']."'" : "DistancePicsV='0'";
$DistancePics = ($_POST['DistancePics']) ? $_POST['DistancePics'] : 0;
$DistancePicsV = ($_POST['DistancePicsV']) ? $_POST['DistancePicsV']: 0;

			//$querySETvaluesThumbs = "UPDATE $tablenameOptions SET $WidthThumb $HeightThumb $WidthGallery $HeightGallery 
			//$DistancePics $DistancePicsV  WHERE id = '$id'";			
			//$wpdb->query($querySETvaluesThumbs);


			$wpdb->update( 
				"$tablenameOptions",
				array('WidthThumb' => $WidthThumb,'HeightThumb' => $HeightThumb,'WidthGallery' => $WidthGallery,'HeightGallery' => $HeightGallery,
				'DistancePics' => $DistancePics,'DistancePicsV' => $DistancePicsV),
				array('id' => $id), 
				array('%d','%d','%d','%d','%d','%d'),
				array('%d')
			);
			
			
	
//$PicsPerSite = $_POST['PicsPerSite'];
//$DistancePics = $_POST['DistancePics'];
//$DistancePicsV = $_POST['DistancePicsV'];

//echo $PicsInRow; echo "<br/>";
//echo $LastRow; echo "<br/>";
//echo $DistancePics; echo "<br/>";
//echo $DistancePicsV; echo "<br/>";


// Ermittel zuerst die gesendeten Zahlenwerte der Einstellungen --- ENDE

// Ermittelt die gesendeten Einstellungen (checkboxes)

		//$maxRes = $_POST['maxRes']; $maxRes = serialize($maxRes);
		
		//print_r($_POST['order']);
		
		$PicsPerSite = $_POST['PicsPerSite'];
		
		$order = $_POST['order'];
		$i = 0;
		//echo "<br>Order:<br>";
		//print_r($order);
		//echo "<br>";
		
		foreach($order as $key => $value){
		
		$i++;
		
			if($value=='t'){$t=$i;}
			if($value=='h'){$h=$i;}
			if($value=='r'){$r=$i;}
		
		}
		
		$ThumbLook = ($_POST['ThumbLook']) ? '1' : '0';
		$HeightLook = ($_POST['HeightLook']) ? '1' : '0';	
		$RowLook = ($_POST['RowLook']) ? '1' : '0';
		
		$ThumbLookOrder = $t;
		$HeightLookOrder = $h;	
		$RowLookOrder = $r;
	

		$ScaleWidthGalery = ($_POST['ScaleWidthGalery']) ? '1' : '0';
		$ScaleSizesGalery = ($_POST['ScaleSizesGalery']) ? '1' : '0';

		$AllowGalleryScript = ($_POST['AllowGalleryScript']) ? '1' : '0';
		
		// $HeightLookHeight = ($_POST['HeightLookHeight']) ? "HeightLookHeight='".$_POST['HeightLookHeight']."'," : "";
		$HeightLookHeight = ($_POST['HeightLookHeight']) ? $_POST['HeightLookHeight'] : "";
		
		//$PicsInRow = ($_POST['PicsInRow']) ? "PicsInRow='".$_POST['PicsInRow']."'," : '';
		$PicsInRow = ($_POST['PicsInRow']) ? $_POST['PicsInRow'] : '';
		$LastRow = ($_POST['LastRow']) ? '1' : '0';
		$ThumbsInRow = ($_POST['ThumbsInRow']) ? '1' : '0';
		$FullSize = ($_POST['FullSize']) ? '1' : '0';
		$AllowSort = ($_POST['AllowSort']) ? '1' : '0';
		
		$AllowComments = ($_POST['AllowComments']) ? '1' : '0';
		$AllowRating = ($_POST['AllowRating']) ? '1' : '0';
		$IpBlock = ($_POST['IpBlock']) ? '1' : '0';
		$FbLike = ($_POST['FbLike']) ? '1' : '0';
		
		//echo $_POST['maxResJPGon'];
		//	echo $_POST['maxResPNGon'];
		//echo $_POST['maxResGIFon'];
		
		// Ermitteln der Auflösung beim Hochalden
		$MaxResJPGon = ($_POST['MaxResJPGon']) ? '1' : '0';
		// $MaxResJPG = ($_POST['MaxResJPG']) ? "MaxResJPG='".$_POST['MaxResJPG']."'," : '';
		$MaxResJPG = ($_POST['MaxResJPG']) ? $_POST['MaxResJPG'] : '';
		$MaxResPNGon = ($_POST['MaxResPNGon']) ? '1' : '0';
		// $MaxResPNG = ($_POST['MaxResPNG']) ? "MaxResPNG='".$_POST['MaxResJPG']."'," : '';
		$MaxResPNG = ($_POST['MaxResPNG']) ? $_POST['MaxResPNG'] : '';
		$MaxResGIFon = ($_POST['MaxResGIFon']) ? '1' : '0';
		// $MaxResGIF = ($_POST['MaxResGIF']) ? "MaxResGIF='".$_POST['MaxResJPG']."'," : '';
		$MaxResGIF = ($_POST['MaxResGIF']) ? $_POST['MaxResGIF'] : '';
		
// Ermittelt die gesendeten Einstellungen (checkboxes) --- ENDE 

			// Update non scale or cut values	

			/*$querySETvalues = "UPDATE $tablenameOptions SET PicsPerSite='$PicsPerSite', MaxResJPGon='$MaxResJPGon', MaxResPNGon='$MaxResPNGon', MaxResGIFon='$MaxResGIFon', 
			$MaxResJPG $MaxResPNG $MaxResGIF 
			ScaleOnly='$ScaleWidthGalery', ScaleAndCut='$ScaleSizesGalery', FullSize = '$FullSize', AllowSort = '$AllowSort',
			AllowComments = '$AllowComments', AllowRating = '$AllowRating', IpBlock = '$IpBlock', FbLike = '$FbLike', AllowGalleryScript='$AllowGalleryScript', 
			ThumbLook = '$ThumbLook', HeightLook = '$HeightLook', RowLook = '$RowLook',
			ThumbLookOrder = '$ThumbLookOrder', HeightLookOrder = '$HeightLookOrder', RowLookOrder = '$RowLookOrder',
			$HeightLookHeight ThumbsInRow = '$ThumbsInRow', $PicsInRow LastRow = '$LastRow' 
			WHERE id = '$id'";*/
			
			//$wpdb->query($querySETvalues);
			
			$wpdb->update( 
				"$tablenameOptions",
				array('PicsPerSite' => $PicsPerSite,'MaxResJPGon' => $MaxResJPGon,'MaxResPNGon' => $MaxResPNGon,'MaxResGIFon' => $MaxResGIFon,
				'MaxResJPG' => $MaxResJPG,'MaxResPNG' => $MaxResPNG,'MaxResGIF' => $MaxResGIF,
				'ScaleOnly' => $ScaleWidthGalery,'ScaleAndCut' => $ScaleSizesGalery,'FullSize' => $FullSize,'AllowSort' => $AllowSort,
				'AllowComments' => $AllowComments,'AllowRating' => $AllowRating,'IpBlock' => $IpBlock,'FbLike' => $FbLike,'AllowGalleryScript' => $AllowGalleryScript,
				'ThumbLook' => $ThumbLook,'HeightLook' => $HeightLook,'RowLook' => $RowLook,
				'ThumbLookOrder' => $ThumbLookOrder,'HeightLookOrder' => $HeightLookOrder,'RowLookOrder' => $RowLookOrder,
				'HeightLookHeight' => $HeightLookHeight, 'ThumbsInRow' => $ThumbsInRow, 'PicsInRow' => $PicsInRow, 'LastRow' => $LastRow),
				array('id' => $id), 
				array('%d','%d','%d','%d',
				'%d','%d','%d',
				'%d','%d','%d','%d',
				'%d','%d','%d','%d','%d',
				'%d','%d','%d',
				'%d','%d','%d',
				'%d','%d','%d','%d'),
				array('%d')
			);
			
			
			
			// input Options
		
			// $forward = ($_POST['forward']) ? '1' : '0';
			// $forward_url = ($_POST['forward_url']) ? "Forward_url='".htmlentities($_POST['forward_url'], ENT_QUOTES, 'UTF-8')."'," : '';
			// $confirmation_text = ($_POST['confirmation_text']) ? "Confirmation_Text='".htmlentities($_POST['confirmation_text'], ENT_QUOTES, 'UTF-8')."'," : '';
			
			$forward = ($_POST['forward']) ? '1' : '0';
			$forward_url = ($_POST['forward_url']) ? htmlentities($_POST['forward_url'], ENT_QUOTES, 'UTF-8') : '';
			$confirmation_text = ($_POST['confirmation_text']) ? htmlentities($_POST['confirmation_text'], ENT_QUOTES, 'UTF-8') : '';
		
			// input Options --- ENDE
			
			//$querySETvaluesInputOptions = "UPDATE $tablenameOptionsInput SET $forward_url $confirmation_text Forward = '$forward' WHERE id = '$id'";
			//$wpdb->query($querySETvaluesInputOptions);
			
			$wpdb->update( 
				"$tablenameOptionsInput",
				array('Forward' => $forward,'Forward_url' => $forward_url,'Confirmation_Text' => $confirmation_text),
				array('id' => $id), 
				array('%d','%d','%d'),
				array('%d')
			);
			
			

			

			
			/*			
			echo $querySETvalues;
			echo "<br/>";

			$updateSQLvalues = $wpdb->query($querySETvalues);	
			
			// Update normal options ---- END
			
			
			if ($RowLook==1) {
			
			$querySETrowLook = "UPDATE $tablenameOptions SET PicsInRow = '$PicsInRow' WHERE id = '$id' ";
			
			echo $querySETrowLook;
			echo "<br/>";
			
			$updateSQLrowLook = $wpdb->query($querySETrowLook);	
						
			}
			
			if ($ThumbLook==1) {
			
			$querySETthumbLook = "UPDATE $tablenameOptions SET DistancePics = '$DistancePics', DistancePicsV = '$DistancePicsV' WHERE id = '$id' ";
			
			$updateSQLthumbLook = $wpdb->query($querySETthumbLook);	
			
			}			


// Origin Values needs first
$selectSQL1 = $wpdb->get_results( "SELECT * FROM $tablenameOptions WHERE id = '$id'" );

		foreach($selectSQL1 as $value){
		
		$ScalePics = $value->ScalePics;
		$WidthThumb1 = $value->WidthThumb;
		$HeightThumb1 = $value->HeightThumb;
		$WidthGalery1 = $value->WidthGalery;
		$HeightGalery1 = $value->HeightGalery;
		$DistancePics1 = $value->DistancePics;
		$DistancePicsV1 = $value->DistancePicsV;
		$PicsPerSite1 = $value->PicsPerSite;
		$ScaleOnly = "".$value->ScaleOnly."";
		$ScaleAndCut = "".$value->ScaleAndCut."";
		$selectedCheckComments1 = $value->AllowComments;
		$selectedCheckIp1 = $value->IpBlock;
		$selectedCheckFb1 = $value->FbLike;
		
		}
		
		echo "<br>";
echo "$DistancePics1 ";
echo "<br>";
		
	echo	$WidthThumb1;
	echo	$HeightThumb1;
	echo	$WidthGalery1;
	echo	$HeightGalery1;
	echo	$selectedCheckComments1;
	echo	$selectedCheckIp1;
	echo	$selectedCheckFb1;		


$selectSQL = $wpdb->get_results( "SELECT * FROM $tablename WHERE GalleryID = '$id'" ); */

	//------------------------------------------------------------
	// ----------------------------------------------------------- Change Size of Thumb pics ----------------------------------------------------------
	//------------------------------------------------------------

/*
if($WidthThumb != $WidthThumb1 OR $HeightThumb != $HeightThumb1){		

		$uploads = wp_upload_dir();
		
		foreach($selectSQL as $value){
		
			

				$ImageOrigin = "".$value->ImageOrigin."";
				$ImageThumb = "".$value->ImageThumb."";
				$ImageGalery = "".$value->ImageGalery."";
				
				$WPdestination1 = $uploads['basedir'].'/'.$ImageThumb;
				
				if(file_exists($WPdestination1) == true ){
				
				
				$WPdestination = $uploads['basedir'].'/'.$ImageOrigin;
				$WPdestinationThumb = $uploads['basedir'].'/'.$ImageThumb;

				
				$filename = $WPdestination;
				
				echo "<br/>WPdestination von Thumb:";
				echo "<br/>";
				echo $WPdestination;
				echo "<br/>";
				


				// Get dimensions of the original image. The x and y coordinates on the original image where we
				list($current_width, $current_height) = getimagesize($filename);
				
				// Hier ist auch anders als bei convert-sveral-pics-in-admin. Da kommt es früher vor.
				$dateityp = getimagesize($filename);
				// Hier ist auch anders als bei convert-sveral-pics-in-admin. Da kommt es früher vor.---- ENDE
				 

				$new_width = $WidthThumb;
				$new_height = $HeightThumb;

				$crop_width = $WidthThumb;
				$crop_height = $HeightThumb;

				echo $current_width;
				echo "<br/>";
				echo $crop_width;
				echo "<br/>";
				echo $current_height;
				echo "<br/>";
				echo $crop_height;
				echo "<br/>";

				$quotient_width = $current_width/$crop_width;//=3,25
				$quotient_height = $current_height/$crop_height;//=1,56

				//417-200
				//217/2=108,5*1,53

				//Pic is more width then height >>> cut width
				if ($quotient_width > $quotient_height){

				$new_width = $current_width/$quotient_height;//417
				$new_height = $crop_height;//
				$left = ($new_width-$crop_width)/2*1.543;
				echo $left;
				echo "<br/>";
				$top = 0;

				}

				//Pic is more height then width >>> cut height
				if ($quotient_height > $quotient_width){

				$new_height = $current_height/$quotient_width;
				$new_width = $crop_width;
				$top = ($new_height-$crop_height)/2*1.87;
				echo $top;
				echo "<br/>";
				$left = 0;

				}

				if ($quotient_height == $quotient_width){

				$new_height = $crop_height;
				$new_width = $crop_width;
				$top = 0;
				$left = 0;

				}

					if ($crop_height > $current_height OR $crop_width > $current_width){

					$new_width = $crop_width;
					$new_height = $crop_height;

					$left= 0;
					echo $top;
					echo "<br/>";
					$top = 0;

					}
				
				echo "Crop Width:<br/>";	
				echo $crop_width;
				echo "<br/>";
								echo "Crop Height:<br/>";	
				echo $crop_height;
				echo "<br/>";
				echo "<br/>";
				echo "<br/>";
				echo "<b>";
				echo $new_height;
				echo "<br/>";
				echo $new_width;
				echo "</b>";
				echo "Großer TEST";
				echo "<br/>";
				echo "Current Width:<br/>";
				echo $current_width;
				echo "<br/>";
				echo "Current Height<br/>";
				echo $current_height;
				echo "<br/>";
				echo $left;
				echo "<br/>";
				echo $top;


				// ACHTUNG!!!!!!!!!!!!!!!!! ---> Hier unterscheid sich change-sizes von convert-several-pics-in-admin

				$newDestination = $WPdestinationThumb;
				
				// ACHTUNG!!!!!!!!!!!!!!!!! ---> Hier unterscheid sich change-sizes von convert-several-pics-in-admin ---- ENDE


				$thumb = imagecreatetruecolor($crop_width, $crop_height);

				if($dateityp[2] == 1){
				$current_image = imagecreatefromgif($filename);
				}

				if($dateityp[2] == 2){
				$current_image = imagecreatefromjpeg($filename);
				}

				if($dateityp[2] == 3){
				$current_image = imagecreatefrompng($filename);
				}

				else{
				echo "Wrong Data-Type";
				}

				imagecopyresized($thumb,$current_image, 0, 0, $left, $top, $new_width, $new_height , $current_width, $current_height);

				imageJPEG($thumb, $newDestination, 100);
								
								}
						
						}
		
		

		$querySET = "UPDATE $tablenameOptions  SET WidthThumb='$WidthThumb', HeightThumb='$HeightThumb' WHERE id = '$id' ";

		$updateSQL = $wpdb->query($querySET);		
		
		
	}

	//------------------------------------------------------------
	// ----------------------------------------------------------- Change size of Galery pics ----------------------------------------------------------
	//------------------------------------------------------------
	
	if($WidthGalery != $WidthGalery1 OR $HeightGalery != $HeightGalery1 OR ($_POST['ScaleSizesGalery']==true AND $_POST['ScaleWidthGalery']==false AND $checkSqlScaleOnly==1) 
	OR ($_POST['ScaleSizesGalery']==false AND $_POST['ScaleWidthGalery']==true AND $checkSqlScaleAndCut==1)){	
	
	echo "Nochmal TEST";
	
		$uploads = wp_upload_dir();
		
	$HeightGalery = ($HeightGalery) ? $HeightGalery : $HeightGalery1 ;	
	
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
	echo $HeightGalery;
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
		
		foreach($selectSQL as $value){
		

				$ImageOrigin = "".$value->ImageOrigin."";
				$ImageThumb = "".$value->ImageThumb."";
				$ImageGalery = "".$value->ImageGalery."";
				
				$WPdestination1 = $uploads['basedir'].'/'.$ImageGalery;


				if(file_exists($WPdestination1) == true ){

				$WPdestination = $uploads['basedir'].'/'.$ImageOrigin;
				$WPdestinationGallery = $uploads['basedir'].'/'.$ImageGalery;
				$filename = $WPdestination;
				
				echo "<br/>WPdestination: von Galery";
				echo "<br/>";
				echo $WPdestination;
				echo "<br/>";

				// Get dimensions of the original image. The x and y coordinates on the original image where we
				list($current_width, $current_height) = getimagesize($filename);
				
				// Hier ist auch anders als bei convert-sveral-pics-in-admin. Da kommt es früher vor.
				$dateityp = getimagesize($filename);
				// Hier ist auch anders als bei convert-sveral-pics-in-admin. Da kommt es früher vor. --- ENDE

				$new_width = $WidthGalery;
				$new_height = $HeightGalery;

				$crop_width = $WidthGalery;
				$crop_height = $HeightGalery;


				$quotient_width = $current_width/$crop_width;//=3,25
				$quotient_height = $current_height/$crop_height;//=1,56

				//417-200
				//217/2=108,5*1,53

				if (($quotient_width > $quotient_height) AND $ScaleOnly == 0){

				$new_width = $current_width/$quotient_height;//417
				$new_height = $crop_height;//
				$left = ($new_width-$crop_width)/2*1.543;
				echo $left;
				echo "<br/>";
				$top = 0;

				}

				if (($quotient_height > $quotient_width)  AND $ScaleOnly == 0){

				$new_height = $current_height/$quotient_width;
				$new_width = $crop_width;
				$top= ($new_height-$crop_height)/2*1.87;
				echo $top;
				echo "<br/>";
				$left = 0;

				}

				if (($quotient_height == $quotient_width)  AND $ScaleOnly == 0){

				$new_height = $crop_height;
				$new_width = $crop_width;
				$top = 0;
				$left = 0;

				}

						if (($crop_height > $current_height OR $crop_width > $current_width)  AND $ScaleOnly == 0){

						$new_width = $crop_width;
						$new_height = $crop_height;

						$left= 0;
						echo $top;
						echo "<br/>";
						$top = 0;

						}
					
				if ($ScaleOnly == 1){ 

				$new_width = $crop_width;
				$new_height = $new_width*$current_height/$current_width;

				$crop_height = $new_height;

				echo "<br/>";
				echo "<br/>";
				echo "Großer TEST1234";
				echo "<br/>";
				echo "<br/>";
				$left= 0;
				echo $top;
				echo "<br/>";
				$top = 0;

				}



				echo "Crop Width:<br/>";	
				echo $crop_width;
				echo "<br/>";				
				echo "Crop Height:<br/>";	
				echo $crop_height;
				echo "<br/>";
				echo $new_height;
				echo "<br/>";
				echo $new_width;
				echo "Current Width:<br/>";
				echo $current_width;
				echo "<br/>";
				echo "Current Height<br/>";
				echo $current_height;
				echo "<br/>";
				echo $left;
				echo "<br/>";
				echo "<b>";
				echo $top;
				echo "</b>";

				
				// ACHTUNG!!!!!!!!!!!!!!!!! ---> Hier unterscheid sich change-sizes von convert-several-pics-in-admin

				$newDestination = $WPdestinationGallery;
				
				// ACHTUNG!!!!!!!!!!!!!!!!! ---> Hier unterscheid sich change-sizes von convert-several-pics-in-admin ---- ENDE

				$galery = imagecreatetruecolor($crop_width, $crop_height);

				if($dateityp[2] == 1){
				$current_image = imagecreatefromgif($filename);
				}

				if($dateityp[2] == 2){
				$current_image = imagecreatefromjpeg($filename);
				}

				if($dateityp[2] == 3){
				$current_image = imagecreatefrompng($filename);
				}

				else{
				echo "Wrong Data-Type";
				}

				imagecopyresampled($galery ,$current_image, 0, 0, $left, $top, $new_width, $new_height , $current_width, $current_height);

				imageJPEG($galery, $newDestination, 100);

					}
			
		}
	
			$querySET1 = "UPDATE $tablenameOptions  SET WidthGalery='$WidthGalery', HeightGalery = '$HeightGalery' WHERE id = '$id' ";
			$updateSQL1 = $wpdb->query($querySET1);
				
	}*/
	
}
	

?>