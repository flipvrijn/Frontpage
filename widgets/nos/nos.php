<?php

class Nu
{
	private $fileContent, $category;

	public function setCategory($category)
	{
		$this->category = $category;
	}

	public function getNews($y, $m, $d)
	{
		$newsItems = array();
		$this->fileContent = file_get_contents("http://nos.nl/nieuws/archief/datum/" . $y . '-' . $m . '-' . $d);
		preg_match('/<ul class="news\-list data\-list time\-cat\-title">(.*?)<\/ul>/', $this->fileContent, $list);
		preg_match_all('/<a href="(.*?)">/', $list[1], $links);
		preg_match_all('/<span class="time">(.*?)<\/span>/', $list[1], $times);
		preg_match_all('/<span class="cat">(.*?)<\/span>/', $list[1], $cats);
		preg_match_all('/<strong>(.*?)<\/strong>/', $list[1], $titles);

		for ($i = 0; $i < count($links[1]); $i++)
		{
			$title = (strlen($titles[1][$i]) > 30) ? substr($titles[1][$i], 0, 30) . '...' : $titles[1][$i];
			$newsItems[$i] = array('link' => 'http://nos.nl' . $links[1][$i], 'time' => $times[1][$i], 'cat' => $cats[1][$i], 'title' => $title, 'alt' => $titles[1][$i]);
		}

		return $newsItems;
	}
}

$widget = new Nu();

echo json_encode($widget->getNews(date('Y'), date('m'), date('d')));