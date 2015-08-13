<?php


	global $wpdb;

	$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
	$tablename_options_input = $wpdb->prefix . "contest_gal1ery_options_input";
	$tablenameMail = $wpdb->prefix . "contest_gal1ery_mail";
	$tablename_form_input = $wpdb->prefix . "contest_gal1ery_f_input";
	$tablename_form_output = $wpdb->prefix . "contest_gal1ery_f_output";

		
		$last = $wpdb->get_row("SHOW TABLE STATUS LIKE '$tablenameOptions'"); // Get the new id of the gallery options which will be created
		$nextIDgallery = $last->Auto_increment; // Get the new id of the gallery options which will be created
		
		$lastFormInput = $wpdb->get_row("SHOW TABLE STATUS LIKE '$tablename_form_input'"); // Get the new id of the gallery options which will be created
		$nextIDformInput = $lastFormInput->Auto_increment; // Get the new id of the gallery options which will be created
		

		/* $wpdb->insert( $tablenameOptions, array( 'id' => '', 'GalleryName' => '', 'PicsPerSite' => 20, 'WidthThumb' => 200, 'HeightThumb' => 150, 'WidthGallery' => 600,
		 'HeightGallery' => 400, 'DistancePics' => 100, 'DistancePicsV' => 50, 'MaxResJPGon' => 0, 'MaxResPNGon' => 0, 'MaxResGIFon' => 0,
		 'MaxResJPG' => 25000000, 'MaxResPNG' => 25000000, 'MaxResGIF' => 25000000, 'ScaleOnly' => 1, 'ScaleAndCut' => 0, 'FullSize' => 1,
		 'AllowSort' => 1, 'AllowComments' => 1, 'AllowRating' => 1, 'IpBlock' => 1, 'FbLike' => 1, 'AllowGalleryScript' => 0, 'Inform' => 0,
		 'ThumbLook'=> 1, 'HeightLook'=> 1, 'RowLook'=> 1,
		 'ThumbLookOrder'=> 1, 'HeightLookOrder'=> 2, 'RowLookOrder'=> 3,
		 'HeightLookHeight'=> 300, 'ThumbsInRow'=> 4, 'PicsInRow'=> 4, 'LastRow'=> 0 ));*/
		 
		 
		 
		 $wpdb->query( $wpdb->prepare( 
			"
				INSERT INTO $tablenameOptions
				( id, GalleryName, PicsPerSite, WidthThumb, HeightThumb, WidthGallery,
				HeightGallery, DistancePics, DistancePicsV, MaxResJPGon, MaxResPNGon, MaxResGIFon,
				MaxResJPG, MaxResPNG, MaxResGIF, ScaleOnly, ScaleAndCut, FullSize,
				AllowSort, AllowComments, AllowRating, IpBlock, FbLike, AllowGalleryScript, Inform,
				ThumbLook, HeightLook, RowLook,
				ThumbLookOrder, HeightLookOrder, RowLookOrder,
				HeightLookHeight, ThumbsInRow, PicsInRow, LastRow )
				VALUES ( %s,%s,%d,%d,%d,%d,
				%d,%d,%d,%d,%d,%d,
				%d,%d,%d,%d,%d,%d,
				%d,%d,%d,%d,%d,%d,%d,
				%d,%d,%d,
				%d,%d,%d,
				%d,%d,%d,%d )
			", 
				'','',20,200,150,600,
				400,100,50,0,0,0,
				25000000,25000000,25000000,1,0,1, 
				0,1,1,1,0,0,0,
				1,1,1,
				1,2,3,
				300,4,4,0
		 ) );

		 
		 $confirmationText = "<p>Your picture upload was successful.<br/>We will activate your picture soon.<br/>Your picture has to be proved.</p>";
		 $confirmationText = htmlentities($confirmationText, ENT_QUOTES, 'UTF-8');
		 
		// $wpdb->insert( $tablename_options_input, array( 'id' => '', 'Forward' => 0, 'Forward_URL' => '', 'Confirmation_Text' => "$confirmationText" ));
		 
		$wpdb->query( $wpdb->prepare(
			"
				INSERT INTO $tablename_options_input
				( id, GalleryID, Forward, Forward_URL, Confirmation_Text)
				VALUES ( %s,%d,%d,
				%s,%s )
			", 
				'',$nextIDgallery,0,
				'',$confirmationText
		 ) );
		 
		 
		if(!function_exists('create_table')){
		// Determine email of blog admin and variables for email table 	
		$from = get_option('blogname');
		$reply = get_option('admin_email');
		$Header = 'You picture was published';
		$Content = 'Dear Sir or Madam<br/>Your picture was published<br/><br/><b>$url$</b>';
		}
	
 
		/*$wpdb->insert( $tablenameMail, array( 'id' => '', 'GalleryID' => $nextIDgallery, 'Admin' => "$from",
			'Header' => "$Header", 'Reply' => "$reply", 'cc' => "$reply",
			'bcc' => "$reply", 'Url' => '', 'Content' => "$Content"));*/
			
		
		$wpdb->query($wpdb->prepare(
			"
				INSERT INTO $tablenameMail
				( id, GalleryID, Admin,
				Header,Reply,cc,
				bcc,Url,Content)
				VALUES ( %s,%d,%s,
				%s,%s,%s,
				%s,%s,%s)
			", 
				'',$nextIDgallery,$from,
				$Header,$reply,$reply,
				$reply,'',$Content
		 ));
			
		
		// Erschaffen von Form_Input
		
		
				// Create input comment for lite version
			
				
				// Feldtyp
				// Feldreihenfolge
				// 1 = Feldtitel
				// 2 = Feldinhalt
				// 3 = Feldkrieterium1
				// 4 = Feldkrieterium2
				// 5 = Felderfordernis
			
				
				// 1. Feldtitel
				$kfFieldsArray['titel']= "Comment";
				// 2. Feldinhalt
				$kfFieldsArray['content'] = "Comment";
				$commentFieldTitel = "Comment";
				// 3. Feldkriterium 1
				$kfFieldsArray['min-char']= "3";
				// 4. Feldkriterium 2
				$kfFieldsArray['max-char']= "1000";
				// 5. Felderfordernis + Eingabe in die Datenbank
				$kfFieldsArray['mandatory']="";

				$kfFieldsArray = serialize($kfFieldsArray);
				
				$commentF = 'comment-f';
				
				//$wpdb->insert( $tablename_form_input, array( 'id' => '', 'GalleryID' => $nextIDgallery,'Field_Type' => 'comment-f',
				//"Field_Order" => 1, "Field_Content" => $kfFieldsArray ) ); 
				
				/*$wpdb->query($wpdb->prepare(
				"
					INSERT INTO $tablename_form_input
					(id, GalleryID, Field_Type,
					Field_Order,Field_Content)
					VALUES ( %s,%d,%s,
					%s,%s)
				", 
				'',$nextIDgallery,$commentF,
				1,$kfFieldsArray
				));*/
					
					
				
				// Create input comment for lite version ---- ENDE		
		
				
				// Erschaffen von Form Input Image
				
				$fieldContent['titel']="Picture upload";
				
				$fieldContent = serialize($fieldContent);
				
				$imageF = 'image-f';
				
				//$wpdb->insert( $tablename_form_input, array( 'id' => '', 'GalleryID' => $nextIDgallery, 'Field_Type' => 'image-f', "Field_Order" => 2, "Field_Content" => $fieldContent ) ); 
				
				$wpdb->query($wpdb->prepare(
				"
					INSERT INTO $tablename_form_input
					(id, GalleryID, Field_Type,
					Field_Order,Field_Content)
					VALUES ( %s,%d,%s,
					%d,%s)
				", 
				'',$nextIDgallery,$imageF,
				1,$fieldContent
				));
		
		
		// Erschaffen von Form_Input --- ENDE
		
	
		// Erschaffen von Form Output Image
		
		//$selectFormImageId = $wpdb->get_var( "SELECT id FROM $tablename_form_input WHERE GalleryID = '$nextID' AND Field_Type = 'image-f'" );
		
		//$fieldContentPictureOutput = $fieldContent['titel'];
		
		//$wpdb->insert( $tablename_form_output, array( 'id' => '', 'f_input_id' => $nextIDformInput, 'GalleryID' => $nextIDgallery,
		//'Field_Type' => 'comment-f', "Field_Order" => 1, "Field_Content" => "$commentFieldTitel" ) );
		

		$Field_Content_Output = "Picture upload";
		
		//$nextIDgallery++;
		//$nextIDformInput++;
		//$wpdb->insert( $tablename_form_output, array( 'id' => '', 'f_input_id' => $nextIDformInput, 'GalleryID' => $nextIDgallery,
		//'Field_Type' => 'image-f', "Field_Order" => 1, "Field_Content" => "Picture upload" ) ); 
		
		$wpdb->query($wpdb->prepare(
		"
			INSERT INTO $tablename_form_output
			(id, f_input_id, GalleryID,
			Field_Type,Field_Order,Field_Content)
			VALUES ( %s,%d,%d,
			%s,%d,%s)
		", 
		'',$nextIDformInput,$nextIDgallery,
		$imageF,1,$Field_Content_Output
		));
		
		
			
			
			
		// Erschaffen eines Galerieordners
		
		$uploadFolder = wp_upload_dir();
		$galleryUpload = $uploadFolder['basedir'].'/contest-gal1ery/gallery-id-'.$nextIDgallery.'';
		/*$galleryCache = $uploadFolder['basedir'].'/contest-gal1ery/gallery-id-'.$nextIDgallery.'/cache';
		$galleryCacheGallery = $uploadFolder['basedir'].'/contest-gal1ery/gallery-id-'.$nextIDgallery.'/cache/gallery';
		$galleryCacheSite = $uploadFolder['basedir'].'/contest-gal1ery/gallery-id-'.$nextIDgallery.'/cache/sites'; */
		
		//echo $galleryUpload;
		
		if(!file_exists($galleryUpload)){
		mkdir($galleryUpload,0777,true);
		}
		/*
		if(!file_exists($galleryCache)){
		mkdir($galleryCache,0777,true);
		}
		
		if(!file_exists($galleryCacheGallery)){
		mkdir($galleryCacheGallery,0777,true);
		}
		
		if(!file_exists($galleryCacheSite)){
		mkdir($galleryCacheSite,0777,true);
		}*/
	
	echo "<br>";
	echo "<div style='width:937px;background-color:#fff;margin-bottom:0px !important;margin-bottom:0px;border: 1px solid #DFDFDF;text-align:center;'>";	
	echo "<h2>You created a new gallery</h2>";
	echo "</div>";
	echo "<br>";

			

?>