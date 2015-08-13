<?php

// 1. Delete Felder in Entries, F_Input, F_Output
// 2. Swap Field_Order in Entries, F_Input, F_Output (bei post "done-upload" wird alles mitgegeben
// 3. Neue Felder hinzufügen in F_Input, Entries
// 4. // Auswahl zum Anzeigen gespeicherter Felder

// Empfangen von Galerie OptiOns ID 

$GalleryID = intval($_GET['option_id']);

global $wpdb;

// Tabellennamen bestimmen

$tablename = $wpdb->prefix . "contest_gal1ery";
$tablenameoptions = $wpdb->prefix . "contest_gal1ery_options";
$tablenameentries = $wpdb->prefix . "contest_gal1ery_entries";
$tablename_form_input = $wpdb->prefix . "contest_gal1ery_f_input";
$tablename_form_output = $wpdb->prefix . "contest_gal1ery_f_output";

// Check if certain fieldnumber should be deleted

//
// Vorgehen: Zuerst Feld löschen, noch for dem Swap. Im Swap nachprüfen ob das Feld zum löschen geschickt wurde, dann ist es gelöscht, dann muss man statt update insert machen.
//

// Löschen Ddaten in Tablename entries
// Löschen Ddaten in Tablename f_input
// Löschen Ddaten in Tablename f_output

if($_POST['deleteFieldnumber']){

$deleteFieldnumber = intval($_POST['deleteFieldnumber']);

// echo "<br>";
//print_r($deleteFieldnumber);
// echo "<br>";

		//$deleteQuery1 = "DELETE FROM $tablename_form_input WHERE GalleryID = '$GalleryID' AND id = '$deleteFieldnumber'";
		//$wpdb->query($deleteQuery1);
		
		//echo "<br>deleteQuery1: $deleteQuery1 <br>";
		
		$wpdb->query( $wpdb->prepare(
			"
				DELETE FROM $tablename_form_input WHERE GalleryID = %d AND id = %d
			", 
				$GalleryID, $deleteFieldnumber
		 ));

		//$deleteQuery2 = "DELETE FROM $tablename_form_output WHERE GalleryID = $GalleryID AND f_input_id = $deleteFieldnumber";
		//$wpdb->query($deleteQuery2);
		
		$wpdb->query( $wpdb->prepare(
			"
				DELETE FROM $tablename_form_output WHERE GalleryID = %d AND f_input_id = %d
			", 
				$GalleryID, $deleteFieldnumber
		 ));
		
		//echo "<br>deleteQuery2: $deleteQuery2 <br>";
		
		//$deleteQuery3 = "DELETE FROM $tablenameentries WHERE GalleryID = '$GalleryID' AND f_input_id = '$deleteFieldnumber'";
		//$wpdb->query($deleteQuery3);		
		
		//echo "<br>deleteQuery3: $deleteQuery3 <br>";
		
				$wpdb->query( $wpdb->prepare(
			"
				DELETE FROM $tablenameentries WHERE GalleryID = %d AND f_input_id = %d
			", 
				$GalleryID, $deleteFieldnumber
		 ));
		

	

}

// Check if certain fieldnumber should be deleted --- ENDE


// Update der aktuellen f_input_id id der aktuellen Define Output felder die genutzt werden. Gleich im nächsten Schrite, siehe unten, wird die actuaID durch neue ersetzt.

		$lastFormInput = $wpdb->get_row("SHOW TABLE STATUS LIKE '$tablename_form_input'"); // Get the new id of the gallery options which will be created
		$nextIDformInput = $lastFormInput->Auto_increment; // Get the new id of the gallery options which will be created

		$actualIDs = $_POST['actualID'];
		
		// echo "<br>";
		// print_r($actualIDs);
		// echo "<br>";

		foreach($actualIDs as $key => $IDvalue){
			
		//$changeIDformInput = $nextIDformInput+$key;
		if(is_numeric ($IDvalue)){
			
			$IDvalue = intval($IDvalue);
			//$querySET = "UPDATE $tablename_form_output  SET f_input_id = '$nextIDformInput' WHERE f_input_id = '$IDvalue' and GalleryID = '$GalleryID'";
			//$updateSQL = $wpdb->query($querySET);
			
				$wpdb->update( 
				"$tablename_form_output",
				array('f_input_id' => $nextIDformInput), 
				array('f_input_id' => $IDvalue,
				'GalleryID' => $GalleryID), 
				array('%d'),
				array('%d','%d')
				);
		}
		
		$nextIDformInput++;
		
		}		
		
		
// Update der aktuellen f_input_id id der aktuellen Define Output felder die genutzt werden. Gleich im nächsten Schrite, siehe unten, wird die actuaID durch neue ersetzt. --- ENDE





// Abspeichern von gesendeten Daten

