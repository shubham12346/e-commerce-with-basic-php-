<?php 
session_start();
if(isset($_SESSION['user']))
{
    session_destroy();
   echo "<script>
    window.location.href='index.php';
   </script>";
}
echo "<script>
    window.location.href='index.php';
   </script>";


?>