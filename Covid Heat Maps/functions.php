<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'pois');

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 
$poi_Id   ="";



// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: home.php');
		}else{
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: usermap.php');				
		}
	}
}

// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}


// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: admin/home.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: usermap.php');
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}



/*function visitBtnHandler(){
	global $poi_Id;
	//$poi_Id =$_POST['variable'];
    addVisit();

}*/
//$poi_Id = $_POST['variable'];



/*function visitBtnHandler(){
	global $poi_Id;
	//$isset=isset($_POST['variable']);
	//echo $isset;
	if (isset($_POST['variable'])){
		echo 'im working';
	$poi_Id =$_POST['variable'];
    addVisit();
	
	}
	//addVisit();
}*/

/*if (isset($_POST['variable'])){
	global $poi_Id;
	$poi_Id = $_POST['variable'];
	var_dump( $_POST);
	}*/

if (isset($_POST['visit_btn'])) {
    addVisit();
}


function addVisit(){

   /* $.post('post_visit.php', { field1: poiId, field2 :userId , field3:new Date()});*/
   //var_dump( $_POST);

   // call these variables with the global keyword to make them available in function
   global $db, $errors,$poi_Id;

   	$poi_Name = $_POST['poiname'];
	$poi_Estimate = $_POST['poiestimate'];

    $sql = "SELECT id FROM users WHERE username='".$_SESSION['user']['username']."' LIMIT 1";
    $q = "SELECT poiId FROM poi WHERE poiName='".$poi_Name."' LIMIT 1 ";


    $results = mysqli_query($db, $sql);
	$results2 = mysqli_query($db, $q);

    $logged_in_user_id = mysqli_fetch_assoc($results);
	$current_user_id = $logged_in_user_id["id"];

	$poi_Ident = mysqli_fetch_assoc($results2);
	$poi_Id = $poi_Ident["poiId"];

	$visitstamp = date("y-m-d");
	
	$visittime = date("H:i:s");
	//echo $visittime;
    // receive all input values from the form. Call the e() function
    // defined below to escape form values
    //$date = e($_POST['currentdate']);
	//$poi_Id = $_POST['poiname'];
	
	//echo "user id= ".$logged_in_user_id["id"]."";
//echo "im working";

	
    //echo "user id= ".$logged_in_user_id["id"]."";
    
    //$query = "INSERT INTO visits (userId,poiId) VALUES('$current_user_id','".$_POST["variable"]."')";
	$query = "INSERT INTO visits (poiId,userId,visitEstimate,visitDate,visitTime) VALUES('$poi_Id','$current_user_id','$poi_Estimate','$visitstamp','$visittime')";
    mysqli_query($db, $query);

//echo "im working";
//echo $poi_Id;
}


//update username
if (isset($_POST['updatename_btn'])) {
	updateName();
}

function updateName(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $email, $username;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username  =  e($_POST['username']);
	$email  =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if($email != $_SESSION['user']['email']){
		array_push($errors, "Email address not verified");
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	$password = md5($password_1);//encrypt the password before saving in the database
	if ($password != $_SESSION['user']['password']) {
		array_push($errors, "Incorrect password");	
	}
	// update user if there are no errors in the form
	if (count($errors) == 0){
		$query = "UPDATE users SET users.username = '$username' WHERE email = '$email'";
		mysqli_query($db, $query);
		//logout to see the changed info	
		session_destroy();
		unset($_SESSION['user']);
		header("location: login.php");
	}
}




//update password
if (isset($_POST['updatepass_btn'])) {
	updatePass();
}

function updatePass(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$email  =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if($email != $_SESSION['user']['email']){
		array_push($errors, "Email address not verified");
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// update user if there are no errors in the form
	if (count($errors) == 0){
		$password = md5($password_1);//encrypt the password before saving in the database
		$query = "UPDATE users SET users.password = '$password' WHERE email = '$email'";
		mysqli_query($db, $query);				
		
	}
}

   
               

             

         



if (isset($_POST['positive_btn'])) {
	addpositive();
}

function addpositive(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $date, $positivetime, $username, $current_user_id;


	$sql= "SELECT id FROM users WHERE username='".$_SESSION['user']['username']."' LIMIT 1";

	$results = mysqli_query($db, $sql);
	$logged_in_user_id = mysqli_fetch_assoc($results);
	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$date = e($_POST['positivedate']);
	$positivetime = e($_POST['positivetime']);

	$current_user_id = $logged_in_user_id["id"];
	

	// form validation: ensure that the form is correctly filled
	if (empty($date)) { 
		array_push($errors, "Date is required"); 
	}

	if (empty($positivetime)) { 
		array_push($errors, "Time is required"); 
	}
	

	// insert in table there are no errors in the form
	if (count($errors) == 0) {
		
		$query = "INSERT INTO positive (userId, positivedate, positivetime)
				  VALUES('$current_user_id', '$date', '$positivetime')";
		mysqli_query($db, $query);
					
	}
}

