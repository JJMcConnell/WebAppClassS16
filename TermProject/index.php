<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title> Cool Lizard Collection </title>
		<link rel="stylesheet" type="text/css" href="style.css">
	
	</head>

	<body>
		
		<?php

			require('/usr/local/www/site/HW2/hw2-credentials.php');

			try{
				$conn = new PDO('mysql:host=localhost;dbname=hw2',
							$db_user, $db_pass);

				$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

				$stmt = $conn->prepare('SELECT * FROM lizards' );
				$stmt->execute(); 

		?>
			<div class="wrapper">
				<h1>Cool Lizard Collection</h1>

				<div>
					<form id="selection">

				<?php 

				foreach ($stmt as $row) 
				{
					  $id = $row ['id'];
					$path = $row['path'];
					$type = $row['type'];

				?>
					<input type="radio" name="lizard" value="<?php echo $id;?>" > 
					<?php echo $type;?>
					
				<?php 

				}
		
				?>
				
					</form>
				</div>
				
				<div class="upload">
					<h3> Have a cool lizard to add to the collection? </h3>

					<form id="fileInputForm">
						<input type="file" id="fileinput" multiple="multiple" accept="image/*" />
					</form?
				</div>
				
			</div>

			<div id="thePopup" class="popup">
				<div id="preview-panel">
						<h2>Enter descriptions for your pictures</h2>
				</div>
			
			</div>

			<?php 
				} catch (PDOException $e ){ 
					echo 'ERROR: ', $e-> getMessage();
				}
			?>

	<script src="../js/jquery-2.2.2.js"></script>	
	<script src="ajax.js"></script>	
	<script src="previews.js"></script>
	</body>
</html>