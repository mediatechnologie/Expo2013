<?php

namespace Expo;

/**
 * Object representing a team Member
 */
class Member
{
	/** @var string */
	protected $_name  = '';

	/**
	 * Creates a new Member object
	 *
	 * @param string  $name   member name
	 * @param string  $class  class the member is part of
	 */
	public function __construct($name)
	{
		$this->_name  = $name;
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

	public function getGroups($index = null)
	{
		$storage = Session::get('groupStorage');
		$groups  = $storage->getGroupsForMember($this);

		if(null !== $index)
		{
			return $groups[0];
		}

		return $groups;
	}
}