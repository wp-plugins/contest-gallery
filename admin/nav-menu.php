<?php

	echo "<table style='border: 1px solid #DFDFDF;background-color:#ffffff;' width='937px;'>";
	echo "<tr><td align='center'><div style='width:180px;' ><br/>Contest Gallery<br/><b>Shortcodes</b><br/><br/></div></td>";
	echo "<td align='center'><div style='width:180px;' ><br/>Galery shortcode:<br/><strong>[cg_gallery_id=\"$GalleryID\"]</strong><br/><br/></div></td>";
	echo "<td align='center'><div style='width:180px;' ><br/>Upload form shortcode: <strong>[cg_users_upload=\"$GalleryID\"]</strong><br/><br/></div></td>";
	echo "<td align='center'><div style='width:180px;' ></div></td>"; 
	echo "</tr>";
	echo "</table>";
	
	echo "<br/>";

	echo "<table style='border: 1px solid #DFDFDF;background-color:#ffffff;' width='937px;'>";
	echo "<tr>";
	echo "<td align='center'><br/><div><form method='POST' action='?page=contest-gal1ery/index.php&option_id=$GalleryID&edit_gallery=true' ><input type='submit' value='&nbsp;<<< &nbsp;&nbsp;Back to gallery' style='text-align:left;width:180px;background:linear-gradient(0deg, #fef050 5%, #fcd729 70%);' /></form><br/></div></td>";
	echo "<td align='center'><br/><div><form method='POST' action='?page=contest-gal1ery/index.php&edit_options=true&option_id=$GalleryID' ><input type='submit' value='Edit options' style='text-align:center;width:180px;background:linear-gradient(0deg, #bbe0ef 5%, #90d4f0 70%);' /></form><br/></div></td>";
	echo "<td align='center'><br/><div><form method='POST' action='?page=contest-gal1ery/index.php&option_id=$GalleryID&define_upload=true'><input type='submit' value='Edit upload form' style='text-align:center;width:180px;background:linear-gradient(0deg, #bbe0ef 5%, #90d4f0 70%);' /></form><br/></div></td>"; 
	echo "<td align='center'><br/><div><form method='POST' action='?page=contest-gal1ery/index.php&inform_user=true&option_id=$GalleryID'><input type='submit' value='Edit e-mail text' style='text-align:center;width:180px;background:linear-gradient(0deg, #bbe0ef 5%, #90d4f0 70%);' /></form><br/></div></td>"; 
	echo "</tr>";
	
		echo "</table>";
		
		echo "<br/>";


?>