<?php 

function wrap_pre($data, $title = '') {
  $count = ((is_array($data) || is_object($data)) && count($data)) ? ' ('.count($data).') ' : '';
  echo '<pre><h4><b>'.$title.$count.'</b></h4>'.print_r($data, true).'</pre>';
}

function timeConvert($time, $to = 'm') {
  $to = (in_array($to, ['m', 'H', 'HH'])) ? $to : 'm';
  $explTime = explode(':', $time);

  if ($explTime[1] != $to) {
    
    // Сутки в минуты и Сутки в Часы
    if ( 
        ($explTime[1] == 'HH' && $to == 'm') || 
        ($explTime[1] == 'HH' && $to == 'H') 
    ) {
      switch ($to) {
        case 'm':
          $mult = 24*60;
          break;
        case 'H':
          $mult = 24;
          break;
      }  
    }
    // Часы в минуты и Часы в сутки
    if ( 
        ($explTime[1] == 'H' && $to == 'm') || 
        ($explTime[1] == 'H' && $to == 'HH') 
    ) {
      switch ($to) {
        case 'm':
          $mult = 60;
          break;
        case 'HH':
          $mult = 1/24;
          break;
        
      }
    }
    // Минуты в часы и Минуты в Сутки
    if ( 
        ($explTime[1] == 'm' && $to == 'H') || 
        ($explTime[1] == 'm' && $to == 'HH') 
    ) {
      switch ($to) {
        case 'H':
          $mult = 1/60;
          break;
        case 'HH':
          $mult = 1/(24*60);
          break;        
      }    

    }

    return ($explTime[0]*$mult);


  } else {
    return $explTime[0];
  }
}