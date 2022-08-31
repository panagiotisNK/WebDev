
<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Log In | Covid Heat Maps</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css” />

</head>


<body>
	<section class="vh-100 gradient-custom bg-dark">
	<form class="container" method="post" action="login.php">
		<div class="row d-flex justify-content-center align-items-center h-100">	
		<div class="col-12 col-md-8 col-lg-6 col-xl-5">
				<div class="card bg-dark text-white" style="border-radius: 1rem;">
					<div class="card-body p-5 text-center">
						<div class="mb-md-5 mt-md-4 pb-5">
							<?php echo display_error(); ?>

							<img src="" alt="Logo">
                            <h1>Covid Heat Maps</h1>

							<br><br>

							<p class="text-white-50 mb-5">Enter your Username and Password to Log In.</p>
							<div class="form-outline form-white mb-4">
								<label class="form-label">Username</label>
								<input type="text" class="form-control form-control-lg" name="username" >
							</div>
							<div class="form-outline form-white mb-4">
								<label class="form-label">Password</label>
								<input type="password" class="form-control form-control-lg" name="password">
								<i class="bi bi-eye-slash" id="togglePassword"></i>
							</div>
							<div class="iform-outline form-white mb-4">
								<button type="submit" class="btn btn-outline-light btn-lg px-5" name="login_btn">Login</button>
							</div>
							<p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>
							<p>
							<p class="mb-0">Don't have an account? <a href="register.php" class="text-white-50 fw-bold">Sign Up</a></p>
							</p>
						</div>
					</div>
				</div>
			</div>
</div>
		</form>
	</section>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>