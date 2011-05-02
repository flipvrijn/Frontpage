(function($){
	nos = function() {
		$("head").append("<link>");
		css = $("head").children(":last");
		css.attr({
			rel:  "stylesheet",
			type: "text/css",
			href: "widgets/nos/css/nos.css"
		});
		_nos();
		$("#nos-reload").click(function(){
			_nos();
		});
	};
})(jQuery);

function _nos() {
	$("#nos-list").html(ajax_load);
	$.getJSON(
		"widgets/nos/nos.php",
		function(json) {
			var length = 0;
			for (var props in json)
				length++;
			if (length > 0)
			{
				var result = '<ul>';
				$.each(json, function(index) {
					result += '<li><span class="time">' + json[index].time + '</span><a href="' + json[index].link + '" title="' + json[index].alt + '">' + json[index].title + '</a></li>';
				});
				result += '</ul>';
			}
			else
				result = '<p>No news</p>';
			$("#nos-list").html(result);
		}
	);
}