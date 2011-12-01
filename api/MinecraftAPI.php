<?php

//#################################################################################### MinecraftAPI
class MinecraftAPI
{

	private static $classes = array("FtpAccess", "Players", "RealDistantCommands");

	private static $path = ".";

	//--------------------------------------------------------------------------------------- getPath
	public static function getPath()
	{
		return MinecraftAPI::$path;
	}

	//------------------------------------------------------------------------------------------ init
	public static function init()
	{
		if (isset($GLOBALS["MinecraftAPIConfig"]["path"])) {
			MinecraftAPI::$path = $GLOBALS["MinecraftAPIConfig"]["path"];
		}
		if (isset($GLOBALS["MinecraftAPIConfig"]["classes"])) {
			MinecraftAPI::$classes = array_merge(
				MinecraftAPI::$classes,
				$GLOBALS["MinecraftAPIConfig"]["classes"]
			);
		}
		foreach (MinecraftAPI::$classes as $class) {
			if (is_file(MinecraftAPI::$path . "/$class.php")) {
				include_once MinecraftAPI::$path . "/$class.php";
			}
		}
	}

}

MinecraftAPI::init();
