<?php

require_once 'connect.req.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$obj = $tabs->findOne(array('position' => (int) $_POST['position']));

	$newObj = array(
		'name' => $_POST['name'],
		'position' => (int) $_POST['position']
	);

	if ($obj == NULL)
	{
		$tabs->save($newObj);
	}
	else
	{
		$cursor = $tabs->find(array('position' => array(':gte' => (int) $_POST['position'])));
		while ($cursor->hasNext())
		{
			$cursor->next();
			$tabs->update(array('_id' => new MongoId($cursor->key())), array(':inc' => array('position' => 1)));
		}
		$tabs->save($newObj);
	}

	echo 'Saved!';
}

?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Frontpage</title>
	<link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
	<header>
		<h3>Add tab</h3>
	</header>

	<div id="form">
		<form action="addTab.php" method="post">
			<label for="name">Name:</label>
			<input type="text" name="name" required placeholder="Name" /><br />

			<label for="position" class="normal">Position:</label>
			<input type="number" name="position" min="1" required />

			<input type="hidden" name="tabId" value="<?php echo $_GET['tab']; ?>" />

			<input type="submit" value="Save!" />
		</form>
	</div>

	<p>
		<a href="index.php">Go back</a>
	</p>

</body>
</html>