<?php

//####################################################################################### FtpAccess
class FtpAccess
{

	private $host;
	private $login;
	private $passwd;
	private $minecraftPath;

	//------------------------------------------------------------------------------------- FtpAccess
	public function FtpAccess($host, $login, $password, $minecraftPath = ".")
	{
		$this->host = $host;
		$this->login = $login;
		$this->password = $password;
		$this->minecraftPath = $minecraftPath;
	}

	//---------------------------------------------------------------------------------------- create
	public static function create($host, $login, $password, $minecraftPath = ".")
	{
		return new FtpAccess($host, $login, $password, $minecraftPath = ".");
	}

	//--------------------------------------------------------------------------------------- getFile
	public function getFile($filePath)
	{
		$ftp = ftp_connect($this->host);
		if (!$ftp) return false;
		if (!@ftp_login($ftp, $this->login, $this->password)) { @ftp_close($ftp); return false; }
		if (!@ftp_get($ftp, "ftp_access_file.tmp", $this->minecraftPath . "/" . $filePath, FTP_BINARY)) { @ftp_close($ftp); return false; }
		@ftp_close($ftp);
		$buffer = file_get_contents("ftp_access_file.tmp");
		unlink("ftp_access_file.tmp");
		return $buffer;
	}

	//--------------------------------------------------------------------------------------- putFile
	public function putFile($localFilePath, $filePath)
	{
		$ftp = @ftp_connect($this->host);
		if (!$ftp) return false;
		if (!@ftp_login($ftp, $this->login, $this->password)) { @ftp_close($ftp); return false; }
		if (!@ftp_put($ftp, $this->minecraftPath . "/" . $filePath, $localFilePath, FTP_BINARY)) { @ftp_close($ftp); return false; }
		@ftp_close($ftp);
		return true;
	}

	//--------------------------------------------------------------------------------- putFileResume
	public function putFileResume($localFilePath, $filePath)
	{
		return $this->putFile($localFilePath, $filePath);
	}

}
