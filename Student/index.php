<?php session_start();
if (isset($_SESSION['student_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '3') {
        include "../DB_connection.php";
        include "data/student.php";
        include "data/subject.php";
        include "data/grade.php";
        include "data/section.php";

        $student_id = $_SESSION['student_id'];
        $student = getStudentByID($student_id, $conn);

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <!-- Jqurry -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <!-- font awesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


            <link rel="icon" href="../img/logo.png">

            <title>Student - Home</title>
        </head>

        <body>
            <!-- Navbar -->
            <?php include "inc/navbar.php" ?>

            <?php
            if ($student != 0) { ?>

                <div class="container my-5">
                    <div class="card" style="width: 28rem;">
                        <img src="../img/S-<?= $student['gender'] ?>.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">@<?= $student['username'] ?></h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">First name: <?= $student['fname'] ?></li>
                            <li class="list-group-item">Last name: <?= $student['lname'] ?></li>
                            <li class="list-group-item">Username: <?= $student['username'] ?></li>
                            <li class="list-group-item">Date of birth: <?= $student['date_of_birth'] ?></li>
                            <li class="list-group-item">Gender: <?= $student['gender'] ?></li>
                            <li class="list-group-item">Address: <?= $student['address'] ?></li>
                            <li class="list-group-item">Email address: <?= $student['email_address'] ?></li>
                            <li class="list-group-item">Date of joined: <?= $student['date_of_joined'] ?></li>
                            <li class="list-group-item">Grade:
                                <?php
                                $grades = $student['grade'];
                                $g = getGradeByID($grades, $conn);
                                echo $g['grade_code'] . '-' . $g['grade'];
                                ?>
                            </li>
                            <li class="list-group-item">Sections:

                                <?php
                                $sections = $student['section'];
                                $s = getSectionByID($sections, $conn);
                                echo $s['section'];
                                ?>
                            </li>

                            <li class="list-group-item">Parent first name: <?= $student['parent_fname'] ?></li>
                            <li class="list-group-item">Parent last name: <?= $student['parent_lname'] ?></li>
                            <li class="list-group-item">Parent phone number: <?= $student['parent_phone_number'] ?></li>


                        </ul>

                    </div>
                </div>

            <?php
            } else {
                header("Location: student.php");
                exit;
            } ?>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <!-- jquery -->
            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(1) a").addClass('active')
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