<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && isset($_GET['teacher_id'])) {
    if ($_SESSION['role'] == '1') {
        include "../DB_connection.php";
        include "data/teacher.php";
        include "data/subject.php";
        include "data/grade.php";
        include "data/section.php";
        include "data/class.php";

        $subjects = getAllSubjects($conn);
        $classes =getAllClasses($conn);

        $teacher_id = $_GET['teacher_id'];
        $teacher = getTeacherByID($teacher_id, $conn);
        if ($teacher == 0) {
            header("Location: teacher.php");
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
            <title>Admin - Edit Teacher</title>

        </head>

        <body class="">
            <!-- Navbar -->
            <?php include "inc/navbar.php";
            ?>

            <div class="container mt-5">
                <a href="teacher.php" class="btn btn-dark">Go - Back</a>

                <form method="post" class="shadow p-3 mt-5 form-w" action="req/teacher-edit.php">
                    <h3>Edit Teacher</h3>
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
                        <input type="text" class="form-control" name="fname" value="<?= $teacher['fname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lname" value="<?= $teacher['lname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $teacher['username'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?= $teacher['address'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Employee Numbe</label>
                        <input type="text" class="form-control" name="employee_number" value="<?= $teacher['employee_number'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" value="<?= $teacher['phone_number'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Qualification</label>
                        <input type="text" class="form-control" name="qualification" value="<?= $teacher['qualification'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="text" class="form-control" name="email_address" value="<?= $teacher['email_address']  ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label><br />
                        <input type="radio" name="gender" value="Male"
                        <?php if($teacher['gender'] == 'Male') echo 'checked'  ?>
                        > Male &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" value="Female"
                        <?php if($teacher['gender'] == 'Female') echo 'checked'  ?>
                        > Female
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="date_of_birth" value="<?= $teacher['date_of_birth']  ?>">
                    </div>


                    <input type="text" value="<?= $teacher['teacher_id'] ?>" name="teacher_id" hidden>

                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <div class="row row-cols-5">
                            <?php
                            $subject_ids = str_split(trim($teacher['subjects']));

                            foreach ($subjects as $subject) {
                                $checked = 0;
                                foreach ($subject_ids as $subject_id) {
                                    if ($subject_id == $subject['subject_id']) {
                                        $checked = 1;
                                    }
                                }
                            ?>
                                <div class="col">
                                    <input type="checkbox" name="subject[]" <?php if ($checked) echo "checked"; ?> value="<?= $subject['subject_id'] ?>">
                                    <?= $subject['subject'] ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Classes</label>
                        <div class="row row-cols-5">
                            <?php
                            $class_ids = str_split(trim($teacher['class']));

                            foreach ($classes as $class) {
                                $checked = 0;
                                foreach ($class_ids as $class_id) {
                                    if ($class_id == $class['class_id']) {
                                        $checked = 1;
                                    }
                                }
                                $grade =getGradeByID($class['grade'],$conn);
                                $section =getSectionByID($class['section'],$conn);
                            ?>
                                <div class="col">
                                    <input type="checkbox" name="classes[]" <?php if ($checked) echo "checked"; ?> value="<?= $class['class_id'] ?>">
                                    <?= $grade['grade_code'] ?>-<?= $grade['grade'].$section['section'] ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>

                </form>

                <!-- Change Password -->
                <form method="post" class="shadow p-3 mt-5 mb-5 form-w" action="req/teacher-change.php" id="change_password">
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

                    <input type="text" value="<?= $teacher['teacher_id'] ?>" name="teacher_id" hidden>

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
                    $("#navLinks li:nth-child(2) a").addClass('active')
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
        header("Location: teacher.php");
        exit;
    }
} else {
    header("Location: teacher.php");
    exit;
} ?>