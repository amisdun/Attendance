


<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "aiti";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else {
        // if(isset($_POST['submit'])){
        //     $staff_id = mysqli_real_escape_string($conn, $_POST['staffid']) ;

        //     $date = date('Y-m-d');
        //     $time = date('h:i:s');
        //     $day = date('l');
        //     $boolean = 1;
            
        //     var_dump($staff_id,$date,$time,$day,$boolean);
           
        //    $sql = "INSERT INTO `logtable` VALUES (NULL, '$staff_id' , '$date', '$time', NULL, '$day', $boolean, NULL)";
            
        //     if (mysqli_query($conn, $sql)) {
        //         echo "New record created successfully";
        //     } else {
        //         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        //     }

        // }

        $staffID = "508924141";
        $date = date("Y-m-d");
        $query = "SELECT logBool from logtable WHERE checkInDate = '$date' and staffId = '$staffID'";
       $result= mysqli_query($conn, $query);
       var_dump($result);
       $row = mysqli_fetch_assoc($result);
       echo $row['logBool'];
      

} 



?>

<form method="post">
<input type="text" name="staffid">
<input type="submit" name="submit"></form>