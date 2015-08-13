jQuery(document).ready(function($){
	
  $(function() {
	  
	   
	  
    $( "#ausgabe1" ).sortable({ cursor: "move", placeholder: "ui-state-highlight", stop:  function( event, ui ) {

if(document.readyState === "complete"){

var v = 0;
//var total = $('.formField').length;



		  $( ".formField" ).each(function( i ) {
		  
		v++;

		//$(this).find('.fieldnumber').val(v); 
		$(this).find('.changeUploadFieldOrder').val(v); 
		//$(this).find('.changeFieldOrderUsersEntries').val(v); 

		// alert(v);
		

				  
		   });  
		   
		   v = 0;
		   
		   }
  
   }


	});
	$('#ausgabe1').css('cursor', 'move');
	
	$( "#fuckoff" ).change(function () {
$( "#ausgabe1" ).append("<input type='text' id='testl'>");
});

  });
 
 
 $(document).on('click', '.cg_delete_form_field', function(e){

	
//var del = arg;
//var del1 = arg1;


 
 	var del = $(this).attr("alt");
	var del1 = $(this).attr("titel");

    if (confirm("Delete field? All user information connected to this field will be deleted.")) {
       // alert("Clicked Ok");
		//confirmForm();
		fDeleteFieldAndData(del,del1);
	    return true;
    } else {
        //alert("Field not deleted.");
		
		var test = $("#"+del).find('.fieldValue').val();
		
		// alert(test);  
		
		//alert("This option is not available in the Lite Version.");
		
        return false;
    }


});
 
 
 /*function checkMe(arg,arg1) {


}*/

// Delete field only

//arg="sdfgsdfgsd";

 $(document).on('click', '.cg_delete_form_field_new', function(e){

 var arg = $(this).attr("alt");
	
$("#"+arg).remove();


});

/*
function fDeleteFieldOnly(arg){

// alert(arg);


}*/

// Delete field only --- ENDE

// Delete field and Data

function fDeleteFieldAndData(arg,arg1){

//alert("ARG: "+arg);
//alert("ARG1: "+arg1);



$("#"+arg).remove();
$( "#ausgabe1").append("<input type='hidden' name='deleteFieldnumber' value="+arg1+">");

	if(document.readyState === "complete"){
	// alert('READY!');
	//$('#submitForm').click();
	//alert("This option is not available in the Lite Version.");
	$('#submitForm').click();
	}



/*


if(document.readyState === "complete"){

var v = 0;
var total = $('.formField').length;

		  $( ".formField" ).each(function( i ) {
		  
		v++;

		$(this).find('.fieldnumber').val(v); 
		$(this).find('.changeUploadFieldOrder').val(v); 
		$(this).find('.changeFieldOrderUsersEntries').val(v); 


		alert("test"+v);
		

				  
		   });  
		   
		   v = 0;

	if(document.readyState === "complete"){
	alert('READY!');
	$('#submitForm').click();
	}
}*/

}

// Delete field and Data --- ENDE















// Überprüfen ob der Upload des Feldes im Frontend notwendig ist. Wenn Häckchen raus ist, erscheint ein zusätzliches Feld mit upload[] und Nummer der checkbox der Div zur späteren Feststellung.
/*
function checkNecessary(arg,arg1){


	if($("."+arg).val() == arg1){

	// ob Upload oder upload
	var checkName = $( "."+arg ).attr('name');
	alert(checkName);
	$( "."+arg ).remove();
	}

else{

	// ob Upload oder upload
	var checkName = $( "."+arg ).attr('name');
	alert(checkName);
	
	if(checkName.indexOf("upload") >= 0){
	$( "#"+arg ).append("<input type='hidden' name='upload[]' class='"+arg+"' value="+arg1+">");
	}

	else{
	$( "#"+arg ).append("<input type='hidden' name='upload[]' class='"+arg+"' value="+arg1+">");
	}

}

}*/

// Überprüfen ob der Upload des Feldes im Frontend notwendig ist. Wenn Häckchen raus ist, erscheint ein zusätzliches Feld mit upload[] und Nummer der checkbox der Div zur späteren Feststellung.--- END


// Ob das Feld notwendig ist oder nicht soll als on oder als off mit gesendet werden

	 // function checkNecessary(){
	 //$('.necessary-check').live('click', function() {
	 //$('.necessary-check').on('click', function() {
$(document).on('click', '.necessary-check', function(e){

	
	//$(".necessary-check").click(function(){

	if($(this).is( ":checked" )){
	
		$(this).parent().find('.necessary-hidden').remove();
		
		//alert(1);
	}
	
	else{
			//$(this).prop("checked",false);
			$(this).removeAttr('checked');
		$(this).parent().append("<input type='hidden' class='necessary-hidden'  name='upload[]' value='off' />");

	//alert(2);
	}


});

//}	

// Ob das Feld notwendig ist oder nicht soll als on oder als off mit gesendet werden --- ENDE
	





$(document).ready(function(){
	
	// Bestimmung der Anzahl der existierenden Div Felder in #ausgabe1 zur Bestiummung der Feldnummer in der Datenbank


    var countChildren = $('#ausgabe1').find('.formField').size();
	
	// Bestimmung der Anzahl der existierenden Div Felder in #ausgabe1 zur Bestiummung der Feldnummer in der Datenbank  ---- ENDE

// Check Box

// 1 = Feldtyp
// 2 = Feldreihenfolge
// 3 = Feldname
// 4 = Feldinhalt
// 5 = Felderfordernis

  $("#cg_create_upload_add_field").click(function(){  
  
  
	if($('#dauswahl').val() == "cb") {
	
	countChildren++;
	
	// alert(countChildren);
	
	var cbCount = 10+$('input#cb').size();
	var cbHiddenCount = 100+$('input#cb').size();
	
	//alert(nfCount);
	
	if($('input#cb').size() == 3){
     alert("This field can be produced maximum 3 times.");
	}
	else{$("#ausgabe1").append("<div id='"+ cbCount +"' class='formField' style='width:855px;margin-bottom:20px;border: 1px solid #DFDFDF;padding-top:7px;padding-bottom:10px;display:table;padding:10px;'><br/><input type='hidden' name='upload[]' value='cb'>"+
	"<input type='hidden' value='"+ countChildren +"' name='addField[]' class='fieldValue'>"+ // Nummer des neuen Feldes wird extra versendet
	"<input type='hidden' value='nf' name='addField[]'>"+
	//"<input type='hidden' name='upload[]' class='fieldnumber' value='"+ countChildren +"'>"+// Feldnummer wird vergeben zur Orientierung in der Datenbank
	//"<input type='hidden' class='fieldnumber' value='"+ countChildren +"'>"+
	//"<input type='hidden' name='upload[]' value='"+ countChildren +"' size='30' class='changeUploadFieldOrder' >"+// Feldreihenfolge
	"<input type='text' name='upload[]' value='Check agreement' maxlength='100' size='30'>"+
	"<input type='hidden' name='actualID[]' value='placeholder' >"+// Platzhalter statt aktueller Feld ID
	"<input id='submit1' class='cg_delete_form_field_new' type='button' onClick='fDeleteFieldOnly("+cbCount+")' value='-' style='width:20px;' alt='"+ cbCount +"' ><br>"+
	"<input type='checkbox' disabled >"+
	"<input type='text' name='upload[]' id='cb'  maxlength='1000' style='width:832px;'>"+
	"Necessary <input type='checkbox' class='necessary-check' name='upload[]' disabled checked >"+
	"<input type='hidden' name='upload[]' class='necessary-hidden' value='off' ><br/><br/></div>");}
	
	location.href = "#"+cbCount+"";
	
	
 }});




// NORMALES FELD

// 1 = Feldtyp
// 2 = Feldreihenfolge 
// 3 = Feldtitel
// 4 = Feldinhalt
// 5 = Feldkrieterium1
// 6 = Feldkrieterium2
// 7 = Felderfordernis

  $("#cg_create_upload_add_field").click(function(){  
  
  
	if($('#dauswahl').val() == "nf") {
	
	countChildren++;
	
	// alert(countChildren);
	
	var nfCount = 10+$('input#nf').size();
	var nfHiddenCount = 100+$('input#nf').size();
	
	//alert(nfCount);
	
	if($('input#nf').size() == 20){
     alert("This field can be produced maximum 20 times.");
	}
	else{$("#ausgabe1").append("<div id='"+ nfCount +"' class='formField' style='width:840px;margin-bottom:20px;border: 1px solid #DFDFDF;padding-top:7px;padding-bottom:10px;display:table;padding:10px;'><br/><input type='hidden' name='upload[]' value='nf'>"+
	"<input type='hidden' value='"+ countChildren +"' name='addField[]' class='fieldValue'>"+ // Nummer des neuen Feldes wird extra versendet
	"<input type='hidden' value='nf' name='addField[]'>"+
	//"<input type='hidden' name='upload[]' class='fieldnumber' value='"+ countChildren +"'>"+// Feldnummer wird vergeben zur Orientierung in der Datenbank
	//"<input type='hidden' class='fieldnumber' value='"+ countChildren +"'>"+
	//"<input type='hidden' name='upload[]' value='"+ countChildren +"' size='30' class='changeUploadFieldOrder'>"+// Feldreihenfolge
	"<input type='text' name='upload[]' value='Name' maxlength='100' size='30'>"+
	"<input type='hidden' name='actualID[]' value='placeholder' >"+// Platzhalter statt aktueller Feld ID
	"<input id='submit1' class='cg_delete_form_field_new' type='button' onClick='fDeleteFieldOnly("+nfCount+")' value='-' style='width:20px;' alt='"+ nfCount +"'><br/>"+
	"<input type='text' name='upload[]' id='nf'  maxlength='1000' value='' style='width:855px;'><br/>"+
	"Min. number of characters:&nbsp; <input type='text' name='upload[]' value='3' size='7' maxlength='4' value=' '><br/>"+
	"Max. number of characters: <input type='text' name='upload[]' value='7' size='7' maxlength='4' value=' '><br/>"+
	"Necessary <input type='checkbox' class='necessary-check' name='upload[]' >"+
	"<input type='hidden' name='upload[]' class='necessary-hidden' value='off' ><br/><br/></div>");}
	
	//alert(nfCount);
	/*
	$('html, body').animate({
	scrollTop: $("#'"+nfCount+"'").offset().top
    }, 400);
	$("html, body").animate({ scrollTop: $("#12").scrollTop() }, 1000);*/	
	
	location.href = "#"+nfCount+"";
	
 }});
 
// KOMMENTARFELD
  
  $("#cg_create_upload_add_field").click(function(){
  
	var kfCount = 20+$('textarea#kf').size();
	var kfHiddenCount = 200+$('textarea#kf').size();
  
	if($('#dauswahl').val() == "kf") {
	
		countChildren++;
	
		// alert(countChildren);
	
	
	if($('textarea#kf').size() == 10){
     alert("This field can be produced maximum 10 times.");
	}
	
	 
	else{$("#ausgabe1").append("<div id='"+ kfCount +"' class='formField' style='width:718px;margin-bottom:20px;border: 1px solid #DFDFDF;padding-top:7px;padding-bottom:10px;display:table;padding:10px;width:856px;'><br/><input type='hidden' name='upload[]' value='kf'>"+
	"<input type='hidden' value='"+ countChildren +"' name='addField[]' class='fieldValue'>"+ // Nummer des neuen Feldes wird extra versendet
	"<input type='hidden' value='kf' name='addField[]'>"+
	//"<input type='hidden' name='upload[]' class='fieldnumber' value='"+ countChildren +"'>"+// Feldnummer wird vergeben zur Orientierung in der Datenbank
	//"<input type='hidden' class='fieldnumber' value='"+ countChildren +"'>"+
	//"<input type='hidden' name='upload[]' value='"+ countChildren +"' size='30' class='changeUploadFieldOrder'>"+// Feldreihenfolge
	"<input type='text' name='upload[]' size='30' maxlength='100' value='Comment'>"+
	"<input type='hidden' name='actualID[]' value='placeholder' >"+// Platzhalter statt aktueller Feld ID
	"<input id='submit1' class='cg_delete_form_field_new' type='button' onClick='fDeleteFieldOnly("+kfCount+")' value='-' style='width:20px;' alt='"+ kfCount +"'><br/>"+
	"<textarea name='upload[]' id='kf' maxlength='10000' rows='10' value='' style='width:857px;'></textarea><br/>"+
	"Min. number of characters:&nbsp; <input type='text' name='upload[]' value='3' size='7' maxlength='4' value=' '><br/>"+
	"Max. number of characters: <input type='text' name='upload[]' value='1000' size='7' maxlength='4' value=' '><br/>"+
	"Necessary <input type='checkbox' class='necessary-check' name='upload[]' >"+
	"<input type='hidden' name='upload[]' class='necessary-hidden' value='off' ><br/><br/></div>");}
	
	location.href = "#"+kfCount+"";
	
 }});
 
 // E-Mail
 
   $("#cg_create_upload_add_field").click(function(){
  
	if($('#dauswahl').val() == "ef") {
	
		countChildren++;
	
		// alert(countChildren);
	
	var efCount = 30+$('input#ef').size();
	var efHiddenCount = 300+$('input#ef').size();
	
	//alert(nfCount);
	
	if($('input#ef').size() == 3){
     alert("This field can be produced maximum 3 times.");
	}
	else{$("#ausgabe1").append("<div id='"+ efCount +"' class='formField' style='width:840px;margin-bottom:20px;border: 1px solid #DFDFDF;padding-top:7px;padding-bottom:10px;display:table;padding:10px;'><br/><input type='hidden' name='upload[]' value='ef'>"+
	"<input type='hidden' value='"+ countChildren +"' name='addField[]' class='fieldValue'>"+ // Nummer des neuen Feldes wird extra versendet
	"<input type='hidden' value='ef' name='addField[]'>"+
	//"<input type='hidden' name='upload[]' class='fieldnumber' value='"+ countChildren +"'>"+// Feldnummer wird vergeben zur Orientierung in der Datenbank
	//"<input type='hidden' class='fieldnumber' value='"+ countChildren +"' class='changeUploadFieldOrder'>"+
	//"<input type='hidden' name='upload[]' value='"+ countChildren +"' size='30'>"+// Feldreihenfolge
	"<input type='hidden' name='actualID[]' value='placeholder' >"+// Platzhalter statt aktueller Feld ID
	"<input type='text' name='upload[]' value='E-Mail' maxlength='100' size='30'><input id='submit1' class='cg_delete_form_field_new' type='button' onClick='fDeleteFieldOnly("+efCount+")' value='-' style='width:20px;' alt='"+ efCount +"'><br/>"+
	"<input type='text' name='upload[]' value='' id='ef' maxlength='100' style='width:855px;'><br/>"+
	"Necessary <input type='checkbox' class='necessary-check' name='upload[]' >"+
	"<input type='hidden' name='upload[]' class='necessary-hidden' ><br/><br/></div>");}
	
	location.href = "#"+efCount+"";
	
 }});
 
	
	
  /*$("#cg_create_upload_add_field").click(function(){
  
alert("This option is not available in the Lite Version.");
	
 });*/
 

 
});
 
 
  
});