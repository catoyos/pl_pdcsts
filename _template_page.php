<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<?php
if(isset($head_title) && $head_title != '') {
    $head_title .= " - ";
} else {
    $head_title = "";
}
$head_title .= "podcasts i tal";

if(!isset($css_class)){
    $css_class = "default";
}
?>
    <head>
<?php include '_template_head.php'; ?>
    </head>

    <body>
        <div class='supercontainer-<?=$css_class ?>'>
<?php print_content(); ?>
        </div>
        <div id="piejs">
<?php include '_template_piejs.php'; ?>
        </div>
    </body>
</html>