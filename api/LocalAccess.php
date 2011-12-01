<?php

//##################################################################################### LocalAccess
class LocalAccess
{

	private $minecraftPath;

	//----------------------------------------------------------------------------------- LocalAccess
	public function LocalAccess($minecraftPath = ".")
	{
		$this->minecraftPath = $minecraftPath;
	}

	//---------------------------------------------------------------------------------------- create
	public static function create($minecraftPath = ".")
	{
		return new LocalAccess($minecraftPath = ".");
	}

	//--------------------------------------------------------------------------------------- getFile
	public function getFile($filePath)
	{
		return file_get_contents($this->minecraftPath . "/" . $filePath);
	}

	//--------------------------------------------------------------------------------------- putFile
	public function putFile($localFilePath, $filePath)
	{
		clearstatcache();
		if (is_file($localFilePath)) {
			if (is_file($this->minecraftPath . "/" . $filePath)) {
				@unlink($filePath);
			}
			return @copy($localFilePath, $filePath);
		} else {
			return false;
		}
	}

	//--------------------------------------------------------------------------------- putFileResume
	public function putFileResume($localFilePath, $filePath)
	{
		return $this->putFile($localFilePath, $filePath);
	}

}
