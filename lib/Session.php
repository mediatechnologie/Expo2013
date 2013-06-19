<?php

namespace Expo;

class Session
{
	public static $_isInitialized = false;

	public static function initialize(array $config = array())
	{
		if(!self::$_isInitialized)
		{
			session_start();
			self::$_isInitialized = true;
		}
	}

	public static function destroy()
	{
		if(!self::$_isInitialized)
		{
			self::initialize();
		}

		session_destroy();
	}

	public static function set($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	public static function get($name, $default = null)
	{
		return isset($_SESSION[$name]) ? $_SESSION[$name] : $default;
	}
}
