<?php
require_once 'aux_data.php';

$xmltopelemento = get_feed_element(urldecode($_GET["targeturl"]), $_GET["targetlocation"]);
$topelementobject = get_channel_data($xmltopelemento->channel);
$head_title = $topelementobject['title'];
$css_class = 'feed_detail';

function print_content(){
    global $topelementobject;
	echo "<div class='container'>\n";
	
	echo "<div class='card title-card mx-auto col-xs-12 col-md-8 col-lg-6'>";
	if($topelementobject['image']!=NULL && $topelementobject['image']!='') {
		echo "<img class='card-img' src='".$topelementobject['image']."' />\n";
		echo "<div class='card-img-overlay'>\n";
	}
	echo "<div class='card-block'>\n";
	echo "<h1><a href='".$topelementobject['link']."'>".$topelementobject['title']."</a></h1>\n";
	echo "<p><strong>".$topelementobject['description']."</strong></p>\n";
	echo "</div>\n";
	echo "<div class='card-block'>\n";
	echo "<p>".$topelementobject['subtitle']."</p>\n";
	echo "</div>\n";
	if($topelementobject['image']!=NULL && $topelementobject['image']!='') {
		echo "</div>";
	}
	echo "</div>\n";

    
    ementobject['subtitle']."</p>\n";
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
    }
    echo "</div></div></div>\n";//TODO: COMPROBAR QUE SE CIERRE TO BIEN
}

require '_template_page.php';