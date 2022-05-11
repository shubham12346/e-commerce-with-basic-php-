<?php 

function OpenCon()
{
    $dbhost = "localhost";
    $user = "root";
    $dbpass = "";
    $dbname = "mynotes";
    $conn = new mysqli($dbhost,$user,$dbpass,$dbname) or die("Connection Failed :%s\n".$conn->error);

    return $conn;
}
function CloseCon($conn)
{
    $conn->close();
}


?>
