<?php

// SQL zum Ermitteln von allen Komments mit gesendeter picture id


		/*echo "<br>tablenameComments: $tablenameComments<br>";
		echo "<br>galeryID: $galeryID<br>";
		echo "<br>pictureID: $pictureID<br>";
		echo "<br>start: $start<br>";
		echo "<br>order: $order<br>";
		echo "<br>step: $step<br>"; */


		
		
		if(!$select_comments){
		$select_comments = $wpdb->get_results( "SELECT * FROM $tablenameComments WHERE pid='$pictureID' ORDER BY Timestamp DESC" );
		}
		


		echo "<br>";
		
		//print_r($select_comments);
		
		if($select_comments){  
		foreach($select_comments as $value){
		
		$id = $value->id;
		$name = htmlspecialchars($value->Name);
		$date = htmlspecialchars($value->Date);
		$timestamp = $value->Timestamp;
		$comment = nl2br(htmlspecialchars($value->Comment));
		$comment1 = $value->Comment;
		
		

		echo "<div style='margin-bottom:20px;margin-top:20px;'>";
		echo "<hr style='width:$widthCommentArea;margin-left:0px;'>";
		echo "<div><b>$name</b> ";
		echo "(<div id='cg-comment-$id' style='display:inline;'></div>):</div>";
		echo "<br/>";
		
		
?>
<script>



var getTimestamp = <?php echo json_encode($timestamp);?>;
var id = <?php echo json_encode($id);?>;

var commentDate = new Date(getTimestamp*1000);

var month = parseInt(commentDate.getMonth());
	month = month+1;

var monthUS = month;

	
	commentDate = commentDate.getFullYear()+"/"+monthUS+"/"+commentDate.getDate()+" "+commentDate.getHours()+":"+commentDate.getMinutes();
	
	//alert(id);
	
	var div = document.getElementById("cg-comment-"+id);
	
	div.innerHTML = div.innerHTML + commentDate;
	
//$( "#cg-comment-"+id ).append( commentDate );	


//alert(commentDate);

</script>



<?php
		
		
		echo "$comment1";
		echo "</div>";
		
			}
			
				//echo "<br>";
				echo "<hr style='width:$widthCommentArea;margin-left:0px;'>";
	//echo "<hr style='padding:0px;margin:0px;width:$widthCommentArea;'>";
		
		}


?>