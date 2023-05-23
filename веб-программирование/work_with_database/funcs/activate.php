<?php
	require_once "../database/database.php";

	function apdate_file($id, $data) {

	}

	if (isset($_POST["id"])) {
		$id = $_POST["id"];
		echo $id;
		$db = get_db();
		$stmt = $db->prepare("UPDATE participants SET deleted_at = null, updated_at = ? WHERE id=?");
		$time = date("Y-m-d H:i:s");
		$stmt->execute([$time, $id]);
	}

header("Location: ../admin.php");
exit();

?>