if ($_POST['submit']) {

	// Alte Werte erstmal löschen
	
		//$deleteQuery = "DELETE FROM $tablename_form_input WHERE GalleryID = '$GalleryID'";
		//$deleteSQL = $wpdb->query($deleteQuery);	
		
		$wpdb->query( $wpdb->prepare(
			"
				DELETE FROM $tablename_form_input WHERE GalleryID = %d
			", 
				$GalleryID
		 ));
		
	// Alte Werte erstmal löschen --- ENDE

//echo "<br>GalleryID: $GalleryID<br>";

$i=0; // Orientierungsvariable für den Gesamtdurchgang
$a=0; // Orientierungsvariable für den Einzeltypdurchgang


// Alte Formularfelder werden überschrieben

//$oldFormFields = $_POST['done-upload'];

//print_r($oldFormFields);

//$selectIDsUserEntriesFieldOrder = array();

/*
	if($oldFormFields){ 

		foreach($oldFormFields as $key => $value){
		
			if ($value=='bh' or $actualStage=='bh'){
			
			
			
			$a++;
			
			// Feldtyp
			// Feldreihenfolge
			// FeldID
			// 1 = Feldtitel
			
				// Variable werden gesetzt
				if($a==1){ $actualStage = 'bh'; $i++;}

				// Unique FeldID wurde übergeben und wird oldFieldOrder benannt. Durch den Unique Wert kann das Feld leider gefunden werden und in Feld_Order wird newFieldOrder eingesetzt
				if($a==2){ $oldFieldOrder = intval(substr("$key",1)); $newFieldOrder=$value; }
				
				// 1. Feldtitel
				if($a==3){ $bhFieldsArray = array(); $bhFieldsArray['titel']=$value; $onlyTitel = $value;

				$bhFieldsArray = serialize($bhFieldsArray);
				
				//echo "<br>bh oldFieldOrder: $oldFieldOrder<br>";
				//echo "<br>bh newFieldOrder: $newFieldOrder<br>";
				
				// Überprüfen ob das Feld schon existiert
				$checkID = $wpdb->get_var("SELECT id FROM $tablename_form_output WHERE GalleryID = '$GalleryID' AND f_input_id = '$oldFieldOrder'");
				
					if($checkID){ 
						// Swap Field_Order in Form-Output-Tabelle..... wenn vorhanden!
						$querySET = "UPDATE $tablename_form_output  SET Field_Order = '$newFieldOrder', Field_Content = '$onlyTitel' WHERE GalleryID = '$GalleryID' AND f_input_id = '$oldFieldOrder' ";
						$updateSQL = $wpdb->query($querySET);
					}

				// Swap Field_Order in Form-Input-Tabelle mit dem neuen Field_Content serialized
				$querySET = "UPDATE $tablename_form_input  SET Field_Order = '$newFieldOrder', Field_Content = '$bhFieldsArray' WHERE id = '$oldFieldOrder' ";
				$updateSQL = $wpdb->query($querySET);		

				$actualStage = ''; $a = 0;
			
				}
				
			}	
		

			if ($value=='nf' or $actualStage=='nf'){
			
			$a++;
			
			// Feldtyp
			// Feldreihenfolge
			// FeldID
			// 1 = Feldtitel
			// 2 = Feldinhalt
			// 3 = Feldkrieterium1
			// 4 = Feldkrieterium2
			// 5 = Felderfordernis
			
				// Variable werden gesetzt
				if($a==1){ $actualStage = 'nf'; $i++; }
				
				// Unique FeldID wurde übergeben und wird oldFieldOrder benannt. Durch den Unique Wert kann das Feld leider gefunden werden und in Feld_Order wird newFieldOrder eingesetzt
				if($a==2){ $oldFieldOrder = intval(substr("$key",1)); $newFieldOrder=intval($value); }		
				
				// 1. Feldtitel
				if($a==3){ $nfFieldsArray = array(); $nfFieldsArray['titel']=$value; $onlyTitel = $value; }
				// 2. Feldinhalt
				if($a==4){ $nfFieldsArray['content']=$value; }
				// 3. Feldkriterium 1
				if($a==5){ $nfFieldsArray['min-char']=$value; }
				// 4. Feldkriterium 2
				if($a==6){ $nfFieldsArray['max-char']=$value; }
				// 5. Felderfordernis + Eingabe in die Datenbank
				if($a==7){ $nfFieldsArray['mandatory']=$value;

				$nfFieldsArray = serialize($nfFieldsArray);
				
				//echo "<br>nf oldFieldOrder: $oldFieldOrder<br>";
				//echo "<br>nf newFieldOrder: $newFieldOrder<br>";
				
				// Überprüfen ob das Feld schon existiert
				$checkID = $wpdb->get_var("SELECT id FROM $tablename_form_output WHERE GalleryID = '$GalleryID' AND f_input_id = '$oldFieldOrder'");
				
					if($checkID){ 
						// Swap Field_Order in Form-Output-Tabelle..... wenn vorhanden!
						$querySET = "UPDATE $tablename_form_output  SET Field_Order = '$newFieldOrder', Field_Content = '$onlyTitel' WHERE GalleryID = '$GalleryID' AND f_input_id = '$oldFieldOrder' ";
						$updateSQL = $wpdb->query($querySET);
					}

				// Swap Field_Order in Form-Input-Tabelle mit dem neuen Field_Content serialized
				$querySET = "UPDATE $tablename_form_input SET Field_Order = '$newFieldOrder', Field_Content = '$nfFieldsArray' WHERE id = '$oldFieldOrder' ";
				$updateSQL = $wpdb->query($querySET);

				// Swap Field_Order in User-Entries-Tabelle mit dem neuen Field_Content nur Titel für Output Form. Erstmal werden alle IDs mit einer bestimmten Field_Order gesammelt
				$selectIDsUserEntriesFieldOrder[$newFieldOrder] = $wpdb->get_results("SELECT id FROM $tablenameentries WHERE GalleryID = '$GalleryID' AND f_input_id = '$oldFieldOrder'");
				//print_r($selectIDsUserEntriesFieldOrder);
			
					
				$actualStage = ''; $a = 0;	
				
				

				}
			}
			
			
			if ($value=='ef' or $actualStage=='ef'){
			
			$a++;
			
			
			
			// Feldtyp
			// Feldreihenfolge
			// FeldID
			// 1 = Feldtitel
			// 2 = Feldinhalt
			// 3 = Felderfordernis
			
				// Variable werden gesetzt
				if($a==1){ $actualStage = 'ef'; $i++; }
				
				// Unique FeldID wurde übergeben und wird oldFieldOrder benannt. Durch den Unique Wert kann das Feld leider gefunden werden und in Feld_Order wird newFieldOrder eingesetzt
				if($a==2){ $oldFieldOrder = intval(substr("$key",1)); $newFieldOrder=$value; }
				
				// 1. Feldtitel
				if($a==3){ $efFieldsArray = array(); $efFieldsArray['titel']=$value; $onlyTitel = $value; }
				// 2. Feldinhalt
				if($a==4){ $efFieldsArray['content']=$value; }
				// 3. Felderfordernis + Eingabe in die Datenbank
				if($a==5){ $efFieldsArray['mandatory']=$value;
				
				$efFieldsArray = serialize($efFieldsArray);
				
								//echo "<br>ef oldFieldOrder: $oldFieldOrder<br>";
				//echo "<br>ef newFieldOrder: $newFieldOrder<br>";
				
				// Überprüfen ob das Feld schon existiert
				$checkID = $wpdb->get_var("SELECT id FROM $tablename_form_output WHERE GalleryID = '$GalleryID' AND f_input_id = '$oldFieldOrder'");
				
					if($checkID){ 
						// Swap Field_Order in Form-Output-Tabelle..... wenn vorhanden!
						$querySET = "UPDATE $tablename_form_output  SET Field_Order = '$newFieldOrder', Field_Content = '$onlyTitel' WHERE GalleryID = '$GalleryID' AND f_input_id = '$oldFieldOrder' ";
						$updateSQL = $wpdb->query($querySET);

					}

				// Swap Field_Order in Form-Input-Tabelle mit dem neuen Field_Content serialized
				$querySET = "UPDATE $tablename_form_input  SET Field_Order = '$newFieldOrder', Field_Content = '$efFieldsArray' WHERE id = '$oldFieldOrder' ";
				$updateSQL = $wpdb->query($querySET);
				
				// Swap Field_Order in User-Entries-Tabelle mit dem neuen Field_Content nur Titel für Output Form. Erstmal werden alle IDs mit einer bestimmten Field_Order gesammelt
				$selectIDsUserEntriesFieldOrder[$newFieldOrder] = $wpdb->get_results("SELECT id FROM $tablenameentries WHERE GalleryID = '$GalleryID' AND f_input_id = '$oldFieldOrder'");
				//print_r($selectIDsUserEntriesFieldOrder);

				
				$actualStage = ''; $a = 0;
					
				}
			
			}

			if ($value=='kf' or $actualStage=='kf'){
			
			
			
			$a++;
			
			// Feldtyp
			// Feldreihenfolge
			// FeldID		
			// 1 = Feldtitel
			// 2 = Feldinhalt
			// 3 = Feldkrieterium1
			// 4 = Feldkrieterium2
			// 5 = Felderfordernis
			
				// Variable werden gesetzt
				if($a==1){ $actualStage = 'kf'; $i++; }
				
				// Unique FeldID wurde übergeben und wird oldFieldOrder benannt. Durch den Unique Wert kann das Feld leider gefunden werden und in Feld_Order wird newFieldOrder eingesetzt
				if($a==2){ $oldFieldOrder = intval(substr("$key",1)); $newFieldOrder=$value; }
				
				// 1. Feldtitel
				if($a==3){ $kfFieldsArray = array(); $kfFieldsArray['titel']=$value; $onlyTitel = $value;}
				// 2. Feldinhalt
				if($a==4){ $kfFieldsArray['content']=$value; }
				// 3. Feldkriterium 1
				if($a==5){ $kfFieldsArray['min-char']=$value; }
				// 4. Feldkriterium 2
				if($a==6){ $kfFieldsArray['max-char']=$value; }
				// 5. Felderfordernis + Eingabe in die Datenbank
				if($a==7){ $kfFieldsArray['mandatory']=$value;

				$kfFieldsArray = serialize($kfFieldsArray);
				
							//	echo "<br>kf oldFieldOrder: $oldFieldOrder<br>";
				//echo "<br>kf newFieldOrder: $newFieldOrder<br>";
				
				// Überprüfen ob das Feld schon existiert
				$checkID = $wpdb->get_var("SELECT id FROM $tablename_form_output WHERE GalleryID = '$GalleryID' AND f_input_id = '$oldFieldOrder'");
				
					if($checkID){ 
						// Swap Field_Order in Form-Output-Tabelle..... wenn vorhanden!
						$querySET = "UPDATE $tablename_form_output  SET Field_Order = '$newFieldOrder', Field_Content = '$onlyTitel' WHERE GalleryID = '$GalleryID' AND f_input_id = '$oldFieldOrder' ";
						$updateSQL = $wpdb->query($querySET);

					}

				// Swap Field_Order in Form-Input-Tabelle mit dem neuen Field_Content serialized
				$querySET = "UPDATE $tablename_form_input  SET Field_Order = '$newFieldOrder', Field_Content = '$kfFieldsArray' WHERE id = '$oldFieldOrder' ";
				$updateSQL = $wpdb->query($querySET);
				
				// Swap Field_Order in User-Entries-Tabelle mit dem neuen Field_Content nur Titel für Output Form. Erstmal werden alle IDs mit einer bestimmten Field_Order gesammelt
				$selectIDsUserEntriesFieldOrder[$newFieldOrder] = $wpdb->get_results("SELECT id FROM $tablenameentries WHERE GalleryID = '$GalleryID' AND f_input_id = '$oldFieldOrder'");
				//print_r($selectIDsUserEntriesFieldOrder);

				
				$actualStage = ''; $a = 0;
		
				}
			}		
		}
		
	}*/
	


	// Field_Order der User Entries wird geändert
/*		// Array dieser Art wird verarbeitet 1 >>>>4,3,5,7,7 ; 2>>>>9,8,10,11 etc. Alle IDs wurden vorher hier gespeichert $selectIDsUserEntriesFieldOrder[$newFieldOrder]. $Key bestimmt die Reihenfolge 
	if($selectIDsUserEntriesFieldOrder){
	
	//echo "<br> selectIDsUserEntriesFieldOrder vorhanden<br>";
	
	//print_r($selectIDsUserEntriesFieldOrder);
	
		foreach($selectIDsUserEntriesFieldOrder as $key => $sumOfIDsOfField){
		
		//	echo "<br> Verarbeitung läuft erste Stufe<br>";
		
			// Neue Reihenfolge wird gesetzt für den ersten ID Strang
			$querySET = "UPDATE $tablenameentries SET Field_Order='$key' WHERE";
			
			//print_r($sumOfIDsOfField);
		
					foreach($sumOfIDsOfField as $entrieID){
					
					$entrieID = $entrieID->id;
					
							//	echo "<br>Zweite Stufe IDs: $entrieID<br>";
					
							$querySET .= " id = '$entrieID'";
							$querySET .= " or";
		
					}
					
			$querySET = substr($querySET,0,-3);
			$updateSQL = $wpdb->query($querySET);
		
		}

	}*/
	
	// Field_Order der User Entries wird geändert --- ENDE

	
	
// Alte Formularfelder werden überschrieben ---- ENDE





// Neue Formularfelder werden eingefügt

$newFormFields = $_POST['upload'];

//print_r($newFormFields);

$order=1;



	if($newFormFields){  

		foreach($newFormFields as $key => $value){
		
			/*if ($value=='bh' or $actualStage=='bh'){
			
			$a++;
			
			// Feldtyp
			// Feldreihenfolge
			// FeldID	
			// 1 = Feldtitel
			
				// Variable werden gesetzt
				if($a==1){ $actualStage = 'bh'; $i++; }	

				// FeldID wird ermittelt
				if($a==2){ $id=$value; }	
				
				// 1. Feldtitel
				if($a==3){ $bhFieldsArray = array(); $bhFieldsArray['titel']=$value; 

				$bhFieldsArray = serialize($bhFieldsArray);
				
					$wpdb->insert( $tablename_form_input, array( 'id' => '', 'GalleryID' => $GalleryID, 'Field_Type' => 'image-f', "Field_Order" => $i, "Field_Content" => $bhFieldsArray ) ); 
					$a=0; $actualStage = ' ';			
					
				}
			}	*/
			

			
			
			
			if ($value=='bh' or $actualStage=='bh'){
			
			$a++;
			
			// Feldtyp
			// 1 = Feldtitel
			
		
				// Variable werden gesetzt
				if($a==1){ $actualStage = 'bh'; $i++; }
				
				// 1. Feldtitel
				if($a==2){ $bhFieldsArray = array(); $bhFieldsArray['titel']= sanitize_text_field($value); 
			
					$bhFieldsArray = serialize($bhFieldsArray);
				
					//$wpdb->insert( $tablename_form_input, array( 'id' => '', 'GalleryID' => $GalleryID, 'Field_Type' => 'image-f', "Field_Order" => $order, "Field_Content" => $bhFieldsArray ) ); 
					$a=0;$actualStage = ' ';$order++;

					$wpdb->query( $wpdb->prepare(
					"
						INSERT INTO $tablename_form_input
						( id, GalleryID, Field_Type, Field_Order, Field_Content)
						VALUES ( %s,%d,%s,%d,%s )
					", 
						'',$GalleryID,'image-f',$order,$bhFieldsArray
				 ) );
				
				}
			}
			
			
			
			
			
			if ($value=='cb' or $actualStage=='cb'){
			
			$a++;
			
			// Feldtyp
			// 1 = Feldname
			// 2 = Feldinhalt
			// 3 = Felderfordernis
			
		
				// Variable werden gesetzt
				if($a==1){ $actualStage = 'cb'; $i++; }
				
				// 2. Feldinhalt
				if($a==2){ $cbFieldsArray = array();  $cbFieldsArray['titel']=sanitize_text_field($value); }
				
				// 2. Feldinhalt
				if($a==3){ $cbFieldsArray['content'] = sanitize_text_field(htmlentities($value, ENT_QUOTES, 'UTF-8'));}

				// 3. Felderfordernis + Eingabe in die Datenbank
				if($a==4){ $cbFieldsArray['mandatory']=sanitize_text_field($value);

				$cbFieldsArray = serialize($cbFieldsArray);
				
					//$wpdb->insert( $tablename_form_input, array( 'id' => '', 'GalleryID' => $GalleryID, 'Field_Type' => 'check-f', "Field_Order" => $order, "Field_Content" => $cbFieldsArray ) ); 
					$a=0;$actualStage = ' ';$order++;
					
					$wpdb->query( $wpdb->prepare(
					"
						INSERT INTO $tablename_form_input
						( id, GalleryID, Field_Type, Field_Order, Field_Content)
						VALUES ( %s,%d,%s,%d,%s )
					", 
						'',$GalleryID,'check-f',$order,$cbFieldsArray
				 ) );
					
				}
			}
			
			
		

			if ($value=='nf' or $actualStage=='nf'){
			
			$a++;
			
			// Feldtyp
			// Feldreihenfolge
			// 1 = Feldtitel
			// 2 = Feldinhalt
			// 3 = Feldkrieterium1
			// 4 = Feldkrieterium2
			// 5 = Felderfordernis
			
				// Variable werden gesetzt
				if($a==1){ $actualStage = 'nf'; $i++; }
				
				// 1. Feldtitel
				if($a==2){ $nfFieldsArray = array(); $nfFieldsArray['titel']=sanitize_text_field($value); }
				// 2. Feldinhalt
				if($a==3){ $nfFieldsArray['content']=sanitize_text_field($value); }
				// 3. Feldkriterium 1
				if($a==4){ $nfFieldsArray['min-char']=intval($value); }
				// 4. Feldkriterium 2
				if($a==5){ $nfFieldsArray['max-char']=intval($value); }
				// 5. Felderfordernis + Eingabe in die Datenbank
				if($a==6){ $nfFieldsArray['mandatory']=sanitize_text_field($value);

				$nfFieldsArray = serialize($nfFieldsArray);
				
					//$wpdb->insert( $tablename_form_input, array( 'id' => '', 'GalleryID' => $GalleryID, 'Field_Type' => 'text-f', "Field_Order" => $order, "Field_Content" => $nfFieldsArray ) ); 
					$a=0;$actualStage = ' ';$order++;
					
					$wpdb->query( $wpdb->prepare(
					"
						INSERT INTO $tablename_form_input
						( id, GalleryID, Field_Type, Field_Order, Field_Content)
						VALUES ( %s,%d,%s,%d,%s )
					", 
						'',$GalleryID,'text-f',$order,$nfFieldsArray
				 ) );
					
				}
			}
			
			
			if ($value=='ef' or $actualStage=='ef'){
			
			//echo "EF SCHLEIFE LÖÄUFT";
			
			$a++;
			
			// Feldtyp
			// Feldreihenfolge
			// 1 = Feldtitel
			// 2 = Feldinhalt
			// 3 = Felderfordernis
			
				// Variable werden gesetzt
				if($a==1){ $actualStage = 'ef'; $i++; }
				
				// 1. Feldtitel
				if($a==2){ $efFieldsArray = array(); $efFieldsArray['titel']=sanitize_text_field($value); }
				// 2. Feldinhalt
				if($a==3){ $efFieldsArray['content']=sanitize_text_field($value); }
				// 3. Felderfordernis + Eingabe in die Datenbank
				if($a==4){ $efFieldsArray['mandatory']=sanitize_text_field($value);
				
				$efFieldsArray = serialize($efFieldsArray);
				
					//$wpdb->insert( $tablename_form_input, array( 'id' => '', 'GalleryID' => $GalleryID, 'Field_Type' => 'email-f', "Field_Order" => $order, "Field_Content" => $efFieldsArray ) ); 
					$a=0; $actualStage = ' ';$order++;
					
					$wpdb->query( $wpdb->prepare(
					"
						INSERT INTO $tablename_form_input
						( id, GalleryID, Field_Type, Field_Order, Field_Content)
						VALUES ( %s,%d,%s,%d,%s )
					", 
						'',$GalleryID,'email-f',$order,$efFieldsArray
				 ) );

				
				}
			
			}

			if ($value=='kf' or $actualStage=='kf'){
			
			$a++;
			
			// Feldtyp
			// Feldreihenfolge
			// 1 = Feldtitel
			// 2 = Feldinhalt
			// 3 = Feldkrieterium1
			// 4 = Feldkrieterium2
			// 5 = Felderfordernis
			
				// Variable werden gesetzt
				if($a==1){ $actualStage = 'kf'; $i++; }
				
				// 1. Feldtitel
				if($a==2){ $kfFieldsArray = array(); $kfFieldsArray['titel']=sanitize_text_field($value); }
				// 2. Feldinhalt
				if($a==3){ $kfFieldsArray['content'] = sanitize_text_field($value);}
				// 3. Feldkriterium 1
				if($a==4){ $kfFieldsArray['min-char']=intval($value); }
				// 4. Feldkriterium 2
				if($a==5){ $kfFieldsArray['max-char']=intval($value); }
				// 5. Felderfordernis + Eingabe in die Datenbank
				if($a==6){ $kfFieldsArray['mandatory']=sanitize_text_field($value);

				$kfFieldsArray = serialize($kfFieldsArray);
				
					//$wpdb->insert( $tablename_form_input, array( 'id' => '', 'GalleryID' => $GalleryID, 'Field_Type' => 'comment-f', "Field_Order" => $order, "Field_Content" => $kfFieldsArray ) ); 
					$a=0;$actualStage = ' ';$order++;
					
					$wpdb->query( $wpdb->prepare(
					"
						INSERT INTO $tablename_form_input
						( id, GalleryID, Field_Type, Field_Order, Field_Content)
						VALUES ( %s,%d,%s,%d,%s )
					", 
						'',$GalleryID,'comment-f',$order,$kfFieldsArray
				 ) );
					
				}
			}		
		}
		
	}
	
// Neue Formularfelder werden eingefügt ---- ENDE
	

} 

