<?php

namespace Expo;

use \DirectoryIterator  as DirectoryIterator;

/**
 * Controller managing most project related functionality
 */
class ProjectController
{
	/** @var array */
	protected static $_projects = array();

	/**
	 * Get all projects in a directory structure
	 *
	 * @param  string  $directory  the directory to search
	 *                             default is the current directory
	 * @return Project[]
	 */
	public static function getAll($directory = '.')
	{
		if(empty(self::$_projects))
		{
			$locations = self::find($directory);
			foreach($locations as $location)
			{
				$project = ProjectFactory::create($location);
				self::$_projects[$project->getExtra('index')] = $project;
			}
		}

		return self::$_projects;
	}

	/**
	 * Get all names of projects found in $directory
	 *
	 * @param  string    $directory  the directory
	 * @return string[]              array of names
	 */
	public static function getNames($directory = '.')
	{
		$names = array();
		foreach(self::getAll($directory) as $project)
		{
			$names[] = $project->getName();
		}

		return $names;
	}

	/**
	 * Get all indexes of projects found in $directory
	 *
	 * @param  string    $directory  the directory
	 * @return int[]                 array of indexes
	 */
	public static function getIndexes($directory = '.')
	{
		$indexes = array();
		foreach(self::getAll($directory) as $project)
		{
			$indexes[] = $project->getExtra('index');
		}

		return $indexes;
	}

	/**
	 * Get Project by index
	 *
	 * @param  int      $index  to retrieve the project by
	 * @return Project          the project
	 */
	public static function getByIndex($index)
	{
		$projects = self::getAll();
		return isset($projects[$index]) ? $projects[$index] : null;
	}

	/**
	 * Is this index found in the projects?
	 *
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
	 * 
	 * @param  string  $directory  the directory to find projects in
	 * @return string[]            array of project directory paths
	 */
	public static function find($directory = '.')
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
					$projects = array_merge($projects, self::find($directory . DIRECTORY_SEPARATOR . $fileinfo->getFilename()));
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