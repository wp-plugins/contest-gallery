<?php 
echo "<div style='display:block !important;color:black;line-height: 20px !important;font-size:18px !important;padding-bottom:8px;height:46px !important;width:400px;'>";
/*
$thumbViewPic = content_url().'/plugins/contest-gal1ery/css/thumb-view.jpg';

echo <<<HEREDOC

 <div id="cg_menu">
    <ul>
      <li class="cg_topmenu">
        <a href="">Menü 1</a>
        <ul>
          <li class="cg_submenu"><a href=""><img src="$thumbViewPic"></a></li>
          <li class="cg_submenu"><a href="">Unterpunkt 1.2</a></li>
        </ul>
      </li>
      <li class="cg_topmenu">
        <a href="">Menü 2</a>
        <ul>
          <li class="cg_submenu"><a href="">Unterpunkt 2.1</a></li>
          <li class="cg_submenu"><a href="">Unterpunkt 2.2</a></li>
        </ul>
      </li>
      <li class="cg_topmenu">
        <a href="">Menü 3</a>
        <ul>
          <li class="cg_submenu"><a href="">Unterpunkt 3.1</a></li>
          <li class="cg_submenu"><a href="">Unterpunkt 3.2</a></li>
        </ul>
      </li>
    </ul>
  </div>
HEREDOC;


echo "<div style='float:left;display:inline;width:240px;'>"; */ 


if($AllowSort == 1 ){

//echo "<br>siteURL: $siteURL<br>";
//echo "<br>siteURLsort: $siteURLsort<br>";
//echo "<br>getLook: $getLook<br>";
echo "<p><a name='cg-begin' style='line-height:0px !important;height:0px !important;'></a></p>";
echo "<div style='display:inline;vertical-align:middle;float:left;padding-top:4px;height:20px !important;line-height: 20px !important;'>";
echo "Sort by: &nbsp;";
echo "</div>";
echo "<div style='display:inline;vertical-align:middle;float:left;margin-right:11px;height:20px !important;'>";
?>
<form style='width:200px !important;height:20px !important;' method="GET" action="<?php echo $siteURLsort; ?>">
<input type="hidden" name="<?php echo $pageIDname[0]; ?>" value="<?php echo $pageIDvalue[0]; ?>">
<input type="hidden" name="1" value="<?php echo $getLook; ?>">
<select name="2" id="select-order" style='width:200px !important;'>
<option <?php echo $selected_date_desc; ?> value="1" >Date descend</option>
<option value="2" <?php echo $selected_date_asc; ?> >Date ascend</option>
<option value="3" <?php echo $selected_comment_desc; ?> >Comments descend</option>
<option value="4" <?php echo $selected_comment_asc; ?> >Comments ascend</option>
<option value="5" <?php echo $selected_rating_desc; ?> >Rating quantity descend</option>
<option value="6" <?php echo $selected_rating_asc; ?> >Rating quantity ascend</option>
</select>
<?php
//echo <<<HEREDOC

echo "<input type='hidden' name='3' value='$getStart'/>";

echo "<input type='submit' id='change-order' style='visibility:hidden;'/>";
echo "</form>";

echo "</div>";
}

//echo "a2342134wefasfd";
//echo "<br>look: $look<br>";
//echo "<br>sendOrder: $sendOrder<br>";

//<input type="hidden" name="order" value="$order">





//<input name="submit" value="Select" type="submit" id="order" style="display: none;" />

//$HeightLook=1;
//$RowLook=1;
//$ThumbLook=1;


//print_r($orderGalleries);

//echo "<br>ThumbLook: $ThumbLook<br>";
//echo "<br>HeightLook: $HeightLook<br>";
//echo "<br>RowLook: $RowLook<br>";

//	echo "$siteURL";


//print_r($orderGalleries);

if(count($orderGalleries)>1){
	
			echo "<div style='display:inline;vertical-align:top;float:left;padding-top:0px;padding-bottom:30px;height:20px !important;line-height: 20px !important;'>";

		//echo "<form method='GET' action='$siteURLsort'>";
		//echo "<input type='hidden' name='".$pageIDname[0]."' value='".$pageIDvalue[0]."'>";
		//echo "<select name='1' id='select-look'>";
		
		$i = 0;

		
	foreach($orderGalleries as $key => $value){
		

		
		if($value=="ThumbLookOrder" AND $ThumbLook == 1 AND ($HeightLook == 1 or $RowLook == 1)){
			$i++;
			//echo "<option value='1' $selected_look_thumb>View $i</option>";
			//echo "<a href='$siteURL&1=1&2=".$getOrder."&3=".$start."'><img title='Thumb view' src='$selected_look_thumb' style='float:left;margin-left:5px;' /></a> ";
			echo "<img title='Thumb view' src='$selected_look_thumb' style='float:left;margin-left:5px;cursor:pointer;' id='cg_thumb_look_frontend' />";
			}
		if($value=="HeightLookOrder" AND $HeightLook == 1 AND ($ThumbLook == 1 or $RowLook == 1)){
			$i++;
			//echo "<option value='2' $selected_look_height>View $i</option>";
			//echo "<a href='$siteURL&1=2&2=".$getOrder."&3=".$start."'><img title='Height view' src='$selected_look_height' style='float:left;margin-left:5px;'></a> ";
			echo "<img title='Height view' src='$selected_look_height' style='float:left;margin-left:5px;cursor:pointer;' id='cg_height_look_frontend'>";
			}
		if($value=="RowLookOrder" AND $RowLook == 1  AND ($ThumbLook == 1 or $HeightLook == 1)){
			$i++;
			//echo "<option value='3' $selected_look_row>View $i</option>";
			//echo "<a href='$siteURL&1=3&2=".$getOrder."&3=".$start."'><img title='Row view' src='$selected_look_row' style='float:left;margin-left:5px;'></a> ";
			echo "<img title='Row view' src='$selected_look_row' style='float:left;margin-left:5px;cursor:pointer;' id='cg_row_look_frontend'> ";
			}
				
		}
	
		//echo "<input type='hidden' name='2' value='$getOrder'>";
		
		//echo "<input type='hidden' name='3' value='$getStart'>";

		//echo "<input type='submit' id='change-look' style='visibility:hidden;' >";
		//echo "</form>";
		echo "&nbsp;";
echo "</div>";	
	
}

if($HeightLook==true){
//echo "<div style='display:inline;vertical-align:top;float:left;padding-top:0px;padding-bottom:30px;height:20px !important;line-height: 20px !important;'>";
echo "&nbsp;";
echo "&nbsp;";
echo "&nbsp;";
echo "&nbsp;";
echo "<input type='hidden' style='display:inline;' id='cg-height' name='cg-height' value='$HeightLookHeight' >";
echo "&nbsp;";
echo "&nbsp;";
echo "<input type='hidden' style='display:inline;' id='cg-border-width' name='cg-border-width' value='0' >";
echo "&nbsp;";
echo "&nbsp;";
echo "<input type='hidden' style='display:inline;' id='cg-border-color' name='cg-border-color' value='#000' >";
echo "&nbsp;";
echo "&nbsp;";
//echo "<input type='button' id='cg-change-height' name='cg-change-height' value='submit' >";

//echo "</div>";
}

echo "</div>";


?>
<noscript>
<div style="border: 1px solid purple; padding: 10px">
<span style="color:red">Enable Javascript to see the gallery</span>
</div>
</noscript>
<?php


//echo "widthMainCGallery: $widthMainCGallery";

//echo "<br>";

	//echo "<br>WidthThumb: $WidthThumb<br>";
	//echo "<br>HeightThumb: $HeightThumb<br>";
//echo "<br>";

//print_r($picsSQL);

//echo "<br>";

//echo "<br>look: $look<br>";

			//$look!='row' or 
			
	$checkSumOfElementsWidth = 0;//wurd gebraucht für Thumb Look
	$aggregateWidth = 0;// wird gebrauht für Thumb Look
