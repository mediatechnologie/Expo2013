<?php

class Member
{
	/** @var string */
	protected $_name  = '';

	/** @var string */
	protected $_class = '';

	public function __construct($name, $class)
	{
		$this->_name  = $name;
		$this->_class = $class;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function getClass()
	{
		return $this->_class;
	}
}