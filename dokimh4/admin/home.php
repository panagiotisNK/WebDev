
<?php 
include('../functions.php');


if(isset($POST['update'])){
    $UpdateQuery = "UPDATE poi SET poiId='$_POST[id]',poiName='$_POST[name]',poiAddress='$_POST[address]',poiRating='$_POST[rating]',poiRatingn='$_POST[ratingn]',poiCurrPop='$_POST[currpop]' WHERE poiId='$_POST[hidden]'";
    mysqli_query($db, $UpdateQuery);
};
 

if(isset($POST['delete'])){
    $DeleteQuery ="DELETE FROM poi WHERE  poiId='$_POST[hidden]' ";
    mysqli_query($db, $DeleteQuery);
};



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
	<title>Home | Covid Heat Maps</title>
 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
	<link rel="stylesheet" type="text/css" href="../style4.css">
	<style>
	.header {
		background: #003366;
	}
	button[name=register_btn] {
		background: #003366;
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



	<br />            
           <div class="container" style="width:700px;" allign="center">  
               
                <div  id="pois">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th><a class="column_sort" id="id" data-order="desc" href="#">ID</a></th>  
                               <th><a class="column_sort" id="name" data-order="desc" href="#">Name</a></th>  
                               <th><a class="column_sort" id="address" data-order="desc" href="#">Address</a></th>  
                               <th><a class="column_sort" id="rating" data-order="desc" href="#">Rating</a></th>  
                               <th><a class="column_sort" id="ratingn" data-order="desc" href="#">Ratingn</a></th>
							   <th><a class="column_sort" id="currpop" data-order="desc" href="#">CurrentPop</a></th>  
						

							  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                          ?>  
                          <form action=home.php method=post> 
                          <tr>  
                               <td><?php echo "<input type=text name=id value= $row[poiId]>"; ?></td>  
                               <td><?php echo "<textarea cols=40 rows=2 name=name >$row[poiName]</textarea>"; ?></td>  
                               <td><?php echo "<textarea cols=40 rows=2 name=address >$row[poiAddress]</textarea>"; ?></td>    
                               <td><?php echo "<input type=text name=rating value= $row[poiRating]>"; ?></td>  
                               <td><?php echo "<input type=text name=ratingn value= $row[poiRatingn]>"; ?></td>  
							   <td><?php echo "<input type=text name=currpop value= $row[poiCurrPop]>"; ?></td>   
							   <td><?php echo "<input type=hidden name=hidden value=$row[poiId]"; ?></td>  
							   <td> <input type=submit name=update value='update'> </td> 
							   <td> <input type=submit name=delete value='delete'> </td> 
                          </tr>  
                          </form>
                          <?php  
                          }  mysqli_close($db);
                          ?>  
                     </table>  
                </div>  
           </div>  


           <br />  
	

           
           <div class="content">
               <h2>Upload File</h2>
               <div>
               <form method="POST" action="upload.php" enctype="multipart/form-data">

<div>

  <span>Upload a File:</span>

  <input type="file" name="uploadedFile" />

</div>

<input type="submit" name="uploadBtn" value="Upload the File" />

</form>

                         </div> 
                         </div>      


                         </body>
</html>