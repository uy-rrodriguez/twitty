<?php
	//require_once("../fonctions.php");
	
	/* *** CHECK DE LOGIN *** */
	function check($conn, $login, $password) {
		$sql = "SELECT * FROM personnes WHERE login = ? AND password = ?";
		
		$stm = $conn->prepare($sql);

		if ($stm->execute(array($login, $password))) {
			$p = $stm->fetchAll();
			$stm->closeCursor();
			
			if (count($p) > 0)
				return $p[0];
			else
				return NULL;
		}
		else {
			$info = $stm->errorInfo();
			$stm->closeCursor();
			print_r($info);
			throw new Exception("Il y a eu une erreur pour obtenir la personne.");
		}
	}
	
	
	//$personne = new Personne();
	$login = $_POST["login"];
	$password = $_POST["password"];
	$seSouvenir = isset($_POST["seSouvenir"]);
	
	try {
		// Connection à la BD
		//$conn = connecterBD();
		$conn = new PDO("pgsql:host=localhost;dbname=L3", "uapv1601663", "uML5i/");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// On liste les personnes
		$p = check($conn, $login, $password);
		
		//deconnecterBD($conn);
		
		if ($p == NULL)
			echo "<script>window.location.replace('../index.php?erreurLogin=1');</script>";
		
		else {
			$vie = 0;
			if ($seSouvenir)
				$vie = time()+86400*30;
			
			setcookie("INTERNET_L3_LOGIN", $p["id"].":".$password.":".$seSouvenir, $vie);
			
			$idPersonne = $p["id"];
		}
	}
	catch (Exception $e) {
		die("Error: " . $e->getMessage() . "<br/>");
	}
?>