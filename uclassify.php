<?php
$cmd = $_GET['cmd'];
$url = $_GET['url'];

$baseUrl = 'http://uclassify.com/browse/uClassify/';
$readkey = 'vhSVEuFSAZXrYxkCj3oxXN0TI+E=';
$removeHTML = 1;
$encoding = 'xml';
$data = '';

if($encoding == 'xml'){
  header ("content-type: text/xml");
} else if($encoding == 'json'){
  header ("content-type: text/javascript");
}

switch($cmd){
  case 'topics':
    // call search-fields to set up search-field-values menus
    $qs = $baseUrl.'Topics'.'/ClassifyUrl/?readkey='.urlencode($readkey).'&url='.urlencode($url).'&removeHtml='.$removeHTML.'&output='.$encoding;
    $data = classify($qs);
    echo $data;
  break;
}

function classify($qs){
  // instantiate cUrl
  
  $url = curl_init($qs);
  
  // set options
  curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($url, CURLOPT_HEADER, 0);
  
  // execute, close & return result
  $data = curl_exec($url);
  curl_close($url);
  
  return $data;
}
?>
