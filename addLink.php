<?php require_once 'connect.req.php'; ?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Add / Edit link - Frontpage</title>
	<link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>
<body>

	<header>
		<h3>Add / Edit a link</h3>
	</header>

	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if ($settings['grid']['width'] >= (int) $_POST['locationX'] && $settings['grid']['height'] >= (int) $_POST['locationY'])
		{
			$query = array('locationX' => (int) $_POST['locationX'], 'locationY' => (int) $_POST['locationY'], 'tabId' => $_POST['tabId']);

			$obj = $links->findOne($query);
			$newObj = array(
				'name' => $_POST['name'],
				'url' => $_POST['url'],
				'locationX' => (int) $_POST['locationX'],
				'locationY' => (int) $_POST['locationY'],
				'tabId' => $_POST['tabId']
			);
			
			if ($_GET['x'] != $_POST['locationX'] || $_GET['y'] != $_POST['locationY'])
				$links->remove(array('locationX' => (int) $_GET['x'], 'locationY' => (int) $_GET['y'], 'tabId' => $_GET['tab']));

			if ($obj == NULL)
				$links->save($newObj);
			else
			{
				$links->update($query, $newObj);
			}

			echo '<p>Saved!</p>';
		}
		else
			echo '<p>This location does not exist!</p>';
	}
	?>

	<div id="form">
		<?php 
		if (isset($_GET['x']) && isset($_GET['y']) && isset($_GET['tab']))
			printf('<form action="addLink.php?x=%s&y=%s&tab=%s" method="post">' . PHP_EOL, $_GET['x'], $_GET['y'], $_GET['tab']);
		else
			printf('<form action="addLink.php" method="post">' . PHP_EOL);
		?>
			<label for="name">Name:</label>
			<input type="text" name="name" value="<?php echo (isset($_GET['name'])) ? $_GET['name'] : ''; ?>" autofocus required placeholder="Name" />

			<label for="url">URL:</label>
			<input type="url" name="url" value="<?php echo (isset($_GET['url'])) ? $_GET['url'] : ''; ?>" required placeholder="URL" /><br />

			<label>Tab:</label>
			<select name="tabId">
				<?php
					$cursor = $tabs->find();
					$cursor->sort(array('position' => 1));

					while ($cursor->hasNext())
					{
						$cursor->next();
						$obj = $cursor->current();
						echo '<option value="' . $cursor->key() . '" ';
						echo (isset($_GET['tab']) && $cursor->key() == $_GET['tab']) ? 'selected="selected"' : '';
						echo '>' . $obj['name'] . '</option>';
					}
				?>
			</select><br />

			<label for="locationX" class="normal">X:</label>
			<input type="number" name="locationX" value="<?php echo (isset($_GET['x'])) ? $_GET['x'] : ''; ?>" required placeholder="X" />
			<label for="locationY" class="normal">Y:</label>
			<input type="number" name="locationY" value="<?php echo (isset($_GET['y'])) ? $_GET['y'] : ''; ?>" required placeholder="Y" /><br />

			<input type="submit" value="Save" />
		</form>
	</div>

	<p><a href="index.php">Go back</a></p>

</body>
</html>