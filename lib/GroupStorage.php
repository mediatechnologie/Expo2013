<?php

namespace Expo;

class GroupStorage
{
	protected $_groups = array();

	/**
	 * @param Group  $group  the group you want to add to this storage
	 */
	public function addGroup(Group $group)
	{
		$this->_groups[$group->name] = $group;
	}

	/**
	 * @param $name  the group name you want
	 */
	public function getGroup($name)
	{
		return isset($this->_groups[$name]) ? $this->_groups[$name] : null;
	}

	/**
	 * @return Group[]  array of groups in this storage :)
	 */
	public function getGroups()
	{
		return $this->_groups;
	}

	public function getGroupsForMember(Member $member)
	{
		$groups = array();

		foreach($this->_groups as $group)
		{
			foreach($group->members as $m)
			{
				if($m == $member)
				{
					$groups[] = $group;
				}
			}
		}

		return $groups;
	}
}