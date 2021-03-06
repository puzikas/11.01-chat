<?php

include 'config.php';

try {
	$conn = new PDO("mysql:host=$domain;dbname=$database", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
	die();
}

$alert = null;

if (isset($_POST['submit'])) {

	if (isset($_POST['username']) && !empty($_POST['username'])) {
		
		if (isset($_POST['text']) && !empty($_POST['text'])) {

			$conn->query("INSERT INTO messages (user_id, body) VALUES ('".$_POST['username']."','".$_POST['text']."')");

		} else {

			$alert = '<div class="alert alert-warning" role="alert">
			Įveskite tekstą!</div>';
		}
	} else {

		$alert = '<div class="alert alert-warning" role="alert">
		Įveskite savo vardą!</div>';
	}
}

if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	$stmt = $conn->prepare("DELETE FROM messages WHERE id = :id");
	$stmt->execute(['id' => $_GET['delete']]);
}



$stmt = $conn->query("select messages.id, nickname, body, created_on from messages
join users ON users.id = messages.user_id
");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
			
			<?php 

			foreach ($messages as $message) {
	echo $message['created_on'] . " "
	 . $message['nickname']
	 . " said: "
	 . $message['body']
	 . " <a href='index.php?delete=" . $message['id'] . "'>X</a>"
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
