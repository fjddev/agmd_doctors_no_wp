<?php  include (__DIR__ . '/../classes/Doctor.php'); ?>
<?php

class DoctorDB {

    function get_doctor_title($doctor_id){
		
		
        $db = Database::getDB();
        $query = "SELECT title FROM doctor_titles WHERE doctor_id = :doctor_id";
   
        $statement = $db->prepare($query);
        $statement->bindValue(':doctor_id', $doctor_id);       
        $statement->execute();     		


        $title_results="";

        foreach($statement as $r){

                $title_results .= $r['title'];

        }

        return $title_results;       

    }



    function get_doctor_interests($doctor_id){
        $db = Database::getDB();

        $query="";
        $query .= "SELECT interest FROM doctor_interest WHERE doctor_id = :doctor_id order by interest";


        $statement = $db->prepare($query);
        $statement->bindValue(':doctor_id', $doctor_id);       
        $statement->execute(); 

        $interest_results="";

        foreach($statement as $r){

                $interest_results .= $r['interest'] .",  ";

        }

        return $interest_results;

    }

	public function getDoctorByState($state, $db){

        //$db = Database::getDB();

        $query = "SELECT d.credentials,d.first_name, d.last_name,  a.address_name, a.address, a.city, a.state, a.zip5 

                    FROM doctor d, address_us a

                    where d.doctor_id = a.doctor_id

                    and a.state=:state";

        $statement = $db->prepare($query);

        $statement->bindValue(':state', $state);

        $statement->execute();  



        $results="";

        $results .= "<table>

        <tr>

        <th>First Name</th>

        <th>Last Name</th>

        <th>Credentials</th>

        <th>Address1</th>

        <th>Address2</th>

        <th>City</th>

        <th>State</th>

        <th>Zip5</th>

        </tr>";

        return $results;

        foreach ($statement as $row)  {

            $results .= "<tr>";

            $results .= "<td>" . $row['first_name'] . "</td>";

            $results .= "<td>" . $row['last_name'] .  "</td>";

            $results .= "<td>" . $row['credentials'] . "</td>";

            $results .= "<td>" . $row['address_name'] . "</td>";

            $results .= "<td>" . $row['address'] . "</td>";

            $results .= "<td>" . $row['city'] . "</td>";

            $results .= "<td>" . $row['state'] . "</td>";

            $results .= "<td>" . $row['zip5'] . "</td>";

            $results .= "</tr>";

        }

        $results .= "</table>";	



        die($results);



        return $results;

    }

    function prepareAddress($company, $addr1, $addr2, $addr3, $addr4, $city, $state, $zip5, $zip4 ){

    

        $formatAddress = $company . "<br>";

        if($addr1) $formatAddress .= $addr1 . "<br>";

        if($addr2) $formatAddress .= $addr2 . "<br>";

        if($addr3) $formatAddress .= $addr3 . "<br>";

        if($addr4) $formatAddress .= $addr4 . "<br>";

        // $formatAddress .= $city . "<br>";

        // $formatAddress .= $state . "<br>";

        if($zip4){

             $formatAddress .= $city . ", " . $state . " " .  $zip5 . "-" . $zip4 . "<br>";

        } else {

             $formatAddress .= $city . ", " . $state . " " . $zip5. "<br>";

        }     

        return $formatAddress;

                         

    }



