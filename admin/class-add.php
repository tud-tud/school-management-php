<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '1') {
        include '../DB_connection.php';
        include 'data/grade.php';
        include 'data/section.php';

        $grades = getAllGrades($conn);
        $sections = getAllSections($conn);

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
            <title>Admin - Add Class</title>

        </head>

        <body class="">
            <!-- Navbar -->
            <?php
            include "inc/navbar.php";
            if ($sections == 0 || $grades == 0) { ?>
                <div class="alert alert-info" role="alert">
                    First create section and class
                </div>
                <a href="class.php" class="btn btn-dark">Go - Back</a>
            <?php } ?>

            <div class="container mt-5">
                <a href="class.php" class="btn btn-dark">Go - Back</a>

                <form method="post" class="shadow p-3 my-5 form-w" action="req/class-add.php">
                    <h3>Add New Class</h3>
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
                        <label class="form-label">Grade</label>
                        <select class="form-control" name="grade">
                            <?php foreach($grades as $grade){?>
                                
                                <option value="<?= $grade['grade_id']?>">
                                <?= $grade['grade_code'].'-'.$grade['grade'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Section</label>
                        <select class="form-control" name="section">
                        <?php foreach($sections as $section){?>
                                
                                <option value="<?= $section['section_id']?>">
                                <?= $section['section'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Create</button>
                </form>

            </div>



            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <!-- jquery -->
            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(6) a").addClass('active')
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