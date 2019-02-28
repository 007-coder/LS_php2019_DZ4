<?php 

define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', __DIR__);
define('APP_DIR', BASE_DIR.DS.'app');

require_once(APP_DIR.DS.'functions.php');
require_once(APP_DIR.DS.'CarSharing.php');

/*
Нужно доделать расчет с учетом трейтов. Реализовать трейты во всей их красе, короче. 
*/


$travel = [
  // Тариф base | hourly | dayly | student 
  'tariff' =>'student',
  'distance' => 5,
  'travelTime' => '24:H',
  'driverAge'=> 22,
  // '' | gps | addDriver
  'option' => [
    'name' => 'addDriver',
    'time' => '1:H'
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








