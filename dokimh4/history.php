<?php include('functions.php'); 
$query = "SELECT * FROM positive WHERE userId = '".$_SESSION['user']['id']."' ORDER BY userId DESC"; 
//$q = "SELECT P " 
$result = mysqli_query($db, $query); ?>
<!DOCTYPE html>
<html>
<head>
	<title>History</title>

    <link rel="stylesheet" href="style4.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
table, th, td {
  border: 1px solid;
}
</style>
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



<div class="container" style="width:700px;" align="center"> <br><br>
		<h4 class="text-white-50">Possible encounter with Covid-19 patient in:</h4> <br>    
        <div class="table-responsive" id="positive">  
        	<table class="table table-bordered text-white">  
                <tr>  
                    <th><a class="column_sort text-white-50" id="poi" data-order="desc" href="#">Point Of Interest</a></th>
                    <th><a class="column_sort text-white-50" id="date" data-order="desc" href="#">Date</a></th>  
                   	<th><a class="column_sort text-white-50" id="time" data-order="desc" href="#">Time</a></th>   
                </tr>  
                <?php  
            	   	while($row = mysqli_fetch_array($result)){  
                ?>  
                <tr>  
                  <td><?php echo $row["positivedate"]; ?></td>
                  <td><?php echo $row["positivedate"]; ?></td>  
                	<td><?php echo $row["positivetime"]; ?></td>  
                </tr>  
                <?php  
        	    	}  
                ?>  
            </table>  
        </div>  
	</div>  

</section>

</body>
</html>