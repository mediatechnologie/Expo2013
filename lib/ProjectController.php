<?php

class ProjectController
{
	/**
	 * ProjectCache
	 */
	protected static $_projects = array();

	public static function getAll($directory = '.')
	{
		if(empty(self::$_projects))
		{
			$locations = self::findInstances($directory);
			foreach($locations as $location)
			{
				$project = ProjectFactory::create($location);
				self::$_projects[$project->getExtra('index')] = $project;
			}
		}

		return self::$_projects;
	}
	/**
	 * Function that retrieves all project names based on their respective directories
	 */
	public static function getNames()
	{
		$names = array();
		foreach(self::getAll() as $project)
		{
			$names[] = $project->getName();
		}

		return $names;
	}

	/**
	 * Function that retrieves all project names based on their respective directories
	 */
	public static function getIndexes()
	{
		$indexes = array();
		foreach(self::getAll() as $project)
		{
			$indexes[] = $project->getExtra('index');
		}

		return $indexes;
	}

	public static function getByIndex($index)
	{
		$projects = self::getAll();
		return $projects[$index];
	}

	/**
	 * @param  int      $index  the index to check for projectism
	 * @return boolean          indicating whether the name is guilty of projectism
	 */
	public static function isProject($index)
	{
		if(in_array($index, self::getIndexes()))
		{
			return true;
		}

		return false;
	}

	/**
	 * Function that retrieves all project directories based on the existance of a project.json
	 */
	public static function findInstances($directory = '.')
	{
		$projects = array();
		foreach(new DirectoryIterator($directory) as $fileinfo)
		{
			if($fileinfo->isDot())
			{
				continue;
			}
			else
			{
				if($fileinfo->isDir())
				{
					$projects = array_merge($projects, self::findInstances($directory . DIRECTORY_SEPARATOR . $fileinfo->getFilename()));
				}
				else
				{
					if($fileinfo->getFilename() === 'project.json')
					{
						$projects[] = $fileinfo->getPath();
					}
				}
			}
		}

		return $projects;
	}
}