<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>IMC</title>
	  	<style type="text/css">
	  		/*lorsque l'on ne mentionne pas le numero de page les classes container, pagination et page ne sont pas créées*/ 
	  		.container {
	  			width: 100%;
	  		}
		  	table {
				border-collapse: collapse;
				width: 100%;
			}

			td, th {
				border: 1px solid black;
			}
			.pagination {
				padding: 10px;
				width: 100%;
				height: 32px;
			}
			.page {
				display: inline-block;
				border: 1px solid black;
				width: 30px;
				height: 30px;
				text-align: center;
				background-color: #FFFFFF;
			}
		</style>
	</head>
	<body>
		<?php include 'data.php.txt'; ?>

		<form method="get" action="imc-v2.php">
			<input type="hidden" name="page">
		</form>

		<?php 
			
			$nb=count($data);
			$personnesParPage = 15;

	 		if (isset($_GET['page'])) {

	 			if ($_GET['page'] < 1 || $_GET['page'] > ceil($nb/$personnesParPage)) {
	 				echo '<script type="text/javascript">
	 						document.location.href = "imc.php"
	 					</script>';
	 			}

	 			else {

					echo '	<div class="container">
								<table>
									<caption>IMC</caption>
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

					for ($i = ($_GET['page'] - 1) * $personnesParPage; $i < $_GET['page'] * $personnesParPage; $i += 1) {
						if (isset($data[$i])) {
							$personne=$data[$i];
							$m=$personne['Poids'];
							$t=$personne['Taille']/100;
							$imc=$m/($t*$t);
							if ($imc >= 25)
								echo "<tr class='gt25'>";
							else 
								echo "<tr>";
							echo "<td>".$personne['Nom']."</td>";
							echo "<td>".$personne['Prenom']."</td>";
							echo "<td>".$personne['Email']."</td>";
							echo "<td>".$personne['Taille']."</td>";
							echo "<td>".$personne['Poids']."</td>";
							echo "<td>".round($imc,2)."</td>";
							echo "</tr>";
						}
					}

					echo '	</tbody>
						</table>
					</div>
					<div class="pagination">';

		    		$k = intval($_GET['page']);
		    		if ($k > 1) { // '<'
		    			$k -= 1;
		    			echo '<div id="pagePrev" class="page"><a href="imc.php?page=' . $k . '"> < </a></div>';
		    		}
		    		$count = 0; // les index de page
		    		for ($i = 0; $i < ceil($nb/$personnesParPage); $i += 1) {
		    			$count += 1;
		    			echo '<div id="' . $count . '" class="page"><a href="imc.php?page=' . $count . '"> ' . $count .' </a></div>';
		    		}
		    		if ($k < ceil($nb/$personnesParPage) - 1) { // '>'
			    		$k += 2;
			    		echo '<div id="pageNext" class="page"><a href="imc.php?page=' . $k . '"> > </a></div>';
			    	}
		    		echo '</div>';	
		    	}
			}

			else { //première partie de l'exercice

				echo '<table><caption>IMC</caption>';
				echo '<thead><tr><th>Nom</th><th>Prénom</th><th>Email</th><th>Taille</th><th>Poids</th><th>IMC</th></tr></thead><tbody>';

				foreach ($data as $person) {
					if (round($person['Poids'] / $person['Taille']*100 / $person['Taille']*100, 2) >= 25)
						echo '<tr class="gt25">';
					else
						echo '<tr>';
					foreach ($person as $property)
						echo '<td>' . $property . '</td>';
					echo '<td>' . round($person['Poids'] / $person['Taille']*100 / $person['Taille']*100, 2) . '</td>';
					echo '</tr>';
				}

				echo '</tbody></table>';
			}
		?>

	    <script type="text/javascript">

			gt25 = document.querySelectorAll('.gt25'); // surligner les IMC >= 25
			for ($i = 0; $i < gt25.length; $i+=1)
				gt25[$i].style.backgroundColor = '#FF0000';

			pages = document.querySelectorAll('.page'); // surligner la page sur laquelle on se trouve
			<?php
				if (isset($_GET['page'])) {
					if ($_GET['page'] == 1)
						$page = 0; // sauf pour page 1 car '<' absent
					else
						$page = $_GET['page']; // '<' décale tout de 1 donc ok
					echo 'pages[' . $page . '].style.backgroundColor = "#A9A9A9";';
				}
			?>
		</script>
	</body>
</html>