<?php
require_once 'aux_db.php';

$css_class = 'rss';
$head_title="rss";

function print_content(){
    try {
        $res = simple_db_select('*', 'podcast');
        if($res != NULL || count($res) > 0) {
?>
    <ul>
<?php
            foreach ($res as $k => $v) {
                foreach ($v as $p => $t) {
                    echo "<!-- $p : $t -->\n";
                }
?>
        <li><a href="./feed_detail.php?targeturl=<?=urlencode($v['feed_url']) ?>"><?=$v['title'] ?></a></li>
<?php
            }
?>
    </ul>
<?php
        }
    } catch(Exception $e) {
        echo "<!-- Error: " . $e->getMessage()." -->\n";
    }
}

require '_template_page.php';