jQuery(document).ready(function($){
jQuery( document ).on( 'click', '#cg_submit', function() {
	
	
	//alert("cg-comment");
	
	// var cg_given_rating=$(this).find('a').attr('alt');
	
		 var name = $("#cg_name").val();
	 var comment = $("#cg_comment").val();
	 var checkID = $("#cg_check").val();
	 var email = $("#email").val();
	 var timestamp = $("#timestamp").val();
	 var cg_galery_id = $('#cg_galery_id').val();
	 var cg_picture_id = $('#cg_picture_id').val();
	 //var cg_rate_value = cg_given_rating;
	 var cg_actual_value_id = $('#cg_actual_value_id').val();
	// var cg_rating_picture_id = "#rating_cg-"+cg_picture_id+"";
	
	 	 
	 	 
	 //	var check = <?php echo json_encode($check);?>;
	 

	 //var pictureID = <?php echo json_encode($pictureID);?>;
	 //var galeryID = <?php echo json_encode($galeryID);?>;
	 var widthCommentArea = $('#widthCommentArea').val();
	 var pathSetComment = $('#pathSetComment').val();
	 
	 //alert("check: "+check);
	 
	     // your existing submit code here
    // requesting my data..
	
	var nameLength = $("#cg_name").val().length;
	var commentLength = $("#cg_comment").val().length;
	


	// var allowSubmit = 0;
	 
	var allowSubmit = 1;
	
	
	//var post_id = jQuery(this).data('id');
	//var post_id = 657567;


	
	
		 if($('#'+checkID+'').is(':checked') ){
	 //alert(allowSubmit);
	 
		if(nameLength<2){
		$('#cg-hint-msg').empty();
		$('#cg-hint-msg').append("<br/<br/><b>The name field must contain two characters or more.</b><br>");
		}
		
		if(commentLength<3){
		$('#cg-hint-msgs').empty();
		$('#cg-hint-msg').append("<br/<br/><b>The comment field must contain three characters or more.</b><br>");
		}
	 
	 
		else if(allowSubmit==1){
			
			
			$('#show_comments').empty();
			$('#cg_name').val("");
			$('#cg_comment').val("");
			
	jQuery.ajax({
		url : post_cg_comment_wordpress_ajax_script_function_name.cg_comment_ajax_url,
		type : 'post',
		data : {
			action : 'post_cg_comment',
			action1 : name,
			action2 : comment,
			action3 : checkID,
			action4 : email,
			action5 : timestamp,
			action6 : cg_picture_id,
			action7 : cg_galery_id,
			action8 : widthCommentArea
			
		},
		success : function( response ) {
			jQuery("#show_new_comments").html( response );
		}
	});
		
		// Um zu vielen requests vorzubeugen
		var allowSubmit = 0;
		setTimeout(function(){ allowSubmit = 1; }, 5000);
									
		}
		else{
		alert("Wait 5 seconds till you can send again");
		$('#cg-hint-msg').empty();
		$('#cg-hint-msg').append("<br/<br/>Wait 5 seconds till you can send again<br>");
		}
	}
	
	else{
	$('#cg-hint-msg').empty();
	
		if(nameLength<2){
		$('#cg-hint-msg').append("<br/<br/>The name field must contain two characters or more.<br>");
		}
		
		if(commentLength<3){
		$('#cg-hint-msg').append("<br/<br/>The comment field must contain three characters or more.<br>");
		}
	
	$('#cg-hint-msg').append("<br/<br/>Plz check the checkbox to prove that you are not a robot.<br>");
	}
	
	return false;

})
})