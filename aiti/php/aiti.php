
<?php 
session_start();

echo "<style>
.button1{
    display:none;
} 
.button2{
    display:none;
} 
</style> ";
// echo '<style type="text/css">

//         .button2 {
//             display: block;
//         }
//         .button1{
//             display:none;
//         }
//         </style>';


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

    if (isset($_POST['submit'])){ //start of authentication of staff id

                    if (!$_POST['staffid']){
                        echo "please enter your staff id";
                    }else{

                            $staffID = mysqli_real_escape_string($conn, $_POST['staffid']);
                                                
                                    $query = "SELECT staffId FROM `staffinfo` WHERE staffId = '$staffID'";
                        //start get staff id in database
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_assoc($result);

                                    if ($row == null){
                                        echo "try again";
                                    }else{
                                        
                                        $staff_id = $row["staffId"];
                                        echo "id: " . $staff_id;
                                        $_SESSION['staff'] = $staff_id;
                                        var_dump($staffID);
                                        
                        //end get staff id in database

                        //start get log boolean from database
                                            $date = date("Y-m-d");
                                            $STAFF = $_SESSION['staff'];
                                            $query = "SELECT logBool from logtable WHERE checkInDate = '$date' and staffId = '$STAFF'";
                                            $result= mysqli_query($conn, $query);
                                           $row = mysqli_fetch_assoc($result);
                                            echo "bool:" . $row['logBool'];
                                            $log_bool = $row['logBool'];
                                             
                        //end get boolean from database

                                        // $date = date("Y-m-d");
                                        // $query = "SELECT logBool from logtable WHERE logDate = '$date' and staffId = '$staffID'";
                                 
                                    if ($log_bool == 1){
                                        echo '<style type="text/css">

                                        .button2 {
                                            display: block;
                                        }
                                        .button1{
                                            display:none;
                                        }
                                        </style>';
                                    }else{

                                        echo '<style type="text/css">

                                        .button2 {
                                            display: none;
                                        }
                                        .button1{
                                            display:block;
                                        }
                                        </style>';
                                    }
                                    }
                        }
                    
    }//end of authentication on staff id

           
            

            $STAFF = $_SESSION['staff'];
            $date = date('Y-m-d');
            $time = date('h:i:s');
            $day = date('l');
            $boolean = 1;

            
            
            if(isset($_POST["checkIn"])){

            $sql = "INSERT INTO `logtable` VALUES (NULL, '$STAFF' , '$date', '$time', NULL, '$day', $boolean, NULL)";
            
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
                    }
                
            if(isset($_POST['checkOut'])){
                $sql = "UPDATE `logtable` SET `checkOutTime`='$time' WHERE `checkInDate`='$date' AND `staffId` = '$STAFF' ";
               
                if (mysqli_query($conn, $sql)) {
                    echo "check out successful";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

        }
}




?>

<html>
 
<br>
<br>

<form method = "post" >
Staff Id:<input type="text" name="staffid">
<input type="submit" name= "submit">
</form>

<form method="post" action="">
<input  type="submit" class="button1" name="checkIn" value="check In">
<input  type="submit" class="button2" name="checkOut" value="check Out">
</form>



</html>


