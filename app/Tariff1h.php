<?php 

/**
* 
*/
class Tariff1h extends A_CarSharing
{  
  const PRICE_PER_MINUTE = 3.333;
  const PRICE_PER_KM = 0;

  protected $_tData = [];
  protected $_tOption = [];

  public function __construct($data = [], $options = [])
  {
    parent::__construct($data, $options);
  }

  public function calcPrice() 
  {
    $time = explode(':', $this->_tData['time']);
    $timeVal = ($time[1] == 'm') ? $time[0] :  timeConvert($this->_tData['time'], 'm');

    wrap_pre($timeVal % 60);

    $calcDistance = $this->_tData['distance']*self::PRICE_PER_KM;
    $calcTime = $timeVal*self::PRICE_PER_MINUTE;   

    // Дописать с учетом трейтов
    return ($calcDistance + $calcTime) * $this->_tData['youthCoef']
           . ' ' . $this->_tData['currencyStr'];
  }

}