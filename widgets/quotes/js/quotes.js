(function($){
	quotes = function() {
		$("head").append("<link>");
		css = $("head").children(":last");
		css.attr({
			rel:  "stylesheet",
			type: "text/css",
			href: "widgets/quotes/css/quotes.css"
		});
		_quotes();
		$("#quotes-reload").click(function(){
			_quotes();
		});
		$(".widget.quotes form").submit(function(event){
			event.preventDefault();
			$.post(
				"widgets/quotes/quotes.php",
				$(".widget.quotes form").serialize()
			);
			$(":input", ".widget.quotes form")
				.not(":submit")
				.val("");
			_quotes();
		});
	};
})(jQuery);

function _quotes() {
	$("#quotes-list").html(ajax_load);
	$.getJSON(
		"widgets/quotes/quotes.php",
		{},
		function(json){
			var length = 0;
			for (var props in json)
				length++;
			if (length > 0)
			{
				var result = '<ul>';
				$.each(json, function(index) {
					result += '<li><strong>' + json[index].author + '</strong>: ' + json[index].text + '</li>';
				});
				result += '</ul>';
			}
			else
				result = '<p>No quotes</p>';
			$("#quotes-list").html(result);
		}
	);
}