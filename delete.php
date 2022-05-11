<?php 

include 'connection.php';
$conn = OpenCon();
$id = $_GET["id"];
$sql = "DELETE FROM `note` WHERE `sno`='$id'";

if(mysqli_query($conn,$sql))
{
    echo "  <script>
    window.location.href='index.php';
    </script>";
   
}else{
    echo "failed to delete";

}
CloseCon($conn);
?>