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

    /* -------------Расчтет цены в зависимости от доп. опций */
    /* -------------Старт ---------------------------------- */
    $calcOption = [
      'gps'=> 0,
      'addDriver'=> 0
    ];        

    if ($this->getGpsStatus()) {        
      $timeGps = explode(':', $this->option['time']);    
      $timeGpsVal = ($timeGps[1] == 'm') ? $timeGps[0] : timeConvert($this->option['time'], 'm');

      if (($timeGpsVal < 60) && ($timeGpsVal % 60 !== 0)) {
        $timeGpsVal = 60;
      }       
      if ($timeGpsVal > 60 && ($timeGpsVal % 60 > 1)) {
        $timeGpsVal = $timeGpsVal + (60 - $timeGpsVal % 60);
      }   

      $calcOption['gps'] = $timeGpsVal * $this->optionsRates['gps']['pricePerMinute'];  
    }    

    if ($this->getAddDriverStatus()) {
      $calcOption['addDriver'] = $this->optionsRates['addDriver']['oneTimePrice'];      
    }
    /* ----------------------------------------*/


    $calcDistance = $this->distance*self::PRICE_PER_KM;
    $calcTime = $timeVal*self::PRICE_PER_MINUTE;

    /*wrap_pre($calcDistance . '+'. $calcTime . ' | '.$this->youthCoef, '$calcDistance + $calcTime | $this->youthCoef in "Base"');    
    wrap_pre($calcOption, '$calcOption in "Base"');*/

    return ($calcDistance + $calcTime + $calcOption['gps'] + $calcOption['addDriver'] ) * $this->youthCoef
           . ' ' . $this->currencyStr;
  }  
  
}