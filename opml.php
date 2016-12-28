<?php
$head_title= 'opml';
$css_class = 'opml';

function print_content(){
    $dir = './opml';
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
}

function print_opml_file($file) {
    $contenido = file_get_contents($file);
    $xmltopelemento = new SimpleXMLElement($contenido);
    echo "<li>\n";
    echo "<h3><a href='$file' title='".$xmltopelemento->head->dateModified."'>";
    echo $xmltopelemento->head->title."</a></h3>\n";
    echo "<div><ul>\n";
    foreach ($xmltopelemento->body->outline as $item) {
            echo "<li><a href='./feed_detail.php?targeturl=".urlencode($item['xmlUrl'])."'>".$item['text']."</a>";
            echo " [<a href='".$item['xmlUrl']."'>feed</a>][<a href='".$item['htmlUrl']."'>link</a>]";
            echo "[<a href='#' onclick='return addpodcast(\"".$item['xmlUrl']."\")'>add</a>]</li>\n";
    }
    echo "</ul></div>\n";
    echo "</li>\n";
}

require '_template_page.php';