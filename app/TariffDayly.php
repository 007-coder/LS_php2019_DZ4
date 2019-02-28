<?php 

/**
* 
*/
class TariffDayly extends CarSharingAbstract
{
  const PRICE_PER_MINUTE = 0.6944;
  const PRICE_PER_KM = 1; 

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

    /*wrap_pre($timeVal, '$timeVal before');*/

    if ($timeVal % 1440 > 0 && $timeVal % 1440 < 30) {
     $timeVal = $timeVal - $timeVal % 1440;
    } else if ($timeVal % 1440 > 30 || ($timeVal % 1440 < 1440) && $timeVal % 1440 !==0 ) {
      $timeVal = $timeVal + (1440 - ($timeVal % 1440));
    }

    /*wrap_pre($timeVal, '$timeVal after');*/

    $calcOption = [];  
    wrap_pre($this->getGpsStatus(), '$this->getGpsStatus() in "dayly" tarif');  
    wrap_pre($this->getAddDriverStatus(), '$this->getAddDriverStatus() in "dayly" tarif');

    $calcDistance = $this->distance*self::PRICE_PER_KM;
    $calcTime = $timeVal*self::PRICE_PER_MINUTE;

    // Дописать с учетом трейтов
    return ($calcDistance + $calcTime) * $this->youthCoef
           . ' ' . $this->currencyStr;
  }
  
}