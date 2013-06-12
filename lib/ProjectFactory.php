<?php

class ProjectFactory
{
	public static function create($location)
	{
		$project = new Project($location);
		$project->load();

		return $project;
	}
}