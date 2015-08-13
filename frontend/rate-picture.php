<?php


		$galeryID = intval($_REQUEST['action1']); 
		$pictureID = intval($_REQUEST['action2']); 
		$rateValue = intval($_REQUEST['action3']); 
		$actualValue = intval($_REQUEST['action4']);
		
		

//------------------------------------------------------------
// ----------------------------------------------------------- Bilder bewerten ----------------------------------------------------------
//------------------------------------------------------------



//global $wpdb;

$ip = $_SERVER['REMOTE_ADDR'];

//echo "<br>ip: $ip<br>";

//$tablename = $wpdb->prefix . "contest_gal1ery";
//$tablenameIP = $wpdb->prefix . "contest_gal1ery_ip";

$tablename = $wpdb->prefix ."contest_gal1ery";
$tablenameIP = $wpdb->prefix ."contest_gal1ery_ip";

//echo "$tablenameIP <br>";
//echo "$tablename <br>";

//echo "<br>pictureID-test: $pictureID<br>";
//echo "<br>rateValue-test: $rateValue<br>";

/*
	if ($pictureID) {
	  $muster1 = "/^[0-9]+$/"; // reg. Ausdruck für Zahlen
	  if (preg_match($muster1, $pictureID) == 0) {
		// Bei Manipulation Rückfall auf 0
		exit("Bitte manipulieren Sie die URL nicht!");
	  } else {
		// Choose picture user want to rate

	  }
	}
	
	if ($rateValue) {
	  $muster1 = "/^[1-5]+$/"; // reg. Ausdruck für Zahlen
	  if (preg_match($muster1, $rateValue) == 0 OR $rateValue==0) {
		// Bei Manipulation Rückfall auf 0
		exit("Bitte manipulieren Sie die URL nicht!");
	  } else {
		$star = $rateValue;
	  }
	}*/
	


if(!$rating){
$rating = 0;
}

if(!$countR){
$countR = 0;
}

//echo "<br>getRating-test: $getRating<br>";
//echo "<br>rating-test: $rating<br>";
//echo "<br>countR-test: $countR<br>";

