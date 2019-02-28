<?php 

/**
* 
*/
class TariffBase extends A_CarSharing
{
  const PRICE_PER_MINUTE = 3;
  const PRICE_PER_KM = 10;

  protected $_tData = [];
  protected $_tOption = [];
  
  /*use GpsTrait;
  use AddDriverTrait;*/

  public function __construct($data = [], $options = [])
  {

    parent::__construct($data, $options);
    /*$this->_tData = $data;  

    if (
      isset($options['option']) && 
      in_array($options['option'], ['gps', 'addDriver'])
    ) {
      if ($options['option'] == 'gps') {
        $this->_tOption = new GpsTraite();
      } 
      else if ($options['option'] == 'addDriver') {
        $this->_tOption = new AddDriverTraite();
      }
    }*/ 

  }

  public function calcPrice() 
  {
    $time = explode(':', $this->_tData['time']);
    $timeVal = ($time[1] == 'm') ? $time[0] : timeConvert($this->_tData['time'], 'm');

    $calcDistance = $this->_tData['distance']*self::PRICE_PER_KM;
    $calcTime = $timeVal*self::PRICE_PER_MINUTE;

    // Дописать с учетом трейтов
    return ($calcDistance + $calcTime) * $this->_tData['youthCoef']
           . ' ' . $this->_tData['currencyStr'];
  }  
  
}