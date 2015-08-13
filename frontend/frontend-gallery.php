<?php 



	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );
$galeryID = $atts['id'];

//echo "testststs";

//------------------------------------------------------------
// ----------------------------------------------------------- Bilder bewerten ----------------------------------------------------------
//------------------------------------------------------------

/*

if (($_GET['star1'] && $_GET['id']) == true AND $_GET['sc']==false) {

global $wpdb;

$ip = $_SERVER['REMOTE_ADDR'];

$tablename = $wpdb->prefix . "contest_gal1ery";
$tablename1 = $wpdb->prefix . "contest_gal1ery_ip";


	if (isset($_GET["id"])) {
	  $muster1 = "/^[0-9]+$/"; // reg. Ausdruck für Zahlen
	  if (preg_match($muster1, $_GET["id"]) == 0) {
		// Bei Manipulation Rückfall auf 0
		exit("Bitte manipulieren Sie die URL nicht!");
	  } else {
		$idGet = $_GET["id"];
		// Choose picture user want to rate
		$get1 = $wpdb->get_row( "SELECT * FROM $tablename WHERE id = '$idGet'" );
	  }
	}
	
		if (isset($_GET["star1"])) {
	  $muster1 = "/^[1-5]+$/"; // reg. Ausdruck für Zahlen
	  if (preg_match($muster1, $_GET["star1"]) == 0 OR $_GET["star1"]==0) {
		// Bei Manipulation Rückfall auf 0
		exit("Bitte manipulieren Sie die URL nicht!");
	  } else {
		$star = $_GET["star1"];
	  }
	}
	
//Select galery number
$GaleryNr= $get1->GaleryNr;	
	

$rating = "'".$idGet;
$rating .= "=1'";	
	
	
$get2 = $wpdb->get_row("SELECT * FROM $tablename1 WHERE IP = '$ip'");

if ($star>5 AND $star!=0){
echo "Bewertung nicht m&ouml;glich<br/>";
}
else {
if($get2 != 0){
//echo "<br/>Big_Test<br/>";

$getrating = $get2 -> Rating;

//echo "<br><b>$getrating</b><br>";

/*$getrating1 = '"$getrating"';
$proveRating1 = '"$proveRating"';

echo "$proveRating1";*/

//echo "<br/>$getrating<br/><br/>";

//$getrating,$proveRating

//$getrating1 = settype($getrating,"string");
//$proveRating1 = settype($proveRating,"string");
/*
$pos = strpos($getrating,$rating);

if ($pos){
echo "<h3 style='padding-left:77px;'>Sie haben das Bild bereits bewertet. Jedes Bild darf nur ein mal bewertet werden.<br/></h3>";
}
else{
$getratingUpdate = $getrating;
$getratingUpdate .= "'$rating',";
$wpdb->update( $tablename1, array('Rating' => $getratingUpdate), array('IP' => $ip) );
echo "<h3 style='padding-left:77px;'>Vielen Dank f&uuml;r Ihre Bewertung!</h3>";
}
}


if($get2 == 0){
$getratingUpdate = "'$rating',";
$wpdb->insert( $tablename1, array( 'id' => '', 'IP' => $ip, 'GaleryNr' => $GaleryNr, 'Rating' => $getratingUpdate ));
echo "<h3 style='padding-left:77px;'>Vielen Dank f&uuml;r Ihre Bewertung!</h3>";
// echo "Tabelle wird eingefügt!<br/>";
}

//else{echo "<br/><b>This IP already exists</b></br>";}

$bewertung = $get1->Bewertung;
$anzahlB = $get1->AnzahlB;


//echo $bewertung;
//echo $anzahlB;


$bewertungNeu = $bewertung+$star;

$anzahlNeu = $anzahlB+1;

 
// $wpdb->update( $tablename, array ('Bewertung' => "$bewertungNeu", 'AnzahlB' => "$anzahlNeu"), array('NamePic' => "$name"));

if ($pos==false){
$querySET6 = "UPDATE $tablename SET Bewertung='$bewertungNeu', AnzahlB='$anzahlNeu' WHERE id = '$idGet' ";

$updateSQL6 = $wpdb->query($querySET6);	
}

}

//$querySET2 = "UPDATE $tablenameOptions  SET DistancePics = '$DistancePics', PicsPerSite='$PicsPerSite', DistancePicsV='$DistancePicsV' WHERE id = '$id' ";


//$wpdb->query("INSERT INTO $tablename (id,Datum,Image,Name)VALUES('','$datumSQL','$newDestination','$dateiname')");


} */

?>


<?php 

//------------------------------------------------------------
// ----------------------------------------------------------- Einzelnes Userbild Kommentare ----------------------------------------------------------
//------------------------------------------------------------



if($_GET['picture_id']==true){

include_once('show-image.php');

}

elseif($_POST['comment']==true){

include_once('set-comment.php');

}



?>


<?php 

//------------------------------------------------------------
// ----------------------------------------------------------- Userbilder Galerie anzeigen !----------------------------------------------------------
//------------------------------------------------------------


if($_GET['picture_id']==false AND $_GET['comment']==false){

include_once('show-gallery-jquery.php');

}



?>
