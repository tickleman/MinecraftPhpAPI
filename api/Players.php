<?php

//######################################################################################### Players
class Players
{

	private $players = array();

	//---------------------------------------------------------------------------------------- create
	public static function create()
	{
		return new Players();
	}

	//----------------------------------------------------------------------------- plusPermissionsEx
	public function plusPermissionsEx($access)
	{
		$lines = explode("\n", $access->getFile("plugins/PermissionsEx/permissions.yml"));
		$in_user = false;
		foreach ($lines as $key => $line) {
			$line = str_replace("\r", "", $line);
			if (strlen($line) && $line[0] != '#') {
				if ($line == "users:") {
					$in_users = true;
				} elseif ($in_users && ($line[0] == ' ')) {
					if ($line[4] != ' ') {
						$user = substr($line, 4, -1);
						$this->players[$user]["name"] = $user;
					} else {
						if (substr($line, 8) == "group:") {
							$in_group = true;
						} elseif ($in_group && substr($line, 8, 2) == "- ") {
							$group = substr($line, 10);
							$this->players[$user]["group"] = $group;
						} else {
							$in_group = false;
						}
					}
				} else {
					$in_users = false;
				}
			}
		}
		return $this;
	}

	//--------------------------------------------------------------------------------------- toArray
	public function toArray()
	{
		return $this->players;
	}

}
