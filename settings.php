<?php require 'connect.req.php'; ?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Settings - Frontpage</title>
	<link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
	
	<header>
		<h3>Settings</h3>
	</header>

	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$settingsCollection->update(array(
			'_id' => new MongoId($settingsId)), 
			array(
				'frontpage' =>
					array(
						'title' => $_POST['title']
					),
				'grid' => 
					array(
						'width' => (int) $_POST['width'], 
						'height' => (int) $_POST['height'],
					),
				'newWindow' => (int) $_POST['newWindow'],
			)
		);

		echo '<p>Saved!</p>';
	} ?>

	<div id="form">
		<form action="settings.php" method="post">
			<fieldset>
				<legend>Frontpage:</legend>
				<label for="title">Title:</label>
				<input type="text" name="title" value="<?php echo $settings['frontpage']['title']; ?>" required placeholder="Title" />
			</fieldset>
			<fieldset>
				<legend>Grid:</legend>
				<label for="width" class="normal">Width:</label>
				<input type="number" name="width" min="1" max="10" value="<?php echo $settings['grid']['width']; ?>" required placeholder="Width" />
				<label for="height" class="normal">Height:</label>
				<input type="number" name="height" min="1" max="10" value="<?php echo $settings['grid']['height']; ?>" required placeholder="Height" />
				<label>Open link in new window:</label>
				<input type="radio" name="newWindow" value="1" <?php echo ($settings['newWindow'] == 1) ? 'checked="checked"' : ''; ?> /> Yes
				<input type="radio" name="newWindow" value="0" <?php echo ($settings['newWindow'] == 0) ? 'checked="checked"' : ''; ?> /> No

				<input type="hidden" name="tabId" value="<?php echo $_GET['tab']; ?>" />

				<input type="submit" value="Save" />
			</fieldset>
		</form>
	</div>

	<p>
		<a href="index.php">Go back</a>
	</p>

</body>
</html>