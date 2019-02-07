<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
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
		<?php include 'data.php.txt'; ?>

		<form method="get" action="imc-v2.php">
			<input type="hidden" name="page" value="1">
		</form>

		<?php 
	 		if (isset($_GET['page'])) {

					echo '	<div class="container">
								<table class="table">
									<thead>
										<tr>
											<th>Nom</th>
											<th>Prénom</th>
											<th>Mail</th>
											<th>Taille</th>
											<th>Poids</th>
											<th>Imc</th>
										</tr>
									</thead>
									<tbody>';

					$nb=count($data);
					$personnesParPage = 15;

					for ($i = ($_GET['page'] - 1) * $personnesParPage; $i < $_GET['page'] * $personnesParPage; $i += 1) {
						$personne=$data[$i];
						$m=$personne['Poids'];
						$t=$personne['Taille']/100;
						$imc=$m/($t*$t);
						$class="";
						if ($imc >= 25) 
							$class="error";
						if ($imc <= 18) 
							$class="warning";
						echo "<tr class=\"$class\">";
						echo "<td>".$personne['Nom']."</td>";
						echo "<td>".$personne['Prenom']."</td>";
						echo "<td>".$personne['Email']."</td>";
						echo "<td>".$personne['Taille']."</td>";
						echo "<td>".$personne['Poids']."</td>";
						echo "<td>".round($imc,2)."</td>";
						echo "</tr>";
					}

					echo '	</tbody>
						</table>
					</div>
					<div class="pagination">';

		    		$k = intval($_GET['page']);
		    		$k -= 1;
		    		echo '<a href="imc-v2.php?page=' . $k . '"> < </a>';
		    		$count = 0;
		    		for ($i = 0; $i < $nb; $i += $personnesParPage) {
		    			$count += 1;
		    			echo '<a href="imc-v2.php?page=' . $count . '"> ' . $count .' </a>';
		    		}
		    		$k += 2;
		    		echo '<a href="imc-v2.php?page=' . $k . '"> > </a>';

		    		echo '</div>';	
			}

			else { //première partie de l'exercice

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
			}
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