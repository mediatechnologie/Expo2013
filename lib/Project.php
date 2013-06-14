<?php

namespace Expo;

/**
 * Class representing a project
 */
class Project
{
	/** @var string */
	protected $_name        = '';

	/** @var string */
	protected $_location    = '';

	/** @var string */
	protected $_description = '';

	/** @var array */
	protected $_teams  = array();

	/** @var Client */
	protected $_client = null;

	/**
	 * Constructs a new project which resides at the given location
	 *
	 * @param string  $location  the project location
	 */
	public function __construct($location)
	{
		$this->_location = $location;
	}

	/**
	 * Loads project file and sets initial variables
	 */
	public function load($file = 'project.json')
	{
		$data = json_decode(file_get_contents($this->_location . DIRECTORY_SEPARATOR . $file));

		$this->setName($data->name);
		$this->setDescription($data->description);
		$this->setExtra($data->extra);
		$this->setTeams($data->teams);

		$client = new Client();
		$client->setName($data->client->name);
		$client->setOrganisation($data->client->organisation);

		$this->setClient($client);
	}

	/**
	 * Set a client for this project
	 *
	 * @param Client  $client  the client you want to bind to this project
	 */
	public function setClient(Client $client)
	{
		$this->_client = $client;
	}

	/**
	 * Set a project name
	 *
	 * @param string  $name  the name you want to give to this project
	 */
	public function setName($name)
	{
		$this->_name = $name;
	}

	/**
	 * Set a project description
	 *
	 * @param string  $description  the description you want to give to this project
	 */
	public function setDescription($description)
	{
		$this->_description = $description;
	}

	/**
	 * Sets extra variables (either in array format or object format)
	 *
	 * @param mixed  $extra  the extra variables you want to give to this project
	 */
	public function setExtra($extra)
	{
		$this->_extra = (array)$extra;
	}

	/**
	 * Get the project client
	 *
	 * @return Client  the project client
	 */
	public function getClient()
	{
		return $this->_client;
	}

	/**
	 * Sets the team object(s) bound to this Project
	 *
	 * @param array  $teams  array of teams
	 */
	public function setTeams($teams)
	{
		foreach($teams as $t)
		{
			$team = new Team($t->name);

			foreach($t->members as $member)
			{
				$team->addMember(new Member($member->name, $member->class));
			}

			$this->_teams[] = $team;
		}
	}

	/**
	 * Get sanitized project Url
	 *
	 * @return string  the url
	 */
	public function getUrl()
	{
		$url = strtolower($this->_name);
		$url = str_replace(' ', '-', $url);
		$url = str_replace('&-', '', $url);

		# retrieves a sanitized url from the project name :3
		return $this->getExtra('index') . DIRECTORY_SEPARATOR . $url;
	}

	/**
	 * Get the location the project resides at
	 *
	 * @return string  the location
	 */
	public function getLocation()
	{
		return $this->_location;
	}

	/**
	 * Get the project name
	 *
	 * @return string  the name
	 */
	public function getName()
	{
		return $this->_name;
	}

	/**
	 * Get the project description
	 *
	 * @return string  the description
	 */
	public function getDescription()
	{
		return $this->_description;
	}

	/**
	 * Get all the teams
	 */
	public function getTeams()
	{
		return $this->_teams;
	}

	/**
	 * Get Team at specific index
	 *
	 * @param int  $index  the team index
	 */
	public function getTeam($index = 0)
	{
		return $this->_teams[$index];
	}

	/**
	 * Get extra project information
	 *
	 * @param $variable  optional variable to obtain from extra
	 */
	public function getExtra($variable = null)
	{
		if(null === $variable)
		{
			return $this->_extra;
		}

		return isset($this->_extra[$variable]) ? $this->_extra[$variable] : '';
	}
}