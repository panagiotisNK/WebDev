<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Your Name Or Your Password</title>
    <link rel="stylesheet" href="style4.css">
</head>
<body>
<div class="header">
	<h2>Change Your Name Or Your Password</h2>
</div>
<form method="post" action="changes.php">
<?php echo display_error(); ?>
	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username" value="<?php echo $username; ?>">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password_1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}" 
		title="Must contain at least one number and one uppercase and lowercase letter, at least 8 or more characters and a special character" required>
	</div>
	<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="update_btn">Confirm Changes</button>
	</div>
	
</form>
</body>
</html>