<?php
/*
echo "<hr />";
if (($gestor = fopen("./rss/indice.csv", "r")) !== FALSE) {
	echo "<ul>";
	while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
		$numero = count($datos);
		if($numero>1){
			echo "<li><a href='./feed_detail.php?targeturl=".urlencode($datos[1])."'>$datos[0]</a></li>\n";
		} else {
			echo "<li>--</li>\n";
		}
	}
	fclose($gestor);
	echo "</ul>";
}
if ($handle = opendir('./rss')) {
	echo "<ul>\n";
	while (false !== ($entry = readdir($handle))) {
		if ($entry != "." && $entry != "..") {
			$contenido = file_get_contents("./rss/$entry");
			echo "<li>$entry\n";
			//echo "<div>$contenido</div>\n";
			echo "</li>\n";
		}
	}
	echo "</ul>\n";
	closedir($handle);
}
*/



/*
echo "<hr />";
printTabla("podcast", $conn);
echo "<hr />";
if (($gestor = fopen("./rss/indice.csv", "r")) !== FALSE) {
	echo "<ul>";
	while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
		$numero = count($datos);
		if($numero>1){
			echo "<li><a href='./rss?targeturl=".urlencode($datos[1])."'>$datos[0]</a></li>\n";
		} else {
			echo "<li>--</li>\n";
		}
	}
	fclose($gestor);
	echo "</ul>";
}
*/




/*
function imprime_elemento($xml_element, $prefix) {
    echo $prefix."<strong>".$xml_element->getName()."</strong><br />";
    imprime_atributos($xml_element, $prefix);
    if((count($xml_element->children())== 0) && (count($xml_element->children("itunes", TRUE)) == 0)) {
		echo $prefix."|  ".$xml_element."<br />";
	} else {
		foreach ($xml_element->children() as $hijo) {
			imprime_elemento($hijo , $prefix."|--");
		}
		foreach ($xml_element->children("itunes", TRUE) as $hijo) {
			imprime_elemento($hijo , $prefix."|··");
		}
	}
	echo "\n";
}
function imprime_atributos($xml_element, $prefix)
{
	foreach ($xml_element->attributes() as $a => $b) {
		echo $prefix."|  [<em>".$a."</em> : ".$b."]<br />";
	}
	echo "\n";
}
*/
