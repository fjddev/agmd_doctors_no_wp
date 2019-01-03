`<?php require ('agmd/model/database.php'); ?>
<?php require ('agmd/model/DoctorDB.php'); ?>
<?php
global $db_password;
global $db_database;
global $db_host;
global $agmd_doctor_details_page;
global $agmd_doctor_accordion_page;
/*local
$db_username = 'root';
$db_password = 'pa55word';
$db_database = 'agmd';
$db_host = 'localhost:3306';
*/
$db_username = 'agmdho5_dev';
$db_password = 'd5v%0gMd';
$db_database = 'agmdho5_admin';
$db_host = 'www.agmdhope.org';
?>

<?php
$us_state_abbrs = [
  'Alabama'=>'AL','Alaska'=>'AK', 'Arizona'=>'AZ', 'Arizona'=>'AZ', 'Arkansas'=>'AR',
  'California'=>'CA','Colorado'=>'CO', 'Connecticut'=>'CT', 'Delaware'=>'DE',
  'Florida'=>'FL', 'Georgia'=>'GA', 'Hawaii'=>'HI',
  'Idaho'=>'ID', 'Illinois'=>'IL', 'Indiana'=>'IN', 'Iowa'=>'IA', 'Kansas'=>'KS', 'Kentucky'=>'KY',
  'Louisiana'=>'LA', 'Maine'=>'ME', 'Maryland'=>'MD', 'Massachusetts'=>'MA', 'Michigan'=>'MI', 'Minnesota'=>'MN', 'Mississippi'=>'MS', 'Missouri'=>'MO', 'Montana'=>'MT',
  'Nebraska'=>'NE', 'Nevada'=>'NV', 'New Hampshire'=>'NH', 'New Jersey'=>'NJ', 'New Mexico'=>'NM', 'New York'=>'NY', 'North Carolina'=>'NC', 'North Dakota'=>'ND',
  'Ohio'=>'OH', 'Oklahoma'=>'OK', 'Oregon'=>'OR', 'Pennsylvania'=>'PA', 'Rhode Island'=>'RI', 'South Carolina'=>'SC', 'South Dakota'=>'SD',
  'Tennessee'=>'TN', 'Texas'=>'TX', 'Utah'=>'UT', 'Vermont'=>'VT', 'Virginia'=>'VA', 'Washington'=>'WA', 'West Virginia'=>'WV',
  'Wisconsin'=>'WI', 'Wyoming'=>'WY'
    ];

?>

<!-- ACCORDION -->

<!DOCTYPE html>
<html>
<head>
  <title>AGMD US Doctor List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
 
</head>
<body>
<br>
<div class="fixed-top" style="margin-top: 20px; margin-bottom: 20px">
<a href="https://www.agmdhope.org" class="btn btn-primary"><i class="fa fa-home"></i> AGMD HOME</a>
</div>

<hr><br>
<h1 class="text-center text-primary">AGMD US Physician Locator</h1>
<br>
<hr><hr>
<div class="container">	
    
<div id="accordion" >
      <!--Begin State -->
      <?php 
        foreach($us_state_abbrs as $stateName=>$stateAbbr){
               $_state_name=str_replace(' ', '_', $stateName);
      ?>  
      <div class="card" id="<?php echo '#state_top_' . strtolower($stateAbbr) . '_top';  ?>">
        <div class="card-header" role="tab" id="<?php echo 'heading_' . strtolower($stateAbbr);?>">
          <h1 class="mb-0">
               <a  href="<?php echo '#' .  strtolower($_state_name); ?>"  
               class="collapsed card-link agmd-btn-primary btn-block 
               stated nav-link " 
                 state_abbr="<?php echo $stateAbbr?>" 
                 data-toggle="collapse" onclick="showDoctor('<?php echo strtolower($_state_name);?>', '<?php echo $stateAbbr; ?>' )";
                 > 
            <h1 class="col text-center"><i class="fa fa-flag" aria-hidden="true"></i>
 <?php echo $stateName; ?></h1>
              </a>
          </h1>
        </div>

        <div id="<?php echo strtolower($_state_name);?>" 
             class="collapse" 
             data-parent="#accordion" 
        >
             <div id="<?php echo strtolower($_state_name) . '_data';?>" class="card-body " onmousedown='return false;' onselectstart='return false;'>

</div>

        </div>

      </div>
      <hr>
         <?php } ?>

      <!--End State -->
</div>  <!-- accordion -->


       


    </div> <!--container-->

    <a href="https://www.agmdhope.org" class="btn btn-primary"><i class="fa fa-home"></i> AGMD HOME</a>

  <div style="margin-top:500px;"></div>
  
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  
 <script>  
var states = new Array();
function showDoctor(id , state) {
 
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
        xmlhttp.open("GET","get_doctor.php?state="+state,true);
        xmlhttp.send();
    }
	
	
jQuery( document ).ready( function( $ ) {

$('.stated').click(function(event){


    state = '<?php echo $stateAbbr; ?>';
	id="<?php echo strtolower($_state_name);?>";
	console.log(state, id);


   // event.preventDefault(); // prevent default behaviour of link click
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
        xmlhttp.open("GET","get_doctor.php?q="+state,true);
        xmlhttp.send();



 


});
});	

</script>
  </body>
  </html>`