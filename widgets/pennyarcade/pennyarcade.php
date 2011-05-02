<?php

class PennyArcade
{
	private $fileContent;

	public function getComic($y, $m, $d)
	{
		$fileContent = file_get_contents('http://www.penny-arcade.com/comic/' . $y . '/' . $m . '/' . $d);
		preg_match('/<img src="(.*?)" alt="(.*?)"\s+ \/>/', $fileContent, $matches);
		return array('image_url' => $matches[1], 'title' => $matches[2], 'alt' => $matches[2]);
	}
}

$widget = new PennyArcade();
$strip = $widget->getComic(date('Y'), date('m'), date('d'));
echo json_encode(array('strip' => $strip));