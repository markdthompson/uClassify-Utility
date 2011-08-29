<?php
function __autoload($class_name) {
    include $class_name . '.php';
}

// which classifier are we using (currently only accepts 'topics'
$classifier = 'topics';
// initialize json variable to empty for error checking
$json = '';

$uc = new uClassify();
$err = $uc->setClassifier($classifier);

$url = "http://www.nytimes.com/2011/08/29/us/29hurricane.html?partner=rss&emc=rss";
if(!$err){
	$json = $uc->classifyUrl($url);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<title>Classification Results for <?php echo $url; ?></title>
	
	<!-- meta tags -->
	<meta name="keywords" content="uClassify, classifier, classification, topics, text">
	<meta name="description" content="uCLassify classification results for user supplied uri">
	
	<!-- javascript -->
	<script src="./scripts/raphael-min.js"></script>
	<script src="./scripts/g.raphael-min.js"></script>
	<script src="./scripts/g.pie-min.js"></script>
	
</head>
<body>
	<header id="main">
		<h1>uClassify Classifier Results</h1>
	</header>
	
	<section id="content">
	
	<?php if(!empty($json)):?>
	
	<?php echo ucfirst($classifier); ?> classification for: <a href="<?php echo $url; ?>"><?php echo $url; ?></a>
	
	<script>
		var data = <?php echo $json; ?>;

		// Creates canvas 640 × 480 at 0, 0
		var r = Raphael(0, 0, 640, 480);
		// Creates pie chart at with center at 320, 200,
		// radius 100 and data from the classification
		
		var set = new Array();
		var legend = new Array();
		var i = 0;
		for(var key in data.cls1){
			legend[i] = key+': '+Math.round((data.cls1[key]*100)*100)/100+'%';
			set[i] = data.cls1[key];
			i++;
		}
		
		r.g.piechart(240, 240, 100, set, {legend: legend, legendpos: "west"});
	</script>
	<?php endif; ?>
	</section>
</body>
</html>