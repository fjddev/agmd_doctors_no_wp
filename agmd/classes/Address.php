<?php
class Address{
  private $doctor_id;
  private $address_name;
  private $address;
  private $city;
  private $state;
  private $zip5;
  private $zip4;

  public static $filter_state;

  private $addressData = Array();

  public function __construct(){

  }

  /**
   * Get the value of zip4
   */ 
  public function getZip4()
  {
    return $this->zip4;
  }

  /**
   * Set the value of zip4
   *
   * @return  self
   */ 
  public function setZip4($zip4)
  {
    $this->zip4 = $zip4;

    return $this;
  }

  /**
   * Get the value of zip5
   */ 
  public function getZip5()
  {
    return $this->zip5;
  }

  /**
   * Set the value of zip5
   *
   * @return  self
   */ 
  public function setZip5($zip5)
  {
    $this->zip5 = $zip5;

    return $this;
  }

  /**
   * Get the value of city
   */ 
  public function getCity()
  {
    return $this->city;
  }

  /**
   * Set the value of city
   *
   * @return  self
   */ 
  public function setCity($city)
  {
    $this->city = $city;

    return $this;
  }

  /**
   * Get the value of address
   */ 
  public function getAddress()
  {
    return $this->address;
  }

  /**
   * Set the value of address
   *
   * @return  self
   */ 
  public function setAddress($address)
  {
    $this->address = $address;

    return $this;
  }

  /**
   * Get the value of address_name
   */ 
  public function getAddress_name()
  {
    return $this->address_name;
  }

  /**
   * Set the value of address_name
   *
   * @return  self
   */ 
  public function setAddress_name($address_name)
  {
    $this->address_name = $address_name;

    return $this;
  }

  /**
   * Get the value of addressData
   */ 
  public function getAddressData()
  {
    return $this->addressData;
  }

  /**
   * Set the value of addressData
   *
   * @return  self
   */ 
  public function setAddressData($addressData)
  {
    $this->addressData[] = $addressData;

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

  public function getFullAddress(){
    return $this->getAddress_name() . ' ' . $this->getAddress() . ' ' .
            $this->getCity() . ' ' . $this->getState() . ' ' . 
            $this->getZip5() . '-' . $this->getZip4() ;
  }

  public static function isState(){
    if('MA' == $filter_state){
      return true;
    } else{
      return false;
    }
  }

  /**
   * Set the value of filter_state
   *
   * @return  self
   */ 
  public static function setFilter_state($filter_state)
  {
    self::$filter_state = $filter_state;

  }

  /**
   * Get the value of doctor_id
   */ 
  public function getDoctor_id()
  {
    return $this->doctor_id;
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
}
