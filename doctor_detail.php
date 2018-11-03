<?php require ('agmd/model/database.php'); ?>
<?php require ('agmd/model/DoctorDB.php'); ?>
<?php 
 
 $doctor_id =  $_GET['doctor_id']; 
 $doctor = new DoctorDB();
 $results = $doctor->get_wp_doctor_detail($doctor_id);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	  <style>
     /*Add scrollbars to the card body  */
/*	
    .card-body{
        overflow-y:scroll;
        height:100px;
    }
    */  
  </style>
</head>
<body>



    <h2 class="text-center text-info">Doctor Details</h2>

    <?php  echo $results;  ?>  
    <tr>
    
    <a href="index.php"  class="btn agmd-btn-primary">Back</a> 
			  
			
</body>
</html>