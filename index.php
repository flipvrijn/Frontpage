<?php require_once 'connect.req.php'; ?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Frontpage</title>
	<link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/buttons.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/grid.js"></script>
	<script type="text/javascript">
		$.ajaxSetup({
			cache: false
		});
		var ajax_load = '<img src="assets/images/loader.gif" alt="loading..." />';

		$(document).ready(function() {
			$.getScript('assets/js/grid.js', function() {
				grid();
			});
			$.getScript('widgets/pennyarcade/js/pennyarcade.js', function() {
				pennyarcade();
			});
			$.getScript('widgets/xkcd/js/xkcd.js', function() {
				xkcd();
			});
			$.getScript('widgets/nos/js/nos.js', function(){
				nos();
			});
			$.getScript('widgets/appstorm/js/appstorm.js', function(){
				appstorm();
			});
			$.getScript('widgets/quotes/js/quotes.js', function(){
				quotes();
			});
		});
	</script>
</head>

<body>
	<section id="left-side">
		<header>
			<h3><?php echo $settings['frontpage']['title']; ?></h3>
		</header>

		<nav>
			<ul>
				<li><a href="settings.php">Settings</a></li>
			</ul>

			<form action="http://www.google.com/search" method="get" target="<?php echo ($settings['newWindow'] == 1) ? '_blank' : '_self'; ?>">
				<input type="search" name="q" placeholder="Search terms" />
				<input type="submit" value="Search!" />
			</form>
		</nav>

		<div id="tabs">
			<ul>
			<?php
				$cursor = $tabs->find();
				$cursor->sort(array('position' => 1));

				$first = true;
				while ($cursor->hasNext())
				{
					echo "<li>";
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
					echo "</li>";
				}

				echo '<li><a href="addTab.php" class="positive right button">Add tab</a></li>' . PHP_EOL;
			?>
			</ul>
		</div>

		<div id="grid-options"><a href="#" class="button">Toggle options</a></div>

		<div id="grid"></div>
	</section>

	<section id="right-side">
		<header>
			<h3>Widgets</h3>
		</header>

		<div id="widgets">
			<div class="widget nos">
				<strong class="title">NOS</strong> <a href="#" id="nos-reload" class="button reload"><span class="reload icon">&nbsp;</span></a>
				<p class="description">News of the day:</p>

				<div id="nos-list"></div>
			</div>
			<div class="widget quotes">
				<strong class="title">Quotes</strong> <a href="#" id="nos-reload" class="button reload"><span class="reload icon">&nbsp;</span></a>
				<p class="description">Awesome quotes:</p>

				<div id="quotes-list"></div>
				<p>Add comment:</p>
				<form action="widgets/quotes/quotes.php" method="POST">
					<label for="text">Text:</label>
					<input type="text" name="text" required placeholder="Text" /><br />
					<label for="author">Author:</label>
					<input type="text" name="author" required placeholder="Author" />
				</form>
			</div>
			<div class="widget appstorm">
				<strong class="title">AppStorm</strong> <a href="#" id="appstorm-reload" class="button reload"><span class="reload icon">&nbsp;</span></a>
				<p class="description">Feeds of today:</p>

				<div id="appstorm-list"></div>
			</div>
			<div class="widget xkcd">
				<strong class="title">XKCD</strong> <a href="#" id="xkcd-reload" class="button reload"><span class="reload icon">&nbsp;</span></a>
				<p class="description">Strip of the day:</p>
				
				<p id="xkcdstrip"></p>				
			</div>
			<div class="widget pennyarcade">
				<strong class="title">Penny Arcade</strong> <a href="#" id="pennyarcade-reload" class="button reload"><span class="reload icon">&nbsp;</span></a>
				<p class="description">Strip of the day:</p>

				<p id="pennyarcadestrip"></p>
			</div>
		</div>

	</section>

</body>
</html>