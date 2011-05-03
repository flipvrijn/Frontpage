<?php

require_once '../connect.req.php';

$jsonResponse = '<table id="gridTable">';
for ($i = 0; $i < $settings['grid']['height']; $i++)
{
	$jsonResponse .= '<tr>';
	for ($j = 0; $j < $settings['grid']['width']; $j++)
	{
		$jsonResponse .= '<td><div>';
		
		$cursor = $tabs->find()->limit(1);
		$cursor->sort(array('position' => 1))->next();
		$tabId = (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : $cursor->key();

		$linkObj = $links->findOne(array('locationX' => $j, 'locationY' => $i, 'tabId' => $tabId));
		if ($linkObj != NULL)
		{
			$jsonResponse .= sprintf('<a href="%s" class="button" %s>%s</a>', 
				$linkObj['url'], 
				($settings['newWindow'] == 1) ? 'target="_blank"' : '',
				$linkObj['name']);
			$jsonResponse .= '</div><div class="options">';
			$jsonResponse .= sprintf('<a href="addLink.php?name=%s&url=%s&x=%s&y=%s&tab=%s" class="button" title="Edit"><span class="pen icon">&nbsp;</span></a>', $linkObj['name'], urlencode($linkObj['url']), $j, $i, $tabId);
			$jsonResponse .= sprintf('<a href="removeLink.php?x=%s&y=%s&tab=%s" class="button negative" title="Remove"><span class="cross icon">&nbsp;</span></a>', $j, $i, $tabId);
			$jsonResponse .= '</div>';
		}
		else
		{
			$jsonResponse .= sprintf('<a href="addLink.php?x=%s&y=%s&tab=%s" class="button positive">&nbsp;</a>', $j, $i,	$tabId);
			$jsonResponse .= '</div><div class="options"></div>';
		}
		$jsonResponse .= '</td>';
	}
	$jsonResponse .= '</tr>';
}
$jsonResponse .= '</table>';

echo json_encode($jsonResponse);