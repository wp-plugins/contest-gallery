<?php
/*error_reporting(E_ALL); 
ini_set('display_errors', 'On');


AUFBAU

*/





	$start = 0; // Startwert setzen (0 = 1. Zeile)
	$step =10;

	if (isset($_GET["start"])) {
	  $muster = "/^[0-9]+$/"; // reg. Ausdruck für Zahlen
	  if (preg_match($muster, $_GET["start"]) == 0) {
		$start = 0; // Bei Manipulation Rückfall auf 0
	  } else {
		$start = $_GET["start"];
	  }
	}
	
	if (isset($_GET["step"])) {
	  $muster = "/^[0-9]+$/"; // reg. Ausdruck für Zahlen
	  if (preg_match($muster, $_GET["start"]) == 0) {
		$step = 10; // Bei Manipulation Rückfall auf 0
	  } else {
		$step = $_GET["step"];
	  }
	}

	
$GalleryID = $_GET['option_id'];


//echo "<br>step: $step<br>";
//echo "<br>start: $start<br>";





	// Tabellennamen ermitteln, GalleryID wurde als Shortcode bereits übermittelt.
	global $wpdb;

	$tablename = $wpdb->prefix . "contest_gal1ery";	
	$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
	$tablenameComments = $wpdb->prefix . "contest_gal1ery_comments";
	$tablenameentries = $wpdb->prefix . "contest_gal1ery_entries";
	$tablename_f_input = $wpdb->prefix . "contest_gal1ery_f_input";
	
	// Reset Informed
	
	// Reset von allen Informed
	if($_GET['resetInformed']=='true'){
	
		//echo "<br>resetInformed: $resetInformed<br>";
		
		//$querySEToptions = "UPDATE $tablename SET Informed='0' WHERE Informed = '1' AND GalleryID = '$GalleryID' ";
		//$updateSQL = $wpdb->query($querySEToptions);
		
						$wpdb->update( 
						"$tablename",
						array('Informed' => '0'), 
						array(
						'id' => '1',
						'GalleryID' => "$GalleryID"
						), 
						array('%d'),
						array('%d','%d')
						);

	}

	// Reset Informed --- ENDE
	
	
	
	
	
	//echo "$GalleryID";

	$selectSQL = $wpdb->get_results( "SELECT * FROM $tablename WHERE GalleryID = '$GalleryID' ORDER BY rowid DESC LIMIT $start, $step " );

	$optionsSQL = $wpdb->get_row( "SELECT * FROM $tablenameOptions WHERE id = '$GalleryID'" );

	//$rows = $wpdb->get_var( "SELECT COUNT(*) AS NumberOfRows FROM $tablename WHERE GalleryID='$GalleryID'");
	
	$rows = $wpdb->get_var( $wpdb->prepare( 
	"
		SELECT COUNT(*) AS NumberOfRows
		FROM $tablename 
		WHERE GalleryID = %d
	",
	$GalleryID
	) );
	
	//$optionsSQL = $wpdb->get_row( "SELECT * FROM $tablename_f_input WHERE id = '$GalleryID'" );
	
	$selectFormInput = $wpdb->get_results( "SELECT id, Field_Type, Field_Order, Field_Content FROM $tablename_f_input WHERE GalleryID = '$GalleryID' AND (Field_Type = 'text-f' OR Field_Type = 'comment-f' OR Field_Type ='email-f') ORDER BY Field_Order ASC" );
	
	$checkInformed = $wpdb->get_results("SELECT 1 FROM $tablename WHERE GalleryID = '$GalleryID' AND Informed = '1' LIMIT 1");
	
	// Die Field_Content Felder werden jetzt schon usnerialized und in einem Array gespeichert um weniger Load zu erzeugen
	

	$selectContentFieldArray = array();
	
	foreach ($selectFormInput as $value) {
	
	// 1. Feld Typ
	// 2. ID des Feldes in F_INPUT
	// 3. Feld Reihenfolge
	// 4. Feld Content

	$selectFieldType = 	$value->Field_Type;
	$id = $value->id;// primäre unique id der form wird auch gespeichert und später in entries inserted zur erkennung des verwendeten formular feldes
	$fieldOrder = $value->Field_Order;// Die originale Field order in f_input Tabelle. Zwecks Vereinheitlichung.
	$selectContentFieldArray[] = $selectFieldType;
	$selectContentFieldArray[] = $id;
	$selectContentFieldArray[] = $fieldOrder;
	$selectContentField = unserialize($value->Field_Content);
	$selectContentFieldArray[] = $selectContentField["titel"];
	
	}
	
	//print_r($optionsSQL);
	
	
		// ------------ Ermitteln der Options-Daten
		
		$RowLook = $optionsSQL->RowLook; // Bilder in einer Reiehe nacheinander anzeigen oder nicht 
		$LastRow = $optionsSQL->LastRow; // Wenn $RowLook an dann wie viele Bilder sollen in letzter Spalte gezeigt werden
		//$PicsPerSite = $optionsSQL->PicsPerSite; // Wie viele Bilder sollen insgesamt  gezeigt werden --- UPDATE: Wird bereits weiter oben oder bei get-data-1.php ermittelt
		$PicsInRow = $optionsSQL->PicsInRow; // Wie viele Bilder in einer Reiehe sollen gezeigt werden
		$WidthGalery = $optionsSQL->WidthGallery;
		$HeightGalery = $optionsSQL->HeightGallery;
		$DistancePics = $optionsSQL->DistancePics;
		$DistancePicsV = $optionsSQL->DistancePicsV;
		$AllowComments = $optionsSQL->AllowComments;
		$AllowRating = $optionsSQL->AllowRating;
		$ScalePics = $optionsSQL->ScalePics;
		$ScaleAndCut = $optionsSQL->ScaleAndCut;
		$AllowGalleryScript = $optionsSQL->AllowGalleryScript;  
		$ThumbsInRow = $optionsSQL->ThumbsInRow; // Anzahl der Bilder in einer Reihe bei Auswahl von ReihenAnsicht (Semi-Flickr-Ansicht)
		$ThumbLook = $optionsSQL->ThumbLook;
		$WidthThumb = $optionsSQL->WidthThumb; // Breite der ThumbBilder (Normale Ansicht mit Bewertung etc.)
		$HeightThumb = $optionsSQL->HeightThumb;  // Höhe der ThumbBilder (Normale Ansicht mit Bewertung etc.)
		$LastRow = $optionsSQL->LastRow;
		$FullSize = $optionsSQL->FullSize;
		$IpBlock = $optionsSQL->IpBlock;
		$FbLike = $optionsSQL->FbLike;
		$ScaleOnly = $optionsSQL->ScaleOnly;
		$JqgGalery = $optionsSQL->JqgGalery;
		$Inform = $optionsSQL->Inform;
		
		
		$WidthThumb = $WidthThumb.'px';// Breite Thumb mit px für Heredoc
		$HeightThumb = $HeightThumb.'px';// Höhe Thumb mit px für Heredoc
		$DistancePics = $DistancePics.'px'; // Abstand der Thumbs Breite mit px für Heredoc
		$DistancePicsV = $DistancePicsV.'px'; // Abstand der Thumbs Höhe mit px für Heredoc
		
				// Ermitteln ob checked oder nicht
				
				$selectedCheckComments = ($AllowComments==1) ? 'checked' : '';
				$selectedCheckRating = ($AllowRating==1) ? 'checked' : '';
				$selectedCheckIp = ($IpBlock==1) ? 'checked' : '';
				$selectedCheckFb = ($FbLike==1) ? 'checked' : '';
				$selectedCheckScalePics = ($ScalePics==1) ? 'checked' : '';
				//$selectedCheckPicUpload = ($value->PicUpload==1) ? 'checked' : '';
				//$selectedCheckSendEmail = ($value->SendEmail==1) ? 'checked' : '';
				//$selectedSendName = ($value->SendName==1) ? 'checked' : '';
				//$selectedCheckSendComment = ($value->SendComment==1) ? 'checked' : '';
				$AllowGalleryScript = ($AllowGalleryScript==1) ? 'checked' : '';

						
				// // Ermitteln ob checked oder nicht ---- ENDE
	

