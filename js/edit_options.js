jQuery(document).ready(function($){
	
	
	$( "#cg_questionJPG" ).hover(function() {
   $('#cg_answerJPG').toggle();
    $(this).css('cursor','pointer');
});

	$( "#cg_questionPNG" ).hover(function() {
   $('#cg_answerPNG').toggle();
    $(this).css('cursor','pointer');
});

	$( "#cg_questionGIF" ).hover(function() {
   $('#cg_answerGIF').toggle();
    $(this).css('cursor','pointer');
});

var v=0;

$(function() {
		$( "#cg_options_sortable" ).sortable({cursor: "move", placeholder: "ui-state-highlight", stop: function( event, ui ) {

	if(document.readyState === "complete"){

		$( ".cg_options_cg_options_sortableDiv" ).each(function( i ) {
			
			v++;
			  
			$(this).find('.cg_options_order').contents().filter(function(){ return this.nodeType == 1; }).remove();
			
			$(this).append('<p class="cg_options_order"><u>'+v+'. cg_options_order</u></p>');
						
			
					  
			   });  
			   
			   v = 0;
			   
			   }
			   
	   }	
		
		});
$('#cg_options_sortable').css('cursor', 'move');
});



// Allow only to press numbers as keys in input boxes

  //called when key is pressed in textbox
  $("#ScaleSizesGalery1, #ScaleSizesGalery2, #DistancePicsV, #DistancePicsV, #PicsInRow, #PicsPerSite, #DistancePics, #maxJPGres, #maxPNGres, #maxGIFres").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#cg_options_errmsg").html("Only numbers are allowed").show().fadeOut("slow");
               return false;
    }
   });


// Allow only to press numbers as keys in input boxes --- END
  
  
 // Check input when site is load

		
	// Check gallery
if($("#ScaleSizesGalery").is( ":checked" )){

//$( "#ScaleWidthGalery" ).attr("disabled",true);
$("#ScaleWidthGalery").prop("disabled",false);
}

else{
$( "#ScaleSizesGalery1" ).attr("disabled",true);
$( "#ScaleSizesGalery2" ).attr("disabled",true);
$( "#ScaleSizesGalery1" ).css({ 'background': '#e0e0e0' });
$( "#ScaleSizesGalery2" ).css({ 'background': '#e0e0e0' });

}

if($("#ScaleWidthGalery").is( ":checked" )){
//$( "#ScaleSizesGalery" ).attr("disabled",true);
$( "#ScaleSizesGalery2" ).attr("disabled",true);
$( "#ScaleSizesGalery2" ).css({ 'background': '#e0e0e0' });

}

if($("#ScaleWidthGalery").is( ":checked" )){

$( "#ScaleSizesGalery1" ).attr("disabled",false);
$( "#ScaleSizesGalery1" ).css({ 'background': '#ffffff' });

}


		// Check gallery END

// Check input when site is load END




// Click input checkboxes



	// Check gallery
$("#ScaleSizesGalery").click(function(){



	if($("#ScaleSizesGalery").is( ":checked" )){
	
	$("#ScaleWidthGalery").prop("checked",false);
	$( "#ScaleSizesGalery1" ).attr("disabled",false);
	$( "#ScaleSizesGalery2" ).attr("disabled",false);
	$( "#ScaleSizesGalery1" ).css({ 'background': '#ffffff' });
	$( "#ScaleSizesGalery2" ).css({ 'background': '#ffffff' });
	
	}
	
	else{

	$("#ScaleWidthGalery").prop("disabled",false);
	$( "#ScaleSizesGalery1" ).attr("disabled",true);
	$( "#ScaleSizesGalery2" ).attr("disabled",true);
	$( "#ScaleSizesGalery1" ).css({ 'background': '#e0e0e0' });
	$( "#ScaleSizesGalery2" ).css({ 'background': '#e0e0e0' });
	
		if($("#ScaleWidthGalery").is( ":checked" )){}
		else{
		$( "#ScaleWidthGalery" ).prop("checked",true);
		$( "#ScaleSizesGalery1" ).attr("disabled",false);
		$( "#ScaleSizesGalery1" ).css({ 'background': '#ffffff' });
		}
	
	}
	
});

$("#ScaleWidthGalery").click(function(){

	if($("#ScaleWidthGalery").is( ":checked" )){
	
	$("#ScaleSizesGalery").prop("checked",false);
	$("#ScaleSizesGalery1").prop("disabled",false);
	$("#ScaleSizesGalery2").prop("disabled",true);
	$( "#ScaleSizesGalery1" ).css({ 'background': '#ffffff' });
	$( "#ScaleSizesGalery2" ).css({ 'background': '#e0e0e0' });

	
	}
	
	else{

	$( "#ScaleSizesGalery" ).prop("checked",true);
	$("#ScaleSizesGalery").prop("disabled",false);
	$("#ScaleSizesGalery1").prop("disabled",false);
	$("#ScaleSizesGalery2").prop("disabled",false);
	$( "#ScaleSizesGalery2" ).css({ 'background': '#ffffff' });
	$( "#ScaleSizesGalery1" ).css({ 'background': '#ffffff' });
	
	}
	
});

	// Check gallery END
	
