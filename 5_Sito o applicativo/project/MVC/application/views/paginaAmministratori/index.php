<head>

	<style>
		<?php include 'style.css'; ?>
	</style>

</head>

<body>

    <header>
	    <div class="header" align="center">
			<div class="topnav_left">
				<a id="Email" href="<?php echo URL."Amministratori"?>"><?php echo $_SESSION['email']?></a>
			</div>
			<div class="topnav_center">
			    <a id="Title" disabled="true"> Lavoro Temporaneo (amministratore)</a>
    		</div>
			<div class="topnav_right">
				<a id="Esci" href="<?php echo URL."Amministratori/esci"?>">LogOff</a>
			</div>
	    </div>
    </header>

    <br>

    <main class="main">
			<div align="center">
				<div class="top_center">
					<button name="visualizzaFattura" style="width:100%; cursor: pointer;" 
					onclick="document.location='<?php echo URL.'Amministratori/creaFattura'?>'">Crea fattura</button>
    			</div>
	    	</div>
			<div align="center">
				<div class="top_centerFilter">
					<form method="POST" action="<?php echo URL;?>Amministratori">
						<button name="filtroLavoriOccupati" style="float:left; width:33.3%; cursor:pointer;">Mostra lavori occupati</button>
						<button name="filtroLavoriScaduti" style="float:left; width:33.3%; cursor:pointer;">Mostra lavori scaduti</button>
						<button name="filtroLavoriTutti" style="float:left; width:33.3%; cursor:pointer;">Mostra tutti i lavori</button>
					</form>
    			</div>
	    	</div>
			<div align="center">
				<div class="top_center">
					<h3 style="width:100%;">Lavori offerti</h3>
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
							<tr><form method="POST" action="<?php echo URL;?>Amministratori/esegui/<?php echo $i;?>">
								<td style="display: none"><input style="width: 100%" type="text" value="<?php echo $row['id']; ?>" name='id'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['datore_email']; ?>" name='datore_email'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['lavoratore_email']; ?>" name='lavoratore_email'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['titolo']; ?>" name='titolo'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['descrizione']; ?>" name='descrizione'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['tariffaOraria']; ?>" name='tariffaOraria'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['occupato']; ?>" name='occupato'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['scaduto']; ?>" name='scaduto'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['oreDiLavoro']; ?>" name='oreDiLavoro'></td>
								<td><input style="width: 100%" type='submit' value='MODIFICA LAVORO (<?php echo $i+1?>)' name='M'></td>
								<td><input style="width: 100%" type='submit' value='ELIMINA LAVORO (<?php echo $i+1?>)' name='E'></td>
							</form></tr>
							<?php $i++; } ?>
						</table>
					<?php }else{ ?>
						<?php echo "non ci sono ancora lavori con queste condizioni"; ?>
					<?php } ?>
    			</div>
			</div>
    </main>
</body>