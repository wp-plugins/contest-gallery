<?php 

//------------------------------------------------------------
// ----------------------------------------------------------- Userbilder Galerie anzeigen !----------------------------------------------------------
//------------------------------------------------------------

function return_bytes($val) {
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

$unix = time();
$unixadd = $unix+2;


$maxigroesse = return_bytes(ini_get('upload_max_filesize'));

$galeryID = $_GET['option_id'];

foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){




$uploads = wp_upload_dir();
$WPdestination = $uploads['basedir'].'/contest-gal1ery/gallery-id-'.$galeryID.'/'; // Pfad zum Bilderordner angeben
if (isset($_FILES['files']) && $_FILES['files']['size'] > 0) {
  $tempname = $_FILES['files']['tmp_name'][$key];
  $dateiname = $_FILES['files']['name'][$key];
  //print_r($dateiname);
  $dateiname = strtolower($dateiname);
  //echo "<br>";
  //print_r($dateiname);
  $dateigroesse = $_FILES['files']['size'][$key];
  $dateityp = GetImageSize($tempname);
  
  /*$search = array();
  $search[] =' ';
  $search[] ='!';
  $search[] ='"';
  $search[] ='#';
  $search[] ='$';
  $search[] ='%';
  $search[] ='&';
  $search[] ="'";
  $search[] ='(';
  $search[] =')';
  $search[] ='*';
  $search[] ='+';
  $search[] =',';
  $search[] ='/';
  $search[] =':';
  $search[] =';';
  $search[] ='=';
  $search[] ='?';
  $search[] ='@';
  $search[] ='[';
  $search[] =']';*/
  $search = array(" ", "!", '"', "#", "$", "%", "&", "'", "(", ")", "*", "+", ",", "/", ":", ";", "=", "?", "@", "[", "]");
  //$replace = "_";
  
  $dateiname = str_replace($search,"_",$dateiname);
  
  // echo "<br>";
  //print_r($dateiname);
  
  //echo "<br/>$tempname";
  //echo "<br/>$dateiname";
  //echo "<br/>$dateigroesse";
  //echo "<br/>$dateityp";
  //echo "<br/>$dateityp[0]";
  //echo "<br/>$dateityp[1]";
  //echo "<br/>$dateityp[2]";
  
  
  if ($dateityp[2] == 1 || $dateityp[2] == 2 || $dateityp[2] == 3) { // GIF o. JPG?
    if ($dateigroesse <= $maxigroesse) { // Datei zu groß?
	
//----------------------------Upload file and save in database ---------------->	

      if (move_uploaded_file($tempname, $WPdestination . $unixadd . '_' . $dateiname)) {
       // echo "<p>Datei wurde <b>erfolgreich</b> hochgeladen!
//Dateigröße: <b>$dateigroesse</b> Byte, 
//Bildname: <b>$dateiname</b><br></p>";

/*	extract( shortcode_atts( array(
		'id' => '1'
	), $atts ) );
$galeryID = $atts['id'];*/

//----------------------------Create Thumbs and Galery pics ---------------->

global $wpdb;

$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";

$picsSQL1 = $wpdb->get_results( "SELECT * FROM $tablenameOptions WHERE id='$galeryID'");


require(dirname(__FILE__) . "/../../convert-several-pics.php");


//----------------------------Create Thumbs and Galery pics END ----------------//

//$testglobal = "test";

//$dateiname = $_FILES['files']['name'][$key];

if ($dateityp[2] == 1){
$GifJpgPng = 'gif';
}

if ($dateityp[2] == 2){
$GifJpgPng = 'jpg';
}

if ($dateityp[2] == 3){
$GifJpgPng = 'png';
}

/*
$filenameCropped = explode('.',$dateiname);
$thumbDestination = 'contest-gal1ery/thumb/';
$thumbDestination .= $unixadd . '_';
$thumbDestination .= $filenameCropped[0];
$thumbDestination .= '.jpg';

echo $dateiname;

$galeryDestination = 'contest-gal1ery/scaled/';
$galeryDestination .= $unixadd . '_';
$galeryDestination .= $filenameCropped[0];  
$galeryDestination .= '.jpg';

$originPicDestination = 'contest-gal1ery/origin/';
$originPicDestination .= $unixadd . '_';
$originPicDestination .= $filenameCropped[0];  
$originPicDestination .= $GifJpgPng;
*/

/*$NamePic = $unixadd . '_' . $dateiname;

$datum = date("d.m.Y");
$uhrzeit = date("H:i");
$datumSQL = $datum. " - " . $uhrzeit;*/
// $dateiname = 'test';
// $newDestination = 'test';

// [bartag foo="foo-value"]

global $wpdb;

$tablename = $wpdb->prefix . "contest_gal1ery";
//require_once('wp-config.php');

// Dateinamen ohne Endung rausbekommen

$dateiname = substr($dateiname,0,-4);

// Insert pic

//$wpdb->insert( $tablename, array( 'id' => '', 'rowid' => '', 'Timestamp' => $unixadd, 'NamePic' => $dateiname,
 //'ImgType' => $GifJpgPng, 'CountC' => 0, 'CountR' => '',  'Rating' => '',
 //'GalleryID' => $galeryID, 'Active' => '', 'Informed' => '' ) );
 
$wpdb->query( $wpdb->prepare(
	"
		INSERT INTO $tablename
		( id, rowid, Timestamp, NamePic,
		ImgType, CountC, CountR, Rating,
		GalleryID, Active, Informed )
		VALUES ( %s,%s,%d,%s,
		%s,%d,%s,%s,
		%d,%s,%s )
	", 
		'','',$unixadd,$dateiname,
		$GifJpgPng,0,'','',
		$galeryID,'',''
 ) );

// Insert Upload Fields for pic if exists

	

$maxIDquery = $wpdb->get_results( "SELECT id
FROM   $tablename
WHERE  id=(SELECT MAX(id) FROM $tablename WHERE rowid='0')");

foreach($maxIDquery  as $maxIDvalue){
$maxID = $maxIDvalue->id;
//echo $maxID;
}

//$querySETrow = "UPDATE $tablename SET rowid='$maxID' WHERE rowid = '0' ";

//$updateSQL5 = $wpdb->query($querySETrow);	

						$wpdb->update(
						"$tablename",
						array('rowid' => $maxID), 
						array('rowid' => '0'), 
						array('%d'),
						array('%d')
						);




      } else {
        echo "<p>Upload was not successfull</p>";
      } 
    } else {
      echo "<p>One of the files you have selected is bigger then max alowed <b>$maxigroesse Byte</b></p>";
	  break;
    } 
  } else {
    echo "<p>One the files you have selected is not a JPG, PNG or GIF file</p>";
	break;
  } 
  //echo "<form action='?page_id=30/hochladen.php' method='post'>
//<input type='submit' value='OK'></form>";

} 

}


?>



</body>
</html>