<?php

		echo "<table style='border: 1px solid #DFDFDF;width:937px;background-color:#ffffff;'>";	
		echo "<tr style='background-color:#ffffff;'>";
		
		
	
		echo "<td style='padding-left:20px;padding-right:50px;'>";
		
		
		echo"&nbsp;&nbsp;Show pics per Site:";

		echo"&nbsp;<a href=\"?page=contest-gal1ery/index.php&option_id=$GalleryID&step=10&start=$i&edit_gallery=true\">10</a>&nbsp;";
		echo"&nbsp;<a href=\"?page=contest-gal1ery/index.php&option_id=$GalleryID&step=20&start=$i&edit_gallery=true\">20</a>&nbsp;";
		echo"&nbsp;<a href=\"?page=contest-gal1ery/index.php&option_id=$GalleryID&step=50&start=$i&edit_gallery=true\">50</a>&nbsp;";
		echo"&nbsp;<a href=\"?page=contest-gal1ery/index.php&option_id=$GalleryID&step=100&start=$i&edit_gallery=true\">100</a>&nbsp;";
		echo"&nbsp;<a href=\"?page=contest-gal1ery/index.php&option_id=$GalleryID&step=200&start=$i&edit_gallery=true\">200</a>&nbsp;";
		
		echo "</td>";
		 /*  */
		echo "<td>";
		

		
	// Determine if User should be informed or not>>>END
		
	
		echo "</td>";
		
	echo "<td>";
	echo "<input type='hidden' name='GalleryID' value='$GalleryID' method='post'>";
	echo "</td>";
	echo "<td style='padding-right:51px;text-align:right;'>";
	echo '&nbsp;&nbsp;Choose all: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" value="alle auswählen " id="chooseAll">';
	echo "<input type='hidden' id='click-count' value='0'>";
	//echo '&nbsp;&nbsp;Alle benachrichtigen: <input type="checkbox" value="alle auswählen " onClick="informAll()" id="informAll" disabled ><br/>';
	//echo '&nbsp;&nbsp;Nochmal benachrichtigen: <input type="checkbox" value="alle auswählen " onClick="informAll()" class="informAll" disabled ><br/>';
	echo "</td>";
		
 
		
	echo "</tr>";

echo "</table>";

	
    for ($i = 0; $rows > $i; $i = $i + $step) {
	
	  $anf = $i + 1;
	  $end = $i + $step;

	  if ($end > $rows) {
		$end = $rows;
	  }
		
		if ($anf == $nr1 AND ($start+$step) > $rows AND $start==0) {
	    continue;
		echo "[<strong><a href=\"?page=contest-gal1ery/index.php&option_id=$GalleryID&step=$step&start=$i&edit_gallery=true\">$anf-$end</a></strong> ] ";
	  } 
	  
	  	 elseif ($anf == $nr1 AND ($start+$step) > $rows AND $anf==$end) {
	    
		echo "[<strong><a href=\"?page=contest-gal1ery/index.php&option_id=$GalleryID&step=$step&start=$i&edit_gallery=true\">$end</a></strong> ] ";
	  } 
			
	  
	    elseif ($anf == $nr1 AND ($start+$step) > $rows) {
	    
		echo "[<strong><a href=\?page=contest-gal1ery/index.php&option_id=$GalleryID&step=$step&start=$i&edit_gallery=true\">$anf-$end</a></strong> ] ";
	  } 
	  
		elseif ($anf == $nr1) {
			echo "[<strong> <a href=\"?page=contest-gal1ery/index.php&option_id=$GalleryID&step=$step&start=$i&edit_gallery=true\">$anf-$end</a></strong>] ";
	  } 
	  
	  	elseif ($anf == $end) {
		echo "[  <a href=\"??page=contest-gal1ery/index.php&option_id=$GalleryID&step=$step&start=$i&edit_gallery=true\">$end</a>  ] ";
	  }
	  
	  else {
		echo "[  <a href=\"?page=contest-gal1ery/index.php&option_id=$GalleryID&step=$step&start=$i&edit_gallery=true\">$anf-$end</a>  ] ";
	  }
	 }


?>