// Check resolution

//JPG
$("#allowRESjpg").click(function(){

	if($("#allowRESjpg").is( ":checked" )){
	
	$("#maxJPGres").prop("disabled",false);
	$( "#maxJPGres" ).css({ 'background': '#ffffff' });
	$( ".checkRESjpg" ).remove();
	$( "#maxJPGresCheck" ).remove();
	
	}
	
	else{
	
	var maxRESval = $("#maxJPGres").val();
	
	$('.maxJPGres').append('<input type="hidden" value="'+maxRESval+'" name="maxRes[]" id="maxJPGresCheck" >');
	
	$("#maxJPGres").prop("disabled",true);
	$( "#maxJPGres" ).css({ 'background': '#e0e0e0' });
	$( "#checkRESjpg" ).append('<input type="hidden" value="off" name="maxRes[]" class="checkRESjpg" >');
	
	}
	
});

//PNG
$("#allowRESpng").click(function(){

	if($("#allowRESpng").is( ":checked" )){
	
	$("#maxPNGres").prop("disabled",false);
	$( "#maxPNGres" ).css({ 'background': '#ffffff' });
	$( ".checkRESpng" ).remove();
	$( "#maxPNGresCheck" ).remove();
	
	}
	
	else{
	
	var maxRESval = $("#maxPNGres").val();
	
	$('.maxPNGres').append('<input type="hidden" value="'+maxRESval+'" name="maxRes[]" id="maxPNGresCheck" >');
	
	$("#maxPNGres").prop("disabled",true);
	$( "#maxPNGres" ).css({ 'background': '#e0e0e0' });
	$( "#checkRESpng" ).append('<input type="hidden" value="off" name="maxRes[]" class="checkRESpng">');
		
	}
	
});

//GIF
$("#allowRESgif").click(function(){

	if($("#allowRESgif").is( ":checked" )){
	
	$("#maxGIFres").prop("disabled",false);
	$( "#maxGIFres" ).css({ 'background': '#ffffff' });
	$( ".checkRESgif" ).remove();
	$( "#maxGIFresCheck" ).remove();
	
	}
	
	else{
		
	var maxRESval = $("#maxGIFres").val();
	
	$('.maxGIFres').append('<input type="hidden" value="'+maxRESval+'" name="maxRes[]" id="maxGIFresCheck" >');
	
	$("#maxGIFres").prop("disabled",true);
	$( "#maxGIFres" ).css({ 'background': '#e0e0e0' });
	$( "#checkRESgif" ).append('<input type="hidden" value="off" name="maxRes[]" class="checkRESgif">');
	
	}
	
});




// Check resolution END	
	

// Click input checkboxes END

// Check if Height Look fields are checked or not

$("#HeightLook").click(function() {
	


if($(this).is(":checked")){
$( "#HeightLookHeight" ).prop("disabled",false);
$( "#HeightLookHeight" ).css({ 'background': '#ffffff' });
$("#ThumbLook").prop("disabled",false);
$("#RowLook").prop("disabled",false);

if ($('#RowLook').is(":checked") || $('#ThumbLook').is(":checked")) {
	
}

else{
	$(this).prop("disabled",true);
	$(this).parent().append("<input type='hidden' name='HeightLook' value='on' />");
	$( "#ThumbLook" ).prop("disabled",false);
	$( "#RowLook" ).prop("disabled",false);
	}

	

}

else{
	
$( "#HeightLookHeight" ).prop("disabled",true);
$( "#HeightLookHeight" ).css({ 'background': '#e0e0e0' });


if ($('#RowLook').is(":checked") || $('#ThumbLook').is(":checked")) {
	
}

else{
	$(this).prop("disabled",true);
	$(this).prop("checked",true);
	$(this).parent().append("<input type='hidden' name='HeightLook' value='on' />");
	$( "#HeightLookHeight" ).prop("disabled",false);
$( "#HeightLookHeight" ).css({ 'background': '#ffffff' });
	}

}

/*
if ($('#ThumbLook').is(":checked")) {}
else{
$( "#ThumbLook" ).prop("checked",true);
$( "#DistancePics" ).prop("disabled",false);
$( "#DistancePicsV" ).prop("disabled",false);
$( "#DistancePics" ).css({ 'background': '#ffffff' });
$( "#DistancePicsV" ).css({ 'background': '#ffffff' });
}*/


});

// Check if Height Look fields are checked or not --- ENDE


// Check if Row Fields are checked or not

