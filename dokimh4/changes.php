<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Your Name Or Your Password</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
	
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <a href="#" class="navbar-brand">Covid Heat Maps</a>
            
            <div class="collapse navbar-collapse">
				<ul class="navbar-nav">
					<li class="nav-item">
                    	<a href="usermap.php" class="nav-link">Home</a>
                    </li> 
					<li class="nav-item">
                    	<a href="changes.php" class="nav-link">Change Your Profile</a>
                    </li> 
                    <li class="nav-item">
                    	<a href="positive.php" class="nav-link">I'm positive!</a>
                    </li>
                    <li class="nav-item">
                    	<a href="history.php" class="nav-link">My History</a>
                    </li>
				</ul>

				<!-- logged in user information -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <?php  if (isset($_SESSION['user'])) : ?>
					        <strong>
                                <i style="color: white;"> <?php echo $_SESSION['user']['username']; ?> </i>
                            </strong>

    		    			<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>) </i> 
			        
		        		<?php endif ?>
                    </li>

                    <li class="nav-item"> 
                            <a href="usermap.php?logout='1'" style="color: red;"> Log Out </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

	<section class="vh-100 gradient-custom bg-dark">
		<form class="container" method="post" action="changes.php">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-12 col-md-8 col-lg-6 col-xl-5">
					<div class="card bg-dark text-white" style="border-radius: 1rem;">
						<div class="card-body p-5 text-center">	
							<div class="mb-md-5 mt-md-4 pb-5">
								<?php echo display_error(); ?>

								<h4 class="text-white-50 mb-5"> Change your account information </h4>

								<div class="form-outline form-white mb-4">
									<label class="form-label">Username</label>
									<input type="text" name="username" class="form-control form-control-lg" value="<?php echo $username; ?>">
								</div>
								<div class="form-outline form-white mb-4">
									<label class="form-label">Password</label>
									<input type="password" name="password_1" class="form-control form-control-lg" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}" 
									title="Must contain at least one number and one uppercase and lowercase letter, at least 8 or more characters and a special character" required>
								</div>
								<div class="form-outline form-white mb-4">
									<label class="form-label">Confirm password</label>
									<input type="password" name="password_2" class="form-control form-control-lg">
								</div>
								<br>
								<div class="form-outline form-white mb-4">
									<button type="submit" class="btn btn-outline-light btn-lg px-5" name="update_btn">Confirm Changes</button>
								</div>
							</div>	
						</div>	
					</div>
				</div>
			</div>
		</form>
</section>


</body>
</html>