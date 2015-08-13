jQuery(document).ready(function($){
	


jQuery( document ).on( 'click', 'img[id*=cg_rate]', function(e) {
	
	
	//alert("cg-rate");
	
	 var cg_given_rating = $(this).attr('alt');
	
	 var cg_galery_id = $('#cg_galery_id').val();
	 var cg_picture_id = $('#cg_picture_id').val();
	 var cg_rate_value = cg_given_rating;
	 var cg_actual_value_id = $('#cg_actual_value_id').val();
	 var cg_rating_picture_id = "#rating_cgd-"+cg_picture_id+"";
	 
	 //alert(cg_given_rating);
	 
	 $("#cg_rate_stars_image").empty();
	 $("#rating_cg").empty();
	
	
	
	//var post_id = jQuery(this).data('id');
	//var post_id = 657567;
	jQuery.ajax({
		url : post_cg_rate_wordpress_ajax_script_function_name.cg_rate_ajax_url,
		type : 'post',
		data : {
			action : 'post_cg_rate',
			action1 : cg_galery_id,
			action2 : cg_picture_id,
			action3 : cg_rate_value,
			action4 : cg_actual_value_id			
		},
		success : function( response ) {
			//jQuery(""+cg_rating_picture_id+"").html( response );
			jQuery("#cg_rate_stars_image").html( response );
		}
	});

	return false;
})

})