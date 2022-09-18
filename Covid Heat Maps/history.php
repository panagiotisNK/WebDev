


<!DOCTYPE html>
<html>
<head>
	<title>History</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
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



<div class="container" style="width:1000px;" align="center"> <br><br>
		<h4 class="text-white-50">Possible encounter with Covid-19 patient in:</h4> <br>    
        <div>  

        <table class="table table-bordered table-sm" >
         <thead class="column_sort text-white-50">
            <tr>
                <th>Store</th>
                <th>Visit Date</th>
                <th>Visit Time</th>
                <th>Contact(s)</th>                                               
            </tr>
         </thead>
         <tbody class="column_sort text-white-50" id="tableBody">
           
         </tbody>
        </table> 

        </div>  

	</div>  

</section>

</body>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

const table = document.getElementById("tableBody");

$.ajax(
  'post_positive.php', 
{
    success: function(data){
    data = JSON.parse(data);
        
    for(let i in data) {
        let poiName=data[i].poiName;
        let visitDate=data[i].visitDate;
        let visitTime=data[i].visitTime;
        let contacts=data[i].poiId;
   console.log(poiName);
   console.log(visitDate);
   console.log(visitTime);
   console.log(contacts);

   let row = table.insertRow();
   
   let name = row.insertCell(0);
   name.innerHTML = poiName;
   let date = row.insertCell(1);
   date.innerHTML = visitDate;
   let time = row.insertCell(2);
   time.innerHTML = visitTime;
   let con = row.insertCell(3);
   con.innerHTML = contacts;

    }
    }
}
    );

</script>