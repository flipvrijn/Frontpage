(function($){
	xkcd = function() {
		$("head").append("<link>");
		css = $("head").children(":last");
		css.attr({
			rel:  "stylesheet",
			type: "text/css",
			href: "widgets/xkcd/css/xkcd.css"
		});
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