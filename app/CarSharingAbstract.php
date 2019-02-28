<?php  
/*namespace CarSharingAbstract;*/

require_once(APP_DIR.DS.'CarSharingInterface.php');
require_once(APP_DIR.DS.'traites'.DS.'GpsTrait.php');
require_once(APP_DIR.DS.'traites'.DS.'AddDriverTrait.php');

 

abstract class CarSharingAbstract implements CarSharingInterface
{
  use GpsTrait;
  use AddDriverTrait;

  protected $tariff = 'base';
  protected $distance = 0;
  protected $travelTime = 0;  
  protected $driverAge = 0;  
  protected $option = ''; 

  protected $tariffObj = null;
  protected $tariffName = '';
  // Дополнит. коэф в зависимости от возраста водителя 1.1 = +10%   
  protected $youthCoef = 1;  
  protected $currencyStr = 'руб';  
  protected $optionsRates = [];  
  protected $optionAddPrice = 0;  


  public function __construct($tariff, $distance, $travelTime, $driverAge, $option = [], $youthCoef = 1)
  { 
    $this->tariff = $tariff;  
    $this->distance = $distance;  
    $this->travelTime = $travelTime;  
    $this->driverAge = $driverAge;  
    $this->option = $option;  
    $this->youthCoef = $youthCoef;

    $this->optionsRates = [
      'gps'=>[
        'pricePerMinute'=>0.25,
        'minTime' => '1:H'
      ],
      'addDriver'=>[
        'oneTimePrice' =>100
      ],
    ];

    $this->setGpsStatus($this->option, $tariff);     
    $this->setAddDriverStatus($this->option, $tariff);     

  }

  public abstract function calcPrice();  
}