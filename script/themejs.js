$(document).ready(function(e) {

//$('#showpane').animate({left:'0.1px',},400);

	$('#shadow').animate({top:'-110px;'});
	//$('#shadow').animate({height:'100px'});
	
   $('#showpane').hide();
 
   $('#pane').mouseover(function(e) {

$('#showpane').show();
      $('#showpane').animate({right:'0.1px',},400);

    });
	//$('#refresh').click().select('#main').addClass('shadow');
  $('#showpane').mouseleave(function(e) {
    $('#showpane').animate({right:'-150px'},500);
});



});