    function get_doctor_phones($doctor_id){

        $db = Database::getDB();

        $query="";
        $query .= "SELECT phone FROM doctor_telephone WHERE doctor_id = :doctor_id";


        $statement = $db->prepare($query);
        $statement->bindValue(':doctor_id', $doctor_id);       
        $statement->execute(); 


        $results = "";

        foreach($statement as $row){

            $results .=  $row['phone'] ."<br>";

        }       



        return $results;



    }



public function get_wp_doctor_detail($doctor_id){

    $db = Database::getDB();	
	$query = "";
    $query .= "SELECT d.doctor_id, d.credentials, d.first_name, d.last_name, a.address_name, ";
	$query .= "       a.address, a.address2, a.address3, a.address4, a.city, a.state, a.zip5, a.zip4 ";
	$query .= " FROM doctor d, address_us a ";
	$query .= "WHERE d.doctor_id = a.doctor_id AND d.doctor_id=:doctor_id ";
	
	$statement = $db->prepare($query);
    $statement->bindValue(':doctor_id', $doctor_id);       
    $statement->execute();     	
	



        

        $results="";

        $results .= '<div  style="overflow-x:auto;" class="agmd-no-copy">';

        $results .= "<table class='table table-bordered table-hover table-striped'>

        <tr>

        <th>Doctor</th>

        <th style='width: 20%'>Title</th>

        <th style='width: 30%' >Interests</th>

        <th>Address</th>

        <th>Phone</th>

        </tr>";



        foreach ($statement as $row) {
            $doctor_id = $row['doctor_id'];
            $titles = $this->get_doctor_title($doctor_id);

            $results .= "<tr>";

            $results .= "<td>". $row['credentials'] . " " . $row['first_name'] . " " . " " . $row['last_name'] . "</td>";

            $results .= "<td>" . $titles . "</td>";



            $results .= "<td>" . $this->get_doctor_interests($doctor_id) . "</td>";



            $address_display = $this->prepareAddress($row['address_name'],

                                                     $row['address'],

                                                     $row['address2'],

                                                     $row['address3'],

                                                     $row['address4'],

                                                     $row['city'],

                                                     $row['state'],

                                                     $row['zip5'],

                                                     $row['zip4']

        );



            $results .= "<td>" . $address_display . "<br>" . "</td>";

            $phones = $this-> get_doctor_phones($doctor_id);

            $results .= "<td>" . $phones  ."<td>";



            $results .= "</tr>";

        }

        $results .= "</table>";	   

        $results .= "</div>";  //agmd-no-copy

        

        $results .= "</main>"; //main 

        $results .= "</div>"; //primary 

        $results .= "</div>"; //wrap 	



        return $results;        

    }
	
	
    public function get_wp_doctor_detail_orig($doctor_id){

        $connection=null;



        if(!$connection){

           $connection = $this->get_connection();

        } 

        

        $rows = $connection->get_results($connection->prepare("SELECT d.doctor_id, d.credentials, d.first_name, d.last_name, a.address_name, a.address, a.address2, a.address3, a.address4, a.city, a.state, a.zip5, a.zip4

        FROM doctor d, address_us a

        where d.doctor_id = a.doctor_id

        and d.doctor_id=%d", $doctor_id)); 

        

        $results="";

        $results .= '<div  style="overflow-x:auto;" class="agmd-no-copy">';

        $results .= "<table class='table table-bordered table-hover table-striped'>

        <tr>

        <th>Doctor</th>

        <th style='width: 20%'>Title</th>

        <th style='width: 30%' >Interests</th>

        <th>Address</th>

        <th>Phone</th>

        </tr>";



        foreach ($rows as $obj) {

            $titles = $this->get_doctor_title($obj->doctor_id);

            $doctor_id = $obj->doctor_id;

            // $interests = $obj->doctor_id;

            $results .= "<tr>";

            $results .= "<td>". $obj->credentials . " " . $obj->first_name . " " . " " . $obj->last_name . "</td>";

            $results .= "<td>" . $titles . "</td>";



            $results .= "<td>" . $this->get_doctor_interests($doctor_id) . "</td>";



            $address_display = $this->prepareAddress($obj->address_name,

                                                     $obj->address,

                                                     $obj->address2,

                                                     $obj->address3,

                                                     $obj->address4,

                                                     $obj->city,

                                                     $obj->state,

                                                     $obj->zip5,

                                                     $obj->zip4

        );



            $results .= "<td>" . $address_display . "<br>" . "</td>";

            $phones = $this-> get_doctor_phones($doctor_id);

            $results .= "<td>" . $phones  ."<td>";



            $results .= "</tr>";

        }

        $results .= "</table>";	   

        $results .= "</div>";  //agmd-no-copy

        

        $results .= "</main>"; //main 

        $results .= "</div>"; //primary 

        $results .= "</div>"; //wrap 	



        return $results;        

    }	



public function get_wp_DoctorByState($state){	 

    $db = Database::getDB();	
	$query = "";
	$query .= "SELECT d.doctor_id, d.credentials, d.first_name, d.last_name, a.city ";
    $query .= "FROM doctor d, address_us a ";
    $query .= "WHERE d.doctor_id = a.doctor_id and a.state=:state_abbr";
	


    $statement = $db->prepare($query);
    $statement->bindValue(':state_abbr', $state);       
    $statement->execute();   	 

	//Check for no results
	$count =  $statement->rowCount();
	if($count == 0){
		$results = "";
		$results = '<div class="alert alert-info col text-center">
		            <strong ><h1> No doctors available at this time for this state.</h1></strong> 
	                </div>';
		return  $results;

	}
	
    $results="";

	$results .= '<div class="container"  style="overflow-x:auto;" >';
	$results .= "<table class='table   table-bordered table-hover table-striped'> ";
	$results .= "<tr> ";
	$results .= "<th >Doctor</th> ";
	$results .= "<th style='width: 25%'>Title</th> ";
	$results .= "<th style='width: 25%'>City/Town</th> ";
	$results .= "<th style='width: 5%'>&nbsp;</th> ";
	$results .= " </tr> "        ;

	foreach ($statement as $row) {

		$titles = $this->get_doctor_title($row['doctor_id']);

		$doctor_id = $row['doctor_id'];


		$results .= "<tr>";

		$results .= "<td>". $row['credentials'] . " " . $row['first_name'] . " " . " " . $row['last_name'] . "</td>";

		$results .= "<td>" . $titles . "</td>";

		$results .= "<td>" . $row['city'] . "</td>";

		$page_name = "doctordetails";

	//	$templ_dir =  get_page_link($agmd_doctor_details_page) ;

		$results .="<td><a href=" . 

		"doctor_details.php?doctor_id={$doctor_id}" .

		 " class='btn agmd-btn-primary doctor_select btn-lg'>Detail</a>" . "</td>";



		$results .= "</tr>";

	}

	$results .= "</table>";	   



	$results .= "</div>"; // agmd-no-copy

	

	$results .= "</main>"; //main 

	$results .= "</div>"; //primary 

	$results .= "</div>"; //wrap 	


	return $results;



}
	
	
 	public function get_wp_DoctorByState_orig($state){
	 global $agmd_doctor_details_page;	

     $connection = $this->get_connection(); 
	 

	 if(!$connection){
		die("NOT CONNECTED");
	 }

    $rows = null;

    $rows = $connection->get_results($connection->prepare("SELECT d.doctor_id, d.credentials, d.first_name, d.last_name, a.city
     FROM doctor d, address_us a
     where d.doctor_id = a.doctor_id
     and a.state=%s", $state)); 





        $results="";

        $results .= '<div class="container"  style="overflow-x:auto;" >';

        $results .= "<table class='table   table-bordered table-hover table-striped'>

        <tr>

        <th >Doctor</th>

        <th style='width: 25%'>Title</th>

        <th style='width: 25%'>City/Town</th>

        <th style='width: 5%'>&nbsp;</th>

        </tr>";





        if(!$rows){

            $results = "";

            $results = '<div class="alert alert-info col text-center">

            <strong ><h1> No doctors available at this time for this state.</h1></strong> 

          </div>';

            return  $results;

        }





        foreach ($rows as $obj) {

            $titles = $this->get_doctor_title($obj->doctor_id);

            $doctor_id = $obj->doctor_id;

            // $interests = $obj->doctor_id;

            $results .= "<tr>";

            $results .= "<td>". $obj->credentials . " " . $obj->first_name . " " . " " . $obj->last_name . "</td>";

            $results .= "<td>" . $titles . "</td>";

            $results .= "<td>" . $obj->city . "</td>";

            $page_name = "doctordetails";

            $templ_dir = 

                         get_page_link($agmd_doctor_details_page) ;

            $results .="<td><a href=" . 

            "{$templ_dir}?doctor_id={$doctor_id}" .

             " class='btn agmd-btn-primary doctor_select btn-lg'>Detail</a>" . "</td>";



            $results .= "</tr>";

        }

        $results .= "</table>";	   



        $results .= "</div>"; // agmd-no-copy

        

        $results .= "</main>"; //main 

        $results .= "</div>"; //primary 

        $results .= "</div>"; //wrap 	



        return $results;



    }	



    public function addInterestToDoctor($doctor_id, $doctor ){

        $db = Database::getDB();

        $query='SELECT interest from doctor_interest

            WHERE doctor_id = :doctor_id'; 

  

        $statement = $db->prepare($query);     

        $statement->bindValue(':doctor_id', $doctor_id);   

        $statement->execute();



        foreach ($statement as $row) {

            $interest = new Interest();

            $interest->setInterest($row['interest']);

            $doctor->setInterests($interest);



        }



      

    }  

    public function addAddressToDoctor($doctor_id, $doctor){

        

        $db = Database::getDB();

        $query = 'SELECT * FROM address_us where doctor_id = :doctor_id';

   

        $statement = $db->prepare($query);

        $statement->bindValue(':doctor_id', $doctor_id);       

        $statement->execute();     

        



       foreach ($statement as $row) {

 

         $address = new Address();

         $address->setDoctor_id($doctor_id);

         $address->setAddress_name($row['address_name']);

         $address->setAddress($row['address']);

         $address->setCity($row['city']);

         $address->setState($row['state']);

         $address->setZip5($row['zip5']);

         $address->setZip4($row['zip4']);

         $doctor->setState($row['state']);

         $doctor->setAddress($address);

       }

       

       

    }    



    public function addTelephoneToDoctor($doctor_id, $doctor){

        

        $db = Database::getDB();

        $query = 'SELECT * FROM doctor_telephone where doctor_id = :doctor_id';

   

        $statement = $db->prepare($query);

        $statement->bindValue(':doctor_id', $doctor_id);       

        $statement->execute();     

        



       foreach ($statement as $row) {

 

         $telephone = new Telephone();

         $telephone->setPhone($row['phone']);

         $telephone->setType($row['type']);

         $doctor->setTelephones($telephone);

       }

       

       

    }        



    public function addEmailToDoctor($doctor_id, $doctor){

        

        $db = Database::getDB();

        $query = 'SELECT * FROM doctor_email where doctor_id = :doctor_id';

   

        $statement = $db->prepare($query);

        $statement->bindValue(':doctor_id', $doctor_id);       

        $statement->execute();     

        



       foreach ($statement as $row) {

 

         $email = new Email();

         $email->setEmail($row['email']);



         $doctor->setEmails($email);

       }

       

       

    }   

    public function loadAllDoctors(){



        $db = Database::getDB();

        $query = "SELECT           d.doctor_id,

                                   d.credentials,

                                   d.first_name,

                                   d.last_name



       FROM doctor d 

       order by d.doctor_id";

        $statement = $db->prepare($query);

        $statement->execute();



        $doctor = new Doctor();



        $doctors = Array();  

        $interests=Array();

        $addresses=Array();   

        $telephones=Array();

        $emails=Array();

 

        foreach ($statement as $row) {

            $doctor = new Doctor();



             $doctor_id = $row['doctor_id'];

             $doctor->setDoctor_id($doctor_id);

             $doctor->setCredentials($row['credentials']);

             $doctor->setFirst_name($row['first_name']);

             $doctor->setLast_name($row['last_name']); 

             



             

             $interests = $this->addInterestToDoctor($row['doctor_id'], $doctor);



             $addresses = $this->addAddressToDoctor($row['doctor_id'],$doctor);



             $telephones = $this->addTelephoneToDoctor($row['doctor_id'],$doctor);



             $emails = $this->addEmailToDoctor($row['doctor_id'],$doctor);             



             $doctors[] = $doctor;              

                                                       

         

        }

        return $doctors;    

    }



    public function getDoctorsByState($doctors, $state){

        Address::setFilter_state($state); 





        $found=false;

        foreach($doctors as $doctor){



            if($doctor->getState()!= $state){

                continue;

            }

            $found=true;

            echo $doctor->getDoctorName() . '<br>';            



            $addresses = $doctor->getAddresses();



            foreach($doctor->getAddresses() as $address){

                     echo $address->getFullAddress() . '<br> ';



            }







            foreach($doctor->getInterests() as $interest) {

                echo $interest->getInterest() .'|';

            }

            echo '<br>';

            foreach($doctor->getTelephones() as $telephone){

                echo $telephone->getPhone() . '|';

            }

            echo '<br>';

            foreach($doctor->getEmails() as $email){

                echo $email->getEmail() . '|';

            }           

            echo '<br><br>';

           }  //foreach doctor



           if(!$found){

              echo "Nothing to report at this time.<br>";

              return;

           } 

    



    }

    //     foreach($doctors as $doctor){



    //         $addresses = $doctor->getAddresses();



    //         Address::setFilter_state('MA'); 

    //         foreach($doctor->getAddresses() as $address){

    //                  echo $address->getFullAddress() . '<br> ';



    //         }





    //         echo $doctor->getDoctorName() . '<br>';            

    //         echo '<br>';

    //         foreach($doctor->getInterests() as $interest) {

    //             echo $interest->getInterest() .'|';

    //         }

    //         echo '<br>';

    //         foreach($doctor->getTelephones() as $telephone){

    //             echo $telephone->getPhone() . '|';

    //         }

    //         echo '<br>';

    //         foreach($doctor->getEmails() as $email){

    //             echo $email->getEmail() . '|';

    //         }           

    //         echo '<br><br>';

    //        }  //foreach doctor

    





         





    //     echo "loadAllDoctors<br>";



    // }



	public function getDoctorByName($state){

        $db = Database::getDB();

            $query = "SELECT d.credentials,d.first_name, d.last_name

                       FROM doctor d

                       where a.state=:state";

            $statement = $db->prepare($query);

            $statement->bindValue(':state', $state);

            $statement->execute();  	

    }

 





    

 



} //class

?>