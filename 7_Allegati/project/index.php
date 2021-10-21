<body>
<header>
	<div class="header" align="center">
		<div class="topnav_left">
			<a id="Accedi" href="Accesso.php">Accedi</a>
		</div>
		<div class="topnav_center">
			<a id="Title" disabled="true"> Lavoro Temporaneo</a>
		</div>
		<div class="topnav_right">
			<a id="Registrati" href="Registrazione.php">Registrati</a>
		</div>
	</div>
</header>
<br>
<main>
	<div class="main" align="center">
		<h3>Lavori Offerti</h3>
		<?php
			require 'Connection.php';
			$sql = "SELECT id, datore_email, lavoratore_email, titolo, descrizione, tariffaOraria, occupato, scaduto, oreDiLavoro FROM lavoro";
			$result = $conn->query($sql);
			$tabella = "<table>";
			$tabella .= 
				"<tr>".
				//"<th> id </th>".
				"<th> datore </th>". //datore_email
				"<th> lavoratore </th>". //lavoratore_email
				"<th> titolo </th>".
				"<th> descrizione </th>".
				"<th> tariffaOraria </th>".
				"<th> occupato </th>".
				"<th> scaduto </th>".
				"<th> oreDiLavoro </th>".
				"</tr>"
			;
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$tabella .= 
						"<tr>".
						//"<td>".$row['id']."</td>".
						"<td>".$row['datore_email']."</td>".
						"<td>".$row['lavoratore_email']."</td>".
						"<td>".$row['titolo']."</td>".
						"<td>".$row['descrizione']."</td>".
						"<td>".$row['tariffaOraria']."</td>".
						"<td>".$row['occupato']."</td>".
						"<td>".$row['scaduto']."</td>".
						"<td>".$row['oreDiLavoro']."</td>".
						"</tr>"
					;
				}
				$tabella .= "</table>";
			} else {
				$tabella = "0 risultati";
			}
			echo $tabella;
		?>
	</div>
</main>
<style>
	body {
		margin: 0;
	}
	
	a{
		text-decoration: none;
	}
	
	.topnav_left, .topnav_center, .topnav_right{
		display: inline-block;
		padding: 16px;
		margin: 1px;
		border: 1px solid black;
	}
	.topnav_left{
		float: left;
	}
	.topnav_right{
		float: right;
	}
	
	.header{
		border: 2px solid black;
	}
	
	table, td, th {  
		border: 1px solid black;
		text-align: left;
	}
	table {
		border-collapse: collapse;
		width: 100%;
	}
	th, td {
		width: 12.5%;
		padding: 5px;
	}
</style>
</body>