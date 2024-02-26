<?php
$F_name = $_POST['F_name'];
$Pwd = $_POST['Pwd'];
$RUID = $_POST['RUID'];
$Email = $_POST['Email'];
$L_name = $_POST['L_name'];
$campus = $_POST['campus'];

if (!empty($F_name) || !empty($L_name) || !empty($Pwd) #if its NOT empty
|| !empty($RUID) || !empty($Email) || !empty($campus)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "root";
    $dbName = "EclipseData";

    //connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if (mysqli_connect_error()){
        die('Connect Erorr('. mysqli_connect_errno().')'. mysqli_connect_error());

    } else{
        //Stament to prepare the fields
        $SELECT = "SELECT Email from Student_information Where email = ? Limit 1";
        $INSERT = "INSERT Into Student_information(F_name, L_name, Pwd, RUID, Email, campus) values(?, ?, ?, ?, ?, ?)";
        
        //statement to insert the values into the DB
        $stmt = $conn->prepare($SELECT); 
        $stmt->bind_param("s", $Email); // i - integer , d - double, s - string, b - BLOB
        $stmt->execute();       //BLOB is for starage on files, like how much storage can a file take up?
        $stmt->bind_result($Email); // This -> function means to set a property within the object
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0){
            $stmt->bind_param("sssiss",$F_name, $L_name, $Pwd, $RUID, $Email, $campus);
            $stmt->execute();
            echo "New Record inserted successfully!";
        } else{
            echo "Someone already registered this email";
            $stmt->close();
            $conn->close();
        }
    }



} else{
    echo "All fields required";
    die(); #this is kinda like exit(), just closes down the service
}


?>