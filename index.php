<?php 

define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', __DIR__);
define('APP_DIR', BASE_DIR.DS.'app');

require_once(APP_DIR.DS.'functions.php');
require_once(APP_DIR.DS.'CarSharing.php');

/*
Нужно доделать расчет с учетом трейтов. Реализовать трейты во всей их красе, короче. 

// пример для $travel['data']
$travel['data'] = [
  'distance' => 5, // Расстояние в км.
  'time' => '5:H', // :m - минуты, :H - часы, :HH - Сутки,
  'driverAge' => 20, // Возраст водителя   
];
*/

$travel = [
  'tariff' =>'student', // Тариф base | 1h | 24h | student 
  'data' => [
    'distance' => 5,
    'time' => '24:H',
    'driverAge'=> 20
  ],
  'options' => []
];
$carSharing = new CarSharing($travel['tariff'], $travel['data'], $travel['options']); 

wrap_pre($carSharing->getTariffInfo());

echo $carSharing->calcPrice();






