<?php

namespace Expo;

/**
 * Object representing the Client
 */
class Client
{
	/** @var string */
	protected $_name = '';

	/** @var string */
	protected $_organisation = '';

	/**
	 * Constructs a new client object
	 *
	 * @param string  $name          client name
	 * @param string  $organisation  organisation the client belongs to
	 */
	public function __construct($name = '', $organisation = '')
	{
		$this->setName($name);
		$this->setOrganisation($organisation);
	}

	/**
	 * Set the client name
	 *
	 * @param string  $name  the name you wish to set
	 */
	public function setName($name)
	{
		$this->_name = $name;
	}

	/**
	 * Get the client name
	 *
	 * @return string  the name of the client
	 */
	public function getName()
	{
		return $this->_name;
	}

	/**
	 * Set the client organisation
	 *
	 * @param string  $organsation  the organisation you wish to set
	 */
	public function setOrganisation($organisation)
	{
		$this->_organisation = $organisation;
	}

	/**
	 * Get the client organisation
	 *
	 * @return string  the organisation of the client
	 */
	public function getOrganisation()
	{
		return $this->_organisation;
	}
}