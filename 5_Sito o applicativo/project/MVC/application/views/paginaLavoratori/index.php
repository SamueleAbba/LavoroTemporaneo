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
					<form method="POST" action="<?php echo URL;?>Lavoratori/aggiungiRichiestaDiLavoro">
						<button name="aggiungiRichiestaLavoro" style="width:100%; cursor: pointer;">Aggiungi richiesta di lavoro</button>
					</form>
    			</div>
	    	</div>
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
								<th> lavoro_id </th>
								<th> lavoratore_email </th>
								<th> titolo </th>
								<th> descrizione </th>
								<th> allegati </th>
							</tr>
							<?php while($row = $this->data->fetch_assoc()) { ?>
							<tr><form method="POST" action="<?php echo URL;?>Lavoratori/esegui/<?php echo $i;?>">
								<td><input style="width: 100%" type="text" value="<?php echo $row['data']; ?>" name='data'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['lavoro_id']; ?>" name='lavoro_id'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['lavoratore_email']; ?>" name='lavoratore_email'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['titolo']; ?>" name='titolo'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['descrizione']; ?>" name='descrizione'></td>
								<td><input style="width: 100%" type="text" value="<?php echo $row['allegati']; ?>" name='allegati'></td>
								<td><input style="width: 100%" type='submit' value='MODIFICA RICHIESTA (<?php echo $i+1?>)' name='M'></td>
								<td><input style="width: 100%" type='submit' value='ELIMINA RICHIESTA (<?php echo $i+1?>)' name='E'></td>
							</form></tr>
							<?php $i++; } ?>
						</table>
					<?php }else{ ?>
						<?php echo "non hai ancora accettato un lavoro"; ?>
					<?php } ?>
    			</div>
			</div>
    </main>
</body>