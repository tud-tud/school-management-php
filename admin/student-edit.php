<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && isset($_GET['student_id'])) {
    if ($_SESSION['role'] == '1') {
        include "../DB_connection.php";
        include "data/student.php";
        include "data/grade.php";
        include "data/section.php";

        $grades = getAllGrades($conn);
        $sections = getAllSections($conn);

        $student_id = $_GET['student_id'];
        $student = getStudentByID($student_id, $conn);
        if ($student == 0) {
            header("Location: student.php");
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
            <title>Admin - Edit Student</title>

        </head>

        <body class="">
            <!-- Navbar -->
            <?php include "inc/navbar.php";
            ?>

            <div class="container mt-5">
                <a href="student.php" class="btn btn-dark">Go - Back</a>

                <form method="post" class="shadow p-3 mt-5 form-w" action="req/student-edit.php">
                    <h3>Edit Student</h3>
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
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="fname" value="<?= $student['fname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lname" value="<?= $student['lname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?= $student['address'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="text" class="form-control" name="email_address" value="<?= $student['email_address'] ?>">
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Date of birth</label>
                        <input type="date" class="form-control" name="date_of_birth" value="<?= $student['date_of_birth'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label><br />
                        <input type="radio" name="gender" value="Male"
                        <?php if($student['gender'] == 'Male') echo 'checked'  ?>
                        > Male &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" value="Female"
                        <?php if($student['gender'] == 'Female') echo 'checked'  ?>
                        > Female
                    </div>

                    

                    <div class="mb-3">
                        <label class="form-label">Parent first name</label>
                        <input type="text" class="form-control" name="parent_fname" value="<?= $student['parent_fname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Parent last name</label>
                        <input type="text" class="form-control" name="parent_lname" value="<?= $student['parent_lname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Parent phone number</label>
                        <input type="text" class="form-control" name="parent_phone_number" value="<?= $student['parent_phone_number'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $student['username'] ?>">
                    </div>

                    <input type="text" value="<?= $student['student_id'] ?>" name="student_id" hidden>


                    <div class="mb-3">
                        <label class="form-label">Grade</label>
                        <div class="row row-cols-5">
                            <?php
                            $grade_ids = str_split(trim($student['grade']));

                            foreach ($grades as $grade) {
                                $checked = 0;
                                foreach ($grade_ids as $grade_id) {
                                    if ($grade_id == $grade['grade_id']) {
                                        $checked = 1;
                                    }
                                }
                            ?>
                                <div class="col">
                                    <input type='radio' name="grade" <?php if ($checked) echo "checked"; ?> value="<?= $grade['grade_id'] ?>">
                                    <?= $grade['grade_code'] ?>-<?= $grade['grade'] ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Section</label>
                        <div class="row row-cols-5">
                            <?php
                            $section_ids = str_split(trim($student['section']));

                            foreach ($sections as $section) {
                                $checked = 0;
                                foreach ($section_ids as $section_id) {
                                    if ($section_id == $section['section_id']) {
                                        $checked = 1;
                                    }
                                }
                            ?>
                                <div class="col">
                                    <input type="radio" name="section" <?php if ($checked) echo "checked"; ?>  value="<?= $section['section_id'] ?>">
                                    <?= $section['section'] ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>




                    <button type="submit" class="btn btn-primary">Update</button>

                </form>

                <!-- Change Password -->
                <form method="post" class="shadow p-3 mt-5 mb-5 form-w" action="req/student-change.php" id="change_password">
                    <h3>Change Password</h3>

                    <?php if (isset($_GET['perror'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_GET['perror'] ?>

                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['psuccess'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= $_GET['psuccess'] ?>

                        </div>
                    <?php } ?>
                    <hr />

                    <div class="mb-3">
                        <label class="form-label">Admin password</label>
                        <input type="password" class="form-control" name="admin_pass" id="">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New password</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="new_pass" id="passInput">
                            <button class="btn btn-secondary" id="gBtn">Random</button>
                        </div>
                    </div>

                    <input type="text" value="<?= $student['student_id'] ?>" name="student_id" hidden>

                    <div class="mb-3">
                        <label class="form-label">Confirm new password</label>
                        <input type="text" class="form-control" name="c_new_pass" id="passInput2">
                    </div>

                    <button type="submit" class="btn btn-primary">Change</button>



                </form>

            </div>


                        
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <!-- jquery -->
            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(3) a").addClass('active')
                });

                function makePass(length) {
                    let result = '';
                    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    const charactersLength = characters.length;
                    let counter = 0;
                    while (counter < length) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                        counter += 1;
                    }
                    var passInput = document.getElementById('passInput')
                    var passInput2 = document.getElementById('passInput2')
                    passInput.value = result;
                    passInput2.value = result;

                }

                var gBtn = document.getElementById('gBtn');
                gBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    makePass(4);
                });
            </script>
        </body>

        </html>

<?php
    } else {
        header("Location: student.php");
        exit;
    }
} else {
    header("Location: student.php");
    exit;
} ?>