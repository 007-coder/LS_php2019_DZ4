<?php 

/**
* 
*/
class TariffStudent extends CarSharingAbstract
{
  const PRICE_PER_MINUTE = 1;
  const PRICE_PER_KM = 4; 

  public function __construct($tariff, $distance, $travelTime, $driverAge, $option = [], $youthCoef)
  {
    parent::__construct(
      $tariff, $distance, $travelTime, 
      $driverAge, $option, $youthCoef
    );    
  }  

  public function calcPrice() 
  {
    if ($this->driverAge > 25) {
      return 'Возраст водителя больше 25! Не могу использовать данный тариф! 
      Выбирите другой тариф.<br>';
    } else {

      $time = explode(':', $this->travelTime);
    $timeVal = ($time[1] == 'm') ? $time[0] : timeConvert($this->travelTime, 'm');

    $calcOption = [];  
    wrap_pre($this->getGpsStatus(), '$this->getGpsStatus() in "student" tarif');  
    wrap_pre($this->getAddDriverStatus(), '$this->getAddDriverStatus() in "student" tarif');

    $calcDistance = $this->distance*self::PRICE_PER_KM;
    $calcTime = $timeVal*self::PRICE_PER_MINUTE;

    // Дописать с учетом трейтов
    return ($calcDistance + $calcTime) * $this->youthCoef
           . ' ' . $this->currencyStr;

    }
  }
  
}