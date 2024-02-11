<?php
function truncate(string $text, ?int $length = 200): string
{
	if ($length === null)
	{
		return $text;
	}
	$cropped = mb_substr($text, 0, $length);
	if ($cropped !== $text)
	{
		return "{$cropped}...";
	}
	return $cropped;
}