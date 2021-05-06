<?php
  $jsonArray = array();

  function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
  }

  $html = file_get_contents('http://www.governo.it/it/articolo/domande-frequenti-sulle-misure-adottate-dal-governo/15638?gclid=CjwKCAiAwrf-BRA9EiwAUWwKXicC1bzopYynHP9pvRxHUza7Ar4dte9hWHi55Uj4xfuAHanOCf7a1BoCTggQAvD_BwE',false);
  preg_match_all('~(?<=path id=").+?(?=fill)~',$html,$matches);
  
  for($i=0;$i<21;$i++){
    $color= get_string_between($matches[0][$i], '(\'', '\')');
    
    $name=ucfirst(substr($matches[0][$i],0,strpos($matches[0][$i],"\"",0)));

    $jsonArray[] = array('name' => $name, 'value' => $color);
  }

  $json = json_encode($jsonArray);
  echo $json;
?>
