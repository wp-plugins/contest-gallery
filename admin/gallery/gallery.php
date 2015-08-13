<?php require_once("get-data.php");

/*
echo "<br>";
echo $uploadFolder['baseurl'];/*

		/*$cachefiles = dirname(__FILE__).'/../../../../uploads/contest-gal1ery/gallery-id-'.$GalleryID.'/cache/look-thumb-0-80.html';
		$cachefiles1 = dirname(__FILE__).'/../../../../uploads/contest-gal1ery/gallery-id-'.$GalleryID.'/cache/*';
		
		if(file_exists($cachefiles )){echo "EXISTS";}
		else{echo "not exists";}*/


require_once(dirname(__FILE__) . "/../nav-gallery.php");
require_once("header-1.php");
require_once("header-2.php");


//$bloginfo = bloginfo("language");
		

	// Bestimmen ob ABSTEIGEND oder AUFSTEIGEND
	

		
	
// -------------------------------Ausgabe der eingetragenen Felder. Hauptdiv id=sortable. Sortierbare Felder div id=sortableDiv				
		

		echo "<form action='?page=contest-gal1ery/index.php&option_id=$GalleryID&step=$step&start=$start&edit_gallery=true' method='POST'>";	
		echo '<input type="hidden" name="option_id" value="'. $GalleryID .'">';
		//echo "<div id='sortable' style='width:935px;border: 1px solid #DFDFDF;background-color:#fff;padding-bottom:50px;padding-left:20px;padding-right:20px;padding-top:20px;'>";
		
		echo "<ul id='sortable' style='width:895px;padding:20px;background-color:#fff;margin-bottom:0px !important;margin-bottom:0px;border: 1px solid #DFDFDF;>";
		
		// Bei der ersten Abarbeitung notwendig
		echo "<li style='width:891px;border: 1px solid #DFDFDF;padding-top:10px;padding-bottom:10px;display:table;' id='div$id' class='sortableDiv'>";