$("#RowLook").click(function() {

if($(this).is(":checked")){

	$( "#PicsInRow" ).prop("disabled",false);
	$( "#LastRow" ).prop("disabled",false);
	$( "#PicsInRow" ).css({ 'background': '#ffffff' });
	$( "#LastRow" ).css({ 'background': '#ffffff' });
	$("#HeightLook").prop("disabled",false);
	$("#ThumbLook").prop("disabled",false);

if ($('#HeightLook').is(":checked") || $('#ThumbLook').is(":checked")) {
	
}

else{
	$(this).prop("disabled",true);
	$(this).parent().append("<input type='hidden' name='RowLook' value='on'/>");
	$( "#ThumbLook" ).prop("disabled",false);
	$( "#HeightLook" ).prop("disabled",false);
	}
	

}

else{
	
	$( "#PicsInRow" ).prop("disabled",true);
	$( "#LastRow" ).prop("disabled",true);
	$( "#PicsInRow" ).css({ 'background': '#e0e0e0' });
	$( "#LastRow" ).css({ 'background': '#e0e0e0' });
	
if ($('#HeightLook').is(":checked") || $('#ThumbLook').is(":checked")) {
	
}

else{
		$(this).prop("disabled",true);
	$(this).prop("checked",true);
	$(this).parent().append("<input type='hidden' name='RowLook' value='on'/>");
	$( "#PicsInRow" ).prop("disabled",false);
	$( "#LastRow" ).prop("disabled",false);
	$( "#PicsInRow" ).css({ 'background': '#ffffff' });
	$( "#LastRow" ).css({ 'background': '#ffffff' });
	}

}

});

// Check if Row Fields are checked or not  --- END

// Check if Row Fields are checked or not

$("#ThumbLook").click(function() {


if($(this).is(":checked")){
	$( "#DistancePics" ).prop("disabled",false);
	$( "#DistancePicsV" ).prop("disabled",false);
	$( "#WidthThumb" ).prop("disabled",false);
	$( "#HeightThumb" ).prop("disabled",false);
	$( "#DistancePics" ).css({ 'background': '#ffffff' });
	$( "#DistancePicsV" ).css({ 'background': '#ffffff' });
	$( "#WidthThumb" ).css({ 'background': '#ffffff' });
	$( "#HeightThumb" ).css({ 'background': '#ffffff' });
	$("#HeightLook").prop("disabled",false);
	$("#RowLook").prop("disabled",false);
	
if ($('#HeightLook').is(":checked") || $('#RowLook').is(":checked")) {
	
}

else{
	$(this).prop("disabled",true);
	$(this).parent().append("<input type='hidden' name='ThumbLook' value='on' />");
	$( "#RowLook" ).prop("disabled",false);
	$( "#HeightLook" ).prop("disabled",false);
	}	
	
}

else{
	$( "#DistancePics" ).prop("disabled",true);
	$( "#DistancePicsV" ).prop("disabled",true);
	$( "#WidthThumb" ).prop("disabled",true);
	$( "#HeightThumb" ).prop("disabled",true);
	$( "#DistancePics" ).css({ 'background': '#e0e0e0' });
	$( "#DistancePicsV" ).css({ 'background': '#e0e0e0' });
	$( "#WidthThumb" ).css({ 'background': '#e0e0e0' });
	$( "#HeightThumb" ).css({ 'background': '#e0e0e0' });
	
if ($('#HeightLook').is(":checked") || $('#RowLook').is(":checked")) {
	
}

else{
		$(this).prop("disabled",true);
	$(this).prop("checked",true);
	$(this).parent().append("<input type='hidden' name='ThumbLook' value='on' />");
		$( "#DistancePics" ).prop("disabled",false);
	$( "#DistancePicsV" ).prop("disabled",false);
	$( "#WidthThumb" ).prop("disabled",false);
	$( "#HeightThumb" ).prop("disabled",false);
	$( "#DistancePics" ).css({ 'background': '#ffffff' });
	$( "#DistancePicsV" ).css({ 'background': '#ffffff' });
	$( "#WidthThumb" ).css({ 'background': '#ffffff' });
	$( "#HeightThumb" ).css({ 'background': '#ffffff' });
	}
	
	
}

});

// Check if Row Fields are checked or not  --- END

// Check if forward fields are checked or not

$("#forward").click(function() {


if($(this).is(":checked")){
	$( "#forward_url" ).prop("disabled",false);
	$( "#confirmation_text" ).prop("disabled",true);
	$( "#forward_url" ).css({ 'background': '#ffffff' });
	$( "#confirmation_text" ).css({ 'background': '#e0e0e0' });
}

else{
	$( "#forward_url" ).prop("disabled",true);
	$( "#confirmation_text" ).prop("disabled",false);
	$( "#forward_url" ).css({ 'background': '#e0e0e0' });
	$( "#confirmation_text" ).css({ 'background': '#ffffff' });
}

});

// Check if forward fields are checked or not  --- END



/*if($('#RowLook').is(":checked")){

}

else{
	$( "#ThumbLook" ).prop("checked",true);
	$( "#DistancePics" ).prop("disabled",false);
	$( "#DistancePicsV" ).prop("disabled",false);
	$( "#DistancePics" ).css({ 'background': '#ffffff' });
	$( "#DistancePicsV" ).css({ 'background': '#ffffff' });

}*/


 });