echo "<input type='hidden' class='aggregateWidth' value='$aggregateWidth'>";// Hidden Feld zum sammeln und abrufen von aggregateWidth über Jquery, wird gebrauht für Thumb Look
		if ($look=='thumb'){
		
		
				//echo "<div id='mainCGallery' style='display:block;position:fix;float:left;'>";
				echo "<div id='mainCGallery'>";
				//echo "<div id='mainCGallery' style='float:left;margin-top: -$DistancePicsV;'>";
				
							
		
		
	

		
			if ($look=='thumb') {
			
		
			// weitergabe zur leichteren Formularabfrage, wird am ende der schleife 1 dazu addiert
			$i = 0;
			
			//print($picsSQL);
				foreach($picsSQL as $value){
				

				
					$id = $value->id;
					$rowid = $value->rowid;
					$Timestamp = $value->Timestamp.'_';
					$NamePic = $value->NamePic;
					$ImgType = $value->ImgType;
					$rating = $value->Rating;
					$countR = $value->CountR;
					$countC = $value->CountC;

					$realId = $id;
					
					// Größe der Bilder bei ReihenAnsicht (Semi-Flickr-Ansicht)  
					$image2 = ($ThumbsInRow==0) ? $imageGalery : $ImageThumb;
					
					// Größe der Bilder bei ThumbAnsicht (gewöhnliche Ansicht mit Bewertung)
					

					// Count Comments
					
					//$countComments = $wpdb->get_var( "SELECT COUNT(*) AS NumberOfRows FROM $tablenameComments WHERE pid='$id'" );
					$countComments = $wpdb->get_var( $wpdb->prepare( 
					"
						SELECT COUNT(*) AS NumberOfRows
						FROM $tablenameComments 
						WHERE pid = %d
					", 
					$id
					) );
					
					// Count Comments --- END
					
					// Count Rating
					
					//$countRating = $wpdb->get_var( "SELECT AnzahlB FROM $tablename WHERE id='$id'" );
					
					//$countRating = ($countRating==0) ? '0' : $countRating;
					
					// Count Rating --- END
					
					// Verschlüsselung der ID
					$id = ($id+8)*2+100000;




					//$scriptOnOff = ($AllowGalleryScript==1) ? 'data-lightbox="roadtrip1"' : ''; 
					
					//$urlGallerySrc = ($ScalePics==0) ? $uploads.'/'.$imageGalery : $uploads.'/'.$imageOrigin; 
					
					//$urlGalleryHref = ($AllowGalleryScript==0) ? $siteURL."pictureID=$rowid"."&order=$rowImages"."&start=$start&look=$look" : $urlGallerySrc; 
					
					//$commentURL = $siteURL."pictureID=$rowid";
					
					// Dynamic configs of pictures showing kind --- END
					
					
					$marginLeft = $WidthThumb-9;	
					$marginTop = $HeightThumb-10;
					
					$marginLeft .= 'px';
					$marginTop .= 'px';
					
					// Zoom pic - END
					
					$originalImage = $uploads.'/'.$imageOrigin;
					
					$commentText = 'Von: ';
					$commentText .= $NameUser;
					$commentText .= " &#013;$comment";
					
					
					// Definition der Variablen, notwendig für die Ausgabe
					
					// destination of the uploaded original image
					
					$uploadFolder = wp_upload_dir();
					
					// Feststellen der Quelle des Original Images		
					$sourceOriginalImg = $uploadFolder['basedir'].'/contest-gal1ery/gallery-id-'.$galeryID.'/'.$Timestamp.$NamePic.'.'.$ImgType; // Pfad zum Bilderordner angeben
					list($widthOriginalImg, $heightOriginalImg) = getimagesize($sourceOriginalImg); // Breite und Höhe von original Image
					
					// Ermittlung der Höhe nach Skalierung. Falls unter der eingestellten Höhe, dann nächstgrößeres Bild nehmen.
					$heightScaledThumb = $WidthThumb*$heightOriginalImg/$widthOriginalImg;
					
					
					// Falls unter der eingestellten Höhe, dann größeres Bild nehmen (normales Bild oder panorama Bild, kein Vertikalbild)
					
					if ($heightScaledThumb <= $HeightThumb) {
					
					$widthScaledThumb = $HeightThumb*$widthOriginalImg/$heightOriginalImg;
					
					if($widthScaledThumb <= 300) {$imageThumb = $NamePic."-300width.".$ImgType;}		
					if($widthScaledThumb > 300 AND $widthScaledThumb <= 624) {$imageThumb = $NamePic."-624width.".$ImgType;}		
					if($widthScaledThumb > 624 AND $widthScaledThumb <= 1024) {$imageThumb = $NamePic."-1024width.".$ImgType; }		
					if($widthScaledThumb > 1024) {$imageThumb = $NamePic.".".$ImgType;}

					// Bestimmung von Breite des Bildes
					$WidthThumbPic = $HeightThumb*$widthOriginalImg/$heightOriginalImg;
					
										// Bestimmung von Breite des Bildes
					$WidthThumbPic = $WidthThumbPic+2;
					$WidthThumbPic = $WidthThumbPic.'px';

					// Bestimmung wie viel links und rechts abgeschnitten werden soll
					$paddingLeftRight = ($WidthThumbPic-$WidthThumb)/2;
					$paddingLeftRight = $paddingLeftRight.'px';
					
					$padding = "left: -$paddingLeftRight;right: -$paddingLeftRight";
					
					}
					
					
					// Falls über der eingestellten Höhe, dann kleineres Bild nehmen (kein Vertikalbild)
					if ($heightScaledThumb > $HeightThumb) {
					if($WidthThumb <= 300) {$imageThumb = $NamePic."-300width.".$ImgType;}		
					if($WidthThumb > 300 AND $WidthThumb <= 624) {$imageThumb = $NamePic."-624width.".$ImgType;}		
					if($WidthThumb > 624 AND $WidthThumb <= 1024) {$imageThumb = $NamePic."-1024width.".$ImgType;}		
					if($WidthThumb > 1024) {$imageThumb = $NamePic.".".$ImgType;}
					
					// Bestimmung von Breite des Bildes
					$WidthThumbPic = $WidthThumb+2;
					$WidthThumbPic = $WidthThumbPic.'px';
					
					// Bestimmung wie viel oben und unten abgeschnitten werden soll
					$heightImageThumb = $WidthThumb*$heightOriginalImg/$widthOriginalImg;
					$paddingTopBottom = ($heightImageThumb-$HeightThumb)/2;
					$paddingTopBottom = $paddingTopBottom.'px';
					
					$padding = "top: -$paddingTopBottom;bottom: -$paddingTopBottom";
					
					}
					
					
					/*if($AllowRating==1){
						  echo "<div id='ul-stars' style='display:block;'><ul class='ul-cgrating'>";
						  echo "<li class='$star1' id='star1' ><a title='Ich vergebe dem Bild 1 Punkt' style='cursor: pointer;' alt='1'></a></li>";
						  echo "<li class='$star2' id='star2' ><a title='Ich vergebe dem Bild 2 Punkt' style='cursor: pointer;' alt='2'></a></li>";
						  echo "<li class='$star3' id='star3' ><a title='Ich vergebe dem Bild 3 Punkt' style='cursor: pointer;' alt='3'></a></li>";
						  echo "<li class='$star4' id='star4' ><a title='Ich vergebe dem Bild 4 Punkt' style='cursor: pointer;' alt='4'></a></li>";
						  echo "<li class='$star5' id='star5' ><a title='Ich vergebe dem Bild 5 Punkt' style='cursor: pointer;' alt='5'></a></li>";
						  echo "<li><div id='rating' style='display:inline;float:left;'>($countR)<div id='rated' style='position:absolute;padding-bottom:100px;float:left;visibility:hidden;'>Sie haben dieses Bild bereits bewertet!</div></div></li>";
						  echo "</ul>";
						  echo "</div>"; 
					}*/
					
			
			
						
			// Beim letzten Bild in der Reihe soll der Abstand nach rechts NULL sein
			
			// Rechtzeitig auf Null setzen falls drüber ist
			$checkWholeWidth = $checkSumOfElementsWidth+$WidthThumb;

			$checkSumOfElementsWidth = $checkSumOfElementsWidth + $WidthThumb + $DistancePics;
			
			//echo "<br>checkSumOfElementsWidth: $checkSumOfElementsWidth<br>";
			
			// Rechtzeitig auf Null setzen falls drüber ist
			if($checkWholeWidth >= $widthMainCGallery){  $checkSumOfElementsWidth = 0; }
			
			if($checkSumOfElementsWidth >= $widthMainCGallery){
			
			$DistancePicsPx = 0;
			$DistancePicsPx = $DistancePicsPx."px";
			
			$checkSumOfElementsWidth = 0;
			
			}
			
			
			

			// Ermitteln Anzahl der Bewertungen
					
			// Ermitteln wie die Stars angezeigt werden sollen beim hovern
			
			if ($countR!=0){
				$averageStars = $rating/$countR;
				$averageStarsRounded = round($averageStars,0);
				//echo "<br>averageStars: $averageStars<br>";
				
			}
			else{$countR=0; $averageStarsRounded = 0;}
			 
			//echo "<br>averageStarsRounded: $averageStarsRounded<br>";

			//echo "<br>averageStarsRounded: $averageStarsRounded<br>";

		//	$star_off_gallery = 'star_off_gallery';
			//$star_on_gallery = 'star_on_gallery';

			//$star1 = 'star_on_gallery';
			//$star2 = 'star_on_gallery';
			//$star3 = 'star_on_gallery';
			//$star4 = 'star_on_gallery';
			//$star5 = 'star_on_gallery';

/*
			if($averageStarsRounded>=1){$star1 = "cgn$realId-1";}
			else{$star1 = "cgo$realId-1";}
			if($averageStarsRounded>=2){$star2 = "cgn$realId-2";}
			else{$star2 = "cgo$realId-2";}
			if($averageStarsRounded>=3){$star3 = "cgn$realId-3";}
			else{$star3 = "cgo$realId-3";}
			if($averageStarsRounded>=4){$star4 = "cgn$realId-4";}
			else{$star4 = "cgo$realId-4";}
			if($averageStarsRounded>=5){$star5 = "cgn$realId-5";}
			else{$star5 = "cgo$realId-5";}*/
			
			$iconsURL = content_url().'/plugins/contest-gal1ery/css';
			
			if($averageStarsRounded>=1){$starTest1 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest1 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=2){$starTest2 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest2 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=3){$starTest3 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest3 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=4){$starTest4 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest4 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=5){$starTest5 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest5 = $iconsURL.'/star_off_48_reduced.png';}
			
			
			
			
			
			// Ermitteln wie die Stars angezeigt werden sollen ---- ENDE
			
			
			// An welcher stelle das Bild ist in der Abfrage
			$getCount = $i;	
			
			

			
echo "<div style='float:left;margin-right: $DistancePicsPx;margin-top: $DistancePicsV;cursor: pointer;display:none;' class='show'>";


				echo <<<HEREDOC
				<input type="hidden" class="DistancePics" value="$DistancePics">
				<input type="hidden" class="DistancePicsV" value="$DistancePicsV">
				<input type="hidden" class="widthOriginalImg" value="$widthOriginalImg">
		<input type="hidden" class="heightOriginalImg" value="$heightOriginalImg">	
		<input type="hidden" class="WidthThumb" value="$WidthThumb">	
		<input type="hidden" class="HeightThumb" value="$HeightThumb">	
		<input type="hidden" class="srcOriginalImg" value="$uploads/$Timestamp$NamePic.$ImgType">
		<input type="hidden" class="src1024width" value="$uploads/$Timestamp$NamePic-1024width.$ImgType">
		<input type="hidden" class="src624width" value="$uploads/$Timestamp$NamePic-624width.$ImgType">
		<input type="hidden" class="src300width" value="$uploads/$Timestamp$NamePic-300width.$ImgType">
		
HEREDOC;

echo "<input type='hidden'  class='hrefCGpic' value='$siteURL&picture_id=$id&1=".$getLook."&2=".$getOrder."&3=".$getStart."#cg-begin' >";

//<a onClick="document.getElementById('cg-img-$id').click()" >

	// 1. Reihenfolge
	// 2. Look
	// 3. Start
	// 4. Step
	// 5. Count (Reihenfolge des Bildes in der Anordnung)
				
	/*echo <<<HEREDOC

		<div class='show-inner' >
HEREDOC;*/
echo "<div class='append' style='float:left;display:inline;width:$WidthThumbPx;height:$HeightThumbPx;'>";


echo "<a href='$siteURL&picture_id=$id&1=".$getLook."&2=".$getOrder."&3=".$getStart."#cg-begin' >";		
	echo <<<HEREDOC
		<img alt='$commentText' src='$uploads/$Timestamp$imageThumb' style='cursor: pointer;$padding;position: absolute !important;max-width:none !important;' class='cg_image' width='$WidthThumbPic' >
		</a>
HEREDOC;
echo "</div>";

if($AllowComments==1 or $AllowComments==1){
	echo "<div style='position:absolute;bottom:0px;background: rgba(0, 0, 0, 0.8);padding-top:3px;padding-bottom:10px;width:$WidthThumbPx;padding-left:3px;font-size:18px;' class='hide' >";
//		echo "<a onClick='document.getElementById(\"cg-img-$id\").click()' >";//<img src='$urlTransparentPic' style='cursor: pointer;position:absolute;z-index:20;width:$WidthThumbPx;height:$HeightThumbPx;'>";
//		echo "</a>";

		if($AllowComments==1){
		echo "<div style='display:block !important;width:$WidthThumbPx;color: #fff;font-size:18px;padding:0px;margin:0px;clear: both;height: 18px;line-height: 18px;' id='rating_cgc-$realId'> <b>Comments ($countC)</b></div>";
		}
								if($AllowRating==1){
									  /*echo "<div style='display:block;height:20px;color:#fff;font-size:18px;text-align:left;float:left;padding-top:3px;'>";
									  echo "<ul class='ul-cgrating'>";
									  echo "<li class='$star1' ><a alt='1'></a></li>";
									  echo "<li class='$star2' ><a alt='2'></a></li>";
									  echo "<li class='$star3' ><a alt='3'></a></li>";
									  echo "<li class='$star4' ><a alt='4'></a></li>";
									  echo "<li class='$star5' ><a alt='5'></a></li>";
									  echo "</ul>";
									  echo "";
									  echo "<b>($countR)</b>";
									  echo "</div>";*/
									  
									  	  echo "<div style='padding-top:2px;'>";
										  //echo "<div style='width:85px;margin:0px;padding:0px;display:inline;float:left;height:20px;clear: both;'>";
									  /*echo "<img src='$starTest1' style='float:left;;'>";
									  echo "<img src='$starTest2' style='float:left;'>";
									  echo "<img src='$starTest3' style='float:left;;'>";
									  echo "<img src='$starTest4' style='float:left;'>";
									  echo "<img src='$starTest5' style='float:left;'>";									  
									  echo "<p  style='float:left;'><b>($countR)</b></p>";	*/		
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest1'  style='float:left;cursor:pointer;' alt='1' id='cg_rate_star1'></div>";
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest2'  style='float:left;cursor:pointer;' alt='2' id='cg_rate_star2'></div>";
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest3'  style='float:left;cursor:pointer;' alt='3' id='cg_rate_star3'></div>";
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest4'  style='float:left;cursor:pointer;' alt='4' id='cg_rate_star4'></div>";
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest5'  style='float:left;cursor:pointer;' alt='5' id='cg_rate_star5'></div>";
						  //echo "</div>";
						  echo "<div style='display:inline;float:left;font-size:18px;v-align: top;line-height: 18px;height: 18px;color:#fff;' id='rating_cg-$pictureID' class='rating_cg'><b>&nbsp;($countR)</b></div>";										  
									  echo "</div>";
									 // echo "<div style='display:inline;float:left;margin:0px;padding:0px;font-size:18px;width:30px;'> &nbsp;<b>($countR)</b></div>";
									  
									//  echo "</div>";
								}

		//include("stars-thumb-look.php");

	//echo "</div>";
				}

				
echo "</div>";



			// Abstand wird zurück gesetzt auf die Einstellungen bei Options
			$DistancePicsPx = $DistancePicsOriginalPx;

// Formular zum Übertragen von Hidden Werten	
/*
echo "<form method='post' action='$siteURL"."picture_id=$id'>";
echo <<<HEREDOC
<input type="hidden" name="order" value="$sendOrder">
<input type="hidden" name="start" value="$start">
<input type="hidden" name="step" value="$step">
<input type="hidden" name="look" value="$look">
<input type="hidden" name="count" value="$i">
<input name="submit" value="Create" type="submit" id="cg-img-$id" style="display: none;" />
</form>
HEREDOC;*/


	echo "</div>";
					/*if($AllowComments==1){
					echo '<div style="padding-top: 10px;">';
					echo "<strong><a href='$siteURL"."pictureID=$rowid&sc=tr&start=$start&look=$look#begin'>Kommentare ($countComments)</a></strong>";
					}

					if($AllowRating==1){
					echo "<ul class='ul-cgrating'>";
						  echo "<li class='$star1'><a href='$siteURL"."star1=1&id=$id1&start=$start&choose=$rowImages&look=$look' title='Ich vergebe dem Bild 1 Punkt'></a></li>";
						  echo "<li class='$star2'><a href='$siteURL"."star1=2&id=$id1&start=$start&choose=$rowImages&look=$look' title='Ich vergebe dem Bild 2 Punkt'></a></li>";
						  echo "<li class='$star3'><a href='$siteURL"."star1=3&id=$id1&start=$start&choose=$rowImages&look=$look' title='Ich vergebe dem Bild 3 Punkt'></a></li>";
						  echo "<li class='$star4'><a href='$siteURL"."star1=4&id=$id1&start=$start&choose=$rowImages&look=$look' title='Ich vergebe dem Bild 4 Punkt'></a></li>";
						  echo "<li class='$star5'><a href='$siteURL"."star1=5&id=$id1&start=$start&choose=$rowImages&look=$look' title='Ich vergebe dem Bild 5 Punkt'></a></li>";
						  echo "<li style='margin-top:2px;font-size:15px;'>($countRating)</li>";
						  echo "</ul>";
					echo "</div>";
					}*/
	
	// weitergabe zur leichteren Formularabfrage, wird am ende der schleife 1 dazu addiert --- ENDE	
	$i++;				
					
				}
		
			}
		
	echo "</div>";	


		
		}
		
		// Thumb Ansicht anzeigen ---- ENDE

	$SameHeightLook=1;
		
	// ROW Ansicht anzeigen	

	if($look=='row'){
	
	echo "<div id='mainCGallery'>";
	
	
	$getSQL = new sql_selects($tablename,$galeryID,$order,$start,$step,$pictureID);
	$count_pics = $getSQL->count_pics();
	//$picsSQL = $getSQL->pics_sql();
	
	// var height1 = parseInt(height);
 
   // Array für neue Höhen
   $newHeight1 = array();
  
   $newHeight2 = 0;
  
  // Beginn des Nenners
  $ratio = 0;
  
  // Array für mehrere Nenner (Gesamtzähler)
  $denominator1 = array();
  // a bestimmt mehrere Nenner
  $a = 0;
  
  // Gesamter Zähler
  $newNumerator = 0;
	
  // Beginn des Zählers im Bruch 
  $numerator = 0;
  
  // Neue Höhe 
  $newHeight = 0;
  
  $partNumerator = 0;
  
  // Anzahl der hochgeladenen Bilder
  $n = $count_pics;
  
  // Wie viele Bilder sollen in einer Reihe dargestellt werden. Einstellung erfolgt durch User in Options
  $picsInRow = $PicsInRow;
  
  // Wie viele Bilder sollen pro Seite dargestellt werden. Einstellung erfolgt durch User in Options.
  $picsPerSite = $PicsPerSite;
  
  // Breite des divs in dem sich die Galerie befindet
  $widthmain = $widthMainCGallery-2;
  
  // Gesamtbreite wird neu berechnet, da Anzahl der Bilder (.cg_image) kleiner ist als eingestellte Anzahl der Bilder in einer Reihe in Options 
  if($n < $picsInRow){
  
  $widthmain = $widthmain/$picsInRow*$n;
  
  // Neue Anzahl der Bilder in einer Reihe. Entspricht der Anzahl der Gesamtbilder.
  $picsInRow = $n;
  
  }
   
  $widthLastRow = $widthmain/$picsInRow*($n-floor($n/$picsInRow)*$picsInRow);
    
  $lastRow = $LastRow;

  $width2 = 0;
    
  $lastRowLeft = $n-($n-floor($n/$picsInRow)*$picsInRow);
		
  $lastImages = 1;	
  
  // Orientierungsvariable bei Durcharbeiten des großen Arrays   
  $r = 0;
  
  $i = 0;
  
  // 1. Die neue Höhe jedes einzelnen Bildes muss ermittelt werden. Diese wird in einem Array gesammelt.
  
 
  
	foreach($picsSQL as $value){
	
	$r++;

	$Timestamp = $value->Timestamp.'_';
	$NamePic = $value->NamePic;
	$ImgType = $value->ImgType;

	
	///echo "<br>countR: $countR;<br>";
	  
	// Feststellen der Quelle des Original Images		
	$uploadFolder = wp_upload_dir();
	
	$sourceOriginalImg = $uploadFolder['basedir'].'/contest-gal1ery/gallery-id-'.$galeryID.'/'.$Timestamp.$NamePic.'.'.$ImgType; // Pfad zum Bilderordner angeben
	list($widthOriginalImg, $heightOriginalImg) = getimagesize($sourceOriginalImg); // Breite und Höhe von original Image
	
	$width = $widthOriginalImg;
	$height = $heightOriginalImg;
	
    $div = $width/$height;
	  
	$ratio  = $ratio + $div;
	  
	 if ($r>$lastRowLeft) {
	 
  	  $width3 = $newHeight2*$width/$height;
	  $width2 = $width2 + $width3;	  
	  	  
	  }
	  
		  if ($r % $picsInRow == 0) {
		  			
			$denominator1[]=$ratio;
			
			$newHeight = floor($widthmain/$ratio);
				
			$newHeight1[] = $newHeight;
				
			$newHeight2 = $newHeight;
		  
		  $a++;
		  
		  $newNumerator = 0;
		  		  
		  $newHeight = 0;
		  
		  $ratio = 0;
		  
		  $partNumerator = 0;

		  
		  }
		  
		  if ($n/$r == 1) { 
				
			if ($lastRow==0) {
					
					if ($width2<=$widthmain) {
					
					$newHeight = $newHeight2;		
										
					}
					
					if ($width2>$widthmain) {

					$newHeight = floor($widthmain/$ratio);

					
					}
				
				}
				

				$newHeight1[] = $newHeight;
		  
		  }	
		  
		
		  
	   }  
	   
	     // 1. Die neue Höhe jedes einzelnen Bildes muss ermittelt werden. Diese wird in einem Array gesammelt. ---- ENDE
		 
		 // 2. Ausgabe der Bilder nach dem die Höhe ermittelt wurde 
		 
		    $h = 0;
			$g = 0;
			
			foreach($picsSQL as $value){
			
			$g++;
			
			$id = $value->id;
			$Timestamp = $value->Timestamp.'_';
			$NamePic = $value->NamePic;
			$ImgType = $value->ImgType;
			$rating = $value->Rating;
			$countR = $value->CountR;
			$countC = $value->CountC;
			
			$realId = $id;
			
			// Verschlüsselung der ID
			$id = ($id+8)*2+100000;

			// Feststellen der Quelle des Original Images		
			$sourceOriginalImg = $uploadFolder['basedir'].'/contest-gal1ery/gallery-id-'.$galeryID.'/'.$Timestamp.$NamePic.'.'.$ImgType; // Pfad zum Bilderordner angeben
			list($widthOriginalImg, $heightOriginalImg) = getimagesize($sourceOriginalImg); // Breite und Höhe von original Image
	
			$newHeightImage = $newHeight1[$h];
			$newWidthImage = $widthOriginalImg*$newHeightImage/$heightOriginalImg;
			$newWidthImagePx = $newWidthImage."px";
			
			// je nach Breite wird entsprechendes Bild gewählt
			if($newWidthImage <= 300) {$imageThumb = $NamePic."-624width.".$ImgType; $imageThumbFirstSize = $imageThumb;}		
			if($newWidthImage > 300 AND $newWidthImage <= 624) {$imageThumb = $NamePic."-624width.".$ImgType; $imageThumbSecondSize = $imageThumb;}		
			if($newWidthImage > 624 AND $newWidthImage <= 1024) {$imageThumb = $NamePic."-1024width.".$ImgType; $imageThumbThirdSize = $imageThumb;}		
			if($newWidthImage > 1024) {$imageThumb = $NamePic.$ImgType; $imageThumbFourthSize = $imageThumb;}
			  
			  //$(this).attr('height',newHeight1[h]);
			  
				  if ($g % 4 == 0) {
				  
				  $h++;
				  
				  }
				  
				  
			// Ermitteln Anzahl der Bewertungen
					
			// Ermitteln wie die Stars angezeigt werden sollen beim hovern
			
			if ($countR!=0){
				$averageStars = $rating/$countR;
				$averageStarsRounded = round($averageStars,0);
				//echo "<br>averageStars: $averageStars<br>";
				
			}
			else{$countR=0; $averageStarsRounded = 0;}
			 


			//echo "<br>averageStarsRounded: $averageStarsRounded<br>";

			//$star_off_gallery = 'star_off_gallery';
			//$star_on_gallery = 'star_on_gallery';

			//$star1 = 'star_on_gallery';
			//$star2 = 'star_on_gallery';
			//$star3 = 'star_on_gallery';
			//$star4 = 'star_on_gallery';
			//$star5 = 'star_on_gallery';


/*
			if($averageStarsRounded>=1){$star1 = "cgn$realId-1";}
			else{$star1 = "cgo$realId-1";}
			if($averageStarsRounded>=2){$star2 = "cgn$realId-2";}
			else{$star2 = "cgo$realId-2";}
			if($averageStarsRounded>=3){$star3 = "cgn$realId-3";}
			else{$star3 = "cgo$realId-3";}
			if($averageStarsRounded>=4){$star4 = "cgn$realId-4";}
			else{$star4 = "cgo$realId-4";}
			if($averageStarsRounded>=5){$star5 = "cgn$realId-5";}
			else{$star5 = "cgo$realId-5";}*/
			
			
			$iconsURL = content_url().'/plugins/contest-gal1ery/css';
			
			if($averageStarsRounded>=1){$starTest1 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest1 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=2){$starTest2 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest2 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=3){$starTest3 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest3 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=4){$starTest4 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest4 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=5){$starTest5 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest5 = $iconsURL.'/star_off_48_reduced.png';}
			
			// Ermitteln wie die Stars angezeigt werden sollen ---- ENDE  
				  
			$newHeightImageDiv = $newHeightImage;
			$newWidthImageDiv = $newWidthImage;
			
			$newHeightImageDivPx = $newHeightImageDiv."px";
			$newWidthImageDivPx = $newWidthImageDiv."px";
			
			$newHeightImage = $newHeightImage+4;
			$newWidthImage = $newWidthImage+4;
			
			$newHeightImagePx = $newHeightImage."px";
			$newWidthImagePx = $newWidthImage."px";
			//$newWidthImagePx = $newWidthImage."px";
			
			
				  
				  
					// Hide Classe ist die Div Box zum Hovern 
				echo <<<HEREDOC
		<div style='float:left;display:none;' class='show'>
						<input type="hidden" class="DistancePics" value="$DistancePics">
				<input type="hidden" class="DistancePicsV" value="$DistancePicsV">
		<input type="hidden" class="WidthThumb" value="$WidthThumb">	
		<input type="hidden" class="HeightThumb" value="$HeightThumb">	
				<input type="hidden" class="widthOriginalImg" value="$widthOriginalImg">
		<input type="hidden" class="heightOriginalImg" value="$heightOriginalImg">		
		<input type="hidden" class="srcOriginalImg" value="$uploads/$Timestamp$NamePic.$ImgType">
		<input type="hidden" class="src1024width" value="$uploads/$Timestamp$NamePic-1024width.$ImgType">
		<input type="hidden" class="src624width" value="$uploads/$Timestamp$NamePic-624width.$ImgType">
		<input type="hidden" class="src300width" value="$uploads/$Timestamp$NamePic-300width.$ImgType">
		
				<div class='append'>		
</div>

		
		
		


HEREDOC;

echo "<input type='hidden'  class='hrefCGpic' value='$siteURL&picture_id=$id&1=".$getLook."&2=".$getOrder."&3=".$getStart."#cg-begin' >";

/*

		<a onClick="document.getElementById('cg-img-$id').click()" >
		<img alt="$commentText" src="$uploads/$Timestamp$imageThumb" class='cg_image' style='left:-2px; right: -2px;position:absolute;max-width:none;overflow:hidden;float:left !important;border:0 !important;visibility:hidden;cursor: pointer;'
        width='$newWidthImagePx;' height='$newHeightImagePx;'>
		</a>



*/


if($AllowComments==1 or $AllowComments==1){
	echo "<div style='position:absolute;bottom:0px;background: rgba(0, 0, 0, 0.8);padding-top:3px;padding-bottom:10px;width:$WidthThumbPx;padding-left:3px;font-size:18px;' class='hide' >";
//		echo "<a onClick='document.getElementById(\"cg-img-$id\").click()' >";//<img src='$urlTransparentPic' style='cursor: pointer;position:absolute;z-index:20;width:$WidthThumbPx;height:$HeightThumbPx;'>";
//		echo "</a>";

		if($AllowComments==1){
		echo "<div style='display:block !important;width:$WidthThumbPx;color: #fff;font-size:18px;padding:0px;margin:0px;clear: both;height: 18px;line-height: 18px;' id='rating_cgc-$realId'> <b>Comments ($countC)</b></div>";
		}
								if($AllowRating==1){
									  /*echo "<div style='display:block;height:20px;color:#fff;font-size:18px;text-align:left;float:left;padding-top:3px;'>";
									  echo "<ul class='ul-cgrating'>";
									  echo "<li class='$star1' ><a alt='1'></a></li>";
									  echo "<li class='$star2' ><a alt='2'></a></li>";
									  echo "<li class='$star3' ><a alt='3'></a></li>";
									  echo "<li class='$star4' ><a alt='4'></a></li>";
									  echo "<li class='$star5' ><a alt='5'></a></li>";
									  echo "</ul>";
									  echo "";
									  echo "<b>($countR)</b>";
									  echo "</div>";*/
									  
									  	  echo "<div style='padding-top:2px;'>";
										  //echo "<div style='width:85px;margin:0px;padding:0px;display:inline;float:left;height:20px;clear: both;'>";
									  /*echo "<img src='$starTest1' style='float:left;;'>";
									  echo "<img src='$starTest2' style='float:left;'>";
									  echo "<img src='$starTest3' style='float:left;;'>";
									  echo "<img src='$starTest4' style='float:left;'>";
									  echo "<img src='$starTest5' style='float:left;'>";									  
									  echo "<p  style='float:left;'><b>($countR)</b></p>";	*/		
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest1' style='float:left;cursor:pointer;' alt='1' id='cg_rate_star1'></div>";
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest2' style='float:left;cursor:pointer;' alt='2' id='cg_rate_star2'></div>";
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest3' style='float:left;cursor:pointer;' alt='3' id='cg_rate_star3'></div>";
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest4' style='float:left;cursor:pointer;' alt='4' id='cg_rate_star4'></div>";
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest5' style='float:left;cursor:pointer;' alt='5' id='cg_rate_star5'></div>";
						  //echo "</div>";
						  echo "<div style='display:inline;float:left;font-size:18px;v-align: top;line-height: 18px;height: 18px;color:#fff;' id='rating_cg-$pictureID' class='rating_cg'><b>&nbsp;($countR)</b></div>";										  
									  echo "</div>";
									 // echo "<div style='display:inline;float:left;margin:0px;padding:0px;font-size:18px;width:30px;'> &nbsp;<b>($countR)</b></div>";
									  
									//  echo "</div>";
								}

		//include("stars-thumb-look.php");

	echo "</div>";
				}

echo "</div>";	



		$i++;  	  
			  
			  }
	   
	   	// 2. Ausgabe der Bilder nach dem die Höhe ermittelt wurde --- ENDE
	   
	  
		
		
		echo "</div>";	

		}
		
		
		
		// Same Height Look
		
		
		if($look=='height'){
		
	echo "<div id='mainCGallery' style='width:700px'>";
	
	//echo "works";
	
	//$getSQL = new sql_selects($tablename,$galeryID,$order,$start,$step,$pictureID);
	//$picsSQL = $getSQL->pics_sql();
	
	


		
  // Neue Höhe 
  $newHeight = 0;
  
  
  // Breite des divs in dem sich die Galerie befindet
  //$widthmain = $widthMainCGallery-2;
  $widthmain = 700;
    

   // die einzelnen neu ermittelten Breiten die durch die vorgegebene Höhe entstehen werden gesammelt
  $widthArray = array();
  
   // die einzelnen Höhen sollen gesammelt werden. Bei Runter- und Hochskaliertung, ist es eine notwendige Angabe im Div 
  $heightArray = array();
  
  // Die Breite der Inhaltsboxen wird ermittelt
  $widthDivArray = array();
  
  // Anzahl der Durchläufe muss gezählt werden um den letzten Durchlauf zu ermitteln
  $lastLoopProcess = count ( $picsSQL );
  
  // Anzahl der Durchläufe muss gezählt werden um den letzten Durchlauf zu ermitteln
  $last = array();
    
  // Summe der einzelnen Breiten
  $aggregateWidth = 0;
  
  // Gesamtzahl der verarbeiteten Bilder
  $countProcessedPics = 0;
  
  // Summer der Gesamtlänge, um die alle Bilder, die in die Gesamtbreite reinpassen, insgesamt reduziert werden können. 
  // Mehr als 46% kann von einem Bild nicht abgezogen werden ( zuerst 10% Höhe, danach 20% Links, 20% Rechts >>>  46% prozent insgesamt als Reduzierung bei einem Bild möglich )
  $aggregateAcceptableReducedSize = 0;
  
  // Orientierungsvariable bei Durcharbeiten des großen Arrays   
  $r = 0;
  
	// Feststellen der Quelle des Original Images		
	$uploadFolder = wp_upload_dir();
  

  // 1. Die neue Höhe jedes einzelnen Bildes muss ermittelt werden. Diese wird in einem Array gesammelt. 
 
	foreach($picsSQL as $value){
	
	//	echo "works1";
	
	$r++;

	$Timestamp = $value->Timestamp.'_';
	$NamePic = $value->NamePic;
	$ImgType = $value->ImgType;
	  

	 
	$sourceOriginalImg = $uploadFolder['basedir'].'/contest-gal1ery/gallery-id-'.$galeryID.'/'.$Timestamp.$NamePic.'.'.$ImgType; // Pfad zum Bilderordner angeben
	list($widthOriginalImg, $heightOriginalImg) = getimagesize($sourceOriginalImg); // Breite und Höhe von original Image
	
	$width = $widthOriginalImg;
	$height = $heightOriginalImg;
	
    $newWidth = $width*$HeightLookHeight/$height;
	
	// die einzelnen neu ermittelten Breiten die durch die vorgegebene Höhe entstehen werden gesammelt
	$widthArray[] = $newWidth;
	$heightArray[] = $HeightLookHeight;
	$widthDivArray[] = $newWidth;
	
	$aggregateWidth = $aggregateWidth + $newWidth;
	
	// zuerst 10% Höhe, danach 20% Links, 20% Rechts >>> 46% prozent insgesamt als Reduzierung möglich
	$acceptableReducedSize = $newWidth/100*46;
	
	// Summer der Gesamtlänge, um die alle Bilder, die in die Gesamtbreite reinpassen, insgesamt reduziert werden können. 
	$aggregateAcceptableReducedSize = $aggregateAcceptableReducedSize + $newWidth;
	
	
	//echo "<br/>aggregateWidth $r: $aggregateWidth<br/>";
	//echo "<br/>sourceOriginalImg $r: $sourceOriginalImg<br/>";
	//echo "<br/>step $n: $lastLoopProcess<br/>";
	
	
	
	// Wenn es der letzte Durchlauf ist und die gesammelte Breite unter 90% der Gesamtbreite ergibt dann wird nichts gemacht
	if ($aggregateWidth < $widthmain/100*90 AND $lastLoopProcess == $r) {
	
		for ($i = $countProcessedPics; $i < $r; $i++) {
		
		//echo "<br>Variante 0:<br/>";
		//echo "<br/>widthArray[$i]: $widthArray[$i]<br/>";
		
		$widthArray[$i] = ceil($widthArray[$i])+4;
		$widthDivArray[$i] = ceil($widthDivArray[$i]);		
		
		//echo "<br/>Neue Breite: $newWidth<br/>";
		//echo "<br/>widthArray[$i]: $widthArray[$i]<br/>";
		

		
		}	
	
	break;
	
	}
	
	
	// Wenn die gesammelte Breite 90% der Gesamtbreite ergibt, dann wird hochskaliert. Die Höhe bleibt die vorgegebene Höhe
	elseif ($aggregateWidth >= $widthmain/100*90 AND $aggregateWidth <= $widthmain) {			
	
		for ($i = $countProcessedPics; $i < $r; $i++) {
		
	//	echo "<br>Variante 1:<br/>";
	//	echo "<br/>widthArray[$i]: $widthArray[$i]<br/>";
		
		$newWidth = $widthArray[$i]/($aggregateWidth*100/$widthmain)*100;
		$widthArray[$i] = ceil($newWidth)+4;
		$widthDivArray[$i] = ceil($newWidth);		
		
	//	echo "<br/>Neue Breite: $newWidth<br/>";
	//	echo "<br/>widthArray[$i]: $widthArray[$i]<br/>";
		

		
		}
		
		$countProcessedPics = $r;
		
		$aggregateWidth = 0; // Gesammelte Breite wieder zurück auf Null setzen
		
		$last[$r] = 'on';
		
	//	echo "<br/>countProcessedPics: $countProcessedPics<br/>";
	
	}
	
	// Wenn die gesammelte Breite größer als die Gesamtbreit ist, dann wird runterskaliert oder abgeschnitten
	elseif($aggregateWidth > $widthmain){
	
	// Größe des Überhangs
	$overhang = $aggregateWidth - $widthmain;
	
	$overhangInPercent = $overhang*100/$widthmain;
	
//	echo "<br/>overhangInPercent: $overhangInPercent<br/>";
	
	
			// Wenn der Überhang nur unter 10% ist dann werden die Bilder NUR runterskaliert	 		
			if ($overhangInPercent <= 10) {
			
			
				for ($i = $countProcessedPics; $i < $r; $i++) {
				
			//	echo "<br>Variante 2:<br/>";
			//	echo "<br/>widthArray[$i]: $widthArray[$i]<br/>";
				
				$newWidth = $widthArray[$i]/100*(100-$overhangInPercent);
				$newHeight = $heightArray[$i]/100*(100-$overhangInPercent);
				$widthArray[$i] = $newWidth+11;
				$heightArray[$i] = ceil($newHeight);
				$widthDivArray[$i] = $newWidth;
				
		//		echo "<br/>Neue Breite: $newWidth<br/>";
		//		echo "<br/>widthArray[$i]: $widthArray[$i]<br/>";
				
				}
				
				$countProcessedPics = $r;
				
				$last[$r] = 'on';
				
			//	echo "<br/>countProcessedPics: $countProcessedPics<br/>";
			
			}
			
			// Wenn der Überhang nur über 10% und unter 46% ist dann werden die Bilder abgeschnitten und runterskaliert			
			if ($overhangInPercent > 10 AND $overhangInPercent <=46) {
			
			
				for ($i = $countProcessedPics; $i < $r; $i++) {
				
		//		echo "<br>Variante 3:<br/>";
		//		echo "<br/>overhangInPercent: $overhangInPercent<br/>";
			//	echo "<br/>widthArray[$i]: $widthArray[$i]<br/>";
				

				$newWidth = $widthArray[$i]/100*90;
				$newHeight = $heightArray[$i]/100*90;
				$widthArray[$i] = $newWidth+4;
				$heightArray[$i] = ceil($newHeight);
				$widthDivArray[$i] = $newWidth;
				
			//	echo "<br/>Neue Breite: $newWidth<br/>";
			//	echo "<br/>widthArray[$i]: $widthArray[$i]<br/>";
				 				
				}
				
				$countProcessedPics = $r;
				
				$last[$r] = 'on';
				
			//	echo "<br/>countProcessedPics: $countProcessedPics<br/>";
			
			}
			
			// Wenn der Überhang über 46% ist dann werden die Bilder abgeschnitten und runterskaliert. Beim letzten in der Reihe wird alles was über 46% ist komplett abgeschnitten.		
			if ($overhangInPercent > 46) {
			
			
				for ($i = $countProcessedPics; $i < $r; $i++) {
				
			//	echo "<br/>Variante 4: $newWidth<br/>";
				
				$newWidth = $widthArray[$i]/100*90;
				$newHeight = $heightArray[$i]/100*90;
				$widthArray[$i] = $newWidth;
				$heightArray[$i] = ceil($newHeight);
				$widthDivArray[$i] = $widthDivArray[$i]/100*(100-36);
				 				
				}
				
				$countProcessedPics = $r;
				
				$last[$r] = 'on';
				
		//		echo "<br/>countProcessedPics: $countProcessedPics<br/>";
			
			}
			
	$aggregateWidth = 0; // Gesammelte Breite wieder zurück auf Null setzen
	
	}
	  

	   }  
	   
	     // 1. Die neue Höhe jedes einzelnen Bildes muss ermittelt werden. Diese wird in einem Array gesammelt. ---- ENDE
		 
		 // 2. Ausgabe der Bilder nach dem die Höhe ermittelt wurde
		 
		    $h = 0;
			$i = 0;
			$aggregateWidth = 0;
			
			foreach($picsSQL as $value){
			
			$id = $value->id;
			$Timestamp = $value->Timestamp.'_';
			$NamePic = $value->NamePic;
			$ImgType = $value->ImgType;
			$rating = $value->Rating;
			$countR = $value->CountR;
			$countC = $value->CountC;
			
			$realId = $id;
			
			// Verschlüsselung der ID
			$id = ($id+8)*2+100000;

			// Feststellen der Quelle des Original Images		
			// $sourceOriginalImg = $uploadFolder['basedir'].'/contest-gal1ery/gallery-id-'.$galeryID.'/'.$Timestamp.$NamePic.'.'.$ImgType; // Pfad zum Bilderordner angeben
			//list($widthOriginalImg, $heightOriginalImg) = getimagesize($sourceOriginalImg); // Breite und Höhe von original Image
			
			$sourceOriginalImg = $uploadFolder['basedir'].'/contest-gal1ery/gallery-id-'.$galeryID.'/'.$Timestamp.$NamePic.'.'.$ImgType; // Pfad zum Bilderordner angeben
			list($widthOriginalImg, $heightOriginalImg) = getimagesize($sourceOriginalImg); // Breite und Höhe von original Image
	

			$widthDiv = $widthDivArray[$i].'px';
			if ($last[$i+1] == 'on'){$widthDiv = $widthmain-$aggregateWidth.'px'; $aggregateWidth = 0;} else{$aggregateWidth = $aggregateWidth + $widthDiv;}
			
			
			$width = $widthArray[$i].'px';
			$height = $heightArray[$i].'px';
			
			$widthPic = $widthArray[$i]+2;
			$widthPic1 = $widthPic.'px';
			
			$heightPic = $heightArray[$i]+2;
			$heightPic1 = $heightPic.'px';
			
		//	echo "<br>height : $height ";
		//	echo "<br>heightPic : $heightPic ";
			
			//echo "TESDTS";
			
			$paddinLeftRight = ($width-$widthDiv)/2;
			$paddinLeftRight = $paddinLeftRight.'px';

			
			//echo "<br/>widthDiv: $widthDiv<br/>";
			//echo "<br/>width: $width<br/>";
			//echo "<br/>paddinLeftRight: $paddinLeftRight<br/>";
			
			
			// je nach Breite wird entsprechendes Bild gewählt
			if($width <= 300) {$imageThumb = $NamePic."-300width.".$ImgType; $imageThumbFirstSize = $imageThumb;}		
			if($width > 300 AND $width <= 624) {$imageThumb = $NamePic."-624width.".$ImgType; $imageThumbSecondSize = $imageThumb;}		
			if($width > 624 AND $width <= 1024) {$imageThumb = $NamePic."-1024width.".$ImgType; $imageThumbThirdSize = $imageThumb;}		
			if($width > 1024) {$imageThumb = $NamePic.'.'.$ImgType; $imageThumbFourthSize = $imageThumb;}
			  

			  
			// Ermitteln Anzahl der Bewertungen
					
			// Ermitteln wie die Stars angezeigt werden sollen beim hovern
			
			if ($countR!=0){
				$averageStars = $rating/$countR;
				$averageStarsRounded = round($averageStars,0);
				//echo "<br>averageStars: $averageStars<br>";
				
			}
			else{$countR=0; $averageStarsRounded = 0;}
			 


			//echo "<br>averageStarsRounded: $averageStarsRounded<br>";

		//	$star_off_gallery = 'star_off_gallery';
		//	$star_on_gallery = 'star_on_gallery';

		//	$star1 = 'star_on_gallery';
		//	$star2 = 'star_on_gallery';
		//	$star3 = 'star_on_gallery';
		//	$star4 = 'star_on_gallery';
		//	$star5 = 'star_on_gallery';


/*
			if($averageStarsRounded>=1){$star1 = "cgn$realId-1";}
			else{$star1 = "cgo$realId-1";}
			if($averageStarsRounded>=2){$star2 = "cgn$realId-2";}
			else{$star2 = "cgo$realId-2";}
			if($averageStarsRounded>=3){$star3 = "cgn$realId-3";}
			else{$star3 = "cgo$realId-3";}
			if($averageStarsRounded>=4){$star4 = "cgn$realId-4";}
			else{$star4 = "cgo$realId-4";}
			if($averageStarsRounded>=5){$star5 = "cgn$realId-5";}
			else{$star5 = "cgo$realId-5";}*/
			
			
			$iconsURL = content_url().'/plugins/contest-gal1ery/css';
			
			if($averageStarsRounded>=1){$starTest1 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest1 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=2){$starTest2 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest2 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=3){$starTest3 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest3 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=4){$starTest4 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest4 = $iconsURL.'/star_off_48_reduced.png';}
			if($averageStarsRounded>=5){$starTest5 = $iconsURL.'/star_48_reduced.png';}
			else{$starTest5 = $iconsURL.'/star_off_48_reduced.png';}
			
			// Ermitteln wie die Stars angezeigt werden sollen ---- ENDE   
			  
			  
			  
	  
					// Hide Klasse ist die Div Box zum Hovern 
				echo <<<HEREDOC
		<div style='float:left;width:$widthDiv;height:$height;display:none;' class='show' >
								<input type="hidden" class="DistancePics" value="$DistancePics">
				<input type="hidden" class="DistancePicsV" value="$DistancePicsV">
		<input type="hidden" class="WidthThumb" value="$WidthThumb">	
		<input type="hidden" class="HeightThumb" value="$HeightThumb">	
		<input type="hidden" class="widthOriginalImg" value="$widthOriginalImg">
		<input type="hidden" class="heightOriginalImg" value="$heightOriginalImg">		
		<input type="hidden" class="srcOriginalImg" value="$uploads/$Timestamp$imageThumb">
				<input type="hidden" class="srcOriginalImg" value="$uploads/$Timestamp$NamePic.$ImgType">
		<input type="hidden" class="src1024width" value="$uploads/$Timestamp$NamePic-1024width.$ImgType">
		<input type="hidden" class="src624width" value="$uploads/$Timestamp$NamePic-624width.$ImgType">
		<input type="hidden" class="src300width" value="$uploads/$Timestamp$NamePic-300width.$ImgType">


HEREDOC;
echo "<div class='append'>";
echo "<a href='$siteURL&picture_id=$id&1=".$getLook."&2=".$getOrder."&3=".$getStart."#cg-begin' >";		

//	<img alt='$commentText' src='$uploads/$Timestamp$imageThumb' style='cursor: pointer;$padding;position: absolute !important;max-width:none !important;' class='cg_image' width='$WidthThumbPic' >

	echo <<<HEREDOC
	
		
		<img src='$uploads/$Timestamp$imageThumb'  style='position:absolute;left: $paddinLeftRight;right:  $paddinLeftRight ;max-width:none !important;' width='$widthPic1' height='$heightPic1' class='cg_image'>
		
		
		</a>
HEREDOC;
echo "</div>";



echo "<input type='hidden'  class='hrefCGpic' value='$siteURL&picture_id=$id&1=".$getLook."&2=".$getOrder."&3=".$getStart."#cg-begin' >";



if($AllowComments==1 or $AllowComments==1){
	echo "<div style='position:absolute;bottom:0px;background: rgba(0, 0, 0, 0.8);padding-top:3px;padding-bottom:10px;width:$WidthThumbPx;padding-left:3px;font-size:18px;clear: both;' class='hide' >";
//		echo "<a onClick='document.getElementById(\"cg-img-$id\").click()' >";//<img src='$urlTransparentPic' style='cursor: pointer;position:absolute;z-index:20;width:$WidthThumbPx;height:$HeightThumbPx;'>";
//		echo "</a>";

		if($AllowComments==1){
		echo "<div style='display:block !important;width:$WidthThumbPx;color: #fff;font-size:18px;padding:0px;margin:0px;clear: both;height: 18px;line-height: 18px;' id='rating_cgc-$realId'> <b>Comments ($countC)</b></div>";
		}
								if($AllowRating==1){
									  /*echo "<div style='display:block;height:20px;color:#fff;font-size:18px;text-align:left;float:left;padding-top:3px;'>";
									  echo "<ul class='ul-cgrating'>";
									  echo "<li class='$star1' ><a alt='1'></a></li>";
									  echo "<li class='$star2' ><a alt='2'></a></li>";
									  echo "<li class='$star3' ><a alt='3'></a></li>";
									  echo "<li class='$star4' ><a alt='4'></a></li>";
									  echo "<li class='$star5' ><a alt='5'></a></li>";
									  echo "</ul>";
									  echo "";
									  echo "<b>($countR)</b>";
									  echo "</div>";*/
									  
									  	  echo "<div style='padding-top:2px;'>";
										  //echo "<div style='width:85px;margin:0px;padding:0px;display:inline;float:left;height:20px;clear: both;'>";
									  /*echo "<img src='$starTest1' style='float:left;;'>";
									  echo "<img src='$starTest2' style='float:left;'>";
									  echo "<img src='$starTest3' style='float:left;;'>";
									  echo "<img src='$starTest4' style='float:left;'>";
									  echo "<img src='$starTest5' style='float:left;'>";									  
									  echo "<p  style='float:left;'><b>($countR)</b></p>";	*/		
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest1' style='float:left;cursor:pointer;' alt='1' id='cg_rate_star1'></div>";
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest2' style='float:left;cursor:pointer;' alt='2' id='cg_rate_star2'></div>";
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest3' style='float:left;cursor:pointer;' alt='3' id='cg_rate_star3'></div>";
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest4' style='float:left;cursor:pointer;' alt='4' id='cg_rate_star4'></div>";
						  echo "<div style='display:inline;float:left;width:17px;height:16px;vertical-align: middle;'><img src='$starTest5' style='float:left;cursor:pointer;' alt='5' id='cg_rate_star5'></div>";
						  //echo "</div>";
						  echo "<div style='display:inline;float:left;font-size:18px;v-align: top;line-height: 18px;height: 18px;color:#fff;' id='rating_cg-$pictureID' class='rating_cg'><b>&nbsp;($countR)</b></div>";										  
									  echo "</div>";
									 // echo "<div style='display:inline;float:left;margin:0px;padding:0px;font-size:18px;width:30px;'> &nbsp;<b>($countR)</b></div>";
									  
									//  echo "</div>";
								}

		//include("stars-thumb-look.php");

	echo "</div>";
				}


echo "</div>";


$i++;

			  
			  
			  }
	   
	   	// 2. Ausgabe der Bilder nach dem die Höhe ermittelt wurde --- ENDE
	   
	   
		
		
		echo "</div>";


		}		
		
		// Zeige Galerie. Abfrage Bildertabelle. ---END---
		
	
		//echo "</div>";

