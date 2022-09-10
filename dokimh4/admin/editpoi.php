<?php 
include('../functions.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Point | Covid Heat Maps</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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


    <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Point</h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['poiId'])){
                            $poiId = mysqli_real_escape_string($db, $_GET['poiId']);
                            $query = "SELECT * FROM poi WHERE poiId='$poiId' ";
                            $query_run = mysqli_query($db, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $poi = mysqli_fetch_array($query_run);
                                ?>
                                <form action="home.php" method="POST">
                                    <input type="hidden" name="poi_id" value="<?= $poi['poiId']; ?>">

                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name" value="<?=$poi['poiName'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Address</label>
                                        <input type="text" name="address" value="<?=$poi['poiAddress'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Rating</label>
                                        <input type="text" name="rating" value="<?=$poi['poiRating'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Ratingn</label>
                                        <input type="text" name="ratingn" value="<?=$poi['poiRatingn'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Current Popularity</label>
                                        <input type="text" name="currpop" value="<?=$poi['poiCurrPop'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="updatepoi_btn" class="btn btn-primary">Update</button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>