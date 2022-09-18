
<?php 
include('../functions.php');
include('afunctions.php');


$visits = getVisits();
$positives = getPositiveCount();
$positivevisits = getPositiveVisits();

?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Charts | Covid Heat Maps</title>
 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>


    <style>
        .chartSize {
            width: 700px;
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
                    <a href="charts.php" class="nav-link">Statistics</a>
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


<br><br>
    <div class="container">

        <div class="chartSize">
            <canvas id="myChart"></canvas>
        </div>
        
        <br><br>

        <div class="chartSize">
            <canvas id="typeChart"></canvas>
        </div>

        <br><br>

        <div class="chartSize">
            <canvas id="positiveTypeChart"></canvas>
        </div>

        <div class="chartSize">
            <canvas id="dayChart1"></canvas>
        </div>
        <br> <br>
        <div class="chartSize">
            <canvas id="dayChart2"></canvas>
        </div>

    </div>

    <script>


        const visits = <?php echo $visits['count(*)'];?>;
        const outbreaks = <?php echo $positives['count(*)'];?>;
        const positivevisits = <?php echo $positivevisits['count(*)'];?>;

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Visits', 'Outbreaks', 'Outbreak Visits'],
                datasets: [{
                    label: '# of People',
                    data: [visits, outbreaks, positivevisits],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


    $(document).ready(function(){
        $.ajax(
        'chartselect.php',
        {
            success: function(data){
                data = JSON.parse(data);
                console.log("working");
                
                let visitCount=[];
                let pType=[];

                for(let i in data) {
                    visitCount.push(data[i].countt);
                    pType.push(data[i].poiType);
                }
                console.log(visitCount);
                var chartdata = {
                    labels: pType,
                    datasets: [
                        {
                            label: 'Visits per Type',
                            backgroundColor:
                                'rgba(75, 192, 192, 0.2)',
                            borderColor: 
                                'rgba(75, 192, 192, 1)',  
                            borderWidth: 1,
                            data: visitCount
                        }
                    ]
                };

                var ctx1 = $("#typeChart");

                var barGraph = new Chart(ctx1, {
                    type: 'bar',
                    data: chartdata
                });
            
            },

            error: function(data){
                console.log(data);
            }
        }); 
    });


    $(document).ready(function(){
        $.ajax(
        'chartselect1.php',
        {
            success: function(data){
                data = JSON.parse(data);
                console.log("working");
                
                let positiveTypeCount=[];
                let pType=[];

                for(let i in data) {
                    positiveTypeCount.push(data[i].countt);
                    pType.push(data[i].poiType);
                }
                console.log(positiveTypeCount);
                var chartdata = {
                    labels: pType,
                    datasets: [
                        {
                            label: 'Positive Visits per Type this Week',
                            backgroundColor: 
                                'rgba(54, 162, 235, 0.2)',
                            borderColor:
                                'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            data: positiveTypeCount
                        }
                    ]
                };

                var ctx2 = $("#positiveTypeChart");

                var barGraph = new Chart(ctx2, {
                    type: 'bar',
                    data: chartdata
                });
            
            },

            error: function(data){
                console.log(data);
            }
        }); 
    });

    $(document).ready(function(){
        $.ajax(
        'chartselect2.php',
        {
            success: function(data){
                data = JSON.parse(data);
                console.log("working");
                
                let visitCount=[];
                let dName=[];

                for(let i in data) {
                    visitCount.push(data[i].visitcount);
                    dName.push(data[i].dayy);
                }
                console.log(visitCount);
                var chartdata = {
                    labels: dName,
                    datasets: [
                        {
                            label: 'Visits per Day (Last 7 Days)',
                            backgroundColor: 
                                'rgba(54, 162, 235, 0.2)',
                            borderColor:
                                'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            data: visitCount
                        }
                    ]
                };

                var ctx3 = $("#dayChart1");

                var barGraph = new Chart(ctx3, {
                    type: 'bar',
                    data: chartdata
                });
            
            },

            error: function(data){
                console.log(data);
            }
        }); 
    });

    $(document).ready(function(){
        $.ajax(
        'chartselect3.php',
        {
            success: function(data){
                data = JSON.parse(data);
                console.log("working");
                
                let positiveVisitCount=[];
                let dName=[];

                for(let i in data) {
                    positiveVisitCount.push(data[i].pvcount);
                    dName.push(data[i].dayy);
                }
                console.log(positiveVisitCount);
                var chartdata = {
                    labels: dName,
                    datasets: [
                        {
                            label: 'Outburst Visits per Day (Last 7 Days)',
                            backgroundColor:
                                'rgba(75, 192, 192, 0.2)',
                            borderColor: 
                                'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            data: positiveVisitCount
                        }
                    ]
                };

                var ctx4 = $("#dayChart2");

                var barGraph = new Chart(ctx4, {
                    type: 'bar',
                    data: chartdata
                });
            
            },

            error: function(data){
                console.log(data);
            }
        }); 
    });
   



    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
</body>

</html>