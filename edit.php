<?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            include 'connection.php';
                            $conn2 = OpenCon();

                            $sql2 = "UPDATE `note` SET `title`='$_POST[title1]',`description-n`='$_POST[desc1]' WHERE `sno`='$_POST[demo]' ";
                            if(mysqli_query($conn2,$sql2)) 
                            {
                                echo  " <script>
                                alert('Note updated successfully ');
                              
                                window.location.href='index.php';
                                  </script> 
                                ";
                               
                            }
                            else{
                                echo "Error: " . $sql . "<br>" . $conn->error;

                            }
                                CloseCon($conn2);
                        }
?>