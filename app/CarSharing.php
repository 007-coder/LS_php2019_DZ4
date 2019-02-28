<?php 

/**
* 
*/
require_once(APP_DIR.DS.'A_CarSharing.php');

class CarSharing extends A_CarSharing
{
  protected $tariffObj = null;  
  protected $tariffName = '';

  // Дополнит. коэф в зависимости от возраста водителя 1.1 = +10%
  protected $youthCoef = 1;
  protected $driverAge = 0;

  const DRIVER_MIN_AGE = 18;
  const DRIVER_MAX_AGE = 65;


  public function __construct($tariff, $data = [], $options = []) 
  {
    $this->tariffName = (in_array($tariff, ['base','1h','24h','student'])) ? ucfirst($tariff) : 'Base';  
    $tStr = 'Tariff' . $this->tariffName;
    require_once(APP_DIR . DS . $tStr . '.php');

    if (isset($data['driverAge'])) {
      if ($data['driverAge'] > self::DRIVER_MAX_AGE) {
        $data['driverAge'] = self::DRIVER_MAX_AGE;
      } else if ($data['driverAge'] < self::DRIVER_MIN_AGE) {
        $data['driverAge'] = self::DRIVER_MIN_AGE;
      } 
      if ($data['driverAge'] >= 18 && $data['driverAge'] <= 21) {
        $this->youthCoef = 1.1;
      } 
      $this->driverAge = $data['driverAge'];
    }

    $data['youthCoef'] = $this->youthCoef;
    $data['currencyStr'] = 'руб';        

    $this->tariffObj = new $tStr($data, $options);

   
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