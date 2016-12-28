<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->

<?php $head_title="opml" ?>
<head><?php include '_template_head.php'; ?></head>
<body>
	<div class='container-opml'>
<?php
$dir = './opml';
echo "<h1>opml</h1>";
echo "<ul>\n";
if ($handle = opendir($dir)) {
	while (false !== ($entry = readdir($handle))) {
		if ($entry != "." && $entry != "..") {
			print_opml_file("$dir/$entry");
		}
	}
	closedir($handle);
}
echo "</ul>\n";
?>
</div>
<div>
	<?php include '_template_piejs.php'; ?>
</div>
</body>
</html>
<?php
function print_opml_file($file) {
	$contenido = file_get_contents($file);
	$xmltopelemento = new SimpleXMLElement($contenido);
	echo "<li>\n";
	echo "<h2><a href='$file' title='".$xmltopelemento->head->dateModified."'>";
	echo $xmltopelemento->head->title."</a></h2>\n";
	echo "<div><ul>\n";
	foreach ($xmltopelemento->body->outline as $item) {
		echo "<li><a href='./feed_detail.php?targeturl=".urlencode($item['xmlUrl'])."'>".$item['text']."</a>";
		echo " [<a href='".$item['xmlUrl']."'>feed</a>][<a href='".$item['htmlUrl']."'>link</a>]";
		echo "[<a href='#' onclick='return addpodcast(\"".$item['xmlUrl']."\")'>add</a>]</li>\n";
	}
	echo "</ul></div>\n";
	/*echo "<!--\n $contenido \n -->\n";*/
	echo "</li>\n";
}
