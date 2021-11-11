<head>

	<style>
		<?php include 'style.css'; ?>
	</style>

</head>

<body>

    <header>
	    <div class="header" align="center">
			<div class="topnav_left">
				<a id="Accedi">Email</a>
			</div>
			<div class="topnav_center">
			    <a id="Title" disabled="true"> Lavoro Temporaneo (datore di lavoro)</a>
    		</div>
			<div class="topnav_right">
				<a id="Registrati">Esci</a>
			</div>
	    </div>
    </header>

    <br>

    <main class="main">
	    <form method="POST">

			<div align="center">
				<div class="top_center">
					<a name="aggiungiLavoro" style="width:100%; cursor: pointer;" href="<?php echo URL."DatoriDiLavoro/aggiungiOffertaDiLavoro"?>">Aggiungi offerta di lavoro</a>
    			</div>
	    	</div>
			<div align="center">
				<div class="top_center">
					<h3 style="width:100%;">Le mie offerte di lavoro</h3>
    			</div>
			</div>
			<div align="center">
				<div class="top_center">
					<?php if ($this->data->num_rows > 0) { $i=0;?>
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
								<th> modifica </th>
								<th> elimina </th>
							</tr>
							<?php while($row = $this->data->fetch_assoc()) { ?>
							<tr><form method="post">
								<td style="display: none"><input type="text" value="<?php echo $row['id']; ?>"></td>
								<td><input type="text" value="<?php echo $row['datore_email']; ?>"></td>
								<td><input type="text" value="<?php echo $row['lavoratore_email']; ?>"></td>
								<td><input type="text" value="<?php echo $row['titolo']; ?>"></td>
								<td><input type="text" value="<?php echo $row['descrizione']; ?>"></td>
								<td><input type="text" value="<?php echo $row['tariffaOraria']; ?>"></td>
								<td><input type="text" value="<?php echo $row['occupato']; ?>"></td>
								<td><input type="text" value="<?php echo $row['scaduto']; ?>"></td>
								<td><input type="text" value="<?php echo $row['oreDiLavoro']; ?>"></td>
								<td><a href="<?php echo URL."DatoriDiLavoro/modifica/".$i?>">M</a></td>
								<td><a href="<?php echo URL."DatoriDiLavoro/elimina/".$i?>">E</a></td>
							</form></tr>
							<?php $i++; } ?>
						</table>
					<?php }else{ ?>
						<?php echo "non hai ancora pubblicato un lavoro"; ?>
					<?php } ?>
    			</div>
			</div>

	    </form>
    </main>
</body>