<!doctype html>
<?php require 'aux_data.php'; ?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<?php
$xmltopelemento = get_feed_element(urldecode($_GET["targeturl"]), $_GET["targetlocation"]);
$topelementobject = get_channel_data($xmltopelemento->channel);
$head_title = $topelementobject['title'];
$css_class = 'feed_detail';
?>
<head><?php include '_template_head.php'; ?></head>
<body>
	<div class='supercontainer-<?=$css_class ?>'>
<?php 
/*
echo "<!-- ";
echo $xmltopelemento;
echo "\n----------------\n";
print_r(get_channel_data($xmltopelemento->channel));
echo " -->";
*/
echo "<h1><a href='".$topelementobject['link']."'>".$topelementobject['title']."</a></h1>\n";
echo "<p><strong>".$topelementobject['description']."</strong></p>\n";
echo "<p><img src='".$topelementobject['image']."' width='200px' />".$topelementobject['subtitle']."</p>\n";
echo "<div class='card-deck'>\n";
$epsublist = array_slice($topelementobject['episodes'], 0, 20, TRUE);
foreach ($epsublist as $episodeobject) {
	echo "<div class='card'>";
	echo "<div class='card-block'>\n";
	echo "<h4 class='card-title'><a href='".$episodeobject['url']."'>".$episodeobject['title']."</a>";
	if ($episodeobject['duration'] > 0) {
		echo "  <small class='text-muted'>[".seconds_to_hms_string($episodeobject['duration'])."]</small>";
	}
	echo "</h4>\n";
	if ($episodeobject['subtitle'] != '') {
		echo "<h6 class='card-subtitle text-muted'>".$episodeobject['subtitle']."</h6>\n";
	}
	
	echo "</div>\n";
	if ($episodeobject['image'] != '') {
		echo "<img class='card-img' src='".$episodeobject['image']."' >\n";
	}
	echo "<div class='card-block'>\n";
	echo "<p class='card-text'>".$episodeobject['description']."</p>\n";
	echo "<p class='card-text'><small class='text-muted'>".$episodeobject['pubDate']."</small></p>\n";
	echo "</div></div>\n\n";
	
/*
echo "<!-- ";
print_r($episodeobject);
echo " -->";
*/
}
echo "</div></div>\n";

?>
</div>
<div>
	<?php include '_template_piejs.php'; ?>
</div>
</body>
</html>
