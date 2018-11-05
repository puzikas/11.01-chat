<?php

$alert = null;

$myFile = fopen("log.txt", "a+") or die("Unable to open file!");			

if (isset($_POST['submit'])) {

	if (isset($_POST['username']) && !empty($_POST['username'])) {
		
		if (isset($_POST['text']) && !empty($_POST['text'])) {

			$txt = date("Y/m/d H:i:s@# ") . "IP:" . $_SERVER['REMOTE_ADDR'] . "@# " . $_POST['username'] . "@# " . $_POST['text'] . "\n";
			fwrite($myFile, $txt);

		} else {

			$alert = '<div class="alert alert-warning" role="alert">
			Įveskite tekstą!</div>';
		}
	} else {

		$alert = '<div class="alert alert-warning" role="alert">
		Įveskite savo vardą!</div>';
	}
}

$chats = [];

while(!feof($myFile)) {
	$chats[] = fgets($myFile);
}
fclose($myFile);



?>


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
		<pre>
			<?php 
			print_r(explode('@#', $chats));
			// print_r(file("log.txt"));
			// while(!feof($myFile)) {
			// 	echo fgets($myFile) . "<br>";
			// }
			// fclose($myFile);
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
					<button class="btn btn-primary" type="submit" name="submit">Rašyti</button>
				</div>
			</div>
		</form>
		
	</div>
</body>
</html>