<?php
	require_once "../database/database.php";

	function apdate_file($id, $data) {

	}

	if (isset($_POST["id"])) {
		$id = $_POST["id"];
		echo $id;
		$db = get_db();
		$stmt = $db->prepare("UPDATE participants SET deleted_at = ?, updated_at = ? WHERE id=?");
		$time = date("Y-m-d H:i:s");
		$stmt->execute([$time, $time, $id]);
	}

header("Location: ../admin.php");
exit();

?>