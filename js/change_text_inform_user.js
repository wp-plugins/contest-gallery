jQuery(document).ready(function($){
	
  
$( "#questionUrl" ).hover(function() {
   $('#answerUrl').toggle();
    $(this).css('cursor','pointer');
});

$( "#questionLink" ).hover(function() {
   $('#answerLink').toggle(); 
    $(this).css('cursor','pointer');
});

  
});