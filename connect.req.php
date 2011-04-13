<?php

ini_set("mongo.cmd", ":");

try
{
	$mongo = new Mongo();
	$db = $mongo->selectDB('frontpage');

	$settingsId = '4da0587bce1963eb14c23cb6';
	$settings = $db->settings;
	$links = $db->links;
	$tabs = $db->tabs;
	$gridSettings = $settings->findOne(array('_id' => new MongoId($settingsId)));
}
catch (MongoConnectionException $e)
{
	echo 'Error while connecting: ' . $e->getMessage();
}