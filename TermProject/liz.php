<?php

			require('/usr/local/www/site/HW2/hw2-credentials.php');

			try{
				$conn = new PDO('mysql:host=localhost;dbname=hw2',
							$db_user, $db_pass);

				$data = array();

				$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

				$stmt = $conn->prepare('SELECT * FROM lizards' );
				$stmt->execute(); 


				foreach ($stmt as $row) 
				{
					  $id = $row['id'];
					$type = $row['type'];
					$path = $row['path'];
					
					$data[] = array('path' => $path);

				}

				echo json_encode($data);

			
			} catch (PDOException $e ){ 
				echo 'ERROR: ', $e-> getMessage();
			}


		?>
