<?php 
/*use CarSharingAbstract;*/

trait AddDriverTrait 
{  
  
  protected $addDriverStatus = false;

  public function setAddDriverStatus($option, $tariff) 
  {
    $validForTariffs = ['hourly', 'dayly'];
    $this->addDriverStatus = (!empty($option) && $option['name'] == 'addDriver' && in_array($tariff, $validForTariffs)) ? true : false;
  }

  public function getAddDriverStatus() 
  {
    return $this->addDriverStatus;
  }
  
}