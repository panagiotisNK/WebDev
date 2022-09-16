<?php


include('message.php');

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'pois');

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 
$poi_Id   ="";

if (isset($_POST['uploadBtn'])  )

{ //echo 'button pressed';

  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)

  {

    // uploaded file details

    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];

    $fileName = $_FILES['uploadedFile']['name'];

    $fileSize = $_FILES['uploadedFile']['size'];

    $fileType = $_FILES['uploadedFile']['type'];

    $fileNameCmps = explode(".", $fileName);

    $fileExtension = strtolower(end($fileNameCmps));

    // removing extra spaces

    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    

    // file extensions allowed

    $allowedfileExtensions = array('json');

    if (in_array($fileExtension, $allowedfileExtensions))

    {
        //echo 'it is a json file';
      // directory where file will be moved

      $uploadFileDir = 'C:\xampflder\htdocs\WebDev\dokimh4\admin/';

      $dest_path = $uploadFileDir . $newFileName;
      copy($fileTmpPath, $dest_path);



      $json_data= file_get_contents($newFileName);

      $array= json_decode($json_data, true);
      
      foreach ($array as $row) 
      {
      
      $type_array = array_column($row["types"],NULL,NULL);
      $popTimes_array = array_column($row["populartimes"],NULL,NULL);
      $data_array = array_column($row["populartimes"][0]["data"],NULL,NULL);
      
          
      
      $sql_basics = "INSERT INTO poi(poiId,poiName,poiAddress,poiRating,poiRatingn,poiCurrPop) VALUES( '".$row["id"]."' , '".$row["name"]."' , '".$row["address"]."' , '".$row["rating"]."' , '".$row["rating_n"]."' , '".$row["current_popularity"]."' )";
      $sql_coordinates= "INSERT INTO poicoordinates(poiId,lat,lng) VALUES( '".$row["id"]."' , '".$row["coordinates"]["lat"]."' , '".$row["coordinates"]["lng"]."' )";
      
          
      mysqli_query($db,$sql_basics);
      mysqli_query($db,$sql_coordinates);
      
      for($i =0; $i<=sizeof($type_array)-1; $i++) 
      {
      $sql_types= "INSERT INTO poitypes(poiId,poiType) VALUES( '".$row["id"]."' , '".$row["types"][$i]."' )";
      mysqli_query($db,$sql_types);
      }
      
      
      
      
      for($j=0; $j<=6; $j++)
      {
      $sql_poiData="INSERT INTO populartimes(poiId,dataDay,dataVal0,dataVal1,dataVal2,dataVal3,dataVal4,dataVal5,dataVal6,dataVal7,dataVal8,dataVal9,dataVal10,dataVal11,dataVal12,dataVal13,dataVal14,dataVal15,dataVal16,dataVal17,dataVal18,dataVal19,dataVal20,dataVal21,dataVal22,dataVal23) VALUES('".$row["id"]."' ,'".$row["populartimes"][$j]["name"]."','".$row["populartimes"][$j]["data"][0]."','".$row["populartimes"][$j]["data"][1]."','".$row["populartimes"][$j]["data"][2]."','".$row["populartimes"][$j]["data"][3]."','".$row["populartimes"][$j]["data"][4]."','".$row["populartimes"][$j]["data"][5]."','".$row["populartimes"][$j]["data"][6]."','".$row["populartimes"][$j]["data"][7]."','".$row["populartimes"][$j]["data"][8]."','".$row["populartimes"][$j]["data"][9]."','".$row["populartimes"][$j]["data"][10]."','".$row["populartimes"][$j]["data"][11]."','".$row["populartimes"][$j]["data"][12]."','".$row["populartimes"][$j]["data"][13]."','".$row["populartimes"][$j]["data"][14]."','".$row["populartimes"][$j]["data"][15]."','".$row["populartimes"][$j]["data"][16]."','".$row["populartimes"][$j]["data"][17]."','".$row["populartimes"][$j]["data"][18]."','".$row["populartimes"][$j]["data"][19]."','".$row["populartimes"][$j]["data"][20]."','".$row["populartimes"][$j]["data"][21]."','".$row["populartimes"][$j]["data"][22]."','".$row["populartimes"][$j]["data"][23]."')";
      mysqli_query($db,$sql_poiData);
      }
      
      
      }
      
      
      
      
      
      
      echo "Data was inserted.";



      if(copy($fileTmpPath, $dest_path)) 
      
      {
        

        $message = 'file was successfully uploaded!';


        
      }

      else 

      {

        $message = 'An error occurred while uploading the file to the destination directory. Ensure that the web server has access to write in the path directory.';

      }

    }

    else

    {

      $message = 'Upload failed as the file type is not acceptable. The allowed file types are:' . implode(',', $allowedfileExtensions);

    }

  }

  else

  {

    $message = 'Error occurred while uploading the file.<br>';

    $message .= 'Error:' . $_FILES['uploadedFile']['error'];

  }

}




?>