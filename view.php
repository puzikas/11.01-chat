<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="styles.css">
<meta charset="utf-8">
<head>
	<title>Chat</title>
</head>
<body>
	<div class="container">
		<div class="row"><h1>Chat</h1></div>
		<?= $alert ?>
		<div class="row chat">
			
			<?php 

			foreach ($messages as $message) {
	echo $message['created_on'] . " "
	 . $message['name']
	 . " said: "
	 . $message['body']
	 
 	 . "<br>";
}

			?>

		</div>
		<form action="index.php" method="post">
			<div class="row fixed-bottom">
				<div class="col-4 input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Jūsų vardas</span>
					</div>
					<input type="text" class="form-control" name="username">
				</div>
				<div class="col-6 input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Žinutė</span>
					</div>
					<textarea class="form-control" name="text"></textarea>
				</div>
				<div class="col-2">
					<button type="submit" name="submit" class="btn btn-primary">Rašyti</button>
				</div>
			</div>
		</form>
		
	</div>
</body>
</html>