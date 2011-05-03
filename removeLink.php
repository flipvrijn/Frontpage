<?php require_once 'connect.req.php'; ?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Remove link - Frontpage</title>
	<link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>
<body>

	<header>
		<h3>Remove a link</h3>
	</header>

	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if ($_POST['answer'] == 'Yes')
		{
			if ($links->remove(array('locationX' => (int) $_POST['locationX'], 'locationY' => (int) $_POST['locationY'], 'tabId' => $_POST['tabId'])))
				echo 'Links removed!';
			else
				echo 'Failed removing link';
		}
	}
	if (isset($_GET['x']) && isset($_GET['y']))
	{
	?>
	
	<p>Are you sure you want to remove the link:</p>
	<?php
		$linkObj = $links->findOne(array('locationX' => (int) $_GET['x'], 'locationY' => (int) $_GET['y'], 'tabId' => $_GET['tab']));
	?>
	<p>Name: <?php echo $linkObj['name']; ?></p>
	<p>Name: <?php echo $linkObj['url']; ?></p>

	<div class="form">
		<form action="removeLink.php" method="post">
			<input type="hidden" name="locationX" value="<?php echo $_GET['x']; ?>" />
			<input type="hidden" name="locationY" value="<?php echo $_GET['y']; ?>" />
			<input type="hidden" name="tabId" value="<?php echo $_GET['tab']; ?>" />
			<input type="submit" name="answer" value="Yes" /> <input type="submit" name="answer" value="No" />
		</form>
	</div>
	
	<?php 
	} 
	?>

	<p>
		<a href="index.php">Go back</a>
	</p>
</body>
</html>