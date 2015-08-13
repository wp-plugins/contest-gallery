jQuery(document).ready(function($){
	
      function countChar(val) {
        var len = val.value.length;
        if (len >= 1000) {
          val.value = val.value.substring(0, 1000);
        } else {
          $('#charNum').text(1000 - len);
        }
      };
	  
	  
	  // Verstecken weiterer Boxen

    $('.mehr').hide();
    $('.clickBack').hide();


    $('.clickMore').click( function() {
         // Zeigen oder Verstecken:

         $(this).next().slideDown('slow');
	     $(this).next(".mehr").next(".clickBack").toggle();
		 $(this).hide();		 

		 
    })
	
	    $('.clickBack').click( function() {
		 $(this).prev().slideUp('slow');
	     $(this).prev(".mehr").prev(".clickMore").toggle();
		 $(this).hide();		
		 
		 
    })

// Verstecken weiterer Boxen ---- ENDE

// Change Daten ändern oder löschen

//$( "#chooseAction1" ).change(function() {

//var chooseAction = $( "#chooseAction1 option:selected" ).val();

//alert('test');
  //alert(chooseAction);
  
  //if ($( "#chooseAction1 option:selected" ).val()==1) {
	
	//$("#chooseAction").remove();
    //$( "#sortable1" ).append('<input type="text" id="chooseAction" name="chooseAction" value="showPics">');
 // alert( "Handler for .change() called.234" ); 
  
  //}
  
    //if ($( "#chooseAction1 option:selected" ).val()==2) {
  
	//$("#chooseAction").remove();
    //$( "#sortable3" ).append("<input type='text' id='chooseAction' name='deletePics' value='deletePics'>");
	//alert( "Handler for .change() called.5678" );
  
  //}
  
//});


// Change Daten ändern oder löschen -- END 



$("input[class*=deactivate]").change(function(){

//$( this ).parent( "div input .imageThumb" ).removeAttr("disabled");
//$( this ).closest( "input" ).removeAttr("disabled");
//$( this ).parent().find( "input .imageThumb" ).removeAttr("disabled"); 

if($(this).is(":checked")){
var platzhalter = 'keine Aktion';
$( this ).parent().find(".deactivate").remove();
$( this ).parent().find( ".image-delete" ).prop("disabled",false);
}

else{

var id = $(this).val();
$( this ).parent().append("<input type='hidden' name='deactivate[]' value='"+id+"' class='deactivate'>" );
$( this ).parent().find( ".image-delete" ).prop("disabled",true);
}


});

$("input[class*=1activate]").change(function(){
	

if($(this).is(":checked")){

var id = $(this).val();

$( this ).parent().find( ".image-delete" ).prop("disabled",false);
$( this ).parent().append("<input type='hidden' name='activate[]' value='"+id+"' class='activate'>" );

//$( this ).parent().append('test123');

}

else{
$( this ).parent().find( ".image-delete" ).prop("disabled",true);
$( this ).parent().find(".activate").remove();
//$( this ).parent().append('test123');
}


});


// Duplicate email to a hidden field for form


$(".email").change(function(){

var email = $( this ).val();

$( this ).parent().find( ".email-clone" ).val(email);

});

// Duplicate email to a hidden field for form -- END 


$("div input #activate").click(function() {
    $("input #inform").prop("disabled", this.checked);
});

/*function informAll(){

//alert(arg);
alert(arg1);

if($("#informAll").is( ":checked" )){
$( "input[class*=inform]").removeAttr("checked",true);
$( "input[class*=inform]").click();
}

else{
$( "input[class*=inform]").click();

}

}*/

// Alle Bilder auswählen 

var n = 0;

$("#chooseAll").click(function(){


n++;
$("#click-count").val(n);



if($("#chooseAll").is( ":checked" )){
//alert('works');
//$( "input[class*=activate]").removeAttr("checked",true);
//$( "input[class*=activate]").prop("checked",true);
$( "input[class*=1activate]").click();

if (n>2) {
$( "input[class*=deactivate]").click();
}

}
else{
//alert('works');
//$( "input[class*=activate]").removeAttr("checked",true);
//$( "input[class*=activate]").removeAttr("checked",true);
//$( "input[class*=activate]").prop("checked",true);
$( "input[class*=deactivate]").click();
$( "input[class*=1activate]").click();
}

});

// Alle Bilder auswählen --- END


//Sortieren der Galerie




	var v = 0;
	
	var $i = 0;
	
	var rowid = [];
	
		if($i==0){  
	
			$( ".sortableDiv" ).each(function( i ) {
					  
			var rowidValue =  $(this).find('.rowId').val(); 
			
			
			rowid.push(rowidValue);
							
			});
			
			$i++;

		}
	
	  
	  $(function() {
		$( "#sortable" ).sortable({cursor: "move",placeholder: "ui-state-highlight", stop: function( event, ui ) {

	if(document.readyState === "complete"){



			  $( ".sortableDiv" ).each(function( i ) {
			  

			  
			$(this).find('.rowId').val(rowid[v]); 

			
			v++;

					  
			   });  
			   
			   v = 0;
			   
			   }
			   
	   }	
		
		});
		$('#sortable').css('cursor', 'move');
	  });

//Sortieren der Galerie --- ENDE
	  

  
});