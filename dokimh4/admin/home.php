
<?php 
include('../functions.php');
include('afunctions.php');
//include('upload.php');




if(isset($_POST['update'])){
    
    $poiId=$_POST['id'];
    $poiName=$_POST['name'];
    $poiAddress=$_POST['address'];
    $poiRating=$_POST['rating'];
    $poiRaringn=$_POST['ratingn'];
    $poiCurrpop=$_POST['currpop'];
    $poiHidden=$_POST['hidden'];

    echo $poiId;

    $UpdateQuery = "UPDATE poi SET poiId='$poiId',poiName='$poiName',poiAddress='$poiAddress',poiRating='$poiRating',poiRatingn='$poiRaringn',poiCurrPop='$poiCurrpop' WHERE poiId='$poiHidden' ";
    mysqli_query($db,$UpdateQuery);
   
};
 

if(isset($_POST['delete'])){
    $poiHidden=$_POST['hidden'];

    echo $poiHidden;

    $DeleteQuery ="DELETE FROM poi WHERE poiId='$poiHidden' ";
    $DeleteQuery1 ="DELETE FROM visits WHERE poiId='$poiHidden' ";
    $DeleteQuery2 ="DELETE FROM populartimes WHERE poiId='$poiHidden' ";
    $DeleteQuery3 ="DELETE FROM poitypes WHERE poiId='$poiHidden' ";
    $DeleteQuery4 ="DELETE FROM poicoordinates WHERE poiId='$poiHidden' ";
    

    
    mysqli_query($db,$DeleteQuery1);
    mysqli_query($db,$DeleteQuery2);
    mysqli_query($db,$DeleteQuery3);
    mysqli_query($db,$DeleteQuery4);
    mysqli_query($db,$DeleteQuery);

};



$query = "SELECT * FROM poi ORDER BY poiId DESC";  
$result = mysqli_query($db, $query);  

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login4.php');
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
		    		    		<a href="login.php" class="nav-link" style="color: red;">Log Out</a>
			        		</small>

		        		<?php endif ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



	<body>
  
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
                          <form action="home.php" method="post"> 
                          <tr>  
                               <td><?php echo "<input type=text name='id' value= $row[poiId]>"; ?></td>  
                               <td><?php echo "<textarea cols=40 rows=2 name='name' >$row[poiName]</textarea>"; ?></td>  
                               <td><?php echo "<textarea cols=40 rows=2 name='address' >$row[poiAddress]</textarea>"; ?></td>    
                               <td><?php echo "<input type=text name='rating' value= $row[poiRating]>"; ?></td>  
                               <td><?php echo "<input type=text name='ratingn' value= $row[poiRatingn]>"; ?></td>  
							   <td><?php echo "<input type=text name='currpop' value= $row[poiCurrPop]>"; ?></td>   
							   <td><?php echo "<input type=hidden name='hidden' value=$row[poiId]>"; ?></td>  
							   <td> <button type="submit" name="update">Update</button> </td> 
							   <td> <button type="submit" name="delete">Delete</button> </td> 
                          </tr>  
                          </form>
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
           <br />  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>



  <span>Upload a File:</span>

  <form action="home.php" method="POST" enctype="multipart/form-data">

  <input type="file" name="uploadedFile" />
  <button type="submit" name="uploadBtn" > Upload the File</button>
</form>
  






 </body>
</html>