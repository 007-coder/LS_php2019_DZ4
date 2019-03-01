<?php 

define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', __DIR__);
define('APP_DIR', BASE_DIR.DS.'app');

require_once(APP_DIR.DS.'functions.php');
require_once(APP_DIR.DS.'CarSharing.php');


$travel = [  
  'tariff' =>'base', // Тариф base | hourly | dayly | student 
  'distance' => 5,
  'travelTime' => '1:H', // ' m - minuts | H - hours | HH - days'
  'driverAge'=> 22,  
  'option' => [
    'name' => 'gps', // '' | gps | addDriver
    'time' => '1.5:H'
  ]  
];

$carSharing = new CarSharing(
  $travel['tariff'], 
  $travel['distance'], 
  $travel['travelTime'], 
  $travel['driverAge'], 
  $travel['option']
); 

wrap_pre($carSharing->getTariffInfo());

echo $carSharing->calcPrice();








