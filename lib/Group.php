<?php

namespace Expo;

class Group
{
	public function __construct($name, $description = '', $members = array())
	{
		$this->name        = $name;
		$this->description = $description;

		foreach($members as $member)
		{
			$this->addMember($member);
		}
	}

	public function addMember(Member $member)
	{
		$this->members[] = $member;
	}

	public function getMembers()
	{
		return $this->members;
	}

	public function getName()
	{
		return $this->name;
	}
}