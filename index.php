<?php 

define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', __DIR__);
define('APP_DIR', BASE_DIR.DS.'app');

require_once(APP_DIR.DS.'functions.php');
require_once(APP_DIR.DS.'CarSharing.php');


$travel = [
  'tariff' =>'base', // base | 1h | 24h | Student 
  'data' => [
    'driverAge'=> 19
  ],
  'options' => []
];
$carSharing = new CarSharing($travel['tariff'], $travel['data'], $travel['options']); 

wrap_pre($carSharing->getTariffInfo());




