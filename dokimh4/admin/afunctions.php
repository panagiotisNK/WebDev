<?php


include('message.php');

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'pois');

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 
$poi_Id   ="";


if(isset($_POST['deletepoi_btn']))
{
    $poiId = mysqli_real_escape_string($db, $_POST['delete']);

    $query = "DELETE FROM poi WHERE poiId='$poiId' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Point Deleted Successfully";
        header("Location: home.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Point Not Deleted";
        header("Location: home.php");
        exit(0);
    }
}


if(isset($_POST['updatepoi_btn']))
{
    $poiId = mysqli_real_escape_string($db, $_POST['poiId']);

    $poiName = mysqli_real_escape_string($db, $_POST['poiName']);
    $poiAddress = mysqli_real_escape_string($db, $_POST['poiAddress']);
    $poiRating = mysqli_real_escape_string($db, $_POST['poiRating']);
    $poiRatingn = mysqli_real_escape_string($db, $_POST['poiRatingn']);
	$poiCurrPop = mysqli_real_escape_string($db, $_POST['poiCurrPop']);

    $query = "UPDATE poi SET poiName='$poiName', poiAddress='$poiAddress', poiRating='$poiRating', poiRatingn='$poiRatingn', poiCurrPop = '$poiCurrPop' WHERE poiId='$poiId' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Point Updated Successfully";
        header("Location: home.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Point Not Updated";
        header("Location: home.php");
        exit(0);
    }

}


?>