// 
// --- Weitere Galerie Bilder anzeigen 

/*
echo "<div class='werte'>";

echo "</div>";*/




	$nr1 = $start + 1;


	
	echo "<br/>";
	
	echo "<div style='clear:both;padding-top:20px;'>"; 
	
	
	//echo "<br>siteURL: $siteURL<br>";
	//echo "<br>Start: $start<br>";
	//echo "<br>step: $step<br>";
	//echo "<br>rows: $rows<br>";
	

	for ($i = 0; $rows > $i; $i = $i + $step) {
	  $anf = $i + 1;
	  $end = $i + $step;

	  if ($end > $rows) {
		$end = $rows;
	  }
		
		if ($anf == $nr1 AND ($start+$step) > $rows AND $start==0) {$start = $i;
	    continue;
		echo "<div style='display:inline;float:left;margin-right:10px;'>[ <strong><u><a href='$siteURL&1=".$getLook."&2=".$getOrder."&3=".$start."#cg-begin'>$anf-$end</a></u></strong> ]</div>";
	  } 
	  
	  	 elseif ($anf == $nr1 AND ($start+$step) > $rows AND $anf==$end) {$start = $i;
	    
		echo "<div style='display:inline;float:left;margin-right:10px;'>[ <strong><u><a href='$siteURL&1=".$getLook."&2=".$getOrder."&3=".$start."#cg-begin'>$anf-$end</a></u></strong> ]</div>";
	  } 
			
	  
	    elseif ($anf == $nr1 AND ($start+$step) > $rows) {$start = $i;
	    
		echo "<div style='display:inline;float:left;margin-right:10px;'>[ <strong><u><a href='$siteURL&1=".$getLook."&2=".$getOrder."&3=".$start."#cg-begin'>$anf-$end</a></u></strong> ]</div>";
	  } 
	  
		elseif ($anf == $nr1) {$start = $i;
			echo "<div style='display:inline;float:left;margin-right:10px;'>[ <strong><u><a href='$siteURL&1=".$getLook."&2=".$getOrder."&3=".$start."#cg-begin'>$anf-$end</a></u></strong> ]</div>";
	  } 
	  
	  	elseif ($anf == $end) {$start = $i;
		echo "<div style='display:inline;float:left;margin-right:10px;'>[ <a href='$siteURL&1=".$getLook."&2=".$getOrder."&3=".$start."#cg-begin'>$anf-$end</a> ]</div>";
	}
	  
	  else {$start = $i;
		echo "<div style='display:inline;float:left;margin-right:10px;'>[ <a href='$siteURL&1=".$getLook."&2=".$getOrder."&3=".$start."#cg-begin'>$anf-$end</a> ]</div>";
	  }
	 }
	 

