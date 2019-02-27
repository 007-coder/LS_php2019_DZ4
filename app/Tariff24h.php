<?php 

/**
* 
*/
class Tariff24h extends A_CarSharing
{
  const PRICE_PER_MINUTE = 0;
  const PRICE_PER_KM = 0;

  protected $_tData = [];
  protected $_tOptions = [];

  public function __construct($data = [], $options = [])
  {    
    $this->_tData = $data;
    $this->_tOptions = $options;    

  }  

  public function calcPrice() 
  {
    
  }
  
}