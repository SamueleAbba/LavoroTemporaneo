<head>

	<style>
		<?php include 'style.css'; ?>
	</style>

</head>

<body>

    <header>
	    <div class="header" align="center">
		    <div class="topnav_center">
			    <a id="Title" disabled="true"> Lavoro Temporaneo - form di registrazione</a>
    		</div>
	    </div>
    </header>

    <br>

    <main>
	    <form method="POST" action='<?php echo URL."Registrazione/test"?>'>
		    <!--<span class="error" style="color:red">* campi obbligatori</span><br>-->

	    	<label>Email</label><br>
		    <input name="email" type="email" size="50">
	    	<!--<span class="error" style="color:red">* <?php echo $emailError; ?></span>-->
	    	<br>
	
	    	<label>Password</label><br>
	    	<input name="password" type="password" size="50">
	    	<!--<span class="error" style="color:red">* <?php echo $passwordError; ?></span>-->
	    	<br>
		
	    	<label for="ruolo">Ruolo</label><br>
	    	<select name="ruolo" style="width:330px">
	    		<option value="lavoratore">Lavoratore</option>
	    	    <option value="datore">Datore</option>
	     	</select><!--<span class="error" style="color:red"> * <?php echo $ruoloError; ?></span><br>-->
			 <br>

			 <p>Hai già un account? <a href="<?php echo URL."Registrazione/reRender"?>">Accedi</a></p>
			 
		    <input name="conferma" type="submit" value="Conferma">
	    </form>
    </main>
</body>