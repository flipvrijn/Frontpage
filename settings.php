<?php

require 'connect.req.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$settings->update(array(
		'_id' => new MongoId($settingsId)), 
			array(
				'grid' => 
					array(
						'width' => (int) $_POST['width'], 
						'height' => (int) $_POST['height']
					),
				'newWindow' => (int) $_POST['newWindow']
			)
	);

	echo 'Saved!';
}

?>

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

	<div id="form">
		<form action="settings.php" method="post">
			<fieldset>
				<legend>Grid size:</legend>
				<label for="width" class="normal">Width:</label>
				<input type="number" name="width" min="1" max="10" value="<?php echo $gridSettings['grid']['width']; ?>" required placeholder="Width" />
				<label for="height" class="normal">Height:</label>
				<input type="number" name="height" min="1" max="10" value="<?php echo $gridSettings['grid']['height']; ?>" required placeholder="Height" />
				<label>Open link in new window:</label>
				<input type="radio" name="newWindow" value="1" <?php echo ($gridSettings['newWindow'] == 1) ? 'checked="checked"' : ''; ?> /> Yes
				<input type="radio" name="newWindow" value="0" <?php echo ($gridSettings['newWindow'] == 0) ? 'checked="checked"' : ''; ?> /> No

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