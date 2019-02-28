<?php 

/**
* 
*/
class TariffBase extends CarSharingAbstract
{
  const PRICE_PER_MINUTE = 3;
  const PRICE_PER_KM = 10;

  public function __construct($tariff, $distance, $travelTime, $driverAge, $option = [], $youthCoef)
  {    
    parent::__construct(
      $tariff, $distance, $travelTime, 
      $driverAge, $option, $youthCoef
    );
  }

  public function calcPrice() 
  {
    $time = explode(':', $this->travelTime);
    $timeVal = ($time[1] == 'm') ? $time[0] : timeConvert($this->travelTime, 'm');

    $calcOption = [];  
    wrap_pre($this->getGpsStatus(), '$this->getGpsStatus() in "base" tariff');  
    wrap_pre($this->getAddDriverStatus(), 'getAddDriverStatus() in "base" tariff');    


    $calcDistance = $this->distance*self::PRICE_PER_KM;
    $calcTime = $timeVal*self::PRICE_PER_MINUTE;

    // Дописать с учетом трейтов
    return ($calcDistance + $calcTime) * $this->youthCoef
           . ' ' . $this->currencyStr;
  }  
  
}