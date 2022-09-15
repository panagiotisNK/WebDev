<?php 
	include('functions.php');
	$query = "SELECT * FROM positive WHERE userId = '".$_SESSION['user']['id']."' ORDER BY userId DESC";  
	$result = mysqli_query($db, $query); 
?>

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
	<div class="row d-flex justify-content-center align-items-center h-50">
		<div class="col-lg-8">
			<div class="card mb-4 bg-dark text-white">
				<div class="card-body">
				<h4 class="text-white-50">Account Information</h4> <br> 
					<div class="row">
						<div class="col-sm-3">
							<p class="mb-0">Username</p>
						</div>
						<div class="col-sm-9">
							<p class="text-muted mb-0"><?php echo $_SESSION['user']['username']; ?>
							<a class="text-white-50" href="usernamechange.php">(Edit)</a></p>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-3">
							<p class="mb-0">Email</p>
						</div>
						<div class="col-sm-9">
							<p class="text-muted mb-0"><?php echo $_SESSION['user']['email']; ?></p>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-3">
							<p class="mb-0">Password</p>
						</div>
						<div class="col-sm-9">
							<a class="text-white-50" href="passwordchange.php">Change Your Password</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container" style="width:700px;" align="center">
		<h4 class="text-white-50">I was positive in:</h4> <br>    
        <div class="table-responsive" id="positive">  
        	<table class="table table-bordered text-white">  
                <tr>  
                    <th><a class="column_sort text-white-50" id="date" data-order="desc" href="#">Date</a></th>  
                   	<th><a class="column_sort text-white-50" id="time" data-order="desc" href="#">Time</a></th>   
                </tr>  
                <?php  
            	   	while($row = mysqli_fetch_array($result)){  
                ?>  
                <tr>  
                    <td><?php echo $row["positivedate"]; ?></td>  
                	<td><?php echo $row["positivetime"]; ?></td>  
                </tr>  
                <?php  
        	    	}  
                ?>  
            </table>  
        </div>  
	</div>  
	
	
	<div class="container" style="width:700px;" align="center">
		<h4 class="text-white-50">I was positive in:</h4> <br>    
        <div class="table-responsive" id="positive">  
        	<table class="table table-bordered text-white">  
                <tr>  
                    <th><a class="column_sort text-white-50" id="date" data-order="desc" href="#">Date</a></th>  
                   	<th><a class="column_sort text-white-50" id="time" data-order="desc" href="#">Time</a></th>   
                </tr>  
                <?php  
            	   	while($row = mysqli_fetch_array($result)){  
                ?>  
                <tr>  
                    <td><?php echo $row["positivedate"]; ?></td>  
                	<td><?php echo $row["positivetime"]; ?></td>  
                </tr>  
                <?php  
        	    	}  
                ?>  
            </table>  
        </div>  
	</div>  
	<br />

</section>

</body>
</html>

<script>  
 	$(document).ready(function(){  
      	$(document).on('click', '.column_sort', function(){  
           	var column_name = $(this).attr("id");  
           	var order = $(this).data("order");  
           	var arrow = '';  
           	//glyphicon glyphicon-arrow-up  
           	//glyphicon glyphicon-arrow-down  
    		if(order == 'desc')  
        	{  
                arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-down"></span>';  
        	}  
        	else  
        	{  
                arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>';  
        	}  
        	$.ajax({  
                url:"infosort.php",  
                method:"POST",  
                data:{column_name:column_name, order:order},  
                success:function(data)  
                {  
                     $('#positive').html(data);  
                     $('#'+column_name+'').append(arrow);  
                }  
        	})  
    	});  
	});  
</script>  