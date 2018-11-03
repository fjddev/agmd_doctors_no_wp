<?php
function get_connection(){
	//$connection= new wpdb('agmdho5_dev','d5v%0gMd','agmdho5_admin','localhost');
	$connection= new wpdb('agmdho5_dev','d5v%0gMd','agmdho5_admin');
	return $connection;
}
function contentGenerator($fname, $lname) {
   if($fname) {
      return "$fname $lname";
   } else {
      return "Content false";
   }
}
function doctor_state_list(){
if(!$conn){	
   $conn = get_connection();	
}   
$rows = $conn->get_results("select * from doctor");
$results="";
foreach ($rows as $obj) :

   $results .=  '<a href="#" class="btn btn-primary btn-block" style="margin-bottom: 5px;">';
   $results .= contentGenerator($obj->first_name, $obj->last_name);
   $results .= "</a>";
   $results .= "<br>";
endforeach;


$results .= "</main>"; //main 
$results .= "</div>"; //primary 
$results .= "</div>"; //wrap 	
return $results;
}
?>