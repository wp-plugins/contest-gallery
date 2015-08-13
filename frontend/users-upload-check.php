<?php 

	// Aurufen von WP-Config hier notwendig
	//require_once("../../../../wp-config.php");

//echo "testtest";



// User ID Überprüfung ob es die selbe ist
$CheckCheck = wp_create_nonce("check");

$check = intval($_POST['check']); 


if($CheckCheck==$check){


		$galeryID = intval($_POST['GalleryID']);

		$unixadd = time();

		if(!function_exists('return_bytes1')){
		function return_bytes1($val) {
			$val = trim($val);
			$last = strtolower($val{strlen($val)-1});
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
		}

		//echo "test1";


		$maxigroesse = return_bytes1(ini_get('upload_max_filesize'));

		$uploads = wp_upload_dir();
		$WPdestination = $uploads['basedir'].'/contest-gal1ery/gallery-id-'.$galeryID.'/';  //   Pfad zum Bilderordner angeben 
		//----------------------------Prove if user tries to reload ---------------->	

		global $wpdb;

		$tablename1 = $wpdb->prefix . "contest_gal1ery";

		/*
		//Reload prove and max id
		$reloadProve = $wpdb->get_results( "SELECT NamePic
		FROM   $tablename1
		WHERE  id=(SELECT MAX(id) FROM $tablename1)");


		foreach($reloadProve as $proveValue){
		$NamePic = $proveValue->NamePic;
		}

		$timestamp = explode("_",$NamePic);

		$timestampUser = $_POST['timestamp'];


		if(isset($_POST['submit'])){


		if($timestamp[0]==$_POST['timestamp']){
		$fehler = true;
		$fehlertext .= "<br/><strong>Dont reload your browser when upload!</strong><br/>";
		}*/

		// Überprüfen ob Formular oder Bild abgeschickt wurden

		if ($_FILES['data']['size'] > 0) {

		//echo "test212435454";

			$last = $wpdb->get_row("SHOW TABLE STATUS LIKE '$tablename1'");
					$nextID = $last->Auto_increment;


		//----------------------------Upload file and save in database ---------------->	

		/*
		if ((isset($_POST['submit']) && $_POST['submit']==true) AND $_FILES['date']['size'] <= 0) {
		echo "<strong>Sie haben kein Bild ausgew&auml;hlt zum Hochladen.</strong><br/><br/>";
		}*/

		if (isset($_FILES['data']) && $_FILES['data']['size'] > 0) {
		  $tempname = $_FILES['data']['tmp_name'];
		  $dateiname = $_FILES['data']['name'];
		  $dateiname = strtolower($dateiname);
		  $dateigroesse = $_FILES['data']['size'];
		  $dateityp = GetImageSize($tempname);
		//echo "<br>Dateiname: $dateiname<br>";
		  $search = array(" ", "!", '"', "#", "$", "%", "&", "'", "(", ")", "*", "+", ",", "/", ":", ";", "=", "?", "@", "[", "]");


		  
		$dateiname = str_replace($search,"_",$dateiname);

		   if(strlen($dateiname)>=100){
		  echo "The name of file you try to upload is to long.";
		  }
		  

		  elseif ($dateityp[2] == 1 || $dateityp[2] == 2 || $dateityp[2] == 3) { // GIF o. JPG?
			if ($dateigroesse <= 5242880) { // Datei zu groß?
			
		//----------------------------Upload file and save in database ---------------->	
		/*
		USE something like:  header('Location: ' . $_SERVER['REQUEST_URI']);
		WITH GET for thank you info to preventing from reloading
		after data was insterted
		Use REQUEST_URI. Do not use PHP_SELF as in most CMS systems and frameworks PHP_SELF would refer to /index.php.
		<br/><br/>

		Thank you for your understanding!*/




			  if (move_uploaded_file($tempname, $WPdestination . $unixadd . '_' . $dateiname)) {


		//----------------------------Create Thumbs and Galery pics ---------------->

		require_once(dirname(__FILE__) . "/../convert-several-pics.php");


		//----------------------------Create Thumbs and Galery pics END ----------------//

		  $dateiname = substr($dateiname,0,-4);

		//$wpdb->insert( $tablename1, array( 'id' => '', 'rowid' => "$nextID", 'Timestamp' => $unixadd, 'NamePic' => $dateiname, 'ImgType' => $imageType, 'CountC' => 0, 'CountR' => '', 'Rating' => '', 'GalleryID' => $galeryID, 'Active' => 0, 'Informed' => 0  ) );
		
		$wpdb->query( $wpdb->prepare(
		"
			INSERT INTO $tablename1
			( id, rowid, Timestamp, NamePic, ImgType, CountC, CountR, Rating, GalleryID, Active, Informed)
			VALUES ( %s,%d,%d,%s,%s,%d,%s,%s,%d,%d,%d )
		", 
			'',$nextID,$unixadd,$dateiname,$imageType,0,'','',$galeryID,0,0
		) );
		
		
		// Prove and insert send data

		$tablenameentries = $wpdb->prefix . "contest_gal1ery_entries";
		
		

		if ($_POST['form_input']){
			
		//	print_r($form_input);

		//$form_input = sanitize_text_field($_POST['form_input']);
		$form_input = $_POST['form_input'];

		//print_r($form_input);


		$i=0;


		// 1. Feldtyp <<< Zur Bestimmung der Feldart für weitere Verarbeitung in der Datenbank, Admin etc.
		// 2. Feldnummer <<<  Zur Bestimmung der Feldreihenfolge in Frontend und Admin.
		// 3. Feldreihenfolge
		// 4. Feldinhalt

			foreach ($form_input as $key => $value) {
			
			$i++;
			
				// Short_Text Entries werden eingefügt (Name, E-Mail)

				if ($i==1 AND ($ft!='kf')){$ft = $value; continue;}

				if ($i==2 AND ($ft=='nf' or $ft=='ef')){$f_input_id = $value; continue;}

				if ($i==3 AND ($ft=='nf' or $ft=='ef')){$field_order = $value;  continue;}

				if ($i==4 AND ($ft=='nf' or $ft=='ef')){
				
				//echo "<br>insert $ft<br>";
				//echo "<br>f_input_id $f_input_id<br>";
				//echo "<br>field_order $field_order<br>";

				$content = $value;
				$content = stripslashes($content);
				$content = sanitize_text_field($content);
				
				if($ft=='nf'){  
				//$wpdb->insert( $tablenameentries, array( 'id' => '', 'pid' => $nextID, 'f_input_id' => $f_input_id, 'GalleryID' => $galeryID, "Field_Type" => 'text-f', 'Field_Order' => $field_order, 'Short_Text' => $content, 'Long_Text' => '') );
				
				$wpdb->query( $wpdb->prepare(
				"
					INSERT INTO $tablenameentries
					( id, pid, f_input_id, GalleryID, Field_Type, Field_Order, Short_Text, Long_Text)
					VALUES ( %s,%d,%d,%d,%s,%d,%s,%s )
				", 
					'',$nextID,$f_input_id,$galeryID,'text-f',$field_order,$content,''
				) );
				
				}
				
				if($ft=='ef'){  
				//$wpdb->insert( $tablenameentries, array( 'id' => '', 'pid' => $nextID, 'f_input_id' => $f_input_id, 'GalleryID' => $galeryID, "Field_Type" => 'email-f', 'Field_Order' => $field_order, 'Short_Text' => $content, 'Long_Text' => '') );
				
				$wpdb->query( $wpdb->prepare(
				"
					INSERT INTO $tablenameentries
					( id, pid, f_input_id, GalleryID, Field_Type, Field_Order, Short_Text, Long_Text)
					VALUES ( %s,%d,%d,%d,%s,%d,%s,%s )
				", 
					'',$nextID,$f_input_id,$galeryID,'email-f',$field_order,$content,''
				) );
								
				}
				
				$ft=false;
				$f_input_id=false;
				$field_order=false;
				$i=0;
				continue;
				}

				// Short_Text Entries werden eingefügt ---- ENDE 
				
				// Long Entries werden eingefügt

				if ($i==1 AND ($ft!='nf' or $ft!='ef')){$ft = $value; continue;}

				if ($i==2 AND ($ft=='kf')){$f_input_id = $value; continue;}

				if ($i==3 AND ($ft=='kf')){$field_order = $value; continue;}

				if ($i==4 AND ($ft=='kf')){
				
				//echo "<br>insert $ft<br>";
				//echo "<br>f_input_id $f_input_id<br>";
				//echo "<br>field_order $field_order<br>";

				$content = $value;
				
				$content = stripslashes($content);				
				$content = nl2br(htmlspecialchars($content, ENT_QUOTES, 'UTF-8'));
				$content = sanitize_text_field($content);
				
				//echo "<br>content $content<br>";
				

				//$wpdb->insert( $tablenameentries, array( 'id' => '', 'pid' => $nextID, 'f_input_id' => $f_input_id, 'GalleryID' => $galeryID, "Field_Type" => 'comment-f', 'Field_Order' => $field_order, 'Short_Text' => '', 'Long_Text' => $content) );
				
				$wpdb->query( $wpdb->prepare(
				"
					INSERT INTO $tablenameentries
					( id, pid, f_input_id, GalleryID, Field_Type, Field_Order, Short_Text, Long_Text)
					VALUES ( %s,%d,%d,%d,%s,%d,%s,%s )
				", 
					'',$nextID,$f_input_id,$galeryID,'comment-f',$field_order,'',$content
				) );

				$ft=false;
				$f_input_id=false;
				$field_order=false;
				$i=0;
				continue;
				}
				
				// Long Entries werden eingefügt ---- ENDE


			}

		}


		// Prove and insert send data --- END		
		$contest_gal1ery_options_input = $wpdb->prefix . "contest_gal1ery_options_input";
		
		$inputOptionsSQL = $wpdb->get_row( "SELECT * FROM $contest_gal1ery_options_input WHERE id='$galeryID'"); // hier aufgehört. Die Gallery ID wird nicht übertragen, muss her geholt werden aus dem Jquery Post vorher oder aus dem Wordpress-PHP
		$Forward = $inputOptionsSQL->Forward;
		
		if($Forward==1){
		
			$Forward_URL = $inputOptionsSQL->Forward_URL;
			$Forward_URL = html_entity_decode(stripslashes($Forward_URL));
			
			$Forward_URLcheck = substr($Forward_URL, 0, 3);
			$Forward_URLcheck = strtolower($Forward_URLcheck);

			if($Forward_URLcheck=='www'){
			$Forward_URL = "http://".$Forward_URL; 	
			}
			
?>
<script>

var redirectURL = <?php echo json_encode($Forward_URL);?>;

// similar behavior as an HTTP redirect
window.location.replace(redirectURL);


</script>
<?php			
			require("forward-url.php");
		
			//exit;
			//echo $Forward_URL;
			
		
		
		}
		
		else{
			$Confirmation_Text = $inputOptionsSQL->Confirmation_Text;
			$Confirmation_Text = html_entity_decode(stripslashes($Confirmation_Text));
			
			echo $Confirmation_Text;
			
			}
		

			//	echo "<p>Your picture upload was successful.<br/>We will activate your picture soon.<br/>Your picture has to be proved.";

				exit();
				
			  } else {
				echo "<p>Upload was not successful!</p>";
			  } 
			} else {
			  echo "<p>The picture size is too big!</p>";
			} 
		  } else {
			echo "<p>Only jpg, png or gif files are allowed!</p>";
		  } 
		  echo "<br/>";
		} 

		} 

		//<<< END prove reload
	
	}
	
else{
	
	echo "Plz don't fiddle the upload.";	
	
	}


?>