<?php 

/**
* 
*/
require_once(APP_DIR.DS.'CarSharingAbstract.php');

class CarSharing extends CarSharingAbstract
{
  const DRIVER_MIN_AGE = 18;
  const DRIVER_MAX_AGE = 65;

  public function __construct($tariff, $distance, $travelTime, $driverAge, $option = []) 
  {
    $this->tariffName = (in_array($tariff, ['base','hourly','dayly','student'])) ? ucfirst($tariff) : 'Base';  
    $tStr = 'Tariff' . $this->tariffName;

    require_once(APP_DIR . DS . $tStr . '.php');

    if (isset($driverAge)) {
      if ($driverAge > self::DRIVER_MAX_AGE) {
        $driverAge = self::DRIVER_MAX_AGE;
      } else if ($driverAge < self::DRIVER_MIN_AGE) {
        $driverAge = self::DRIVER_MIN_AGE;
      } 
      if ($driverAge >= 18 && $driverAge <= 21) {
        $this->youthCoef = 1.1;
      } 

      $this->driverAge = $driverAge;
    }              

    $this->tariffObj = new $tStr($tariff, $distance, $travelTime, $driverAge, $option, $this->youthCoef);
   
  }

  public function calcPrice() 
  {
    return $this->tariffObj->calcPrice();
  }

  public function getTariffInfo() 
  {
    return [
      'name' => $this->tariffName,
      'youthCoef' => $this->youthCoef,
      'driverAge' => $this->driverAge,
    ];
    
  }


  
}