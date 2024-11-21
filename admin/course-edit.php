<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && isset($_GET['course_id'])) {
    if ($_SESSION['role'] == '1') {
        include "../DB_connection.php";
        include 'data/grade.php';
        include 'data/course.php';

        $course_id = $_GET['course_id'];
        $course = getCourseByID($course_id, $conn);
        $grades = getAllGrades($conn);

        if ($course == 0) {
            header("Location: course.php");
            exit;
        }

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

            <link rel="icon" href="../img/logo.png">
            <title>Admin - Edit Course</title>

        </head>

        <body class="">
            <!-- Navbar -->
            <?php include "inc/navbar.php";
            ?>

            <div class="container mt-5">
                <a href="course.php" class="btn btn-dark">Go - Back</a>

                <form method="post" class="shadow p-3 my-5 form-w" action="req/course-edit.php">
                    <h3>Edit Course</h3>
                    <hr />
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_GET['error'] ?>

                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['success'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= $_GET['success'] ?>

                        </div>
                    <?php } ?>

                    <div class="mb-3">
                        <label class="form-label">Course Name</label>
                        <input type="text" class="form-control" name="course_name" value="<?= $course['course_name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course Code</label>
                        <input type="text" class="form-control" name="course_code" value="<?= $course['course_code'] ?>">
                    </div>
                    <div class=" mb-3">
                        <label class="form-label">Grade</label>
                        <select class="form-control" name="grade">
                            <?php foreach ($grades as $grade) {
                                $selected = 0;
                                if ($grade['grade_id'] == $course['grade']) {
                                    $selected = 1;
                                }
                            ?>
                                <option value="<?= $grade['grade_id'] ?>"
                                    <?php if ($selected) echo "selected"; ?>>
                                    <?= $grade['grade_code'] . '-' . $grade['grade'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <input type="text" value="<?= $course['course_id'] ?>" name="course_id" hidden>


                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

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