// Wird gebraucht um die höchste RowID am Anfang zu ermitln
	    $r = 0;	
		
	
		foreach($selectSQL as $value){
		
			$selectedCheck = "".$value->Active."";

				if ($selectedCheck == 1){
				$checked = "checked";
				}
				else {
				$checked = "";
				}

		$id = $value->id;
		$rowid = $value->rowid;
		$CountC = $value->CountC;
		
		
		// Die höchste RowID wird gebraucht und später von JavaScript verarbeitet
				/*$r++;
		
				if ($r==1) {
				
				echo '<input type="hidden" id="highestRowId" value="'. $rowid .'">';
				
				}*/
		// Die höchste RowID wird gebraucht und später von JavaScript verarbeitet --- END
		
		
		echo "<br/>";
		
		echo "<li style='width:891px;border: 1px solid #DFDFDF;padding-top:10px;padding-bottom:10px;display:table;' id='div$id' class='sortableDiv'>";
		
		
		
		
		echo "<br/>";
		
		// hidden inputs zur bestimmung der Reihenfolge
		echo "<input type='hidden' name='row[$id]'  class='rowId' value='$rowid'>"; // Zur Feststellung der Reihenfolge, wird vom Javascript verarbeitet
		echo "<input type='hidden' name='count[]' value=\"$id\">";
		echo "<input type='hidden' name='changeGalery' value='changeGalery'>";
		// hidden inputs zur bestimmung der Reihenfolge ENDE
		
		
		
		// ------ Bild wird mittig und passend zum Div angezeigt	
		
						
					// destination of the uploaded original image
					
					$uploadFolder = wp_upload_dir();
					
					// Feststellen der Quelle des Original Images		
					$sourceOriginalImg = $uploadFolder['basedir'].'/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'.'.$value->ImgType; // Pfad zum Bilderordner angeben
					$sourceOriginalImgShow = $uploadFolder['baseurl'].'/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'.'.$value->ImgType; // Pfad zum Bilderordner angeben
					list($widthOriginalImg, $heightOriginalImg) = getimagesize($sourceOriginalImg); // Breite und Höhe von original Image
					
					$WidthThumb = 125;
					$HeightThumb = 81;
				
					
					// Ermittlung der Höhe nach Skalierung. Falls unter der eingestellten Höhe, dann nächstgrößeres Bild nehmen.
					$heightScaledThumb = $WidthThumb*$heightOriginalImg/$widthOriginalImg;
					
					
					// Falls unter der eingestellten Höhe, dann größeres Bild nehmen (normales Bild oder panorama Bild, kein Vertikalbild)
					
					if ($heightScaledThumb <= $HeightThumb) {
					
					$widthScaledThumb = $HeightThumb*$widthOriginalImg/$heightOriginalImg;
					
					$imageThumb = $NamePic."-300width.".$ImgType;		


					// Bestimmung von Breite des Bildes
					$WidthThumbPic = $HeightThumb*$widthOriginalImg/$heightOriginalImg;
					$WidthThumbPic = $WidthThumbPic.'px';
					
					// Bestimmung wie viel links und rechts abgeschnitten werden soll
					$paddingLeftRight = ($WidthThumbPic-$WidthThumb)/2;
					$paddingLeftRight = $paddingLeftRight.'px';
					
					$padding = "left: -$paddingLeftRight;right: -$paddingLeftRight";
					
					}
					
					
					// Falls über der eingestellten Höhe, dann kleineres Bild nehmen (kein Vertikalbild)
					if ($heightScaledThumb > $HeightThumb) {
					
					$imageThumb = $NamePic."-300width.".$ImgType;		
				
					// Bestimmung von Breite des Bildes
					$WidthThumbPic = $WidthThumb.'px';
					
					// Bestimmung wie viel oben und unten abgeschnitten werden soll
					$heightImageThumb = $WidthThumb*$heightOriginalImg/$widthOriginalImg;
					$paddingTopBottom = ($heightImageThumb-$HeightThumb)/2;
					$paddingTopBottom = $paddingTopBottom.'px';
					
					$padding = "top: -$paddingTopBottom;bottom: -$paddingTopBottom";
					
					}

		// Bild wird mittig und passend zum Div angezeigt	--------  ENDE
		
		
		
		// ----------- Ermitteln der Sprache des Blogs, um das Upload Datum in richtiger schreibweise anzuzeigen
	
		$uploadTime = date('m/d/Y h:i a', $value->Timestamp);
			

		// Ermitteln der Sprache des Blogs, um das Upload Datum in richtiger schreibweise anzuzeigen  ------------  ENDE
		
		
		
		
		
		echo "<div style='float:left;width:125px;margin-left:20px;'>";
		echo '<div style="width:125px;height:81px;overflow: hidden !important;position: relative;float:left;display:inline;margin-left:1px;">';
		echo '<a href="'.$sourceOriginalImgShow.'" target="_blank" title="Show full size" alt="Show full size"><img src="'.$content_url.'/uploads/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-300width.'.$value->ImgType.'" style="'.$padding.';position: absolute !important;max-width:none !important;" width="'.$WidthThumbPic.'"></a>';
		echo "</div>";
		echo '<div style="width:125px;text-align:center;font-size:11px;float:left;margin-right:20px;"><input type="text" disabled name="upload-date" value=" '.$uploadTime .'" style="width:125px;text-align:center;font-size:11px;float:left;margin-right:20px;" ></div>';
		echo "</div>";
		
		echo "<div style='float:left;margin-left:20px;width:470px !important;'>";
		
		//print_r($selectUpload);
		
		// FELDBENENNUNGEN

		// 1 = Feldtyp
		// 2 = Feldnummer
		// 3 = Feldtitel
		// 4 = Feldinhalt
		// 5 = Feldkrieterium1
		// 6 = Feldkrieterium2
		// 7 = Felderfordernis
		
		$r = 0; // Notwendig zur Überprüfung ab wann das dritte Feld versteckt wird. ACHTUNG: Bild-Uploadfeld immer dabei, dasswegen r>=4 zum Schluss.
		
		//print_r($selectContentFieldArray);
		
		if ($selectFormInput == true) {
		

			
					foreach($selectContentFieldArray as $key => $formvalue){
					
							
							// 1. Feld Typ
							// 2. ID des Feldes in F_INPUT
							// 3. Feld Reihenfolge
							// 4. Feld Content
							
							
													
							if($formvalue=='text-f'){$fieldtype="nf"; $i=1; continue;}	
							if($fieldtype=="nf" AND $i==1){$formFieldId=$formvalue; $i=2; continue;}	
							if($fieldtype=="nf" AND $i==2){$fieldOrder=$formvalue; $i=3; continue;}	
							if ($fieldtype=="nf" AND $i==3) {
							
							//$getEntries = $wpdb->get_var( "SELECT Short_Text FROM $tablenameentries WHERE pid='$id' AND f_input_id = '$formFieldId'");
							
							$getEntries = $wpdb->get_var( $wpdb->prepare( 
							"
								SELECT Short_Text
								FROM $tablenameentries 
								WHERE pid = %d and f_input_id = %d
							", 
							$id,$formFieldId
							) );
							
							echo "<div>";
							echo "$formvalue:<br/>";
							echo "<input type='hidden' name='content[]' value='$id'>";
							echo "<input type='hidden' name='content[]' value='$formFieldId'>";
							echo "<input type='hidden' name='content[]' value='$fieldOrder'>";
							echo "<input type='hidden' name='content[]' value='text-f'>";
							echo "<input type='text' value='$getEntries' name='content[]'  style='width: 520px;' maxlength='100'>";
							echo "</div>";

							$fieldtype='';
							
							$i=0;
							
							}
							
							if($formvalue=='email-f'){$fieldtype="ef";  $i=1; continue;}	
							if($fieldtype=="ef" AND $i==1){$formFieldId=$formvalue; $i=2; continue;}	
							if($fieldtype=="ef" AND $i==2){$fieldOrder=$formvalue; $i=3; continue;}	
							if ($fieldtype=='ef' AND $i==3) {
							
							//$getEntries = $wpdb->get_var( "SELECT Short_Text FROM $tablenameentries WHERE pid='$id' AND f_input_id = '$formFieldId'");
							
							$getEntries = $wpdb->get_var( $wpdb->prepare( 
							"
								SELECT Short_Text
								FROM $tablenameentries 
								WHERE pid = %d and f_input_id = %d
							", 
							$id,$formFieldId
							) );
							
							echo "<div>";
							echo "$formvalue:<br/>";
							echo "<input type='hidden' name='content[]' value='$id'>";
							echo "<input type='hidden' name='content[]' value='$formFieldId'>";
							echo "<input type='hidden' name='content[]' value='$fieldOrder'>";
							echo "<input type='hidden' name='content[]' value='email-f'>";
							echo "<input type='text' value='$getEntries' name='content[]'  style='width: 520px;' class='email'  maxlength='100'>";
							echo "<input type='hidden' value='$getEntries' name='email[$id]'  style='width: 520px;' class='email-clone'  maxlength='100'>";
							echo "</div>";
							
							$fieldtype='';
							
							$i=0;
							
							}
							
							if($formvalue=='comment-f'){$fieldtype="kf"; $i=1; continue;}	
							if($fieldtype=="kf" AND $i==1){$formFieldId=$formvalue; $i=2; continue;}	
							if($fieldtype=="kf" AND $i==2){$fieldOrder=$formvalue; $i=3; continue;}	
							if ($fieldtype=='kf' AND $i==3) {
							
							//$getEntries = $wpdb->get_var( "SELECT Long_Text FROM $tablenameentries WHERE pid='$id' AND f_input_id = '$formFieldId'");
							
							$getEntries = $wpdb->get_var( $wpdb->prepare( 
							"
								SELECT Long_Text
								FROM $tablenameentries 
								WHERE pid = %d and f_input_id = %d
							", 
							$id,$formFieldId
							) );
							
							
							$getEntries1 = html_entity_decode(stripslashes($getEntries));
							
							echo "<div>";
							echo "$formvalue:<br/>";
							echo "<input type='hidden' name='content[]' value='$id'>";
							echo "<input type='hidden' name='content[]' value='$formFieldId'>";
							echo "<input type='hidden' name='content[]' value='$fieldOrder'>";
							echo "<input type='hidden' name='content[]' value='comment-f'>";
							echo "<textarea name='content[]' style='width: 520px;' rows='4'  maxlength='1000'>$getEntries1</textarea>";
							echo "</div>";
							
							$fieldtype='';
							
							$i=0;
								
							}

													
						}
					
				
					
					
					
				
		
			if ($r>=4) {
			echo "</div>"; //Bild-Uploadfeld immer dabei, dasswegen r>=4 zum Schluss.
			}
		
			else{
		
			echo "<p>&nbsp;</p>";
		
			}
			
			
		
		}
		
		else{
		
		echo "<p>&nbsp;</p>";
		
		}
		
		echo "</div>";
		echo "<div style='float:left;width:160px;margin-left:85px;'>";		
		echo "<div class='informdiv' style='margin-bottom:18px;'>";
		
		
		// Überprüfe ob schon aktiviert ist oder nicht
		
		$Active = $value->Active;
		
		if ($Active == 1) {echo 'Activate/Delete:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;  <input type="checkbox" class="deactivate_'. $id .'" value="'. $id .'" ' . $checked . '>';
		echo "<input type='hidden' name='active[$id]' value=\"$id\" class='image-delete' >";
		} // Beim Anklicken erscheinen Felder zum Deaktivieren
		else{echo 'Activate/Delete:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;  <input type="checkbox" class="1activate_'. $id .'" value="'. $id .'" ' . $checked . '>';
		echo "<input type='hidden' disabled name='active[$id]' value=\"$id\" class='image-delete' >";
		} // Beim Anklicken erscheinen Felder zum Aktivieren
		
		if($CountC>0){ echo "<br><br><a href=\"?page=contest-gal1ery/index.php&option_id=$GalleryID&show_comments=true&id=$id\">Comments</a>"; }
		else{ echo ""; }
		
		// Überprüfe ob schon aktiviert ist oder nicht --- ENDE
		
		// Check if user should be informed or is informed
		
		$Informed = $value->Informed;
		if($Informed==1){echo "<br><b>Informed</b><br>";}
		else{echo "<br><br><br><b></b>";}
		//echo "<br>Inform: $Inform<br>";
		
		//echo "<br>Activate: $Activate<br>";
		
		
		

		
		
	//echo "<br>Informed: $Informed<br>";
		//if($Informed==1){  echo "klappt";}
		
		if($Active==1){

				if ($Inform == 1) {
				
					//$Informed = $value->Informed;
					
					$InformedId = ($Informed==1) ? "<input type='hidden' disabled name='informId[]' value=\"$id\" class='image-delete' >" : "<input type='hidden' name='informId[]' value=\"$id\" class='image-delete' >";
					$resetInformedId = ($Informed==1) ? "<input type='hidden' name='resetInformId[]' value=\"$id\" class='image-delete' >" :  "";
					//$InformedVisual = ($Informed==1) ? "&nbsp;<b>I</b>" :  "";
					
					//if($Informed==1){  echo "klappt";}
					echo $InformedId;
					echo $resetInformedId;
				
				}		
		
			echo '<input type="hidden" name="imageUnlinkOrigin[]" value="/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" name="imageUnlink300[]" value="/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-300width.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" name="imageUnlink624[]" value="/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-624width.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" name="imageUnlink1024[]" value="/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-1024width.'.$value->ImgType.'" class="image-delete">';
			
		}
		
		if($Active!=1){ 
		
				if ($Inform == 1) {
				
					$Informed = $value->Informed;
					
					$InformedId = ($Informed==1) ? "<input type='hidden' disabled name='informId[]' value=\"$id\" class='image-delete' >" : "<input type='hidden' disabled name='informId[]' value=\"$id\" class='image-delete' >";
					$resetInformedId = ($Informed==1) ? "<input type='hidden' name='resetInformId[]' value=\"$id\" class='image-delete' >" :  "";
					$InformedVisual = ($Informed==1) ? "&nbsp;<b>I</b>" :  "";
					
					echo $InformedId;
					echo $resetInformedId;
					
			
				}	
		
		
			echo '<input type="hidden" disabled name="imageUnlinkOrigin[]" value="/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" disabled name="imageUnlink300[]" value="/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-300width.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" disabled name="imageUnlink624[]" value="/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-624width.'.$value->ImgType.'" class="image-delete">';
			echo '<input type="hidden" disabled name="imageUnlink1024[]" value="/contest-gal1ery/gallery-id-'.$GalleryID.'/'.$value->Timestamp.'_'.$value->NamePic.'-1024width.'.$value->ImgType.'" class="image-delete">';
		
		
		}
		
		
		
		echo "</div>";
		
		if($countC>0){  
		echo "<div >";
		echo '<a href="?page=contest-gal1ery/index.php&pictureID=' . $id . '">Comments</a><br/>';
		echo "</div>";
		}
		echo "</div>";
		echo "</li>";


		}
		
				echo "</ul>";
				
								echo "<div style='padding:20px;background-color:white;width:895px;text-align:right;margin-top:0px;border-bottom: 1px solid #DFDFDF;border-left: 1px solid #DFDFDF;border-right: 1px solid #DFDFDF;'>";
		
		echo "<select name='chooseAction1' id='chooseAction1'>";
		echo "<option value='1'>Activate data &nbsp;</option>";
		echo "<option value='2'>Delete data</option>";
		
		/*
		if($selectSQL){  
		echo "<option value='4'>Zip selected</option>";
		}*/
		
		if($checkInformed){  
		echo "<option value='3'>Reset informed</option>";
		}
		
		echo "</select>";
		
		echo '&nbsp;&nbsp; <input type="submit" name="submit" value="Save" id="cg_gallery_backend_submit" style="text-align:center;width:80px;">';

						
		echo "</div>";
				

				
		

		
				
	
		echo '</form>';
		
		if($_POST['chooseAction1'] == 4 and ($_POST['informId']==false and $_POST['resetInformId']==false)){
		
			?><script>alert("You have to select pics.");</script><?php
		
		}
		
				echo "<br/>";
				echo "<br/>";
				
				
				
				// Ausgabe der eingetragenen Felder. Hauptdiv id=sortable. Sortierbare Felder div id=sortableDiv ----- ENDE			
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

?>