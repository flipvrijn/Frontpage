(function($){
	grid = function() {
		$("head").append("<link>");
		css = $("head").children(":last");
		css.attr({
			rel:  "stylesheet",
			type: "text/css",
			href: "assets/css/grid.css"
		});
		_grid();
		$("#grid-options").click(function() {
			if ($("div.options:first").is(":hidden"))
				$("div.options").slideDown("slow");
			else
				$("div.options").hide();
		});
		$("#tabs a").click(function(){
			_grid($(this).attr("id"));
			$("#tabs a").removeClass("primary");
			$(this).addClass("primary");
		});
	};
})(jQuery);

function _grid(id) {
	$("#grid").html(ajax_load);
	var url = "ajax/grid.php";
	$.getJSON(
		url,
		{id: id},
		function(json) {
			$("#grid").html(json);
		}
	);
}