(function($){
	xkcd = function() {
		_xkcd();
		$("#xkcd-reload").click(function(){
			_xkcd();
		});
	};
})(jQuery);

function _xkcd() {
	$("#xkcdstrip").html(ajax_load);
	$.getJSON(
		"widgets/xkcd/xkcd.php",
		{},
		function(json){
			var result = '<a href="' + json.strip.image_url + '"><img src="' + json.strip.image_url + '" title="' + json.strip.title + '" alt="' + json.strip.alt + '" /></a>';
			$("#xkcdstrip").html(result);
		}
	);
}