<?php
	require 'db.inc.php'; 

    $osztaly = array(
		array("Kulhanek László István"),
		array("Molnár Gergő Máté","Bakcsányi Dominik","Füstös Loránt","Orosz Zsolt","Harsányi László Ferenc",null),
		array("Kereszturi Kevin","Juhász Levente","Szabó László","Sütő Dániel","Détári Klaudia",null),
		array("Fazekas Miklós Adrián",null,"Gombos János","Bicsák József"),
	);

	
	foreach($osztaly as $oSor => $tomb){
		foreach($tomb as $oOszlop => $tanulo){
			$sql = "INSERT INTO `5/13ice` (nev, sor, oszlop) VALUES (' $tanulo ' ,  ($oSor+1) ,  ($oOszlop+1) )";

			if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
			} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			}
	
		}
	}
?>