// ----------  Auswahl aufsteigend oder absteigend
	
	/*if ($_POST['dauswahl']==false) {

	$galeryrow = $wpdb->get_row( "SELECT * FROM $tablenameOptions WHERE id = '$GalleryID'" );

	$orderpicsdesc = ($galeryrow->OrderPics == 0) ? 'selected' : '';
	$orderpicsasc = ($galeryrow->OrderPics == 1) ? 'selected' : '';

	}


		// Show choice desc or asc
		
		if (@$_POST['dauswahl'] == "dab" OR @$_GET['dauswahl'] == "dab") {
		$turn = 'DESC';
		$turn1 = 'dab';
		$orderpicsdesc = 'selected';
		}

		echo $_POST['dauswahl'];
		
		if (@$_POST['dauswahl'] == "dauf"  OR @$_GET['dauswahl'] == "dauf") {
		$turn = 'ASC';
		$turn1 = 'dauf';
		$orderpicsasc = 'selected';
		}

		else {
		$turn = 'DESC';
		} */
		
// Auswahl aufsteigend oder absteigend ----------- ENDE

	
		//// Config how many pics should be shown at one time 
	
		$i=0;	
		$nr1 = $start + 1;			
				
				
				
	// Configuration link urls ----->
	
	$content_url  = content_url();
	
	$pathPlugin = plugins_url();
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	
	$path = $_SERVER['REQUEST_URI'];
	
	$host = $_SERVER['HTTP_HOST'];
	
	/*echo "<br/>";
	echo "$path";
	echo "<br/>";
	echo "$host";
	echo "<br/>";*/
	
	$siteUrlOff = (strpos($path,'?')) ? $host.$path.'&' : $host.$path.'?';
	
	// echo "<b>$siteUrlOff</b>";
	
	$siteURL = $pageURL.$siteUrlOff;
	
	//echo $siteURL;
	
	// Wenn der zweite Teil des Explodes existiert, dann die URL wieder zurück machen
	
	$siteURL = (strpos($siteURL,'&&')) ? str_replace("&&", "&","$siteURL") : $siteURL;
	
	$explode = explode('&',$siteURL);
	
	$siteURLdauswahl = ($explode[2]) ? $explode[0].'&'. $explode[1].'&'.'dauswahl' : $siteURL.'dauswahl';
	
	//echo "$siteURLdauswahl";
	
	// Configuration link urls -----> END
	

	
    	// Ermitteln der Options-Daten ---------------- ENDE
		
		
		
		

		
			// Determine values of Options Table>>>>END
			
		// Determine name fields names of upload Form
		
		//$i=0;
		
		/*echo "<br/>";
		print_r($defineUpload);	
		echo "<br/>";		
		
		foreach ($defineUpload as $variant => $value) {

		if ($value=='nf' AND $i==0) {$i++;continue;}
		if ($i==1) {$name1uploadForm = $value;$i++;continue;}
		
		if ($value=='nf' AND $i==2) {$i++;continue;}
		if ($i==3) {$name2uploadForm = $value;$i++;continue;}
		
		if ($value=='nf' AND $i==4) {$i++;continue;}
		if ($i==5) {$name3uploadForm = $value;$i++;continue;}		
			
		}
		
		
		// Checken ob Kommentar oder E-Mail Feld vorhanden sind
		
		$keysDuKf = @array_keys($defineUpload,'kf',true);
		
		if ($keysDuKf) {
		
		$keysDuKf[0]++;
		$keysDuKf1 = $keysDuKf[0];
		
		echo "<br/>";
		echo print_r($keysDuKf);
		echo "<br/>";
		
		}

		
		$keysDuEf = @array_keys($defineUpload,'ef',true);
		
		if ($keysDuEf) {
		
		$keysDuEf[0]++;
		$keysDuEf1 = $keysDuEf[0];
		
		}
		

		$kFtitle = ($keysDuKf) ? "$defineUpload[$keysDuKf1]": "";
		$eFtitle = ($keysDuEf) ? "$defineUpload[$keysDuEf1]": "";
		
		// Checken ob Kommentar oder E-Mail Feld vorhanden sind --- ENDE
	
		
		

		echo "<br/>Name1: ";
		echo $name1uploadForm;
		echo "<br/>Name2: ";
		echo $name2uploadForm;
		echo "<br/>Name3: ";
		echo $name3uploadForm;
		echo "<br/>";*/
		

		
		
		
		// Determine name fields names of upload Form --- END
			
			// Determine if User should be informed or not
	
		//	$disabledInform = ($Inform==0) ? 'disabled' : '';
			
			// Determine if User should be informed or not END
	

			/* creates a compressed zip file */
function create_zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}

//echo $rows;

			// rausfinden wie viel Mega-/Kilobyte hochgeladen werden können und es anzeigen lassen

				
			/*	function return_bytes1($val) {
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

			$maxsize = return_bytes1(ini_get('post_max_size'));

			function formatBytes1($bytes, $precision = 2) { 
				$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

				$bytes = max($bytes, 0); 
				$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
				$pow = min($pow, count($units) - 1); 

				$bytes /= pow(1024, $pow); 

				return round($bytes, $precision) . ' ' . $units[$pow]; 
			}

			$maxsizeConverted = formatBytes1($maxsize,2);
			
			
			
			echo formatBytes1(memory_get_peak_usage(),2);
			
			echo "<br/>";
			
			echo formatBytes1(memory_get_usage(),2);
			echo "<br/>";

			

			
			echo "<br/>";*/

			// rausfinden wie viel Mega-/Kilobyte hochgeladen werden können und es anzeigen lassen ---- ENDE
	
	// Maximal möglich eingestellter Upload wird ermittelt
	$max_post = (int)(ini_get('post_max_size'));
	
	

	
	
?>