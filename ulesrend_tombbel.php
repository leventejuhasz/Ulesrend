<?php

	require 'db.inc.php';
	
	$osztaly=array();

	$sql = "SELECT * FROM `5/13ice`";
	$result = $conn->query($sql);
	

	if($result){
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$osztaly[$row["sor"]-1][$row["oszlop"]-1]=$row["nev"];
			}
		} else {
			echo "0 results";
		}
	}
	else{
		echo "Error in ".$sql."<br>".$conn->error;
  	}
	

	
	$en=array(1,0);
	$tanar=array(3,3);

	

	/*
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


	*/
	$hianyzok= array(
		array(0),
		array(3),
		array(1),
		array(),
	);

	$conn->close();

?>

<!doctype html>
<html lang="hu">
	<head>
		<meta charset="utf-8">
		<Title>Ülésrend</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<table>
			<tr>
				<th colspan="6">Ülésrend</th>
			</tr>
			<?php
			/*foreach($osztaly as $key => $tomb){
				foreach($tomb as $tanulo){

				}
			} */
			foreach($osztaly as $sor => $tomb){
				echo "<tr>";
				foreach($tomb as $oszlop => $tanulo){
					if($tanulo=="")
						echo "<td class='empty'>";
					else{
						echo "<td ";
						if ($sor == $en[0] && $oszlop == $en[1]) echo " id='me'";
						if($sor == $tanar[0] && $oszlop == $tanar[1]) echo " colspan='2'";
						if(in_array($oszlop,$hianyzok[$sor])) echo " class='missing'";
						echo ">";
					}
				
					echo "$tanulo</td>";
				} 
				echo "</tr>";
			}
			?>
			
		</table>
	</body>
</html>