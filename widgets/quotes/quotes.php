<?php

require_once '../../connect.req.php';

class Quotes
{
	private $quotes;

	public function __construct($db)
	{
		try
		{
			$this->quotes = $db->quotes;
		}
		catch (MongoConnectionException $e)
		{
			echo 'Error while connecting: ' . $e->getMessage();
		}
	}

	public function add($array)
	{
		if (isset($array['text']) && isset($array['author']))
		{
			$newObj = array(
				'text' => $array['text'],
				'author' => $array['author']
			);

			$this->quotes->save($newObj);
		}
	}

	public function getQuotes()
	{
		$cursor = $this->quotes->find();
		$cursor->sort(array('_id' => -1));

		$quotesArray = array();

		while($cursor->hasNext())
		{
			$cursor->next();
			$obj = $cursor->current();
			array_push($quotesArray, array('text' => $obj['text'], 'author' => $obj['author']));
		}

		return $quotesArray;
	}
}

$widget = new Quotes($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$widget->add($_POST);
}

echo json_encode($widget->getQuotes());