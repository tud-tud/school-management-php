<?php session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '1') {
        include "../DB_connection.php";
        include "data/course.php";
        include "data/grade.php";

        $courses = getAllCouses($conn);

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

            <title>Admin - Course</title>
        </head>

        <body>
            <!-- Navbar -->
            <?php include "inc/navbar.php";
            if ($courses != 0) { ?>

                <div class="container mt-5">
                    <a href="course-add.php" class="btn btn-dark">Add New Course</a>

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
                                    <th scope="col">Courses</th>
                                    <th scope="col">Course_Code</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($courses as $course) {
                                    $i++ ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td>
                                            <?php
                                            echo  $course['course_name'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo  $course['course_code'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $grade = getGradeByID($course['grade'],$conn);
                                            echo  $grade['grade_code'].'-'.$grade['grade'];
                                            ?>
                                        </td>
                                
                                        <td>
                                            <a href="course-edit.php?course_id=<?= $course['course_id'] ?>" class="btn btn-warning">Edit</a>
                                            <a href="course-delete.php?course_id=<?= $course['course_id'] ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php
            } else { ?>
                    <div class="alert alert-info w-450 m-5" role="alert">
                        Emty!
                    </div>
                <?php } ?>
                </div>



                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                <!-- jquery -->
                <script>
                    $(document).ready(function() {
                        $("#navLinks li:nth-child(8) a").addClass('active')
                    });
                </script>
        </body>

        </html>

<?php
    } else {
        header("Location:../login.php");
        exit;
    }
} else {
    header("Location:../login.php");
    exit;
} ?>