<!DOCTYPE html>
<html>

<head>
	<title>Form Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css">
	<style>
		body {
			background: linear-gradient(to right, #d194d3, #3e093f);
		}
	</style>
</head>

<body>
	<div id="wrapper">
		<form class="login" action="ceklogin.php" method="POST">
			<h1>Login</h1>
			<label>Username</label>
			<input type="text" name="username" placeholder="masukkan username" required="" autofocus="">
			<label>Password </label>
			<input type="password" name="password" placeholder="masukkan password" required="">
			<button type="submit" name="login">SUBMIT</button>
		</form>
		<!-- Menampung jika ada pesan -->
		<?php if (isset($_GET['pesan'])) {  ?>
			<label><?php echo $_GET['pesan']; ?></label>
		<?php } ?>
	</div>
</body>

</html>