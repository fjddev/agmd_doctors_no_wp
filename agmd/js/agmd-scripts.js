var states = new Array();
function showDoctor(id, state) {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(id).innerHTML = this.responseText;
            }
        };
        /*xmlhttp.open("GET","getDoctor.php?q="+state,true);*/
		xmlhttp.open("GET","getDoctor.php?q="+state,true);
        xmlhttp.send();
 }
 
 


jQuery( document ).ready( function( $ ) {
$('.stated').click(function(event){


    event.preventDefault(); // prevent default behaviour of link click

    var state_abbr = $(this).attr('state_abbr');
	var value = $( this ).attr( 'href' );
    var state_data =  value + "_data";

    console.log('value: ' + value,state_data,state_abbr);



    

    // Return when a state has been previously processed
    // This eliminates duplicate data being processed.
    var stateExists = states.includes(state_abbr);
    if(!stateExists){
        states.push(state_abbr);
    }else{
      //  return;
    }



  var data = {
    cache: false,  
	type:   'post',
    'action': 'get_doctor', 'state': state_abbr
  };
  $.post( ajaxurl, data, function( response ) { 
      console.log('response',response);
      $(state_data).append(response);
    //   window.location.hash = '#state_top_'+state_abbr;

  });




});

// here



});  //stated click event




