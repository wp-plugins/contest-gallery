jQuery(document).ready(function($){
	
	//alert("test1");
	
//$( document ).ready(function() {

//$('#25').on( "click", function() { alert( 25 );});

//alert(234234);


/*$( "#25" ).click(function() {
alert("clicked");
  $( ".25" ).click();
});*/




	// Daten ermitteln zur weitergabe über JSON

	var id = $("#cg_galeryID").val();
	var widthMainCGallery = parseInt($('#mainCGdiv').parent().width());
	var order = $("#cg_order").val();
	var look = $("#cg_look").val();
	var start = $("#cg_start").val();
	var step = $("#cg_step").val();
	var siteURL = $("#cg_siteURL").val();
	var HeightLookHeight = $("#cg_HeightLookHeight").val();
	
	//	alert("cg_galeryID: " + id);
	//	alert("widthMainCGallery: " + widthMainCGallery);
	//	alert("order: " + order);
	//	alert("look: " + look);
	//	alert("start: " + start);
	//	alert("step: " + step);
	//	alert("siteURL: " + siteURL);
	//	alert("HeightLookHeight: " + HeightLookHeight);
	
	
	 var cg_change_clicked = 0;

$("#cg-change-height").click(function(){
	
	//alert("1");
		
   var cg_change_clicked = 1;
   
   	if (cg_change_clicked==1){
	//alert("2");
	var HeightLookHeight = $("#cg-height").val();
	var arg = HeightLookHeight;
	//alert(HeightLookHeight);
	heightLogic(arg);
		
	}
	
	});
	


	
//	alert("id:"+id);
//	alert("widthMainCGallery:"+widthMainCGallery);
//	alert("order:"+order);
	//alert("look:"+look);
//	alert("start:"+start);
	//alert("step:"+step);
//	alert("siteURL:"+siteURL);
	//alert("HeightLookHeight:"+HeightLookHeight);
	
	
	
	
	
	var dataArray = [];
	dataArray[0] = id;
	dataArray[1] = widthMainCGallery;
	dataArray[2] = look;
	dataArray[3] = order;
	dataArray[4] = start;
	dataArray[5] = step;
	dataArray[6] = siteURL;
	
	//alert(id);

	// Daten ermitteln zur weitergabe über JSON --- ENDE


	//var request = $.post("wp-content/plugins/contest-gal1ery/frontend/show-gallery1.php",{getData: dataArray});
	//request.done(function(data){
	//$('#mainCGdiv').html(data);	
	
	
	
	// Alle Bilder anzeigen sobald diese geladen sind
	/*$(function() {
	  $(".cg_image").css('visibility','visible');   
	});*/
	/*
	 $( ".cg_image" ).each(function() {
$(".cg_image").css('visibility','visible');   
});*/

$( ".show" ).css("display","hidden");
	
	// Hoverinhalt verstecken
	$( "[class*=hide]" ).hide();
  

   // Inhalt beim hovern aufdecken
	  $( ".show" ).hover(function() {
	  $(this).css("cursor: default");
	  //$("[class*=cgo]").css("cursor: default");
	 // $(".ul-cgrating").css("cursor: default");
	 
	  
	  var width = $(this).width();
	  var height = $(this).height();
	  // 22 ist die Breite des Hover-Balkens
	  height = height-32;
	  
	 // alert(width);
	  
	  if(width>130){
	   $(this).find( "[class*=hide]").toggle();
		
	  $(this).find( ".hide").css('width',width);
	  // Der Hoverbalken muss den Boden des Images treffen
	  $(this).find( ".hide").css('margin-top',height);
	  }
	  
});


// Auswahl select Feld
//$("#select").val(order);


// Prüfen ob Reihenfolge verändert wurde und Formular senden

$( "#select-order" ).change(function() {
$("#change-order").click();
});

$( "#select-look" ).change(function() {
$("#change-look").click();
});


$("[class*=click-pic]").click(function(){

var myClass = $(this).attr("class");

var id = myClass.substring(10);

$("#cg-img-"+id).click();

});



//$( document ).ready(function() {

//if(document.readyState === "complete"){

//alert(12312321);



//alert("test");


function heightLogic(arg){
	
  //alert("test: heightlogic");
	
  var HeightLookHeight = arg;
  
  //alert(HeightLookHeight);

   // Neue Höhe 
  var newHeight = 0;
  
  // Ermitteln von Breite des parent Divs nach resize
  var widthMainCGallery = parseInt($('#mainCGdiv').parent().width());
  
  //alert(widthMainCGallery);
  
  // Breite des divs in dem sich die Galerie befindet
  var widthmain = widthMainCGallery;
  var widthmainReal = widthmain;
  
  //alert(widthmain);
  
  //$(".werte").append('<br> WidthMain: '+widthmain+'<br>'); 
   
   // die einzelnen neu ermittelten Breiten die durch die vorgegebene Höhe entstehen werden gesammelt
  var widthArray = [];
  
   // die einzelnen Höhen sollen gesammelt werden. Bei Runter- und Hochskaliertung, ist es eine notwendige Angabe im Div 
  var heightArray = [];
  
  // Die Breite der Inhaltsboxen wird ermittelt
  var widthDivArray = [];
  
  // Anzahl der Durchläufe muss gezählt werden um den letzten Durchlauf zu ermitteln
  var lastLoopProcess = "<?php echo $count;?>";
  
  // Anzahl der Durchläufe muss gezählt werden um den letzten Durchlauf zu ermitteln
  var last = [];
    
  // Summe der einzelnen Breiten
  var aggregateWidth = 0;
  
  // Gesamtzahl der verarbeiteten Bilder
  var countProcessedPics = 0;
  
  // Summer der Gesamtlänge, um die alle Bilder, die in die Gesamtbreite reinpassen, insgesamt reduziert werden können. 
  // Mehr als 46% kann von einem Bild nicht abgezogen werden ( zuerst 10% Höhe, danach 20% Links, 20% Rechts >>>  46% prozent insgesamt als Reduzierung bei einem Bild möglich ) 
  var aggregateAcceptableReducedSize = 0;
  
  // Orientierungsvariable bei Durcharbeiten des großen Arrays   
  var r = 0;
  
   // Orientierungsvariable bei Durcharbeiten des großen Arrays   
  var i = 0;

  // 1. Die neue Höhe jedes einzelnen Bildes muss ermittelt werden. Diese wird in einem Array gesammelt.     
  
  //alert(widthmain);
  
 // alert(widthmain);
  
  $('#mainCGallery').css('width',widthmain);

  
	  $( ".show" ).each(function( i ) {
	  
	r++;
	
	// Die original Image Größen werden ermittelt über die hidden Felder. Die beim ersten Load von php ermittelt wurden.
	var width = $(this).find(".widthOriginalImg").val();
	var height = $(this).find(".heightOriginalImg").val();
	
    var newWidth = width*HeightLookHeight/height;
	
	// die einzelnen neu ermittelten Breiten die durch die vorgegebene Höhe entstehen werden gesammelt
	widthArray.push(newWidth);
	heightArray.push(HeightLookHeight);
	widthDivArray.push(newWidth);
	
	var cg_border_width = $("#cg-border-width").val();
	//alert(cg_border_width);
	aggregateWidth = aggregateWidth + newWidth;
	
	// zuerst 10% Höhe, danach 20% Links, 20% Rechts >>> 46% prozent insgesamt als Reduzierung möglich
	acceptableReducedSize = newWidth/100*46;
	
	// Summer der Gesamtlänge, um die alle Bilder, die in die Gesamtbreite reinpassen, insgesamt reduziert werden können. 
	aggregateAcceptableReducedSize = aggregateAcceptableReducedSize + newWidth;
	
	widthmain = widthmain-cg_border_width*2;
	
	//$(".werte").append('<br> aggregateWidth '+r+' :'+aggregateWidth+'<br>'); 
	////$(".werte").append('<br>'+r+' :'+src+'<br>'); 
	//$(".werte").append('<br> step '+r+' :'+lastLoopProcess+'<br>'); 
	
	//$(".werte").append('<br>Durchgang: '+i+'<br>'); 
	
	
	// Wenn es der letzte Durchlauf ist und die gesammelte Breite unter 90% der Gesamtbreite ergibt dann wird nichts gemacht
	if (aggregateWidth < widthmain/100*90 && lastLoopProcess == r) {
	
		for (i = countProcessedPics; i < r; i++) {
		
			//$(".werte").append('<br> Variante 0:<br>'); 
			//$(".werte").append('<br> widthArray['+i+']: '+widthArray[i]+'<br>'); 
			
			widthArray[i] = widthArray[i];
			widthDivArray[i] = widthDivArray[i];	

		//$(".werte").append('<br> Neue Breite:'+newWidth+'<br>'); 
		//$(".werte").append('<br> widthArray['+i+']: '+widthArray[i]+'<br>'); 
		
		}
		
	widthmain = widthmainReal;
	
	}
	
	
	// Wenn die gesammelte Breite 90% der Gesamtbreite ergibt, dann wird hochskaliert. Die Höhe bleibt die vorgegebene Höhe 
	else if (aggregateWidth >= widthmain/100*90 && aggregateWidth <= widthmain) {			
	
		for (i = countProcessedPics; i < r; i++) {
		
			//$(".werte").append('<br> Variante 1:<br>'); 
			//$(".werte").append('<br> widthArray['+i+']: '+widthArray[i]+'<br>'); 
			
			newWidth = widthArray[i]/(aggregateWidth*100/widthmain)*100;
			widthArray[i] = newWidth;
			widthDivArray[i] = newWidth;		
			
		//$(".werte").append('<br> Neue Breite:'+newWidth+'<br>'); 
		//$(".werte").append('<br> widthArray['+i+']: '+widthArray[i]+'<br>'); 
		
		
		

		
		}
		
		countProcessedPics = r;
		
		aggregateWidth = 0; // Gesammelte Breite wieder zurück auf Null setzen
		
		last[r] = 'on';
		
		//$(".werte").append('<br> countProcessedPics: '+countProcessedPics+'<br/>');
		//$(".werte").append('<br> last['+r+']: '+last[r]+'<br>'); 
		
		widthmain = widthmainReal;
	
	}
	
	// Wenn die gesammelte Breite größer als die Gesamtbreit ist, dann wird runterskaliert oder abgeschnitten
	else if(aggregateWidth > widthmain){
	
	// Größe des Überhangs
	overhang = aggregateWidth - widthmain;
	
	overhangInPercent = overhang*100/widthmain;
	
	//$(".werte").append('<br> overhangInPercent: '+overhangInPercent+'<br/>');
	
			// Wenn der Überhang nur unter 10% ist dann werden die Bilder NUR runterskaliert	 		
			if (overhangInPercent <= 10) {
			
			
				for (i = countProcessedPics; i < r; i++) {
				
					//$(".werte").append('<br> Variante 2:<br>'); 
					//$(".werte").append('<br> widthArray['+i+']: '+widthArray[i]+'<br>'); 
				
					newWidth = widthArray[i]/100*(100-overhangInPercent);
					newHeight = heightArray[i]/100*(100-overhangInPercent);
					widthArray[i] = newWidth;
					heightArray[i] = newHeight;
					widthDivArray[i] = newWidth;
					
					
					
					//$(".werte").append('<br> Neue Breite:'+newWidth+'<br>'); 
					//$(".werte").append('<br> widthArray['+i+']: '+widthArray[i]+'<br>'); 
				
				}
				
				countProcessedPics = r;
				
				last[r] = 'on';
				
		//$(".werte").append('<br> countProcessedPics: '+countProcessedPics+'<br/>');
		//$(".werte").append('<br> last['+r+']: '+last[r]+'<br>'); 
			
			}
			
			// Wenn der Überhang nur über 10% und unter 46% ist dann werden die Bilder abgeschnitten und runterskaliert			
			if (overhangInPercent > 10 && overhangInPercent <=46) {
						
				for (i = countProcessedPics; i < r; i++) {
				
				//$(".werte").append('<br> Variante 3:<br>'); 
				//$(".werte").append('<br> overhangInPercent: '+overhangInPercent+'<br/>');
				//$(".werte").append('<br> widthArray['+i+']: '+widthArray[i]+'<br>'); 
					

					newWidth = widthArray[i]/100*90;
					newHeight = heightArray[i]/100*90;
					widthArray[i] = newWidth;
					heightArray[i] = newHeight;
					//widthDivArray[i] = widthDivArray[i]/100*(100-Math.ceil((overhangInPercent-10)));
					widthDivArray[i] = newWidth;
					
					//alert(newHeight);
					//alert(newWidth);
					
				//$(".werte").append('<br> Neue Breite:'+newWidth+'<br>'); 
				//$(".werte").append('<br> Neue Div Breite:'+widthDivArray[i]+'<br>'); 
				//$(".werte").append('<br> widthArray['+i+']: '+widthArray[i]+'<br>'); 
				 				
				}
				
				countProcessedPics = r;
				
				last[r] = 'on';
				
				//$(".werte").append('<br> countProcessedPics: '+countProcessedPics+'<br/>');
				//$(".werte").append('<br> last['+r+']: '+last[r]+'<br>'); 
			
			}
			
			// Wenn der Überhang über 46% ist dann werden die Bilder abgeschnitten und runterskaliert. Beim letzten in der Reihe wird alles was über 46% ist komplett abgeschnitten.		
			if (overhangInPercent > 46) {
			
			
				for (i = countProcessedPics; i < r; i++) {
				
				//$(".werte").append('<br> Variante 4: '+newWidth+'<br>'); 
				
				newWidth = widthArray[i]/100*90;
				newHeight = heightArray[i]/100*90;
				widthArray[i] = newWidth;
				heightArray[i] = newHeight;
				widthDivArray[i] = widthDivArray[i]/100*(100-36);
				 				
				}
				
				countProcessedPics = r;
				
				last[r] = 'on';
				
				//$(".werte").append('<br> countProcessedPics: '+countProcessedPics+'<br/>');
				//$(".werte").append('<br> last['+r+']: '+last[r]+'<br>'); 
			
			}
			
	aggregateWidth = 0; // Gesammelte Breite wieder zurück auf Null setzen
	
	widthmain = widthmainReal;
	
	}  
	  
	  
 
	   });
	   
  
   var h = 0;
   var i = 0;
   var aggregateWidth = 0;
   

   
$( ".show" ).each(function( i ) {

	 
	 var srcOriginalImg = $(this).find('.srcOriginalImg').val();
	 var src1024width = $(this).find('.src1024width').val();
	 var src624width = $(this).find('.src624width').val();
	 var src300width = $(this).find('.src300width').val();
	  var hrefCGpic = $(this).find('.hrefCGpic').val();

//alert(srcOriginalImg);
	  
	  
		
			//width = widthArray[i]+'px';
			//height = heightArray[i]+'px';
			
			width = Math.ceil(widthArray[i])+2; 
			height = Math.ceil(heightArray[i]);
			
			
			
			
			//widthDiv = widthDivArray[i]+'px';
			widthDiv = Math.ceil(widthDivArray[i]);
			if (last[i+1] == 'on'){
				
				
				//alert(width);
				widthDiv = widthmain-aggregateWidth;
				//width = widthmain-aggregateWidth;
				aggregateWidth = 0;
				//if(i==3){alert(aggregateWidth);alert(width);}
			} 
			else{
				aggregateWidth = aggregateWidth + widthDiv;
			}
			
			
			
			
			
			paddinLeftRight = (width-widthDiv)/2;
			//paddinLeftRight = paddinLeftRight+'px';
			var cg_border_width = $("#cg-border-width").val();
			var cg_border_color = $("#cg-border-color").val();
			//var border = ""+cg_border_width+"px solid "+cg_border_color+";";
			
			//alert(widthDiv);
			$(this).css('width',widthDiv);
			$(this).css('height',height);
			$(this).css('float','left');
			$(this).css('display','inline');
			
			$(this).find(".append").css({"border-color": ""+cg_border_color+"", "border-width":""+cg_border_width+"px","border-style":"solid"});
			
			//alert("WidthDiv: "+widthDiv)

			//$(this).find(".append").append("<img src='"+srcOriginalImg+"' style='position:absolute;left: -"+paddinLeftRight+"px ;right:  -"+paddinLeftRight+"px ;max-width:none !important;' width='"+width+"px' height='"+height+"px' class='cg_image'>");
			
				/*	  if(WidthThumbPic<=300){ //alert("300");
			  $(this).find(".show-inner").find(".append").append("<a href='"+hrefCGpic+"'>"+
			  "<img src='"+src300width+"' style='position:absolute;"+padding+";max-width:none !important;' width='"+WidthThumbPic+"px' height='"+HeightThumb+"px' class='cg_image'>"+
			  "</a>");
			 // alert("WidthThumb1:" + WidthThumb);		
			  }*/
			
			
			
			  if(width<=300){ //alert("300");
			  $(this).find(".append").append("<a href='"+hrefCGpic+"' class='cg_image_href'>"+
			  "<img src='"+src300width+"' style='position:absolute;left: -"+paddinLeftRight+"px ;right:  -"+paddinLeftRight+"px ;max-width:none !important;' width='"+width+"px' height='"+height+"px' class='cg_image'>"+
			  "</a>");
			  }
			  
			  else if(width<=624){ //alert("624");
			  $(this).find(".append").append("<a href='"+hrefCGpic+"' class='cg_image_href'>"+
			  "<img src='"+src624width+"' style='position:absolute;left: -"+paddinLeftRight+"px ;right:  -"+paddinLeftRight+"px ;max-width:none !important;' width='"+width+"px' height='"+height+"px' class='cg_image'>"+
			  "</a>");
			  }
			  
			  else if(width<=1024){// alert("1024");
			   $(this).find(".append").append("<a href='"+hrefCGpic+"' class='cg_image_href'>"+
			  "<img src='"+src1024width+"' style='position:absolute;left: -"+paddinLeftRight+"px ;right:  -"+paddinLeftRight+"px ;max-width:none !important;' width='"+width+"px' height='"+height+"px' class='cg_image'>"+
			  "</a>");
			  }
			  
			  else if(width>1024){// alert("1024");
			  $(this).find(".append").append("<a href='"+hrefCGpic+"' class='cg_image_href'>"+
			  "<img src='"+srcOriginalImg+"' style='position:absolute;left: -"+paddinLeftRight+"px ;right:  -"+paddinLeftRight+"px ;max-width:none !important;' width='"+width+"px' height='"+height+"px' class='cg_image'>"+
			  "</a>");
			  }
			
			//$(this).find(".cg_image").attr('width',width);
			//$(this).find(".cg_image").attr('height',height);
			
			
			//$(this).find(".cg_image").css('left',-paddinLeftRight);
			//$(this).find(".cg_image").css('right',-paddinLeftRight);
			
			
			//$(this).css("display","inline");
			

	  
					// Hide Klasse ist die Div Box zum Hovern 
			/*	echo <<<HEREDOC
		<div style='float:left;display:inline;width:$widthDiv;height:$height;' class='show'><a href="$urlGalleryHref#begin" $scriptOnOff title="$commentText" >
		<img style="left: -$paddinLeftRight !important; right: -$paddinLeftRight !important; position: absolute !important; max-width:none !important;" alt="$commentText" src="$uploads/$Timestamp$imageThumb" class='cg_image' $JqgGalery1 width='$width' height='$height'></a>
		<div style='position:absolute;' class='hide'>
		<p style='display:block;padding-top:1px;padding-bottom:5px;background: rgba(0, 128, 128, .6);background: #008080;background-image: url($commentIcon); background-repeat:no-repeat;background-position: 40px 4px;'>
		<img src="$sourceStar">($countRating)
		&nbsp;&nbsp;($countComments)</p></div></div>
HEREDOC;

	*/   
	
	i++;
	
	

	  
	  });
	  
	 // if(document.readyState === "complete"){ 
	  	  $( ".show" ).each(function( i ) {


 //$( window ).load(function() {
	

	  
$(this).css("display","inline");
			


//});

	  
	  });	
	
	
}


// alert(242342);

function thumbLogic(){
	
 //alert(123213);
 

 
  // Ermitteln von Breite des parent Divs nach resize
  var widthMainCGallery = parseInt($('#mainCGdiv').parent().width());
  
  
  // Breite des divs in dem sich die Galerie befindet
  var widthmain = widthMainCGallery-2;
  
  
  $('#mainCGallery').css('width',widthmain);
  

	   
  
   var h = 0;
   var i = 0;
   
   //var aggregateWidth = 0;
   

  var newHeight = 0;   
   
   //alert('checkSumOfElementsWidth'+aggregateWidth);
   
   var checkFirstTimeWholeWidth = 0;
   
   
   
$( ".show" ).each(function( i ) {


	var aggregateWidth = parseInt($('.aggregateWidth').val()); // Hidden Feld zum sammeln und abrufen von aggregateWidth über Jquery
	var DistancePics = parseInt($(this).find('.DistancePics').val());
	var DistancePicsV = parseInt($(this).find('.DistancePicsV').val());


	 var widthOriginalImg = parseInt($(this).find('.widthOriginalImg').val());
	 var heightOriginalImg = parseInt($(this).find('.heightOriginalImg').val());
	 var WidthThumb = parseInt($(this).find('.WidthThumb').val());
	 var HeightThumb = parseInt($(this).find('.HeightThumb').val());
	 
	 //alert(WidthThumb);
	 //alert(WidthThumb);
	 
	 //$('#mainCGdiv').parent().width());
	 
	 var hrefCGpic = $(this).find('.hrefCGpic').val();
	 
	 
	 
	 
	 
	 
	 
	 var srcOriginalImg = $(this).find('.srcOriginalImg').val();
	 var src1024width = $(this).find('.src1024width').val();
	 var src624width = $(this).find('.src624width').val();
	 var src300width = $(this).find('.src300width').val();
	 
	 
	 
	 
	 
	 // Ermittlung der Höhe nach Skalierung. Falls unter der eingestellten Höhe, dann nächstgrößeres Bild nehmen.
					var heightScaledThumb = WidthThumb*heightOriginalImg/widthOriginalImg;
					
					//alert("heightScaledThumb: "+heightScaledThumb);
					// Falls unter der eingestellten Höhe, dann größeres Bild nehmen (normales Bild oder panorama Bild, kein Vertikalbild)
					
					if (heightScaledThumb <= HeightThumb) {
					
					var widthScaledThumb = HeightThumb*widthOriginalImg/heightOriginalImg;
					
					if(widthScaledThumb <= 300) {var imageThumb = src300width;}		
					if(widthScaledThumb > 300 && widthScaledThumb <= 624) {var imageThumb = src624width;}		
					if(widthScaledThumb > 624 && widthScaledThumb <= 1024) {var imageThumb = src1024width; }		
					if(widthScaledThumb > 1024) {var imageThumb = srcOriginalImg;}

					// Bestimmung von Breite des Bildes
					var WidthThumbPic = HeightThumb*widthOriginalImg/heightOriginalImg;
				
					
					// Bestimmung von Breite des Bildes
					var WidthThumbPic = WidthThumbPic+2;
					//$WidthThumbPic = $WidthThumbPic.'px';

					// Bestimmung wie viel links und rechts abgeschnitten werden soll
					var paddingLeftRight = (WidthThumbPic-WidthThumb)/2;
					    paddingLeftRight = paddingLeftRight+'px';
					
					var padding = "left: -"+paddingLeftRight+";right: -"+paddingLeftRight+"";
					
					
					
					}
					
						
					// Falls über der eingestellten Höhe, dann kleineres Bild nehmen (kein Vertikalbild)
					if (heightScaledThumb > HeightThumb) {
					if(WidthThumb <= 300) {var imageThumb = src300width;}		
					if(WidthThumb > 300 && WidthThumb <= 624) {var imageThumb = src624width;}		
					if(WidthThumb > 624 && WidthThumb <= 1024) {var imageThumb = src1024width;}		
					if(WidthThumb > 1024) {var imageThumb = srcOriginalImg;}
					
					//alert("WidthThumb: "+WidthThumb);
					
					// Bestimmung von Breite des Bildes
					var WidthThumbPic = WidthThumb+2;
					
					//alert("WidthThumbPic: "+WidthThumbPic1);
					
					
					//$WidthThumbPic = $WidthThumbPic.'px';
					
					// Bestimmung wie viel oben und unten abgeschnitten werden soll
					var heightImageThumb = WidthThumb*heightOriginalImg/widthOriginalImg;
					var paddingTopBottom = (heightImageThumb-HeightThumb)/2;
					    paddingTopBottom = paddingTopBottom+'px';
						
					
					
					var padding = "top: -"+paddingTopBottom+";bottom: -"+paddingTopBottom+"";
					
					
					
					}
					
					
					/*if($AllowRating==1){
						  echo "<div id='ul-stars' style='display:block;'><ul class='ul-cgrating'>";
						  echo "<li class='$star1' id='star1' ><a title='Ich vergebe dem Bild 1 Punkt' style='cursor: pointer;' alt='1'></a></li>";
						  echo "<li class='$star2' id='star2' ><a title='Ich vergebe dem Bild 2 Punkt' style='cursor: pointer;' alt='2'></a></li>";
						  echo "<li class='$star3' id='star3' ><a title='Ich vergebe dem Bild 3 Punkt' style='cursor: pointer;' alt='3'></a></li>";
						  echo "<li class='$star4' id='star4' ><a title='Ich vergebe dem Bild 4 Punkt' style='cursor: pointer;' alt='4'></a></li>";
						  echo "<li class='$star5' id='star5' ><a title='Ich vergebe dem Bild 5 Punkt' style='cursor: pointer;' alt='5'></a></li>";
						  echo "<li><div id='rating' style='display:inline;float:left;'>($countR)<div id='rated' style='position:absolute;padding-bottom:100px;float:left;visibility:hidden;'>Sie haben dieses Bild bereits bewertet!</div></div></li>";
						  echo "</ul>";
						  echo "</div>"; 
					}*/
					
			
			
						
			// Beim letzten Bild in der Reihe soll der Abstand nach rechts NULL sein
			
			// 			alert('aggregateWidth1 '+aggregateWidth);
			
			// Rechtzeitig auf Null setzen falls drüber ist
			var checkWholeWidth = aggregateWidth+WidthThumb;
			
		// 			alert('checkWholeWidth '+checkWholeWidth);
			// 		alert('DistancePics '+DistancePics);

			aggregateWidth = aggregateWidth + WidthThumb + DistancePics;
			
			// 			alert('checkWholeWidth '+checkWholeWidth);
	// 		alert('aggregateWidth2 '+aggregateWidth);
	// 		alert('WidthThumb '+WidthThumb);
			
			//echo "<br>checkSumOfElementsWidth: $checkSumOfElementsWidth<br>";
			
			// Rechtzeitig auf Null setzen falls drüber ist
			if(checkWholeWidth >= widthmain){  aggregateWidth = 0; checkFirstTimeWholeWidth = 1; }
			
			if(aggregateWidth >= widthmain){
			
			var DistancePics = 0;
			//DistancePicsPx = $DistancePicsPx."px";
			
			aggregateWidth = 0;
			
		// 	alert("true");
			
			}
			

			
	
//alert("works");
			// Ermitteln Anzahl der Bewertungen
					
			// Ermitteln wie die Stars angezeigt werden sollen beim hovern
			

	 	// margin-right: $DistancePicsPx;margin-top: $DistancePicsV;
			
		// 	alert('DistancePicsPx '+DistancePics);
	// 		alert('DistancePicsV '+DistancePicsV);
			
			$(this).css('margin-right',DistancePics);
			$(this).css('margin-top',DistancePicsV);
			$(this).css('float','left');
			$(this).css('display','inline');
			$(this).css('cursor','pointer');
			
			
			//$(this).find('show-inner').css('width',WidthThumb);
			//$(this).find('show-inner').css('height',HeightThumb);
			
			$(this).find(".append").css({"float":"left","display":"inline","width": ""+WidthThumb+"","height": ""+HeightThumb+""});
			
//alert("WidthThumbPic:" + WidthThumbPic);	
			//alert(checkFirstTimeWholeWidth);
			if(checkFirstTimeWholeWidth==0){$(this).css('margin-top','0px');}

		//alert(WidthThumbPic);
		  if(WidthThumbPic<=300){// alert("300");
			  $(this).find(".append").append("<a href='"+hrefCGpic+"' class='cg_image_href'>"+
			  "<img src='"+src300width+"' style='position:absolute;"+padding+";max-width:none !important;' width='"+WidthThumbPic+"px' height='"+HeightThumb+"px' class='cg_image'>"+
			  "</a>");
			 // alert("WidthThumb1:" + WidthThumb);		
			  }
			  
			  else if(WidthThumbPic<=624){//alert("600");
			  $(this).find(".append").append("<a href='"+hrefCGpic+"' class='cg_image_href'>"+
			  "<img src='"+src624width+"' style='position:absolute;"+padding+";max-width:none !important;' width='"+WidthThumbPic+"px' height='"+HeightThumb+"px' class='cg_image'>"+
			  "</a>");
			  }
			  
			  else if(WidthThumbPic<=1024){//alert("1000");
			  $(this).find(".append").append("<a href='"+hrefCGpic+"' class='cg_image_href'>"+
			  "<img src='"+src1024width+"' style='position:absolute;"+padding+";max-width:none !important;' width='"+WidthThumbPic+"px' height='"+HeightThumb+"px' class='cg_image'>"+
			  "</a>");
			  }
			  
			  else if(WidthThumbPic>1024){//alert("2000");
			  $(this).find(".append").append("<a href='"+hrefCGpic+"' class='cg_image_href'>"+
			  "<img src='"+srcOriginalImg+"' style='position:absolute;"+padding+";max-width:none !important;' width='"+WidthThumbPic+"px' height='"+HeightThumb+"px' class='cg_image'>"+
			  "</a>");
			  }
			

	$('.aggregateWidth').val(aggregateWidth); // Hidden Feld zum sammeln und abrufen von aggregateWidth über Jquery
	  
	
	i++;
	
	
//alert("i"+i)
	  
	  });
	  
	 // if(document.readyState === "complete"){ 
	  	  $( ".show" ).each(function( i ) {


 //$( window ).load(function() {
	

	  
$(this).css("display","inline");
			


//});

	  
	  });	
	
	
}


function rowLogic(){

//alert(look);

   // alert("ROW ANSICHT");
 
 // var height1 = parseInt(height);
 
 // Array für neue Höhen
  var newHeight1 = [];
  
  var newHeight2 = 0;
  
  // Beginn des Nenners
  var ratio = 0;
  
  // Array für mehrere Nenner (Gesamtzähler)
  var denominator1 = [];
  // a bestimmt mehrere Nenner
  var a = 0;
  
  // Gesamter Zähler
  var newNumerator = 0;
	
  // Beginn des Zählers im Bruch 
  var numerator = 0;
  
  // width/height
  var divArray = [];
  
  // Neue Höhe 
  var newHeight = 0;
  
  var partNumerator = 0;
  
  // Anzahl der hochgeladenen Bilder
  var n = $( ".show" ).length;
  
  //alert("N:"+n);
  
  // Wie viele Bilder sollen in einer Reihe dargestellt werden. Einstellung erfolgt durch User in Options
  var picsInRow = $("#cg_PicsInRow").val();
  

  
  //alert("PicsInRow: "+picsInRow);
  
  // Wie viele Bilder sollen pro Seite dargestellt werden. Einstellung erfolgt durch User in Options.
  var picsPerSite = $("#cg_PicsPerSite").val();
  
  // Breite des divs in dem sich die Galerie befindet
     var widthMainCGallery = $('#mainCGdiv').parent().width();
	//    alert("widthMainCGallery: "+widthMainCGallery);
	
	  //alert("widthMainCGallery: "+widthMainCGallery);
		
  //var widthmain = $('#mainCGallery').width();
  var widthmain = widthMainCGallery;
  
  //alert("Widthmain1: "+widthmain);
  
  //var widthmainDiv = widthmain-5;
  
  $('#mainCGallery').css('width',widthmain);
  
  // Gesamtbreite wird neu berechnet, da Anzahl der Bilder (.cg_image) kleiner ist als eingestellte Anzahl der Bilder in einer Reihe in Options 
  if(n < picsInRow){
  
  widthmain = widthmain/picsInRow*n;
  picsInRow = n;
  
  //alert("Widthmain"+widthmain);
  
  }
  
  var widthLastRow = widthmain/picsInRow*(n-Math.floor(n/picsInRow)*picsInRow);
  
    
  var lastRow = "<?php echo $LastRow;?>";
  
  //  alert(picsInRow);   alert(picsPerSite); alert(lastRow);


  var width2 = 0;
    
  var lastRowLeft = n-(n-Math.floor(n/picsInRow)*picsInRow);
  
  //alert(lastRowLeft);

   var lastImages = 1;
  
  // Orientierungsvariable bei Durcharbeiten des großen Arrays   
  var r = 0;
  
	  $( ".show" ).each(function( i ) {
	  
	  r++;
	  
	  //alert(r);
	  
	  
	  
	  //var width = $(this).width();
	  //var height = $(this).height();
	  
	  var width = $(this).find('.widthOriginalImg').val();
	 var height = $(this).find('.heightOriginalImg').val();
	 //var srcOriginalImg = $(this).find('.srcOriginalImg').val();
	  
	 // alert(width);
		
	  var div = width / height;
	  
	  ratio  = ratio + div;
	  
	  //alert(ratio);
	  
	 if (r>lastRowLeft) {
	 
  
	  width3 = newHeight2*width/height;
	  
	  width2 = width2 + width3;	  
	  
	  
	  }
	  

	  
		  if (r % picsInRow == 0) {
		  
			
		  denominator1.push(ratio);
				
				newHeight = Math.floor(widthmain/ratio);
				

				
				//alert("newHeight"+newHeight);

				newHeight1.push(newHeight);
				
				newHeight2 = newHeight;
		  
		  a++;
		  
		  newNumerator = 0;
		  		  
		  newHeight = 0;
		  
		  ratio = 0;
		  
		  divArray.length = 0;
		  
		  partNumerator = 0;

		  
		  }
		  
		  if (n/r == 1) {
		  

				
			if (lastRow==0) {
					
		
						
					if (width2<=widthmain) {

					
					
					newHeight = newHeight2;		
					
	
					
					}
					
					if (width2>widthmain) {

					newHeight = Math.floor(widthmain/ratio);

					
					}
				
				}
				
// alert(newHeight);
				newHeight1.push(newHeight);
		  
		  }
		  
		  
	  
	  
	  
	   });
	   

 
   var h = 0;
   var g = 0;
   
	var aggregateWidth=0;
   
   	  $( ".show" ).each(function( i ) {

	  
	   
	  g++;
	  
	  var setNewHeight = newHeight1[h];
	  
	// alert(newHeight1[h]);
	 
	 var widthOriginalImg = $(this).find('.widthOriginalImg').val();
	 var heightOriginalImg = $(this).find('.heightOriginalImg').val();
	 //var srcFirstLoad = $(this).find('.srcFirstLoad').val();
	 var srcOriginalImg = $(this).find('.srcOriginalImg').val();
	 var src1024width = $(this).find('.src1024width').val();
	 var src624width = $(this).find('.src624width').val();
	 var src300width = $(this).find('.src300width').val();
	 
	 var hrefCGpic = $(this).find('.hrefCGpic').val();
	 
	  //alert(widthOriginalImg);
	  //alert(heightOriginalImg);
	
	 var newWidthDiv = Math.ceil(widthOriginalImg*newHeight1[h]/heightOriginalImg);
	 
	 aggregateWidth = aggregateWidth+newWidthDiv;
	 
	 		  if (g % picsInRow == 0) {
		  
		  	//	  alert("aggregateWidth:" +aggregateWidth);
		 
		  
		  var newWidthDiv = newWidthDiv+(widthmain-aggregateWidth);
		  
		  //alert(newWidthImage);
		  aggregateWidth=0;
		  

		  }
	 
	 // alert(newHeight1[h]);
	 
	// alert(newWidthImage);
	 
	 //alert("setNewHeight: "+setNewHeight);	alert("newWidthImage: "+newWidthImage);
	 
	  $(this).css('height',newHeight1[h]);
	  $(this).css('width',newWidthDiv);
	  $(this).css('float','left');
	  
	  var newWidthImage = newWidthDiv+2;
	  
	  //alert(newWidthImageTest);
	 
	  
	 // $(this).find(".append").append("<img src='"+srcFirstLoad+"' style='float:left !important;position:absolute;left: -2px ;right:  -2px ;max-width:none !important;' width='"+newWidthImageTest+"' height='"+setNewHeight+"' class='cg_image'>");
	 
	 			 /* if(width<=300){ //alert("300");
			  $(this).find(".append").append("<a href='"+hrefCGpic+"'>"+
			  "<img src='"+src300width+"' style='position:absolute;left: -"+paddinLeftRight+"px ;right:  -"+paddinLeftRight+"px ;max-width:none !important;' width='"+width+"px' height='"+height+"px' class='cg_image'>"+
			  "</a>");
			  }*/
	  
	  if(newWidthImage<=300){ //alert("300");
	  $(this).find(".append").append("<a href='"+hrefCGpic+"' class='cg_image_href'>"+
	  "<img src='"+src300width+"' style='float:left !important;position:absolute;left: -2px ;right:  -2px ;max-width:none !important;' width='"+newWidthImage+"' height='"+setNewHeight+"' class='cg_image'>"+
	  "</a>");
	  }
	  
	  else if(newWidthImage<=624){ //alert("624");
	  $(this).find(".append").append("<a href='"+hrefCGpic+"' class='cg_image_href'>"+
	  "<img src='"+src624width+"' style='float:left !important;position:absolute;left: -2px ;right:  -2px ;max-width:none !important;' width='"+newWidthImage+"' height='"+setNewHeight+"' class='cg_image'>"+
	  "</a>");
	  }
	  
	  else if(newWidthImage<=1024){// alert("1024");
	  $(this).find(".append").append("<a href='"+hrefCGpic+"' class='cg_image_href'>"+
	  "<img src='"+src1024width+"' style='float:left !important;position:absolute;left: -2px ;right:  -2px ;max-width:none !important;' width='"+newWidthImage+"' height='"+setNewHeight+"' class='cg_image'>"+
	  "</a>");
	  }
	  
	  else if(newWidthImage>1024){// alert("1024");
	  $(this).find(".append").append("<a href='"+hrefCGpic+"' class='cg_image_href'>"+
	  "<img src='"+srcOriginalImg+"' style='float:left !important;position:absolute;left: -2px ;right:  -2px ;max-width:none !important;' width='"+newWidthImage+"' height='"+setNewHeight+"' class='cg_image'>"+
	  "</a>");
	  }
	  
	  //$(this).find('.cg_image').attr('height',setNewHeight);

	  		//<img alt="$commentText" src="$uploads/$Timestamp$imageThumb" class='cg_image' style='left:-2px; right: -2px;position:absolute;max-width:none;overflow:hidden;float:left !important;border:0 !important;visibility:hidden;cursor: pointer;'
       // width='$newWidthImagePx;' height='$newHeightImagePx;'>
	  
		  if (g % picsInRow == 0) {
		  
		  h++;
		  
		  }
	  
	  
	   });
	   
	   
	   	$( ".show" ).each(function( i ) {




			  
		$(this).css("display","inline");
					


	  
	  });	
	
}	



 if (look=='thumb') {
	 
	// alert("thumb");
$('.append').empty();
thumbLogic();

	 
	   }








if (look=='height') {

$('.append').empty();
heightLogic(HeightLookHeight);

	   
	   }
//alert("test");







	   
	if (look=='row') {

  $('.append').empty();
	rowLogic();   

	   
	   } 
	   
	   
//}

	
	
	
function changeLook(prev_look){
	
	var prev_look = prev_look;
	//alert(""+prev_look);
	var look = $("#cg_look").val();
	//alert(""+look);
	
			if(prev_look=='thumb'){var prev_look=1;}
			if(prev_look=='height'){var prev_look=2;}
			if(prev_look=='row'){var prev_look=3;}
			
			if(look=='thumb'){var look=1;}
			if(look=='height'){var look=2;}
			if(look=='row'){var look=3;}
			
		//	alert(look);
			
			
			$('.cg_image_href').each(function() {
			var cg_src = $(this).attr('href');
			//alert(cg_src);
			var cg_src_replace = cg_src.replace('&1='+prev_look+'&', '&1='+look+'&'); 
			//alert(cg_src_replace);
			$(this).attr("href",""+cg_src_replace+"")
			});
			
			
	
}

	$(document).on('click', '#cg_thumb_look_frontend', function(e){
		
		var prev_look = $("#cg_look").val();
		var look = $("#cg_look").val();
		//alert(look);
		if(look!='thumb'){
		//alert("thumbs");
		/*var cg_thumb_input = this;
        cg_thumb_input.disabled = true;
		cg_height_input.disabled = false;*/
		
			$('.show').attr('style','');
			$('.append').attr('style','');
			$('.append').empty();
		
			var cg_icon_forward = $(this).attr('src');
			var cg_src_thumb_icon = $(this).attr('src');
			cg_src_thumb_icon = cg_src_thumb_icon.substr(0,cg_src_thumb_icon.length - 7);
			//alert(cg_src_height_icon);
			cg_src_thumb_icon = cg_src_thumb_icon+'on.jpg';
			//alert(cg_src_height_icon);
			$(this).attr('src',cg_src_thumb_icon);
			
			
			$("#cg_row_look_frontend").attr('src',cg_icon_forward);

			$("#cg_height_look_frontend").attr('src',cg_icon_forward);
			
			
			$("#cg_look").val('thumb');
			$(this).css('cursor','default');
			$("#cg_height_look_frontend").css('cursor','pointer');
			$("#cg_row_look_frontend").css('cursor','pointer');
			
			var look = $("#cg_look").val();
			
			thumbLogic();
			
			changeLook(prev_look);
			
			}

});

	$(document).on('click', '#cg_height_look_frontend', function(e){
		
		var prev_look = $("#cg_look").val();
		var look = $("#cg_look").val();
				if(look!='height'){
	
		// var cg_height_input = this;
        //cg_height_input.disabled = true;
		//cg_thumb_input.disabled = false;
        /*setTimeout(function() {
           input.disabled = false;
        }, 3000);*/


	$('.show').attr('style','');
	//$('.show-inner').attr('style','');
	$('.append').attr('style','');
	$('.append').empty();
	
	var cg_icon_forward = $(this).attr('src');
	var cg_src_height_icon = $(this).attr('src');
	cg_src_height_icon = cg_src_height_icon.substr(0,cg_src_height_icon.length - 7);
	//alert(cg_src_height_icon);
	cg_src_height_icon = cg_src_height_icon+'on.jpg';
	//alert(cg_src_height_icon);
	$(this).attr('src',cg_src_height_icon);
	
	
	$("#cg_thumb_look_frontend").attr('src',cg_icon_forward);

	$("#cg_row_look_frontend").attr('src',cg_icon_forward);
	
	
	$("#cg_look").val('height');
	$(this).css('cursor','default');
	$("#cg_row_look_frontend").css('cursor','pointer');
	$("#cg_thumb_look_frontend").css('cursor','pointer');
	
	var look = $("#cg_look").val();
	
	//alert(look);
	

	heightLogic(HeightLookHeight);

	changeLook(prev_look);

				}

});


	$(document).on('click', '#cg_row_look_frontend', function(e){
		
		var prev_look = $("#cg_look").val();
		var look = $("#cg_look").val();
				if(look!='row'){
			

		// var cg_height_input = this;
        //cg_height_input.disabled = true;
		//cg_thumb_input.disabled = false;
        /*setTimeout(function() {
           input.disabled = false;
        }, 3000);*/
		
	

	$('.show').attr('style','');
	//$('.show-inner').attr('style','');
	$('.append').attr('style','');
	$('.append').empty();
	
	var cg_icon_forward = $(this).attr('src');
	var cg_src_row_icon = $(this).attr('src');
	cg_src_row_icon = cg_src_row_icon.substr(0,cg_src_row_icon.length - 7);
	//alert(cg_src_height_icon);
	cg_src_row_icon = cg_src_row_icon+'on.jpg';
	//alert(cg_src_height_icon);
	$(this).attr('src',cg_src_row_icon);
	

	$("#cg_thumb_look_frontend").attr('src',cg_icon_forward);

	$("#cg_height_look_frontend").attr('src',cg_icon_forward);
	
	
	$("#cg_look").val('row');
	$(this).css('cursor','default');
	$("#cg_height_look_frontend").css('cursor','pointer');
	$("#cg_thumb_look_frontend").css('cursor','pointer');
	
	var look = $("#cg_look").val();
	
	//alert(look);
	

	rowLogic();
	
	changeLook(prev_look);

				}
 

});




	$( window ).resize(function() {
		
	var look = $("#cg_look").val();

	
	//alert(look);	
		
if (look=='thumb') {
$('.append').empty();
thumbLogic();
	   
	   }		
			
		

//------------------------------------------------------------------	
// ---------- Row Ansicht Horizontal (Gleiche Anzahl der Bilder in einer Reihe) -------------------------------
//------------------------------------------------------------------	


	if (look=='row') {
$('.append').empty();
rowLogic(); 
	   
	   
	   }  
	   
//------------------------------------------------------------------	
// ---------- Row Ansicht Horizontal ENDE --------------------------
//------------------------------------------------------------------



//------------------------------------------------------------------	
// ---------- Same Height Ansicht Horizontal (Gleiche Anzahl der Bilder in einer Reihe) -------------------------------
//------------------------------------------------------------------	



 if (look=='height') {

 $('.append').empty();
var HeightLookHeight = $("#cg-height").val();	

heightLogic(HeightLookHeight);

	   
	   } 
	   
//------------------------------------------------------------------	
// ---------- SameHeight Ansicht Horizontal ENDE -------------------------- 
//------------------------------------------------------------------		



 
	   
	
	
});
	
	
	//});
	  

  
});