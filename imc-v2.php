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
	<div class="container">

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
			<tbody>
				<form method="get" action="imc-v2.php">
					<input type="hidden" name="page" value="1">
				</form>

				<?php
					$nb=count($data);
					$personnesParPage = 15;

					for ($i = ($_GET['page'] - 1) * $personnesParPage; $i < $_GET['page'] * $personnesParPage; $i += 1) {
						$personne=$data[$i];
						$m=$personne['Poids'];
						$t=$personne['Taille']/100;
						$imc=$m/($t*$t);
						$class="";
						if ($imc >= 25) $class="error";
						if ($imc <= 18) $class="warning";
						echo "<tr class=\"$class\">";
						echo "<td>".$personne['Nom']."</td>";
						echo "<td>".$personne['Prenom']."</td>";
						echo "<td>".$personne['Email']."</td>";
						echo "<td>".$personne['Taille']."</td>";
						echo "<td>".$personne['Poids']."</td>";
						echo "<td>".round($imc,2)."</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>

	    <div class="pagination">
	    	<?php 
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
	    	?>
	    </div>

	</div>
</body>
</html>