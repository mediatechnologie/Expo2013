<?php

function generateMap()
{
	$map = array();
	$map['collision'] = array();

	$projects = Expo\ProjectController::getAll();

	$blocks    = array();
	$tileWidth = count($projects) * 5;
	$width     = $tileWidth * 70;

	foreach($projects as $project)
	{
		$block = getBlock($map, $tileWidth, 6);
		$block['image'] = $project->getExtra('image-' . $block['size']);
		$block['url']   = $project->getUrl();

		$blocks[] = $block;
	}

	$block = getBlock($map, $tileWidth, 6);
	$block['size']  = 1;
	$block['image'] = '/expo/assets/images/ma_logo_x64.png';

	$blocks[] = $block;

	return $blocks;
}

function getBlock(&$map, $w, $h)
{
	do
	{
		$isColliding = false;

		$x       = rand(0, $w);
		$offsetX = $x * 64 + $x * 8 - 5;
		$y       = rand(0, $h);
		$offsetY = $y * 64 + $y * 8 - 5;

		$size    = $y < 5 ? rand(1,3) : ($y < 6 ? rand(1, 2) : 1);

		for($i = 0; $i < $size; $i++)
		{
			for($j = 0; $j < $size; $j++)
			{
				if(isset($map['collision'][$x + $i][$y + $j]))
				{
					$isColliding = true;
				}
			}
		}

		if(!$isColliding)
		{
			for($i = 0; $i < $size; $i++)
			{
				for($j = 0; $j < $size; $j++)
				{
					$map['collision'][$x + $i][$y + $j] = true;
				}
			}
		}
	}
	while($isColliding);

	return array(
		'xOffset' => $offsetX,
		'yOffset' => $offsetY,
		'size'    => $size,
	);
}