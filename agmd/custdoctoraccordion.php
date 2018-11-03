<?php
/*
  Template Name: XcustomDoctorAccordion
*/  
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
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
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div >  
    <h1 class="col text-center"> AGMD US State Doctor Lookup</h1>
    <br><br>
</div> 

    <?php get_template_part('doctor_accordion'); ?>  

<?php wp_footer(); ?>
</body>
</html>