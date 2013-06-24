<?php

namespace Expo;

/**
 * Project factory unit
 */
class ProjectFactory
{
	/**
	 * Creates Project objects
	 *
	 * @param  string  $location  to create a Project instance at
	 * @return Project
	 */
	public static function create($id, $location)
	{
		$project = new Project($id, $location);
		$project->load();

		return $project;
	}
}