<?php
/*use CarSharingAbstract;*/

trait GpsTrait 
{
  protected $gpsStatus = false;

  public function setGpsStatus($option, $tariff) 
  { 
    $validForTariffs = ['base', 'hourly','dayly', 'student'];
    $this->gpsStatus = (!empty($option) && $option['name'] == 'gps' && in_array($tariff, $validForTariffs)) ? true : false;
  }

  public function getGpsStatus() 
  {
    return $this->gpsStatus;
  }

}