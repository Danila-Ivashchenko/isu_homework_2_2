<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<table>
	<?php
	for ($i = 0; $i <= 10; $i++){
		echo '<tr>';
		for ($j = 0; $j <= 10; $j++){
			if ($i == 0 && $j == 0)
				echo "<td class='zero_cell'></td>";
			else if ($i == 0)
				echo "<td class='head_of_col'>$j</td>";
			else if ($j == 0)
				echo "<td class='head_of_row'>$i</td>";
			else if ($i == $j )
				echo "<td class='diagonal_cell'>" . $j * $i . '</td>';
			else
				echo '<td>' . $j * $i . '</td>';
		}
		echo '</tr>';
	}
	?>
	</table>
</body>
</html>