<?php
include 'aux_data.php';
include 'aux_db.php';

$action = $_POST['action'];
$feed_url = $_POST['feed_url'];
$xmltopelemento = get_feed_element(urldecode($feed_url), 'REMOTE');
$channelobject = get_channel_data($xmltopelemento->channel);
switch ($action) {
case "insert_feed":
	$dataarray[':title'] = $channelobject['title'];
	$dataarray[':feed_url'] = $channelobject['feed_url'];
	$dataarray[':link'] = $channelobject['link'];
	$dataarray[':author'] = $channelobject['author'];//nop
	$dataarray[':image'] = $channelobject['image'];
	$dataarray[':local_image'] = $channelobject['local_image'];//nop
	$dataarray[':subtitle'] = $channelobject['subtitle'];//nop
	$dataarray[':summary'] = $channelobject['summary'];
	$dataarray[':description'] = $channelobject['description'];
	$dataarray[':folder'] = $channelobject['folder'];//nop
	$dataarray[':last_update'] = $channelobject['last_update'];
	$dataarray[':last_checked'] = $channelobject['last_checked'];
	$dataarray[':ttl'] = $channelobject['ttl'];
	foreach($dataarray as $k => $v) {
		if($v == "") $dataarray[$k] = NULL;
	}
	
	
	$res = insert_podcast($dataarray, $conn);
	break;
}

echo $res;

?>