//echo "getRating: $getRating";

	
if ($rateValue>5 or $rateValue<1){
echo "Rating is not allowed!<br/>";
}
else {
	
//$getRating = $wpdb->get_var( "SELECT Rating FROM $tablenameIP WHERE pid = '$pictureID' and GalleryID = '$galeryID' and IP = '$ip'" );

$getRating = $wpdb->get_var( $wpdb->prepare(
"
	SELECT COUNT(*) AS NumberOfRows
	FROM $tablenameIP 
	WHERE pid = %d and GalleryID = %d and IP = %d
", 
$pictureID,$galeryID,$ip
) );

//echo "<br>getrating: $getRating<br>";

		$getTotalRating = $wpdb->get_row( "SELECT CountR, Rating FROM $tablename WHERE id = '$pictureID' and GalleryID = '$galeryID'" );
	
$rating = $getTotalRating->Rating;
$countR = $getTotalRating->CountR;	


if ($getRating){
	
	$starON = plugins_url( '/../css/star_48.png', __FILE__ );
$starOFF = plugins_url( '/../css/star_off_48.png', __FILE__ );

$rating = round($rating/$countR,0);
	
if($rating>=1){$star1 = "cgin$pictureID-1"; $star1img = $starON;}
else{$star1 = "cgio$pictureID-1"; $star1img = $starOFF;}
if($rating>=2){$star2 = "cgin$pictureID-2";$star2img = $starON;}
else{$star2 = "cgio$pictureID-2"; $star2img = $starOFF;}
if($rating>=3){$star3 = "cgin$pictureID-3";$star3img = $starON;}
else{$star3 = "cgio$pictureID-3"; $star3img = $starOFF;}
if($rating>=4){$star4 = "cgin$pictureID-4";$star4img = $starON;}
else{$star4 = "cgio$pictureID-4"; $star4img = $starOFF;}
if($rating>=5){$star5 = "cgin$pictureID-5";$star5img = $starON;}
else{$star5 = "cgio$pictureID-5"; $star5img = $starOFF;}


  						  echo "<div style='width:110px;margin-top:15px;display:inline;float:left;'>";
						  echo "<img src='$star1img' class='$star1' style='float:left;cursor:pointer;' alt='1' id='cg_rate_star1'>";
						  echo "<img src='$star2img' class='$star2' style='float:left;cursor:pointer;' alt='2' id='cg_rate_star2'>";
						  echo "<img src='$star3img' class='$star3' style='float:left;cursor:pointer;' alt='3' id='cg_rate_star3'>";
						  echo "<img src='$star4img' class='$star4' style='float:left;cursor:pointer;' alt='4' id='cg_rate_star4'>";
						  echo "<img src='$star5img' class='$star5' style='float:left;cursor:pointer;' alt='5' id='cg_rate_star5'>";
						  echo "</div>";
						  echo "<div style='display:inline;float:left;margin-top:12px;' id='rating_cg-$pictureID' class='rating_cg'>($countR)</div>";
?>
<script>

alert("You have already rated this picture.");
 
 /*
var ratingPictureID = <?php echo json_encode("#rating_cgd-".$pictureID);?>;

var countR = <?php echo json_encode($countR);?>;	 

 
 alert(countR);
 alert(ratingPictureID);
 
 

	$(""+ratingPictureID+"").text("("+countR+")");*/


</script>
<?php

}
else{
	
	
//$wpdb->insert( $tablenameIP, array( 'id' => '', 'IP' => $ip, 'GalleryID' => $galeryID, 'pid' => $pictureID, 'Rating' => $rateValue ));

		$wpdb->query( $wpdb->prepare(
			"
				INSERT INTO $tablenameIP
				( id, IP, GalleryID, pid, Rating)
				VALUES ( %s,%d,%d,%d,%d )
			", 
				'',$ip,$galeryID,$pictureID,$rateValue
		 ) );


$cumulatedRating = $rating+$rateValue;

$newCountR = $countR+1;

$newRating = round($cumulatedRating/$newCountR,0);

 



//$querySET = "UPDATE $tablename SET Rating='$cumulatedRating', CountR='$newCountR' WHERE id = '$pictureID' ";
//$updateSQL = $wpdb->query($querySET);

				$wpdb->update( 
				"$tablename",
				array('Rating' => $cumulatedRating,'CountR' => $newCountR), 
				array('id' => $pictureID), 
				array('%d','%d'),
				array('%d')
				);








echo "<input type='hidden' id='rate_picture' value='on' />";

$starON = plugins_url( '/../css/star_48.png', __FILE__ );
$starOFF = plugins_url( '/../css/star_off_48.png', __FILE__ );


if($newRating>=1){$star1 = "cgin$pictureID-1"; $star1img = $starON;}
else{$star1 = "cgio$pictureID-1"; $star1img = $starOFF;}
if($newRating>=2){$star2 = "cgin$pictureID-2";$star2img = $starON;}
else{$star2 = "cgio$pictureID-2"; $star2img = $starOFF;}
if($newRating>=3){$star3 = "cgin$pictureID-3";$star3img = $starON;}
else{$star3 = "cgio$pictureID-3"; $star3img = $starOFF;}
if($newRating>=4){$star4 = "cgin$pictureID-4";$star4img = $starON;}
else{$star4 = "cgio$pictureID-4"; $star4img = $starOFF;}
if($newRating>=5){$star5 = "cgin$pictureID-5";$star5img = $starON;}
else{$star5 = "cgio$pictureID-5"; $star5img = $starOFF;}

  						  echo "<div style='width:110px;margin-top:15px;display:inline;float:left;'>";
						  echo "<img src='$star1img' class='$star1' style='float:left;cursor:pointer;' alt='1' id='cg_rate_star1'>";
						  echo "<img src='$star2img' class='$star2' style='float:left;cursor:pointer;' alt='2' id='cg_rate_star2'>";
						  echo "<img src='$star3img' class='$star3' style='float:left;cursor:pointer;' alt='3' id='cg_rate_star3'>";
						  echo "<img src='$star4img' class='$star4' style='float:left;cursor:pointer;' alt='4' id='cg_rate_star4'>";
						  echo "<img src='$star5img' class='$star5' style='float:left;cursor:pointer;' alt='5' id='cg_rate_star5'>";
						  echo "</div>";
						  echo "<div style='display:inline;float:left;margin-top:12px;' id='rating_cg-$pictureID' class='rating_cg'>($newCountR)</div>";


?>

 <script>
 
// alert("works");
/*
var newCountR = <?php echo json_encode($newCountR);?>;	
var newRating = <?php echo json_encode($newRating);?>;
var laufzeit = <?php echo json_encode($laufzeit);?>;
var starON = <?php echo json_encode($starON);?>;
var starOFF = <?php echo json_encode($starOFF);?>;


var ratingPictureID = <?php echo json_encode("#rating_cgd-".$pictureID);?>;

 alert("ratingPictureID: "+ratingPictureID);
 alert("newCountR: "+newCountR);
 alert("starON: "+starON);
 alert("starOFF: "+starOFF);

var countR = <?php echo json_encode($countR);?>;	

 

 //alert("You have already rated this picture.");
 
 alert(newCountR);
 alert(countR);
 alert(ratingPictureID);
 




	$("#ultimatetest1").append("<p>lalalalalala</p>");
	//$(document).text("("+newCountR+")");
	//$(""+ratingPictureID+"").text("("+newCountR+")");
	
	//alert(laufzeit);
	
	if(newRating>=1){$("#cgd_star1").attr("src",starON);}
	else{$("#cgd_star1").attr("src",starOFF);}
	if(newRating>=2){$("#cgd_star2").attr("src",starON);}
	else{$("#cgd_star2").attr("src",starOFF);}
	if(newRating>=3){$("#cgd_star3").attr("src",starON);}
	else{$("#cgd_star3").attr("src",starOFF);}
	if(newRating>=4){$("#cgd_star4").attr("src",starON);}
	else{$("#cgd_star4").attr("src",starOFF);}
	if(newRating>=5){$("#cgd_star5").attr("src",starON);}
	else{$("#cgd_star5").attr("src",starOFF);}
	 

 

*/

</script>
<?php






}

}










?>