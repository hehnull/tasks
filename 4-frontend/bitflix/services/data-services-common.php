<?php
declare(strict_types = 1);

function extractData(string $dataPath)
{
	static $receivedAllPaths = [];
	$receivedData = null;
	if (!in_array($dataPath, array_keys($receivedAllPaths), true))
	{
		$receivedData = require_once $dataPath;
		$receivedAllPaths[$dataPath] = $receivedData;
	}
	return $receivedAllPaths[$dataPath];
}

function getOptions(?string $option = null)
{
	$options = extractData(ROOT . '/config.php');
	if (isset($option))
	{
		return $options[$option];
	}
	return $options;
}

function toupperMenu($item): string
{
	return mb_strtoupper($item);
}

function getMenuItem(): array
{
	return array_map('toUpperMenu',
		array_merge(getOptions('firstPages'), getDbGenresWithCodes(), getOptions('lastPages')));
}

function outputDuration(int $onlyMinutes): string
{
	$minutes = $onlyMinutes % 60;
	$hours = intval($onlyMinutes / 60);
	return sprintf("%s мин. / %s:%s", $onlyMinutes, $hours, $minutes);
}
