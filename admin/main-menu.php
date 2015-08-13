<?php
// Path to jquery Lightbox Script

$siteURL = get_site_url()."/wp-admin/admin.php";







?>
<script type="text/javascript">

var siteURL = <?php echo json_encode($siteURL);?>;

function checkMe(arg) {

var del = arg;

    if (confirm("Are you sure you want to delete this gallery (id "+del+")? All uploaded pictures and entries will be irrevocable deleted.")) {
        //alert("Clicked Ok");
		//confirmForm(); 
		//fDeleteFieldAndData(del);
		//e.preventDefault();
		//window.location.href = '?page=contest-gal1ery/index.php&delete=true&option_id='+del+'';
		window.location.replace(siteURL+'?page=contest-gal1ery/index.php&delete=true&option_id='+del+'');
	    return true;
    } else {
        //alert("Clicked Cancel");
        return false;
    }
}

</script>
<?php

$permalinkURL = get_site_url()."/wp-admin/admin.php";

//echo "$permalinkURL 2323242";

	global $wpdb;

	$tablename = $wpdb->prefix . "contest_gal1ery_options";

	$selectSQL = $wpdb->get_results( "SELECT * FROM $tablename ORDER BY id ASC" );
	
	echo '<div class="main-table">';
	
	echo "<table style='border: 1px solid #DFDFDF;background-color:#ffffff;' width='635px'>";
	echo "<tr><td style='padding-left:20px;overflow:hidden;' colspan='4'><p><h2>Contest Gallery</h2></p></td></tr>";
	echo "</table>";
	echo "<br/>";
	
	

		foreach($selectSQL as $value){

			$option_id = $value -> id;
			
			if ($option_id % 2 != 0) {
			$backgroundColor = "#DFDFDF";
			} else {
			$backgroundColor = "#ECECEC";
			}
			
		echo "<table width='635px' style='border: 1px solid #DFDFDF;background-color:#ffffff;'>";

			echo "<tr style='background-color:#ffffff;'>";
			
			echo "<td style='padding-left:20px;width:50px;' ><p>ID: $option_id</p></td>";
			echo "<td align='center'><p>Shortcode: <strong>[cg_gallery id = \"".$option_id."\"]</strong></p></td>";				
			echo '<td align="center"><p><form action="?page=contest-gal1ery/index.php&option_id='.$option_id.'&edit_gallery=true" method="POST" ><input type="hidden" name="option_id" value="'.$option_id.'">';
			echo '<input type="hidden" name="page" value="contest-gal1ery/index.php"><input name="" value="Edit" type="Submit" style="text-align:center;width:70px;background:linear-gradient(0deg, #bbe0ef 5%, #90d4f0 70%);"></form></p></td>';	
			echo '<td align="center"><p><form action="?page=contest-gal1ery/index.php" method="GET" ><input type="hidden" name="option_id" value="'.$option_id.'">';
			echo '<input type="hidden" name="delete" value="true"><input type="button" value="Delete" onClick="return checkMe('.$option_id.')" style="text-align:center;width:70px;background:linear-gradient(0deg, #fef050 5%, #fce129 70%);"></form></p></td>';
			//echo '<td style="padding-left:100px;padding-right:20px;"><p><form action="?page=contest-gal1ery/index.php&option_id=' . $option_id . '&delete=true" method="GET" ><input value="L&ouml;schen" type="Submit"></form></p></td>';
			
			echo "</tr>";
		
		echo "</table>";
			
			}
			
	$option_id++;

echo "<br/>";

// Die nexte ID des Option Tables ermitteln
	$last = $wpdb->get_row("SHOW TABLE STATUS LIKE '$tablename'");
			$nextID = $last->Auto_increment;

echo "<table style='border: 1px solid #DFDFDF;background-color:#ffffff;' width='635px'>";	
 	echo '<tr><td style="padding-left:20px;overflow:hidden;" colspan="4"><p><form action="?page=contest-gal1ery/index.php&option_id='.$option_id.'&edit_gallery=true&create=true" method="POST" ><input type="hidden" name="option_id" value="'.$nextID.'">';
	echo '<input type="hidden" name="create" value="true"><input type="hidden" name="page" value="contest-gal1ery/index.php"><input name="" value="New gallery" type="Submit"></form></p></td></tr>';	
 	//echo '<tr><td style="padding-left:20px;overflow:hidden;" colspan="4"><p><a href="?page=contest-gal1ery/index.php&option_id=' . $option_id . '&create=true" class="classname">Neue Galerie</a></p></td></tr>';	
 	//echo '<tr><td style="padding-left:20px;overflow:hidden;" colspan="4"><p><a href="?page=contest-gal1ery/index.php&option_id=' . $option_id . '&create=true" class="classname">Neue Galerie</a></p></td></tr>';	
	
	echo "</table>";

	echo '</div>';
	
?>