<?php

include("Interest.php");
include("Address.php");
include("Telephone.php");
include("Email.php");

class Doctor{
  // Keys
  private $state;
  private $doctor_id;
  private $first_name;
  private $last_name;
  private $credentials;

  // Interest Instance
  private $interest;
  // Address Instance
  private $address;
  // Telephone Instance
  private $telephone;
  // Email Instance;
  private $email;

  // Array of address objects 
  private $addresses;
  // Array of interests objects
  private $interests;
  // Array of telephone objects
  private $telephones;
  // Array of email objects
  private $emails;

  public function __construct(){
    $this->interest = new Interest();
    $this->address = new Address();
    $this->telephone = new Telephone();
    $this->email = new Email();

    $this->addresses = Array();
    $this->interests = Array();
    $this->telephones = Array();
    $this->emails = Array();

  }


  /**
   * Set the value of doctor_id
   *
   * @return  self
   */ 
  public function setDoctor_id($doctor_id)
  {
    $this->doctor_id = $doctor_id;

    return $this;
  }
    /**
   * Get the value of state
   */ 
  public function getState()
  {
    return $this->state;
  }

  /**
   * Set the value of state
   *
   * @return  self
   */ 
  public function setState($state)
  {
    $this->state = $state;

    return $this;
  }

  /**
   * Get the value of first_name
   */ 
  public function getFirst_name()
  {
    return $this->first_name;
  }

  /**
   * Set the value of first_name
   *
   * @return  self
   */ 
  public function setFirst_name($first_name)
  {
    $this->first_name = $first_name;

    return $this;
  }

  /**
   * Get the value of last_name
   */ 
  public function getLast_name()
  {
    return $this->last_name;
  }

  /**
   * Set the value of last_name
   *
   * @return  self
   */ 
  public function setLast_name($last_name)
  {
    $this->last_name = $last_name;

    return $this;
  }

  /**
   * Get the value of credentials
   */ 
  public function getCredentials()
  {
    return $this->credentials;
  }

  /**
   * Set the value of credentials
   *
   * @return  self
   */ 
  public function setCredentials($credentials)
  {
    $this->credentials = $credentials;

    return $this;
  }

  public function getDoctorName(){
    return $this->first_name . ' ' . 
           $this->last_name  . ' ' .
           $this->credentials;

  }

  /**
   * Get the value of interests
   */ 
  public function getInterest()
  {
    return $this->interest;
  }



  /**
   * Set the value of interest
   *
   * @return  self
   */ 
  public function setInterest($interest)
  {

    $this->interest->setInterestData($interest);

  }



  /**
   * Set the value of address
   *
   * @return  self
   */ 
  public function setAddress($addressRef)
  {
    $this->addresses[]=$addressRef;

    return $this;
  }

  /**
   * Return an array of address objects
   */ 
  public function getAddresses()
  {
    return $this->addresses;
  }

  /**
   * Get the value of interests
   */ 
  public function getInterests()
  {
    return $this->interests;
  }

  /**
   * Set the value of interests
   *
   * @return  self
   */ 
  public function setInterests($interest)
  {
    $this->interests[] = $interest;

    return $this;
  }

  /**
   * Get the value of telephones
   */ 
  public function getTelephones()
  {
    return $this->telephones;
  }

  /**
   * Set the value of telephones
   *
   * @return  self
   */ 
  public function setTelephones($telephone)
  {
    $this->telephones[] = $telephone;

    return $this;
  }

  /**
   * Get the value of emails
   */ 
  public function getEmails()
  {
    return $this->emails;
  }

  /**
   * Set the value of emails
   *
   * @return  self
   */ 
  public function setEmails($email)
  {
    $this->emails[] = $email;

    return $this;
  }


}