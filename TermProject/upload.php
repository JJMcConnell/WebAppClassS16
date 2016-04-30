<?php

	require('/usr/local/www/site/HW2/hw2-credentials.php');
	echo $desc = $_POST['description'];

	try{
		$conn = new PDO('mysql:host=localhost;dbname=hw2',
					$db_user, $db_pass);

		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

//Resets the id counter for the DB so that it remains in order 
		$reset = $conn->prepare("ALTER TABLE lizards AUTO_INCREMENT=1");
		$reset->execute();
		

		$stmt = $conn->prepare("INSERT INTO lizards (type, path) VALUES ('$desc', '/HW2/pics/')");
		$stmt->execute();

		echo $id = $conn->lastInsertId();

	} catch (PDOException $e ){ 
		echo 'ERROR: ', $e-> getMessage();
	}


	echo print_r( $_FILES);
	echo print_r($_POST);

	if (isset($_FILES['uploaded_file'])) {
    	// Example:

	echo $newname = "pics/" . "$id" . "-" . "$desc" . ".jpg";

    	if	(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $newname)){
        	echo $_FILES['uploaded_file']['name']. " uploaded ...";

		$upt = $conn->prepare("UPDATE lizards SET path = '/HW2/$newname' WHERE id = '$id'");
		$upt->execute();
		
    	} else {
       	 echo $_FILES['uploaded_file']['name']. " NOT uploaded ...";
    	}

    	exit;
	} else {
    	echo "no";
	}