// Formular zum Übertragen von Hidden Werten	


	 

	 
	echo "</div>";
	
	
	
/*		


	for ($i = 0; $rows > $i; $i = $i + $step) {
	  $anf = $i + 1;
	  $end = $i + $step;

	  if ($end > $rows) {
		$end = $rows;
	  }
		
		if ($anf == $nr1 AND ($start+$step) > $rows AND $start==0) {
	    continue;
		echo "<div style='display:inline;float:left;'>[ <strong><a href='$siteURL"."start=$i"."&choose=$rowImages&look=$look'>$anf-$end</a></strong> ]</div>";
	  } 
	  
	  	 elseif ($anf == $nr1 AND ($start+$step) > $rows AND $anf==$end) {
	    
		echo "<div style='display:inline;float:left;'>[ <strong><a href='$siteURL"."start=$i"."&choose=$rowImages&look=$look'>$end</a></strong> ]</div>";
	  } 
			
	  
	    elseif ($anf == $nr1 AND ($start+$step) > $rows) {
	    
		echo "<div style='display:inline;float:left;'>[ <strong><a href='$siteURL"."start=$i"."&choose=$rowImages&look=$look'>$anf-$end</a></strong> ]</div>";
	  } 
	  
		elseif ($anf == $nr1) {
			echo "<div style='display:inline;float:left;'>[ <strong> <a href='$siteURL"."start=$i"."&choose=$rowImages&look=$look'>$anf-$end</a></strong> ]</div>";
	  } 
	  
	  	elseif ($anf == $end) {
		echo "<div style='display:inline;float:left;'>[ <a href='$siteURL"."start=$i"."&choose=$rowImages&look=$look'>$end</a>  ]</div>";
	  }
	  
	  else {
		echo "<div style='display:inline;float:left;'>[ <a href='$siteURL"."start=$i"."&choose=$rowImages&look=$look'>$anf-$end</a>  ]</div>";
	  }
	 }



*/

	
	
?>