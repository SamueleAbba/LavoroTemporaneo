<?php

class Index_Model extends Model{

    function __construct(){}
    function run(){
		require 'application/controller/connettion.php';
        $sql = "SELECT id, datore_email, lavoratore_email, titolo, descrizione, tariffaOraria, occupato, scaduto, oreDiLavoro FROM lavoro";
        $result = $conn->query($sql);//dbconnect::connect()->query($sql);
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
		$result->close();
    }

}

?>