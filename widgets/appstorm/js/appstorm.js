(function($){
	appstorm = function() {
		_appstorm();
		$("#appstorm-reload").click(function(){
			_appstorm();
		});
	};
})(jQuery);

function _appstorm() {
	$("#appstorm-list").html(ajax_load);
	$.getJSON(
		"widgets/appstorm/appstorm.php",
		function(json) {
			var length = 0;
			for (var props in json)
				length++;
			if (length > 0)
			{
				var result = '<ul>';
				$.each(json, function(index) {
					result += '<li>';
					$.each(this, function(key, value) {
						result += '<a href="' + json[index][key].url + '">' + json[index][key].title + '</a>';
					});
					result += '</li>';
				});
				result += '</ul>';
				$("#appstorm-list").html(result);
			}
			else
				$("#appstorm-list").html('<p>No feeds</p>');
		}
	);
}