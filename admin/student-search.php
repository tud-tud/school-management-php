<?php session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '1') {

        if (isset($_GET['searchKey'])) {

            $search_key = $_GET['searchKey'];

            include "../DB_connection.php";
            include "data/student.php";
            include "data/grade.php";

            $students = searchStudents($search_key, $conn);



?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <!-- css -->
                <link rel="stylesheet" href="../css/style.css">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
                <!-- Jqurry -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <!-- font awesome -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


                <link rel="icon" href="../img/logo.png">

                <title>Admin - Search Students</title>
            </head>

            <body>
                <!-- Navbar -->
                <?php include "inc/navbar.php";
                if ($students != 0) { ?>

                    <div class="container mt-5">
                        <a href="student-add.php" class="btn btn-dark">Add New Students</a>

                        <!-- Search Form -->
                        <form action="student-search.php" method="get" class="mt-3 n-table">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="searchKey" value="<?= $search_key ?>" placeholder="Search...">
                                <button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>

                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger mt-3 n-table" role="alert">
                                <?= $_GET['error'] ?>
                            </div>
                        <?php } ?>

                        <?php if (isset($_GET['success'])) { ?>
                            <div class="alert alert-info mt-3 n-table" role="alert">
                                <?= $_GET['success'] ?>
                            </div>
                        <?php } ?>

                        <!-- table -->
                        <div class="table-responsive">
                            <table class="table table-bordered mt-3 n-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Grade</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($students as $student) {
                                        $i++ ?>
                                        <tr>
                                            <th scope="row"><?= $i ?></th>
                                            <td><?= $student['student_id'] ?></td>
                                            <td><a href="student-view.php?student_id=<?= $student['student_id'] ?>"><?= $student['fname'] ?></a></td>
                                            <td><?= $student['lname'] ?></td>
                                            <td><?= $student['username'] ?></td>

                                            <td>
                                                <?php
                                                $grade = $student['grade'];
                                                $g_temp = getGradeByID($grade, $conn);

                                                if ($g_temp != 0) {
                                                    echo $g_temp['grade_code'] . '-' . $g_temp['grade'];
                                                }

                                                ?>
                                            </td>
                                            <td>
                                                <a href="student-edit.php?student_id=<?= $student['student_id'] ?>" class="btn btn-warning">Edit</a>
                                                <a href="student-delete.php?student_id=<?= $student['student_id'] ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                } else { ?>
                        <div class="alert alert-info w-450 m-5" role="alert">
                            No Results Found!! <a href="student.php" class="btn btn-dark">Go - Back</a>
                        </div>
                    <?php } ?>
                    </div>



                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                    <!-- jquery -->
                    <script>
                        $(document).ready(function() {
                            $("#navLinks li:nth-child(3) a").addClass('active')
                        });
                    </script>
            </body>

            </html>

<?php

        } else {
            header("Location:../student.php");
            exit;
        }
    } else {
        header("Location:../login.php");
        exit;
    }
} else {
    header("Location:../login.php");
    exit;
} ?>