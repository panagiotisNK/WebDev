<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>I'm positive!</title>
    <link rel="stylesheet" href="style4.css">
</head>
<body>

<h1>Show a Date and Time Control</h1>


  <form method="post" action="positive.php">
<?php echo display_error(); ?>
	<div class="input-group">
		<label for="birthdaytime">Birthday (date and time):</label>
  <input type="datetime-local" id="visitime" name="birthdaytime">
  <div class="input-group">
		<button type="submit" class="btn" name="update_btn">Submit</button>
	</div>
	</div>
</form>

</body>
</html>