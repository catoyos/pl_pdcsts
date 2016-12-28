<!doctype html>
<?php require 'aux_db.php'; ?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->

<?php $head_title="rss" ?>
<head><?php include '_template_head.php'; ?></head>
<body>
	<div class='container-rss'>
<?php
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
?>
</div>
<div>
<?php include '_template_piejs.php'; ?>
</div>
</body>
</html
