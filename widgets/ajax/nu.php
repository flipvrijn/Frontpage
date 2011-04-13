<?php

class Nu
{
	private $fileContent, $category;

	public function setCategory($category)
	{
		$this->category = $category;
	}

	public function getNews()
	{
		$this->fileContent = file_get_contents("http://www.nu.nl/deeplink_rss2/index.jsp?r=" . ucfirst($this->category));

		$news = array();
		$xml = new SimpleXMLElement($this->fileContent);
		foreach ($xml->channel->item as $item)
		{
			array_push($news, $item);
		}

		return $news;
	}
}

$widget = new Nu();
$category = (isset($_GET['category'])) ? $_GET['category'] : 'algemeen';
$widget->setCategory($category);

foreach ($widget->getNews() as $news)
{
	$datetime = DateTime::createFromFormat('D, d M Y H:i:s O', $news->pubDate);
	$new = (time() - strtotime($news->pubDate) <= 900) ? 'Yes' : 'No';
	$title = (strlen($news->title) < 45) ? (string) $news->title : substr($news->title, 0, 45) . ' ...';
	$jsonArray[] = array(array('url' => (string) $news->link, 'title' => $title, 'alt' => (string) $news->title, 'pubDate' => (string) $datetime->format('Y-m-d H:i:s'), 'new' => $new));
}

echo json_encode($jsonArray);