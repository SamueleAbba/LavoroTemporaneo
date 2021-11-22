<head>

	<style>
		<?php include 'style.css'; ?>
	</style>

</head>

<body>

	<header>
		<div class="header" align="center">
			<div class="topnav_left">
				<a id="Email" href="<?php echo URL."DatoriDiLavoro"?>"><?php echo $_SESSION['email']?></a>
			</div>
			<div class="topnav_center">
				<a id="Title" disabled="true"> Lavoro Temporaneo - aggiungi offerta di lavoro</a>
			</div>
			<div class="topnav_right">
				<a id="Esci" href="<?php echo URL."DatoriDiLavoro/esci"?>">LogOff</a>
			</div>
		</div>
	</header>

    <br>

    <main>
		<form method="POST" action='<?php echo URL."DatoriDiLavoro/aggiungi"?>'>

			<label>Email</label><br>
			<input class="disabled" name="email" type="email" size="50" value="<?php echo $_SESSION['email']?>" readonly="true">
			<br>

			<label>Titolo</label><br>
			<input name="titolo" type="text" size="50" value="Titolo di default">
			<br>

			<label>Descrizione</label><br>
			<input name="descrizione" type="textarea" size="50" value="Descrizione di default">
			<br>

			<label>TariffaOraria</label><br>
			<input name="tariffaOraria" type="number" size="50" value="0" min="0" max="100">
			<br>

			<label>OreDiLavoro</label><br>
			<input name="oreDiLavoro" type="number" size="50" value="0" min="0" max="100">
			<br>

			<br>

			<input name="conferma" type="submit" value="Conferma">
		</form>
	</main>
</body>