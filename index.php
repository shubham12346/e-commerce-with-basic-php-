<?php
session_start();
if (!(isset($_SESSION['user']))) {
    echo "  session is not set";
    echo "<script>
    window.location.href='login.php';
   </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand active" href="#">
                <?php if ((isset($_SESSION['username']))) {
                    echo $_SESSION["username"];
                } else {
                    echo "Mynotes";
                }
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="logout.php">Log out</a>
                    </li>



                </ul>

            </div>
        </div>
    </nav>

    <section>
        <div class="container w-75  me-5">
            <form action="add.php" method="POST" class="ms-5 mt-5">
                <div class="mb-3 w-75">
                    <label for="exampleInputEmail1" class="form-label">Title </label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>

                <div class="form-floating w-75 ">

                    <textarea class="form-control" name="desc" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Description</label>
                </div>

                <button type="submit" class="btn btn-primary mt-5">Add Note</button>
            </form>

        </div>
    </section>





    <section id="showTable">
        <?php
        include 'connection.php';
        $conn = OpenCon();
        $us = $_SESSION["user"];
        $uid = $_SESSION["uid"];
        $sql = "SELECT * FROM `note` WHERE `uemail`='$us'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          $i=1;
        ?>



            <table class="table w-50  ms-auto mt-5  me-auto border">

                <tr>

                    <th scope="col">S.NO</th>
                    <th scope="col"> Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>

                </tr>

                <?php
            while ($row = mysqli_fetch_assoc($result)) {

                ?>

                    <tr>
                        <td> <?php echo $i; ?></td>
                        <td> <?php echo  $row["title"]; ?></td>
                        <td><?php echo  $row["description-n"]; ?></td>
                        <td> <?php echo  $row["ndate"]; ?> </td>

                        <td>
                            <button type="button" class="btn btn-primary" onclick="showid('<?php echo $row['sno']; ?>')" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Edit
                            </button>


                        </td>
                        <td><a class="btn btn-primary" href="delete.php?id=<?php echo $row['sno']; ?>"> Delete </a></td>
                    </tr>


                <?php
                    $i++;

                }
                ?>
            </table>


        <?php

        }else{
            echo " no record found";
            echo "Error: " . $sql . "<br>" . $conn->error;
        
        }
        CloseCon($conn);

        ?>
    </section>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="edit.php" method="POST">

                        <div class="mb-3 w-75">
                            <label for="exampleInputEmail1" class="form-label"> S no </label>
                            <input type="text" name="demo" class="form-control" id="sno" aria-describedby="emailHelp">

                        </div>
                        <div class="mb-3 w-75">
                            <label for="exampleInputEmail1" class="form-label"> Edit Title </label>
                            <input type="text" name="title1" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>

                        <div class="form-floating w-75 ">

                            <textarea class="form-control" name="desc1" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2"> Edit Description</label>
                        </div>

                        <button type="submit" class="btn btn-primary mt-5">Add Note</button>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>













    <script>
        function showid(name) {


            document.getElementById("sno").value = name;
        }
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>