<?php

ini_set("mongo.cmd", ":");

try
{
	$mongo = new Mongo();
	$db = $mongo->selectDB('frontpage');

	$links = $db->links;
	$tabs = $db->tabs;
	$settingsCollection = $db->settings;
	$settingsCursor = $db->settings->find()->limit(1);
	$settingsId;
	$settings = array();
	foreach ($settingsCursor as $obj)
	{
		$settingsId = $settingsCursor->key();
		$settings = $obj;
	}
}
catch (MongoConnectionException $e)
{
	echo 'Error while connecting: ' . $e->getMessage();
}