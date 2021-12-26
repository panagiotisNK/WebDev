<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Your Name Or Your Password</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style4.css">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <a href="#" class="navbar-brand">Covid Heat Maps</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
            <!--    <li class="nav-item">
                    <a href="usermap.php" class="nav-link">Home</a>
                    </li> -->

                    <!-- logged in user information -->
                    <li class="nav-item">
                        <img src="images/user_profile.png">
                    </li>

                    <li class="nav-item">
                        <?php  if (isset($_SESSION['user'])) : ?>
					        <strong>
                                <i style="color: white;"> <?php echo $_SESSION['user']['username']; ?>
                            </strong>

					        <small>
    		    				<i  style="color: #888;">(]<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
		    		    		<a href="usermap.php?logout='1'" style="color: red;">logout</a>
			        		</small>

		        		<?php endif ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>