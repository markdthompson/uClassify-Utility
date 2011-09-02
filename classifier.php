<?php
//error_reporting(E_ALL);
//ini_set('display_errors','On');

// which classifier are we using (currently only accepts 'topics')
$classifier = $_GET['clsfr'];

//echo $classifier; exit();

// the url to classify
$url = $_GET['url'];

//echo $url; exit();

// the encoding to return (xml or json)
$encoding = $_GET['enc'];

//echo $encoding; exit();

// instantiate or uClassify wrapper class
$uc = new uclassify();

// set the classifier
$err = $uc->setClassifier($classifier);

// set the encoding
$err = $uc->setEncoding($encoding);

// if no errors, classify the url and return json to visualize
if(!$err){
	echo $uc->classifyUrl($url);
} else {
	echo -1;
}

function __autoload($class_name) {
	include $class_name . '.php';
}
?>