// Auswahl zum Anzeigen gespeicherter Felder
$selectFormInput = $wpdb->get_results("SELECT * FROM $tablename_form_input WHERE GalleryID = $GalleryID ORDER BY Field_Order ASC");


	



	
	/*	// Swap Field_Order values of users in database if necessary
		
		if($_POST['changeFieldRow']){
		
		$changeFieldRow = $_POST['changeFieldRow'];
		
		//print_r($changeFieldRow);
		
		
		// FELDBENENNUNGEN
		// 1 = Neuer Wert in der Datenbank
		// 2 = Alter Wert in der Datenbank
		
		$i = 2;
		
		$proveValue = array();
		
		
		
			foreach($changeFieldRow as $key => $value){
			
				if ($i == 0) {$i = 1;}
						
				if ($i==1) {
				
					$key = $oldFieldOrder;			
					$value = $newFieldOrder; 
					
					// Swap Field_Order in User-Entries-Tabelle
					$querySET = "UPDATE $tablenameentries  SET Field_Order = '$newRowKey' WHERE GalleryID = '$GalleryID' AND Field_Order = '$oldFieldOrder' ";
					$updateSQL = $wpdb->query($querySET);
					
					// Swap Field_Order in Form-Input-Tabelle
					$querySET = "UPDATE $tablename_form_input  SET Field_Order = '$newRowKey' WHERE GalleryID = '$GalleryID' AND Field_Order = '$oldFieldOrder' ";
					$updateSQL = $wpdb->query($querySET);
					
					// Swap Field_Order in Form-Output-Tabelle..... wenn vorhanden! Überprüfung auf Existenz nicht notwendig.
					$querySET = "UPDATE $tablename_form_output  SET Field_Order = '$newRowKey' WHERE GalleryID = '$GalleryID' AND Field_Order = '$oldFieldOrder' ";
					$updateSQL = $wpdb->query($querySET);

				
				}
				
				
				
				
				
				if ($i==1) {$originKey = $value; // Alter Wert in der Datenbank
				
				//echo "<br/>rowKey: $rowKey<br/>";
				//echo "<br/>originKey: $originKey<br/>";
				
					if ($originKey != $rowKey) {	
						
						// Addition zu Wiedererkennung. Wird zwischengespeichert zur Differenzierng.
						$newRowKey = $rowKey+10;
						
						// Überprüfng ob eines der urpsrünglichen Werte zwischengespeichert wurden, aufgrund Erkennungsnotwendigkeit 
						$newOriginKey = $originKey+10;
						
						//echo "<br/>";
						//print_r($proveValue);
						//echo "<br/>";
						//echo "<br/>NeworiginKey: $newOriginKey<br/>";
						//echo "<br/>NeworiginKey: $newRowKey<br/>";
						
						
					
							if (array_search($newOriginKey, $proveValue)===false) {		
							
							// Zwischenspeicherung zur Differenzierung, wenn die Position nicht vorher gelöscht wurde
							if ($deleteFieldnumber != $rowKey) {							
							$querySET = "UPDATE $tablenameentries  SET Field_Order = '$newRowKey' WHERE GalleryID = '$GalleryID' AND Field_Order = '$rowKey' ";
							$updateSQL = $wpdb->query($querySET);
							}
							
							//echo "<br/>Zwischenspeicherung!<br/>";
							
							//echo "<br/>Originkey: <b>$originKey</b><br/>";
							//echo "<br/>rowKey: <b>$rowKey</b><br/>";
													
							// Neuen Wert ändern in Alten (Wert der Reihenfolge)				
							$querySET = "UPDATE $tablenameentries  SET Field_Order = '$rowKey' WHERE GalleryID = '$GalleryID' AND Field_Order = '$originKey' ";
							$updateSQL = $wpdb->query($querySET);
							
							// Speicherung des neuen Zwischenwertes in ein Array. Wenn die Position nicht vorher gelöscht wurde.
							if ($deleteFieldnumber != $rowKey) {	
							$proveValue[] = $newRowKey; 
							}
							//	

							}
							
							else{
							
							
							// Zwischengespeicherte Werte neue Werte hinzufügen
							
							// Prüfen ob ein Eintrag existiert, nicht dass er doppelt vorkommt
							$checkEntries = $wpdb->get_results("SELECT pid FROM $tablenameentries WHERE Field_Order = '$rowKey'");
								if ($checkEntries) {
								
								// Den doppelten sicherstellen, so dass man ihn wieder erkennen kann
								$querySET = "UPDATE $tablenameentries  SET Field_Order = '$newRowKey' WHERE GalleryID = '$GalleryID' AND Field_Order = '$rowKey' ";
								$updateSQL = $wpdb->query($querySET);
								
									if ($deleteFieldnumber==$rowKey) {
									
									// Auswahl der Bildnummern (pid)
									$selectPics = $wpdb->get_results("SELECT pid FROM $tablenameentries WHERE GalleryID = '$GalleryID' GROUP BY pid ASC");

									foreach($selectPics as $value){

									// Bestimmung der Feldnummer
									$pid = $value->pid;
									
									// Einsetzen des neuen Feldes in die Datenbank als leerer Datenbestand bei allen existierenden Bildern
									$wpdb->insert( $tablenameentries, array( 'id' => '', 'pid' => $pid, 'GalleryID' => $GalleryID, "Fieldtype" => $ft, 'fieldnumber' => $fn, 'ShortText' => '', 'LongText2' => '') );

									}									
									
									// Eintrag vornehmen nach dem abgesichert ist, dass es keine Doppelten geben kann
									$querySET = "UPDATE $tablenameentries  SET Fieldnumber = '$rowKey' WHERE GalleryID = '$GalleryID' AND Fieldnumber = '$newOriginKey' ";
									$updateSQL = $wpdb->query($querySET);	
									}
									else{
									// Eintrag vornehmen nach dem abgesichert ist, dass es keine Doppelten geben kann
									$querySET = "UPDATE $tablenameentries  SET Fieldnumber = '$rowKey' WHERE GalleryID = '$GalleryID' AND Fieldnumber = '$newOriginKey' ";
									$updateSQL = $wpdb->query($querySET);									
									}
								
								$proveValue[] = $newRowKey; 
								
								//echo "<br/>Update der zwischengespeicherten Werte! CheckEntries Wahr!<br/>";	
								
								}
								
								else{
								
								// Doppelte können nicht existieren. Einfach Eintrag vornehmen.
								$querySET = "UPDATE $tablenameentries  SET Fieldnumber = '$rowKey' WHERE GalleryID = '$GalleryID' AND Fieldnumber = '$newOriginKey' ";
								$updateSQL = $wpdb->query($querySET);
								
								}
								
													

							
							}
						

						
						//echo "<br/>Geklappt!<br/>";
						
						//echo "<br/>";
						
						//print_r($proveValue);						
						
						//echo "<br/>";
						
						
										
						//$querySET = "$originKey=(@temp:=$originKey), $originKey = $newKey, $newKey = @temp; UPDATE $tablenameentries SET Fieldnumber = '$originKey' WHERE GalleryID = '$GalleryID' AND Fieldnumber = '$newKey'";
						//$querySET = "UPDATE $tablenameentries SET Fieldnumber = (CASE WHEN Fieldnumber=$originKey THEN $newKey WHEN Fieldnumber=$newKey THEN $originKey END) WHERE Fieldnumber IN ($originKey, $newKey)";
						/*$querySET = "UPDATE $tablenameentries  SET Fieldnumber = '$originKey' WHERE GalleryID = '$GalleryID' AND Fieldnumber = '$newKey' ";
						$updateSQL = $wpdb->query($querySET);	
						
						echo "TEST!";*/
						
						/*$querySET = "UPDATE table1 SET Fieldnumber = CASE Fieldnumber   
                          WHEN $newKey THEN $originKey   
                          ELSE Fieldnumber  
                        END,   
					Fieldnumber = CASE Fieldnumber   
                          WHEN $originKey THEN $newKey   
                          ELSE Fieldnumber   
                        END  
					WHERE Fieldnumber IN ($newKey, $originKey)";*/ 

				/*	
					}
				
				}

			$i--;
				
			} 
		
		
		}	*/	
		// Swap Field_Order values of users in database if necessary --- ENDE
	
		
		// Add new fields in database if necessary 
		/*
		
		if($_POST['addField']){
		
		//echo "<br>AddFieldFunktionLäuft: <br>";
		
		$addField = $_POST['addField'];
		
		//print_r($addField);
		
		
		// FELDBENENNUNGEN
		// 1 = Feldnummer in der Datenbank
		// 2 = Feldtyp in der Datenbank
		
		$i = 2;
		
			foreach($addField as $key => $value){
			
			if ($i == 0) {$i = 2;}
						
			if ($i==2) {$fn = $value;} // Bestimmung der Feldnummer in der Datenbank
			
			if ($i==1) {$ft = $value;
			
			//echo "<br>true</br>";
			//echo "Zusammenfassung: NextID: $nextID; GalleryID: $GalleryID; Fieldtype: $ft; Fieldnumber: $fn; ShortText: ;LongText: ;<br/>";
			
			// Auswählen alle Bild IDs die in einer Galerie vorhanden sind
			$selectPicIds = $wpdb->get_results("SELECT id FROM $tablename WHERE GalleryID = '$GalleryID' GROUP BY id ASC");
			
			// Auswahl der Bildnummern (pid)
			if(!$selectPics){
			$selectPics = $wpdb->get_results("SELECT pid FROM $tablenameentries WHERE GalleryID = '$GalleryID' GROUP BY pid ASC");
			}
			
			//print_r($selectPicIds);

			foreach($selectPicIds as $value){ 

			// Bestimmung der Feldnummer
			$pid = $value->id;
			
			//echo "<br>pid:</br>";
			//echo "$pid";
			
			// Einsetzen des neuen Feldes in die Datenbank als leerer Datenbestand bei allen existierenden Bildern
			$wpdb->insert( $tablenameentries, array( 'id' => '', 'pid' => $pid, 'GalleryID' => $GalleryID, "Fieldtype" => $ft, 'fieldnumber' => $fn, 'ShortText' => '', 'LongText2' => '') );

			}
			
			
			} // Bestimmung des Feldtypes in der Datenbank
			
			$i--;
				
			}
		
		
		}	*/	
		// Add new fields in database if necessary --- ENDE





// Pfad definieren JS

//$pfad = plugins_url()."/f-einfach/js/jquer-1.6.2.js"; 


?>