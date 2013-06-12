<?php

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

	public function __construct($location)
	{
		$this->_location = $location;
	}

	public function load()
	{
		$data = json_decode(file_get_contents($this->_location . DIRECTORY_SEPARATOR . 'project.json'));

		$this->_name        = $data->name;
		$this->_description = $data->description;
		$this->_extra       = $data->extra;

		$this->setTeams($data->teams);
	}

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

	public function addMember(Member $member)
	{
		$this->_team;
	}

	public function getUrl()
	{
		$url = strtolower($this->_name);
		$url = str_replace(' ', '-', $url);
		$url = str_replace('&-', '', $url);

		# retrieves a sanitized url from the project name :3
		return $this->getExtra('index') . DIRECTORY_SEPARATOR . $url;
	}

	public function getLocation()
	{
		return $this->_location;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function getDescription()
	{
		return $this->_description;
	}

	public function getTeams($index = null)
	{
		if(null === $index)
		{
			return $this->_teams;
		}

		return $this->_teams[$index];
	}

	public function getExtra($variable = null)
	{
		if(null === $variable)
		{
			return (array)$this->_extra;
		}

		return $this->_extra->{$variable};
	}
}