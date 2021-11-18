<head>

	<style>
		<?php include 'style.css'; ?>
	</style>

</head>

<body>

	<header>
		<div class="header" align="center">
			<div class="topnav_left">
				<a id="Accedi" href="Accesso">Accedi</a>
			</div>
			<div class="topnav_center">
				<a id="Title" disabled="true"> Lavoro Temporaneo</a>
			</div>
			<div class="topnav_right">
				<a id="Registrati" href="Registrazione">Registrati</a>
			</div>
		</div>
	</header>

	<br>
	
	<main>
		<div class="main" align="center">
			<h3>Lavori Offerti</h3>

			
			<?php if($this->data->num_rows > 0){ ?>
				<table>
				<tr>
					<th style="display: none"> id </th>
					<th> datore </th>
					<th> lavoratore </th>
					<th> titolo </th>
					<th> descrizione </th>
					<th> tariffaOraria </th>
					<th> occupato </th>
					<th> scaduto </th>
					<th> oreDiLavoro </th>
				</tr>
				<?php while($row = $this->data->fetch_assoc()){ ?>
					<tr>
						<td style="display: none"><?php echo $row['id']; ?></td>
						<td><?php echo $row['datore_email']; ?></td>
						<td><?php echo $row['lavoratore_email']; ?></td>
						<td><?php echo $row['titolo']; ?></td>
						<td><?php echo $row['descrizione']; ?></td>
						<td><?php echo $row['tariffaOraria']; ?></td>
						<td><?php echo $row['occupato']; ?></td>
						<td><?php echo $row['scaduto']; ?></td>
						<td><?php echo $row['oreDiLavoro']; ?></td>
					</tr>
				<?php } ?>
				</table>
			<?php } else { ?>
				<?php echo "0 risultati";?>
			<?php } ?>
		</div>
	</main>

</body>