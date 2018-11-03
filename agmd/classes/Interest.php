<?php
class Interest{
   private $interestData = Array();

   private $interest;

   public function __construct(){

   }

   /**
    * Get the value of interest
    */ 
   public function getInterestData()
   {
      return $this->interestData;
   }

   /**
    * Set the value of interest
    *
    * @return  self
    */ 
   public function setInterestData($interest)
   {
      $this->interestData[] = $interest;

   }

   /**
    * Get the value of interest
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
      $this->interest = $interest;

      return $this;
   }
}