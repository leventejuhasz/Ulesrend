<?php
	require 'db.inc.php';
    session_start();

    if(!empty($_POST['user'])){
        $sql = "UPDATE `5/13ice`  SET felhasznalonev='" .$_POST['user'] ."' WHERE id=".$_SESSION['id'];
		$conn->query($sql);
        $_SESSION['username']=$_POST['user'];
    }
    if(!empty($_POST['pw'])){
        $sql = "UPDATE `5/13ice`  SET jelszo='" .md5($_POST['pw'])."' WHERE id=".$_SESSION['id'];
		$conn->query($sql);
    }
?>

<!doctype html>
<html lang="hu">
	<head>
		<meta charset="utf-8">
		<Title>User</title>
	</head>
	<body>
		
        <form action="user.php" method="post">
            
            Felhasználónév (<?php echo $_SESSION['username']; ?>): 
            <br><input type="text" name="user"><br>
            Jelszó:
            <br><input type="password" name="pw"><br>

            <input type="submit" value="Módosít">
        </form>
		<a href="ulesrend.php">Vissza</a>
	</body>
</html>
<?php
    $conn->close();
?>