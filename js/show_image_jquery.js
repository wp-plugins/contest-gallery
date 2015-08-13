jQuery(document).ready(function($){
	
		var check = $("#cg_check").val();

$("#checkbox").append("<input type='checkbox' value='"+check+"' name='"+check+"' id='"+check+"' '> I am not a robot<br/><br/>");

	  $( "#cg_arrow_left").hide();
	  $( "#cg_arrow_right").hide();


	/*
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));*/


		 $( "#cg_arrow_left" ).mouseout(function() {
	  $( "#cg_arrow_left").hide();
	  $( "#cg_arrow_right").hide();
	  });
	  
	  		 $( "#cg_arrow_right" ).mouseout(function() {
	  $( "#cg_arrow_left").hide();
	  $( "#cg_arrow_right").hide();
	  });

	  $( "#cg_img_gallery" ).mouseover(function() {
	  $( "#cg_arrow_left").toggle();
	  $( "#cg_arrow_right").toggle();
	  });
	  
		  $("#cg_arrow_left").mouseover(function() {
		  $("#cg_arrow_left").toggle();
          $("#cg_arrow_right").toggle();		  
		  });
		  
		  $("#cg_arrow_right").mouseover(function() {
		  $("#cg_arrow_left").toggle();
          $("#cg_arrow_right").toggle();		  
		  });
		  
		 $( "#cg_img_gallery" ).mouseout(function() {
	  $( "#cg_arrow_left").hide();
	  $( "#cg_arrow_right").hide();
	  }); 
		  
			  
		   
});