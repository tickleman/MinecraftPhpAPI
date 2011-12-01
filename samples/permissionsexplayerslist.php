<?php
include "connectform.php";
if ($_POST) {
	
$GLOBALS["MinecraftAPIConfig"]["path"] = "../api";
include_once "MinecraftAPI.php";
$access = FtpAccess::create($_POST["host"], $_POST["login"], $_POST["password"]);

$players = Players::create()
	->addPermissionsEx($access)
	->toArray();
?>

<table>
<tr><th>name</th><th>group</th></tr>
<?php foreach ($players as $player) { ?>
<tr><td><?php echo $player["name"]; ?></td><td><?php $player["group"]; ?></td></tr>
<?php } ?>
</table>

<?php
}
