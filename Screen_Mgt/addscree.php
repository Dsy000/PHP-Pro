<?php
/**
 *
 * Created By Deepak Yadav.
 *
 */
require_once "screen_mgnt.php";
//print_r($_POST);
if ($_POST == null) {
	echo "Get null";
} else {
	if (isset($_POST['command']) && isset($_POST['name'])) {
		$command = $_POST['command'];
		$name = trim($_POST['name']);
		$name = str_replace(' ', '_', $name);

		$session = new screen_mgnt();
		$out = $session->setScreenName_logD($name, $command);
		echo $out;
		header("Location: index.php");

	}
}

?>