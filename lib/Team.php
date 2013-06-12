<?php

class Team
{
	/** @var string */
	protected $_name = '';

	/** @var Member[] */
	protected $_members = array();

	/** @var Client */
	protected $_client = null;

	/**
	 * @param string  $name     team name
	 * @param array   $members  optional list of Member objects
	 */
	public function __construct($name, $members = array())
	{
		$this->_members = $members;
	}

	/**
	 * @param Member  $member  the member you want to add to this group
	 */
	public function addMember(Member $member)
	{
		$this->_members[] = $member;
	}

	/**
	 * @return Members[]  list of member objects
	 */
	public function getMembers()
	{
		return $this->_members;
	}

	/**
	 * @param Client  $client  the client you want to bind to this team
	 */
	public function setClient(Client $client)
	{
		$this->_client = $client;
	}

	/**
	 * @return Client  the project client
	 */
	public function getClient()
	{
		return $this->_client;
	}
}