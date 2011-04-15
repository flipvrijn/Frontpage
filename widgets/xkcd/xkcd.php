<?php

class XKCD
{
	private $fileContent;

	public function getStrip($url)
	{
		$this->fileContent = file_get_contents($url);
		preg_match('/<img src="(.*?)" title="(.*?)" alt="(.*?)" \/>/', $this->fileContent, $matches);
		return array('image_url' => $matches[1], 'title' => $matches[2], 'alt' => $matches[3]);
	}


}

$widget = new XKCD();
$strip = (isset($_GET['id'])) ? $widget->getStrip('http://www.xkcd/' . $_GET['id'] . '/') : $widget->getStrip('http://www.xkcd.com/');
echo json_encode(array('strip' => $strip));