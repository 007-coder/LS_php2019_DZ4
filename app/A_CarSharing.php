<?php  
require_once(APP_DIR.DS.'I_CarSharing.php');
require_once(APP_DIR.DS.'traites'.DS.'gps.php');
require_once(APP_DIR.DS.'traites'.DS.'addDriver.php');



abstract class A_CarSharing implements I_CarSharing
{
  protected $_tData = [];
  protected $_tOption = [];

  use GpsTrait;
  use AddDriverTrait;

  public function __construct($data = [], $options = [])
  {   
    $this->_tData = $data;  

    if (
      isset($options['option']) && 
      in_array($options['option'], ['gps', 'addDriver'])
    ) {
      if ($options['option'] == 'gps') {
        $this->_tOption = GpsTrait::calcOptionGPS();
      } 
      else if ($options['option'] == 'addDriver') {
        $this->_tOption = AddDriverTrait::calcOptionDriver();
      }
    }

  }
  

  public abstract function calcPrice();  
}