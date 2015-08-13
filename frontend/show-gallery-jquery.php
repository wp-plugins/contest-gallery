<!-- <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>-->
<!-- <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>-->
<?php

include("get-data.php");




	
?>
<div id="mainCGdiv">
<?php

echo "<input type='hidden' id='cg_galeryID' value='$galeryID'>";
echo "<input type='hidden' id='cg_order' value='$order'>";
echo "<input type='hidden' id='cg_look' value='$look'>";
echo "<input type='hidden' id='cg_start' value='$start'>";
echo "<input type='hidden' id='cg_step' value='$step'>";
echo "<input type='hidden' id='cg_siteURL' value='$siteURL'>";
echo "<input type='hidden' id='cg_HeightLookHeight' value='$HeightLookHeight'>";
echo "<input type='hidden' id='cg_PicsInRow' value='$PicsInRow'>";
echo "<input type='hidden' id='cg_PicsPerSite' value='$PicsPerSite'>";

// Pfade Ordner bei show-image.php  --- ENDE

//echo "<br>order: $order<br>";

//print_r($picsSQL);

//print_r($picsSQL);
//echo "<br>look111: $look<br>";
include("show-gallery.php");


//$end1 = microtime(true);

//$laufzeit1 = $end1 - $start1; 

//echo "Laufzeit1: ".$laufzeit1." Sekunden!";


?>

</div>

<?php
/*
$fp = fopen($cachefile, 'w'); // open the cache file for writing
fwrite($fp, ob_get_contents()); // save the contents of output buffer to the file
fclose($fp); // close the file
ob_end_flush(); // Send the output to the browser */?>