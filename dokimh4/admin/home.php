
<?php 
include('../functions.php');


$query = "SELECT * FROM poi ORDER BY poiId DESC";  
$result = mysqli_query($db, $query);  


if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login4.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");



     if (isset($_SESSION['message']) && $_SESSION['message'])
     {
       printf('<b>%s</b>', $_SESSION['message']);
       unset($_SESSION['message']);
     }

    }
    
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Home | Covid Heat Maps</title>
 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <a href="#" class="navbar-brand">Covid Heat Maps</a>
            <div class="collapse navbar-collapse">
				<ul class="navbar-nav">
					<li class="nav-item">
                    	<a href="home.php" class="nav-link">Home</a>
                    </li> 
					<li class="nav-item">
                    <a href="create_user.php" class="nav-link">Create User</a>
                    </li> 
				</ul>

				<!-- logged in user information -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <?php  if (isset($_SESSION['user'])) : ?>
					        <strong>
                                <i style="color: white;"> <?php echo $_SESSION['user']['username']; ?>
                            </strong>

					        <small>
    		    				<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
		    		    		<a href="home.php?logout='1'" style="color: red;">Log Out</a>
			        		</small>

		        		<?php endif ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



	<body>
  
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Points of Interest Table</h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Rating</th>
                                    <th>Ratingn</th>
                                    <th>Current Popularity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM poi";
                                    $query_run = mysqli_query($db, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $poi)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $poi['poiId']; ?></td>
                                                <td><?= $poi['poiName']; ?></td>
                                                <td><?= $poi['poiAddress']; ?></td>
                                                <td><?= $poi['poiRating']; ?></td>
                                                <td><?= $poi['poiRatingn']; ?></td>
                                                <td><?= $poi['poiCurrPop']; ?></td>
                                                <td>
                                                    <a href="editpoi.php?id=<?= $poi['poiId']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <form action="functions.php" method="POST" class="d-inline">
                                                        <button type="submit" name="deletepoi_btn" value="<?=$poi['poiId'];?>" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>



  <span>Upload a File:</span>

  <input type="file" name="uploadedFile" />

</div>

<input type="submit" name="uploadBtn" value="Upload the File" />


                         </body>
</html>