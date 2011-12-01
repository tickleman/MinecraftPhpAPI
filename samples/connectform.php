<form action="<?php echo $_SERVER["SCRIPT_NAME"] ?>" method="post">
<label for="host">host</label><input name="host" value="<?php echo $_POST["host"]; ?>">
<label for="login">login</label><input name="login" value="<?php echo $_POST["login"]; ?>">
<label for="password">password</label><input name="password" value="<?php echo $_POST["password"]?>" type="password">
<?php echo isset($formitems) ? $formitems : ""?>
</form>
