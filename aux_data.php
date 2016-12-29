<?php

function get_feed_element($url,$location){
	$xml_element = "";	
	$type = ($location==NULL||$location=="")?'REMOTE':$location;
	if(strtoupper($type) == 'LOCAL'){
		$xml_element = get_feed_element_local($url);
	} else if(strtoupper($type) == 'REMOTE'){
		$xml_element = get_feed_element_remote($url);
	}
	return $xml_element;
}
function get_feed_element_local($file){
	$contenido = file_get_contents("./rss/$file");
	$xmltopelemento = new SimpleXMLElement($contenido);

	return $xmltopelemento;
}
function get_feed_element_remote($url){
	$contenido = file_get_contents($url);
	$xmltopelemento = new SimpleXMLElement($contenido);

	return $xmltopelemento;
}

function get_channel_data($xml_channel_element) {
	$data['feed_url'] = (string)$xml_channel_element->children('itunes', true)->{'new-feed-url'}[0];
	if($data['feed_url']=="" || $data['feed_url']==NULL) {
		foreach ($xml_channel_element->children('atom', true)->link as $atomlink) {
			$varhref = $atomlink->attributes()->href;
			$varrel = $atomlink->attributes()->rel;
			if ($varrel == 'self') {
				$data['feed_url'] = (string)$varhref;
			}
		}
	}
	if($data['feed_url']=="" || $data['feed_url']==NULL) {
		foreach ($xml_channel_element->children('atom10', true)->link as $atomlink) {
			$varhref = $atomlink->attributes()->href;
			$varrel = $atomlink->attributes()->rel;
			if ($varrel == 'self') {
				$data['feed_url'] = (string)$varhref;
			}
		}
	}
	$data['title'] = (string)$xml_channel_element->title[0];
	$data['link'] = (string)$xml_channel_element->link[0];
	$data['image'] = (string)$xml_channel_element->image->url[0];
	$data['itunes_image'] = '';
	if(count($xml_channel_element->children('itunes', true)->image) > 0){
		$data['itunes_image'] = (string)$xml_channel_element->children('itunes', true)->image[0]->attributes()->href;
		if($data['image'] == "") {
			$data['image'] = $data['itunes_image'];
		}
	}
	$data['description'] = (string)$xml_channel_element->description[0];
	$data['summary'] = (string)$xml_channel_element->children('itunes', true)->summary[0];
	$data['subtitle'] = (string)$xml_channel_element->children('itunes', true)->subtitle[0];
	$data['last_checked'] = null;
	$data['last_update'] = (string)$xml_channel_element->lastBuildDate[0];
	$data['ttl'] = (string)$xml_channel_element->ttl[0];
	if($data['ttl'] == "") {
		$data['ttl'] = 360;
	}
	foreach( $xml_channel_element->item as $xml_item_element) {
		$items[] = get_item_data($xml_item_element);
	}
	$data['episodes'] = $items;
	
	return $data;
}

function get_item_data($xml_item_element) {
	$data['title'] = (string)$xml_item_element->title[0];
	$data['url'] = (string)$xml_item_element->enclosure[0]['url'];
	$data['size'] = (string)$xml_item_element->enclosure[0]['length'];
	$data['type'] = (string)$xml_item_element->enclosure[0]['type'];
	$data['description'] = (string)$xml_item_element->description[0];
	$data['summary'] = (string)$xml_item_element->children('itunes', true)->summary[0];
	$data['subtitle'] = (string)$xml_item_element->children('itunes', true)->subtitle[0];
	$data['image'] = (string)$xml_item_element->image[0];
	$data['itunes_image'] = '';
	if(count($xml_item_element->children('itunes', true)->image) > 0){
		$data['itunes_image'] = (string)$xml_item_element->children('itunes', true)->image[0]->attributes()->href;
		if($data['image'] == "") {
			$data['image'] = $data['itunes_image'];
		}
	}
	$data['pubDate'] = (string)$xml_item_element->pubDate[0];
	$data['pubDate_parsed'] = date_parse($data['pubDate']);
	$data['guid'] = (string)$xml_item_element->guid[0];
	$data['link'] = (string)$xml_item_element->link[0];
	$data['duration_str'] = (string)$xml_item_element->children('itunes', true)->duration[0];
	if($data['duration_str']==NULL||$data['duration_str']==""){
		$data['duration'] = 0;
	} else if(preg_match("/^[:\d\s]+$/", $data['duration_str'])) {
		$timearray = split(':', $data['duration_str']);
		$data['timearray'] = $timearray;
		if(count($timearray) == 1) {
			$data['duration'] = intval($timearray[0]);
		} else if(count($timearray) == 2) {
			$data['duration'] = 60 * intval($timearray[0]) + intval($timearray[1]);
		} else if(count($timearray) >= 3) {
			$data['duration'] = 3600 * intval($timearray[0]) +  60 * intval($timearray[1]) + intval($timearray[2]);
		} else {
			$data['duration'] = 0;
		}
	} else {
		$data['duration'] = 0;
	}
	
	return $data;
}

function seconds_to_hms_string($seconds) {
	$hourval = floor($seconds/3600);
	$minval = floor(($seconds - 3600 * $hourval)/60);
	$secval = floor( $seconds - 3600 * $hourval - 60 * $minval);
	$res = "$hourval:".str_pad($minval, 2, "0", STR_PAD_LEFT).":".str_pad($secval, 2, "0", STR_PAD_LEFT);
	
	return $res;
}
