<?php 

/**
* 
*/
class TariffHourly extends CarSharingAbstract
{  
  const PRICE_PER_MINUTE = 3.333;
  const PRICE_PER_KM = 0;


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
    
    if ($timeVal % 60 > 0) {
     $timeVal = $timeVal + (60 - ($timeVal % 60));
    }  

    $calcOption = [];  
    wrap_pre($this->getGpsStatus(), '$this->getGpsStatus() in "hourly" tarif');  
    wrap_pre($this->getAddDriverStatus(), '$this->getAddDriverStatus() in "hourly" tarif');  

    $calcDistance = $this->distance*self::PRICE_PER_KM;
    $calcTime = $timeVal*self::PRICE_PER_MINUTE;

    // Дописать с учетом трейтов
    return ($calcDistance + $calcTime) * $this->youthCoef
           . ' ' . $this->currencyStr;
  }

}