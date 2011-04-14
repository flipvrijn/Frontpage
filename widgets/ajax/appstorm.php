<?php

class AppStorm
{
	private $feedContent;

	public function getFeeds()
	{
		$this->feedContent = file_get_contents('http://feeds.feedburner.com/MacAppStorm');
		$feeds = array();
		$xml = new SimpleXMLElement($this->feedContent);

		foreach ($xml->channel->item as $item)
		{
			array_push($feeds, $item);
		}

		return $feeds;
	}
}

$widget = new AppStorm();

$jsonArray = array();

foreach ($widget->getFeeds() as $feed)
{
	$datetime = DateTime::createFromFormat('D, d M Y H:i:s O', $feed->pubDate);
	if (strtotime($datetime->format('Y-m-d')) == strtotime(date('Y-m-d')))
	{
		$jsonArray[] = array(array('url' => (string) $feed->link, 'title' => (string) $feed->title));
	}
}

echo json_encode($jsonArray);