(function($){
	pennyarcade = function() {
		$("head").append("<link>");
		css = $("head").children(":last");
		css.attr({
			rel:  "stylesheet",
			type: "text/css",
			href: "widgets/pennyarcade/css/pennyarcade.css"
		});
		_pennyarcade();
		$("#pennyarcade-reload").click(function(){
			_pennyarcade();
		});
	};
})(jQuery);

function _pennyarcade() {
	$("#pennyarcadestrip").html(ajax_load);
	$.getJSON(
		"widgets/pennyarcade/pennyarcade.php",
		{},
		function(json){
			var result = '<a href="' + json.strip.image_url + '"><img src="' + json.strip.image_url + '" title="' + json.strip.title + '" alt="' + json.strip.alt + '" /></a>';
			$("#pennyarcadestrip").html(result);
		}
	);
}