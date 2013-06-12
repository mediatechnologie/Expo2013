<?php

namespace Expo;

/**
 * Object representing a team Member 
 */
class Member
{
	/** @var string */
	protected $_name  = '';

	/** @var string */
	protected $_class = '';

	/**
	 * Creates a new Member object
	 *
	 * @param string  $name   member name
	 * @param string  $class  class the member is part of
	 */
	public function __construct($name, $class)
	{
		$this->_name  = $name;
		$this->_class = $class;
	}

	/**
	 * Get the member name
	 *
	 * @return string  the member name
	 */
	public function getName()
	{
		return $this->_name;
	}

	/**
	 * Get class the member is part of
	 *
	 * @return string  class
	 */
	public function getClass()
	{
		return $this->_class;
	}
}