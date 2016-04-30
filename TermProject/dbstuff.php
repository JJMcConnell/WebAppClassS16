<?php

	require('/usr/local/www/site/HW2/hw2-credentials.php');

	try{
		$conn = new PDO('mysql:host=localhost;dbname='lizards',
					$db_user, $db_pass );

		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		$stmt = $conn->prepare('SELECT * FROM lizards' );
		$stmt->execute(); 

		echo '<h1>Results for SELECT * </h1>';

		while ($row = $stmt->fetch() ) {
			echo '<p>';
			print_r($row);
		}

	} catch (PDOException $e ){ 
		echo 'ERROR: ', $e-> getMessage();
	}
?>

