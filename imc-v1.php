<!doctype html>
<html lang="fr">
<head>
  	<meta charset="utf-8">
  	<title>IMC</title>
  	<style type="text/css">
	  	table {
			border-collapse: collapse;
		}

		td, th {
			border: 1px solid black;
		}
  	</style>
</head>
<body>
 	<?php include("data.php"); ?>

 	<?php
 		echo '<table><caption>IMC</caption>';
		echo '<tr><th>Nom</th><th>Prénom</th><th>Email</th><th>Taille</th><th>Poids</th><th>IMC</th></tr>';

		foreach ($data as $person) {
			echo '<tr>';
			foreach ($person as $property)
				echo '<td>' . $property . '</td>';
			echo '<td>' . round($person['Poids'] / $person['Taille']*100 / $person['Taille']*100, 2) . '</td>';
			echo '</tr>';
		}

		echo '</table>';
	?>

	<script type="text/javascript">
		tr = document.querySelectorAll('tr');
		<?php
		$count = 1;
			foreach ($data as $person) {
				if ($person['Poids'] / $person['Taille']*100 / $person['Taille']*100 > 25) {
					echo "tr[$count].style.backgroundColor = '#FF0000';";
				}
				$count += 1;
			}
		?>
	</script>
</body>
</html>