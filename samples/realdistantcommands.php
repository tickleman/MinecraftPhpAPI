<?php
$command = $_POST["command"] ? $_POST["command"] : "say Hello World";
$formitems = <<<EOT
<input name="command" value="$command">
EOT;
include "connectform.php";

if ($_POST) {

echo "<H3>SEND COMMAND $_POST[command]<H3>";

$GLOBALS["MinecraftAPIConfig"]["path"] = "../api";
include_once "MinecraftAPI.php";
$access = FtpAccess::create($_POST["host"], $_POST["login"], $_POST["password"]);

RealDistantCommands::create()
	->addCommand($_GET["command"])
	->send($access);
echo "command was sent";

}
