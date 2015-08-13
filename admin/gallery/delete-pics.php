<?php


		$start = 0; // Startwert setzen (0 = 1. Zeile)
	$step =10;

	if (isset($_GET["start"])) {
	  $muster = "/^[0-9]+$/"; // reg. Ausdruck für Zahlen
	  if (preg_match($muster, $_GET["start"]) == 0) {
		$start = 0; // Bei Rückfall auf 0
	  } else {
		$start = intval($_GET["start"]);
	  }
	}
	
	if (isset($_GET["step"])) {
	  $muster = "/^[0-9]+$/"; // reg. Ausdruck für Zahlen
	  if (preg_match($muster, $_GET["start"]) == 0) {
		$step = 10; // Bei Manipulation Rückfall auf 0
	  } else {
		$step = intval($_GET["step"]);
	  }
	}

	global $wpdb;

	$GalleryID = $_GET['option_id'];


	// Set table names
	$tablename = $wpdb->prefix . "contest_gal1ery";
	$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
	$tablenameEntries = $wpdb->prefix . "contest_gal1ery_entries";
	$tablenameComments = $wpdb->prefix . "contest_gal1ery_comments";
	
	// Set table names --- END
	
	$imageUnlinkOrigin = $_POST['imageUnlinkOrigin'];
	$imageUnlink300 = $_POST['imageUnlink300'];
	$imageUnlink624 = $_POST['imageUnlink624'];
	$imageUnlink1024 = $_POST['imageUnlink1024'];
	//$count = $_POST['count'];
	
	//echo "Neuer Test";
	
	//echo "<br/>Thumb:";
	//print_r($imageUnlinkOrigin);
	//echo "<br/>";
	//echo "<br/>";
	
	//echo "<br/>imageUnlink300:";
	//print_r($imageUnlink300);
	
	//echo "<br/>";
	//echo "<br/>";
	//echo "<br/>imageUnlink624:";
	
	//print_r($imageUnlink624);
	
	//echo "<br/>";
	//echo "<br/>";
	
		//echo "<br/>";
	//echo "<br/>imageUnlink1024:";
	
	//print_r($imageUnlink1024);
	
	//echo "<br/>";
	//echo "<br/>";
	
	

	
	
// Pics vom Server löschen

   // Wordpress Uploadordner bestimmen. Array wird zurück gegeben.
	$upload_dir = wp_upload_dir();
	
				//echo "<br/>";
	//echo "<br/>basedir:";
	
	//echo $upload_dir['basedir'];
	
	//echo "<br/>";
	//echo "<br/>";
	
		
		foreach($imageUnlinkOrigin as $key => $value){
	
		//@unlink(".../wp-content/uploads/$value");
		@unlink($upload_dir['basedir'].$value);
		
	//	echo "<br>";
	//	echo $upload_dir['basedir'].$value;
	//	echo "<br>";

		}	

		foreach($imageUnlink300 as $key => $value){
		
	
		@unlink($upload_dir['basedir'].$value);
		
		
	//	echo "<br>";
//		echo $upload_dir['basedir'].$value;
//		echo "<br>";

		}
		
		foreach($imageUnlink624 as $key => $value){
	
		//@unlink(".../wp-content/uploads/$value");
		@unlink($upload_dir['basedir'].$value);
		
	//	echo "<br>";
	//	echo $upload_dir['baseurl'].$value;
	//	echo "<br>";

		}
		
		foreach($imageUnlink1024 as $key => $value){
	
		//@unlink(".../wp-content/uploads/$value");
		@unlink($upload_dir['basedir'].$value);
		
	//	echo "<br>";
	//	echo $$upload_dir['basedir'].$value;
	//	echo "<br>";

		}
		


	
// Pics vom Server löschen --- END	
	
	
// DATEN Löschen und exit

//echo "<br>DELETE ACTION<br>";


$deleteId1 = $_POST['active'];	

//print_r($deleteId1);

//print_r($deleteId1 );

		/*
		foreach($deleteId1 as $key => $value){
	
       				$deleteQuery .= ' id = "' . $value . '"';
					$deleteQuery .= ' or';
										
					$deleteEntries .= ' pid = "' . $value . '"';
					$deleteEntries .= ' or';
					
					$deleteComments .= ' pid = "' . $value . '"';
					$deleteComments .= ' or';
						
		}*/
		
	
		foreach($deleteId1 as $key => $value){
			
					$deleteQuery = 'DELETE FROM ' . $tablename . ' WHERE';			
					$deleteQuery .= ' id = %d';
					
					$deleteEntries = 'DELETE FROM ' . $tablenameEntries . ' WHERE';
					$deleteEntries .= ' pid = %d';
					
					$deleteComments = 'DELETE FROM ' . $tablenameComments . ' WHERE';
					$deleteComments .= ' pid = %d';
					
					$deleteParameters = '';
					$deleteParameters .= $value;

					
					$wpdb->query( $wpdb->prepare(
						"
							$deleteQuery
						", 
							$deleteParameters
					 ));
					 
					 $wpdb->query( $wpdb->prepare(
						"
							$deleteEntries
						", 
							$deleteParameters
					));
		 
					$wpdb->query( $wpdb->prepare(
						"
							$deleteComments
						", 
							$deleteParameters
					 ));
					 
		}		 

	
	/*
	$deleteQuery = substr($deleteQuery,0,-3);	
	$deleteSQL = $wpdb->query($deleteQuery);
	
	//echo "<br>$deleteQuery<br>";
	
	$deleteEntries = substr($deleteEntries,0,-3);	
	$deleteSQL = $wpdb->query($deleteEntries);
	
	//echo "<br>$deleteEntries<br>";
	
	$deleteComments = substr($deleteComments,0,-3);	
	$deleteSQL = $wpdb->query($deleteComments);*/
	
//	echo "<br>$deleteComments<br>";

	
	
// DATEN Löschen und exit ENDE	

?>