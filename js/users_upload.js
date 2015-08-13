jQuery(document).ready(function($){
	
	
	 var countChildren = $('#ausgabe1').children().size()+1;
	 
	 //alert(countChildren);
	
	//alert("works");


		  $("#ausgabe1").css('visibility','visible');   // Document is ready



/*
Notwendige Formularprüfung

1. Prüfen der Bilder

- Prüfen ob Bild ausgewählt wurde >>> submit
- Prüfen ob der Größe der Bilder in MB >>> change und submit
- Prüfen ob das berechtigte Bildformat übergeben wurde >>> change und submit
- Prüfen ob die Auflösung der Bilder zu hoch ist >>> change und submit


2. Prüfen der Textfelder
- Prüfen ob E-Mail richtig geschrieben wurde >>> submit
- Prüfen wie viel Buchstaben eingegeben worden sind >>> submit


*/

// 1. Prüfen der Bilder

//- Prüfen ob das berechtigte Bildformat übergeben wurde
//- Funktion bilden

function checkPic(e) {
	
//	alert("pic will be checked");
	
		// Validate Emailadress

		  /*var emailRegex = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

		  $( ".ef" ).each(function( i ) {
		  
		  var email = $(this).val();
		  
		  alert("email:"+email);
		  
		  if (!emailRegex.test(email)){var check = 1;
		  $( this ).parent().find('.append').append('<p>E-Mail address hast to be valid</p>');
		  }
		  
		  }); */
		  
// Validate Emailadress --- ENDE
	
	
	
	
	


// Bereits versendete Meldungen wieder löschen	
$(".bh").parent().find('.append').empty();

//var checkSelected = (".bh").val().size();

//alert("checkSelected"+checkSelected);
/*
if(checkSelected==0){
	$(".bh").parent().find('.append').append('<b>No picture is choosed</b>');
	 e.preventDefault();
}*/


//var filename = $('input[type=file]')[0].files[0].name;
var filename = filename = $('input[type=file]').val().split('\\').pop();
// alert('filename: '+filename);



if(!filename){
	$( this ).parent().find('.append p').remove();
	$(".bh").parent().find('.append').append('<p style="font-size:14px;">No picture is choosed</p>');
	 e.preventDefault();
}



//var ext = filename.match(/\.(.+)$/)[1];
var ext = filename.match(/\.(.+)$/)[1].toLowerCase();
// alert('ext: '+ext);
var fileType = ext;	 
// alert('fileType: '+fileType);

var testcheck = 1;

var restrictJpg = $("#restrictJpg").val();
var restrictPng = $("#restrictPng").val();
var restrictGif = $("#restrictGif").val();
//var restrictPng = <?php echo json_encode($MaxResPNGon);?>;
//var restrictGif = <?php echo json_encode($MaxResGIFon);?>;

//alert("restrictJpg:"+restrictJpg);


if (restrictJpg==1) {var maxResJpg = $("#restrictJpg").val();}
if (restrictPng==1) {var maxResPng = $("#restrictPng").val();}
if (restrictGif==1) {var maxResGif = $("#restrictGif").val();}

var wrongType = 0;

		if (fileType != 'jpg' && fileType != 'png' && fileType != 'gif') 
		{ wrongType = 1;
	// alert("wrongt type"+wrongType);
		}
		
		
		if (wrongType==1) {$(".bh").parent().find('.append').append('<p style="font-size:14px;">This file type is not allowed</p>');}

		
		
//- Prüfen ob das berechtigte Bildformat übergeben wurde   --- ENDE

//- Prüfen ob der Größe der Bilder in MB	
// Überprüfen ob der File größer ist als vorgegebene Uploadgröße

//var post_max_size = <?php echo "$max_post"; ?>; 
var post_max_size = $("#post_max_size").val();
// alert("Post max size:"+post_max_size);

	var file = $(".bh")[0].files[0];
	// alert('file: '+file);
	var sizePic = file.size;
	// alert('sizePic: '+sizePic);
	//alert("Aktuelle Größe: "+sizePic);
	
	if (sizePic >= post_max_size) {
	
	$(".bh").parent().find('.append').append('<p style="font-size:14px;">The file you choosed is to big. Max allowed size: <?php echo "$post_max_sizeMB"; ?></p>');
	 e.preventDefault();
	
	}
	
// Überprüfen ob der File größer ist als vorgegebene Uploadgröße --- ENDE 

// überprüfen auflösung für jpg
// Check the resolution of a pic
	
	if (fileType == 'jpg' && restrictJpg == 1) {
	
	// alert('test');
	
var _URL = window.URL || window.webkitURL;

    var file, img;
    if (file = $(".bh")[0].files[0]) {
        img = new Image();
		// Aufgrund onload findet diese Prüfung als aller letztens staat!
        img.onload = function () {
        //    alert("testRES"+this.width + " " + this.height);	
			
   		if (this.width*this.height > maxResJpg) {
		
		// alert('groeßer111');
		$(".bh").parent().find('.append').append('<p style="font-size:14px;">The resolution of this pic is '+this.width*this.height+'px. It is to high. Maximum allowed resolution for JPGs is '+maxResJpg+'px.</p>');
		 e.preventDefault();
		// alert('geklappt!res');
		
	
		}

        };
		
       img.src = _URL.createObjectURL(file);
	   
    }
	
	}

// überprüfen auflösung für png	
if (fileType == 'png' && restrictPng == 1) {
	
var _URL = window.URL || window.webkitURL;

    var file, img;
    if (file = $(".bh")[0].files[0]) {
        img = new Image();
		// Aufgrund onload findet diese Prüfung als aller letztens staat!
        img.onload = function () {
          //  alert("testRES"+this.width + " " + this.height);	
			
   		if (this.width*this.height > maxResJpg) {
		
		//alert('groeßer111');
		$(".bh").parent().find('.append').append('<p style="font-size:14px;">The resolution of this pic is '+this.width*this.height+'px. Its to high. Maximum allowed resolution for PNGs is '+maxResPng+'px.</p>');
		 e.preventDefault();
		//alert('geklappt!res');
		
	
		}

        };
		
       img.src = _URL.createObjectURL(file);
	   
    }
	
	}
	
// überprüfen auflösung für gif	
if (fileType == 'gif' && restrictGif == 1) {
	
var _URL = window.URL || window.webkitURL;

    var file, img;
    if (file = $(".bh")[0].files[0]) {
        img = new Image();
		// Aufgrund onload findet diese Prüfung als aller letztens staat!
        img.onload = function () {
            //alert("testRES"+this.width + " " + this.height);	
			
   		if (this.width*this.height > maxResJpg) {
		
		//alert('groeßer111');
		$(".bh").parent().find('.append').append('<p style="font-size:14px;">The resolution of this pic is '+this.width*this.height+'px. Its to high. Maximum allowed resolution for GIFs is '+maxResGif+'px.</p>');
		 e.preventDefault();
		//alert('geklappt!res');
		
	
		}

        };
		
       img.src = _URL.createObjectURL(file);
	   
    }
	
	}	
	
    //var check = 1;
}






   	$('INPUT[type="file"]').change(function (e) {
	

	checkPic(e);



});

// <<< Ende überprüfen der Change() Funktion



//$( "#cg_users_upload_submit" ).click(function() {
	
	 $(document).on('click', '#cg_users_upload_submit', function(e){

	//alert('submitted1');
	
 // $( "form" ).submit(function( e ) {

	//alert('submitted2');
	

	

  var emailRegex = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
  
  
  
  
  
  		  $( ".cg-check-f" ).each(function( i ) {
			  
			  // alert('cf');
			 
				if(!$(this).prop('checked')){
					// alert('cf 1');
					$( this ).parent().find('.append p').remove();
					$( this ).parent().find('.append').append('<p style="font-size:14px;">You have to check this agreement</p>');	
					var check = 1;
					e.preventDefault();
				}



		  
		  }); 
  
  
  
  
		  

		  $( ".ef" ).each(function( i ) {
			  
			 
			  
			
		  
		  var email = $(this).val();
		  			//   alert('ef');
		 var checkIfNeed = $( this ).parent().find(".checkIfNeed").val();
		  
		  //alert(email);
		  
		  if (checkIfNeed == 'on' || email.length > 0) {
		  
			  if (!emailRegex.test(email)){
						// 	  alert('ef 1');
				//   alert('remove yes');
			  $( this ).parent().find('.append p').remove();
			  $( this ).parent().find('.append').append('<p style="font-size:14px;">E-Mail address has to be valid</p>');
			  
			  var check = 1;
		//	  alert("check: "+check);
			  e.preventDefault();
			  }
		  
		  }
		  
		  //alert('check: '+check);
		  
		  }); 
		  
// Validate Emailadress --- ENDE



// Überprüfen ob die Anzahl der Buchstaben in den Feldern stimmt
		  
		  $( ".nf" ).each(function( i ) {
		   // $(this).attr( "width", "200px" );
		   
		 var minsize = $( this ).parent().find(".minsize").val();
		 var maxsize = $( this ).parent().find(".maxsize").val();
		 var checkIfNeed = $( this ).parent().find(".checkIfNeed").val();
		 
		 var realsize = $( this ).val().length;
		 
		 		// 	  alert('nf');
		 
		 				 
		 if (checkIfNeed == 'on') {
			 
			 		// 	  alert('nf 1');
		 
	 
		 		 if (realsize<minsize) {
				 
			 
				 $( this ).parent().find('.append p').remove();
	
				 
				 $( this ).parent().find('.append').append('<p style="font-size:14px;">This field must contain more then '+minsize+' charackters</p>');
				 
				var check = 1;
		//		alert("check: "+check);
				e.preventDefault();
						}
		 
		 }
		 


   
		   }); 
		   
		   
// Überprüfen ob die Anzahl der Buchstaben in den Kommentar-Feldern stimmt
		  
		  $( ".kf" ).each(function( i ) {
		   // $(this).attr( "width", "200px" );
		   
		 var minsize = $( this ).parent().find(".minsize").val();
		 var maxsize = $( this ).parent().find(".maxsize").val();
		 var checkIfNeed = $( this ).parent().find(".checkIfNeed").val();
		 
		 var realsize = $( this ).val().length;
		 
		 	// 		  alert('kf');
			 				 
		 if (checkIfNeed == 'on') {
			 
			 // 			  alert('kf 1');
	 
	 
		 		 if (realsize<minsize) {
				 
		 
				 $( this ).parent().find('.append p').remove();
				 
			
				 
				 $( this ).parent().find('.append').append('<p style="font-size:14px;">This field must contain more then '+minsize+' charackters</p>');
				 var check = 1;
				// alert("check: "+check);
				 e.preventDefault();

						}
		 
		 }
		 
  
		   });
		   
		   			//alert("check: "+check);
		   
		   		 // alert('end');
				  
 checkPic(e);
		   
// Überprüfen ob die Anzahl der Buchstaben in den Feldern stimmt --- ENDE 
  
		   /*if (check == 1) {
		   alert('Form has to be blocked');

		  
		  
		   e.preventDefault();
		   } */






//});

});




 });