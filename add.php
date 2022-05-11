<?php
// edited by shubham agrahari
  session_start();
  $user = $_SESSION["user"];
  $uid = $_SESSION["uid"];
  echo $uid;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'connection.php';

        $conn = OpenCon();
        $SQL = "INSERT INTO `note`( `userId`,`uemail`, `title`, `description-n`) VALUES ( '$uid', '$user','$_POST[title]' , '$_POST[desc]' )";
        if(mysqli_query($conn, $SQL)){
            echo  " <script>
                                alert('Note inserted successfully ');
                              
                                window.location.href='index.php';
                                  </script> 
                             
                                ";
        } else{
            echo  " <script>
                                alert('FAiled to insert');
                                window.location.href='index.php';
                                
                                ";
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        CloseCon($conn);
        
    }


    ?>