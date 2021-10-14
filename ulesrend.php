<?php
	require 'db.inc.php';
	session_start();

	$tanar=array(3,3);

	function getStudents($conn){
		$sql = "SELECT * FROM `5/13ice`";
		$result = $conn->query($sql);
		return $result;
	}

	function getIds($conn,$table){
		$sql = "SELECT * FROM ".$table;
		$result = $conn->query($sql);	
		$array=array();

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($array,$row["id"]);
			}
		}
		return $array;
	}


	$admins= getIds($conn,"admins");

	//form feldolgozása
	if(!empty($_POST['hianyzo_id'])){
		$sql = "INSERT INTO `hianyzok` (id) VALUES (" .$_POST['hianyzo_id'] .")";
		$conn->query($sql);
	}
	elseif(!empty($_GET["nem_hianyzo"])){
		$sql = "DELETE FROM `hianyzok` Where id=".$_GET["nem_hianyzo"];
		$result = $conn->query($sql);
	}
	elseif(isset($_POST['pw']) and isset($_POST['user'])) {
		$loginError='';
		if(strlen($_POST['user']) == 0) {
			$loginError.=" Nem írtál be felhasználónevet!";
		}
		if(strlen($_POST['pw']) == 0) {
			$loginError.=" Nem írtál be jelszót!";
		}
		if($loginError == ''){
			$sql = "SELECT * FROM `5/13ice` WHERE felhasznalonev='".$_POST['user']."'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				if($row = $result->fetch_assoc()){
					if(md5($_POST['pw'])==$row['jelszo']){
						$_SESSION["id"]=$row['id'];
						$_SESSION["nev"]=$row['nev'];
						$_SESSION["username"]=$row['felhasznalonev'];
						if(in_array($row['id'],$admins)){
							$_SESSION["admin"]=1;
						}else{
							$_SESSION["admin"]=0;
						}

						$loginError="Sikeres bejelentkezés";
					}
					else{
						$loginError="Hibás jelszó!<br>";
					}				
				}
			}
			else{
				$loginError="Nincs ilyen felhasználónév!<br>";
			}
		}
	}
	elseif(isset($_POST['logout'] )){
		session_unset();
	}
	
	$hianyzok= getIds($conn,"hianyzok");

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
				<th colspan="3">
					<?php
					if (!empty($_SESSION["id"])){
						echo 'Üdv '.$_SESSION['nev']."!";
						echo '<form action="ulesrend.php" method="post">
							<input type="submit" value="Kilépés" name="logout">
							</form>';
					}
					else{
						if(isset($_POST['user'])){
							echo "<br>".$loginError;
						}
						else echo 'Belépés';
						
					
					?>
					<form action="ulesrend.php" method="post">
						Felhasználó:<input type="text" name="user"><br>
						Jelszó:<input type="password" name="pw"><br>
						<input type="submit">
					</form>
					<?php } ?>
				</th>
				<th colspan="3">Ülésrend
				<?php if(!empty($_SESSION['id']) and $_SESSION['admin']==1){ ?>
					<form action="ulesrend.php" method="post">
						Hiányzó: <select name="hianyzo_id">
								<?php
								$result=getStudents($conn);
								if ($result->num_rows > 0) {
									
									while($row = $result->fetch_assoc()) {
										if($row["nev"] and !in_array($row["id"],$hianyzok)){
											echo '<option value='.$row["id"].'>'.$row["nev"].'</option>';
										}
									}
								}
								?>
							</select><br>
						<input type="submit">
					</form>	
				<?php } ?>
				</th>
			</tr>
			<?php
				$result=getStudents($conn);
				if ($result->num_rows > 0) {
					$sor=0;
					while($row = $result->fetch_assoc()) {
						if($row["sor"] != $sor){
							if($sor != 0){
								echo '</tr>';
							}
							echo '<tr>';
							$sor = $row["sor"];
						}
						$plusz='';
						if(!$row["nev"])
							$plusz.= " class='empty'";
						else{
							if (!empty($_SESSION['id']) and $row['id'] == $_SESSION['id']) $plusz.= ' id="me"';
							if($sor-1 == $tanar[0] && $row["oszlop"]-1 == $tanar[1]) $plusz.=  ' colspan="2"';
							if(in_array($row["id"],$hianyzok)) $plusz.=  ' class="missing"';
							
						}
						if(!empty($_SESSION['id']) and $row['id']==$_SESSION['id']){
							echo "<td".$plusz." ><a href='user.php'>".$row["nev"]."</a>";
						}else{
							echo "<td".$plusz." >".$row["nev"];
						}
						if(!empty($_SESSION['id']) and $_SESSION['admin'] == 1 and in_array($row["id"],$hianyzok)) echo '<br><a href="ulesrend.php?nem_hianyzo='.$row["id"].'">Nem hiányzó</a>';
						echo "</td>";
					}
				} else {
					echo "0 results";
				}

				$conn->close();
			?>
		</table>
		
	</body>
</html>