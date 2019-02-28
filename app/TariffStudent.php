<?php 

/**
* 
*/
class TariffStudent extends A_CarSharing
{
  const PRICE_PER_MINUTE = 1;
  const PRICE_PER_KM = 4;

  protected $_tData = [];
  protected $_tOptions = [];

  public function __construct($data = [], $options = [])
  {
    $this->_tData = $data;
    $this->_tOptions = $options;
  }  

  public function calcPrice() 
  {
    if ($this->_tData['driverAge'] > 25) {
      return 'Возраст водителя больше 25! Не могу использовать данный тариф! 
      Выбирите другой тариф.<br>';
    } else {

      $time = explode(':', $this->_tData['time']);
      $timeVal = ($time[1] == 'm') ? $time[0] :  timeConvert($this->_tData['time'], 'm');

      $calcDistance = $this->_tData['distance']*self::PRICE_PER_KM;
      $calcTime = $timeVal*self::PRICE_PER_MINUTE;

      // Дописать с учетом трейтов
      return ($calcDistance + $calcTime) * $this->_tData['youthCoef']
             . ' ' . $this->_tData['currencyStr'];

    }
  }
  
}