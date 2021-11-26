<head>
	<style>
		<?php include 'style.css'; ?>
	</style>
</head>
<body>
    <header>
	    <div class="header" align="center">
			<div class="topnav_left">
				<a id="Email" href="<?php echo URL."Lavoratori"?>"><?php echo $_SESSION['email']?></a>
			</div>
			<div class="topnav_center">
			    <a id="Title" disabled="true"> Lavoro Temporaneo (lavoratore)</a>
    		</div>
			<div class="topnav_right">
				<a id="Esci" href="<?php echo URL."Lavoratori/esci"?>">LogOff</a>
			</div>
	    </div>
    </header>
    <br>
    <main class="main">
			<div align="center">
				<div class="top_center">
					<h3 style="width:100%;">Le mie richieste di lavoro</h3>
    			</div>
			</div>
			<div align="center">
				<div class="top_center">
					<?php if ($this->data->num_rows > 0) { $i=0;?>
						<table>
							<tr>
								<th> data </th>
								<th> lavoro </th>
								<th> lavoratore </th>
								<th> titolo </th>
								<th> descrizione </th>
								<th> allegati </th>
								<th> modifica </th>
								<th> elimina </th>
							</tr>
							<?php while($row = $this->data->fetch_assoc()) { ?>
							<tr><form method="POST" action="<?php echo URL;?>Lavoratori/esegui/<?php echo $i;?>">
								<td><input class="disabled" readonly="true" style="width: 100%" type="text" value="<?php echo $row['data']; ?>" name='data'></td>
								<td><input class="disabled" readonly="true" style="width: 100%" type="text" value="<?php echo $row['lavoro_id']; ?>" name='lavoro_id'></td>
								<td><input class="disabled" readonly="true" style="width: 100%" type="text" value="<?php echo $row['lavoratore_email']; ?>" name='lavoratore_email'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['titolo']; ?>" name='titolo'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['descrizione']; ?>" name='descrizione'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['allegati']; ?>" name='allegati'></td>
								<td><input style="width: 100%" type='submit' value='MODIFICA RICHIESTA (<?php echo $i+1?>)' name='M'></td>
								<td><input style="width: 100%" type='submit' value='ELIMINA RICHIESTA (<?php echo $i+1?>)' name='E'></td>
							</form></tr>
							<?php $i++; } ?>
						</table>
					<?php }else{ ?>
						<?php echo "al momento non hai ancora fatto richieste per un lavoro"; ?>
					<?php } ?>
    			</div>
			</div>
			<div align="center">
				<div class="top_center">
					<h3 style="width:100%;">Vedi tutti i lavori disponibili</h3>
    			</div>
			</div>
			<div align="center">
				<div class="top_center">
					<?php if($this->allData->num_rows > 0){ $i=1;?>
						<table>
						<tr>
							<th style="display: none"> id </th>
							<th> datore </th>
							<th> lavoratore </th>
							<th> titolo </th>
							<th> descrizione </th>
							<th> tariffaOraria </th>
							<th> oreDiLavoro </th>
							<th> occupato </th>
							<th> scaduto </th>
							<th> fai una richiesta </th>
						</tr>
						<?php while($row = $this->allData->fetch_assoc()){ ?>
							<tr><form method="POST" action="<?php echo URL;?>Lavoratori/aggiungiRichiestaDiLavoro/<?php echo $row['id']?>">
								<td style="display: none"><?php echo $row['id']; ?></td>
								<td><?php echo $row['datore_email']; ?></td>
								<td><?php echo $row['lavoratore_email']; ?></td>
								<td><?php echo $row['titolo']; ?></td>
								<td><?php echo $row['descrizione']; ?></td>
								<td><?php echo $row['tariffaOraria']; ?></td>
								<td><?php echo $row['oreDiLavoro']; ?></td>
								<td><?php echo $row['occupato']; ?></td>
								<td><?php echo $row['scaduto']; ?></td>
								<td><input style="width: 100%" type='submit' value='fai una richiesta per (<?php echo $i?>)' name='F'></td>
							</form></tr>
						<?php $i++; } ?>
						</table>
					<?php } else { ?>
						<?php echo "al momento non ci sono ancora offerte di lavoro disponibili";?>
					<?php } ?>
				</div>
			</div>
    </main>
</body>