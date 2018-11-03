<?php require ('agmd/model/database.php'); ?>
<?php require ('agmd/model/DoctorDB.php'); ?>
<?php


$doctorDB = new DoctorDB();
$state = $_GET['state'];


$results = NULL;
$results = $doctorDB->get_wp_DoctorByState($state);

echo $results;

?>