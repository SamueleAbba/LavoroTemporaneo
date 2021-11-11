<?php

// carico il file di configurazione
require 'application/config/config.php';

// carico le classi dell'applicazione
require 'application/libs/application.php';

require 'application/libs/View.php';

require 'application/libs/Controller.php';

require 'application/libs/Model.php';

require 'application/libs/Database.php';

require 'application/libs/Session.php';

// faccio partire l'applicazione
$app = new Application();
?>