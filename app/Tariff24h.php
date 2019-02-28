<?php 

/**
* 
*/
class Tariff24h extends A_CarSharing
{
  const PRICE_PER_MINUTE = 0.6944;
  const PRICE_PER_KM = 1;

  protected $_tData = [];
  protected $_tOption = [];

  /*use GpsTrait;
  use AddDriverTrait;*/

  public function __construct($data = [], $options = [])
  {
    parent::__construct($data, $options);
  }  

  public function calcPrice() 
  {
    $time = explode(':', $this->_tData['time']);
    $timeVal = ($time[1] == 'm') ? $time[0] :  timeConvert($this->_tData['time'], 'm');

    $calcDistance = $this->_tData['distance']*self::PRICE_PER_KM;
    $calcTime = $timeVal*self::PRICE_PER_MINUTE;

    // Дописать с учетом трейтов
    return ($calcDistance + $calcTime) * $this->_tData['youthCoef']
           . ' ' . $this->_tData['currencyStr'];
  }
  
}