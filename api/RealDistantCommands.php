<?php

//############################################################################# RealDistantCommands
class RealDistantCommands
{

	private $commandsFile;

	//--------------------------------------------------------------------------- RealDistantCommands
	public function RealDistantCommands($commandsFile = null)
	{
		$this->commandsFile = is_null($commandsFile)
			? (MinecraftAPI::getPath() . "/RealDistantCommands.txt")
			: $commandsFile;
	}

	//------------------------------------------------------------------------------------ addCommand
	public function addCommand($command)
	{
		$f = fopen($this->commandsFile, "ab");
		fputs($f, $command . "\n");
		fclose($f);
		return $this;
	}

	//---------------------------------------------------------------------------------------- create
	public function create($commandsFile = null)
	{
		return new RealDistantCommands($commandsFile);
	}

	//------------------------------------------------------------------------------------------ send
	public function send($access)
	{
		RealDistantCommands::addCommand("flush");
		return $access->putFileResume(
			$this->commandsFile, "plugins/RealDistantCommands/RealDistantCommands.txt"
		);
	}

}
