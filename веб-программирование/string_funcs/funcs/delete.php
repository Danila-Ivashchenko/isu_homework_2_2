<?php
	require_once "./parse_data.php";

	function apdate_file($id, $data) {

	}

	if (isset($_POST["id"])) {
		$id = $_POST["id"];
		echo $id;
		$data = parse_data('../static/data.txt');
		$file = fopen('../static/data.txt', 'w');
		foreach ($data as $data_row) {
			$line = $data_row[0] . '|' . $data_row[1] . '|' . $data_row[2] . '|' . $data_row[3] . '|';
			$line .= $data_row[4] . '|' . $data_row[5] . '|' . $data_row[6] . '|' . $data_row[7] . '|';
			$line .= $data_row[8] . '|';
			if ($data_row[0] == $id) {
				$line .= "DELETED\n";
			} else {
				$line .= "ACTIVE\n";
			}
			fwrite($file, $line);
		}
		fclose($file);
	}

header("Location: ../admin.php");
exit();

?>