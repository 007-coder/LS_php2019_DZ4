<?php 

function wrap_pre($data, $title = '') {
  $count = ((is_array($data) || is_object($data)) && count($data)) ? ' ('.count($data).') ' : '';
  echo '<pre><h4><b>'.$title.$count.'</b></h4>'.print_r($data, true).'</pre>';
}