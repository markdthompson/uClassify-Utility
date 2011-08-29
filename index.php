<?php
function __autoload($class_name) {
    include $class_name . '.php';
}

$url = "http://www.nytimes.com/2011/08/29/us/29hurricane.html?partner=rss&emc=rss";

$uc = new uClassify();
$json = $uc->classifyUrl($url);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<title>uCLassify Classifier Results for <?php echo $url; ?></title>
	
	<!-- meta tags -->
	<meta name="keywords" content="uClassify, classifier, classification, topics, text">
	<meta name="description" content="uCLassify classification results for <?php echo $url; ?>">
	
	<!-- javascript -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	
</head>
<body>
	<header id="main">
		<h1>uCLassify Classifier Results</h1>
	</header>
	<section id="content">
	<p>url =  <?php echo $url; ?></p>
	<script>
		var data = <?php echo $json; ?>;
		alert(data.cls1.Society)
	</script>
	</section>
</body>
</html>
	