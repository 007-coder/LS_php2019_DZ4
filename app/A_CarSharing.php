<?php  
require_once(APP_DIR.DS.'I_CarSharing.php');


abstract class A_CarSharing implements I_CarSharing
{
  public abstract function calcPrice();
  

  
}