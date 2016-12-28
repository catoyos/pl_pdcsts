function addpodcast(feedurl) {
	var datavals = { action : 'insert_feed', feed_url : encodeURIComponent(feedurl) }

	$.ajax({
		type: 'POST',
		url: "aux_ajax.php",
		data: datavals,
		dataType: "text",
		success: function(result){
			console.log(result);
		},
		failure: function (errMsg) {
			console.err("**" + errMsg);
		}
	});
	return false;
}

