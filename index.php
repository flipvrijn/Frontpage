<?php

require_once 'connect.req.php';

?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Frontpage</title>
	<link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/buttons.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript">
		$.ajaxSetup({
			cache: false
		});
		var ajax_load = '<img src="assets/images/loader.gif" alt="loading..." />';

		$(function() {
			loadGrid();
			$("#tabs a").click(function(){
				loadGrid($(this).attr("id"));
				$("#tabs a").removeClass("primary");
				$(this).addClass("primary");
			});
			xkcd();
			appstorm();
			nos();
			$("#xkcd-reload").click(xkcd);
			$("#appstorm-reload").click(appstorm);
			$("#nos-reload").click(function(){
				nos();
			});
			$("#nos-categories").change(function(){
				nos();
			});
		});

		function loadGrid(id) {
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

		function xkcd() {
			$("#xkcdstrip").html(ajax_load);
			$.getJSON(
				"widgets/ajax/xkcd.php",
				{},
				function(json){
					<?php
						printf('var result = \'<a href="\' + json.strip.image_url + \'" %s><img src="\' + json.strip.image_url + \'" title="\' + json.strip.title + \'" alt="\' + json.strip.alt + \'" /></a>\';',
						($gridSettings['newWindow'] == 1) ? 'target="_blank"' : '');
					?>
					$("#xkcdstrip").html(result);
				}
			);
		}

		function appstorm() {
			$("#appstorm-list").html(ajax_load);
			$.getJSON(
				"widgets/ajax/appstorm.php",
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
								<?php
									printf('result += \'<a href="\' + json[index][key].url + \'" %s>\' + json[index][key].title + \'</a>\';',
										($gridSettings['newWindow'] == 1) ? 'target="_blank"' : '');
								?>
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

		function nos() {
			$("#nos-list").html(ajax_load);
			$.getJSON(
				"widgets/ajax/nos.php",
				function(json) {
					var length = 0;
					for (var props in json)
						length++;
					if (length > 0)
					{
						var result = '<ul>';
						$.each(json, function(index) {
							<?php
								printf('result += \'<li><span class="time">\' + json[index].time + \'</span><a href="\' + json[index].link + \'" title="\' + json[index].alt + \'" %s>\' + json[index].title + \'</a></li>\';',
									($gridSettings['newWindow'] == 1) ? 'target="_blank"' : '');
							?>
						});
						result += '</ul>';
						$("#nos-list").html(result);
					}
					else
						$("#nos-list").html('<p>No news</p>');
				}
			);
		}
	</script>
</head>

<body>
	<section id="left-side">
		<header>
			<h3>Flip's Frontpage</h3>
		</header>

		<nav>
			<ul>
				<li><a href="settings.php">Settings</a></li>
			</ul>

			<form action="http://www.google.com/search" method="get" target="<?php echo ($gridSettings['newWindow'] == 1) ? '_blank' : '_self'; ?>">
				<input type="search" name="q" placeholder="Search terms" />
				<input type="submit" value="Search!" />
			</form>
		</nav>

		<div id="tabs">
			<?php
				$cursor = $tabs->find();
				$cursor->sort(array('position' => 1));

				$first = true;
				while ($cursor->hasNext())
				{
					$cursor->next();
					$obj = $cursor->current();
					if ($first)
					{
						printf('<a href="#" id="%s" class="left primary button">%s</a>',
							$cursor->key(),
							$obj['name']);
						$first = false;
					}
					else
					{
						printf('<a href="#" id="%s" class="middle button">%s</a>',
							$cursor->key(),
							$obj['name']);
					}
				}

				echo '<a href="addTab.php" class="positive right button">Add tab</a>';
			?>
		</div>

		<div id="grid"></div>
	</section>

	<section id="right-side">
		<header>
			<h3>Other stuff</h3>
		</header>

		<div id="widgets">
			<div class="widget xkcd">
				<strong class="title">XKCD</strong> <a href="#" id="xkcd-reload" class="button reload"><span class="reload icon">&nbsp;</span></a>
				<p class="description">Strip of the day:</p>
				
				<p id="xkcdstrip"></p>				
			</div>
			<div class="widget nos">
				<strong class="title">NOS</strong> <a href="#" id="nos-reload" class="button reload"><span class="reload icon">&nbsp;</span></a>
				<p class="description">News of the day:</p>

				<div id="nos-list"></div>
			</div>
			<div class="widget appstorm">
				<strong class="title">AppStorm</strong> <a href="#" id="appstorm-reload" class="button reload"><span class="reload icon">&nbsp;</span></a>
				<p class="description">Feeds of today:</p>

				<div id="appstorm-list"></div>
			</div>
		</div>

	</section>

</body>
</html>