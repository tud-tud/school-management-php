<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '1') {

        include "../DB_connection.php";
        include "data/grade.php";
        include "data/section.php";

        $grades = getAllGrades($conn);
        $sections = getAllSections($conn);

        $fname = '';
        $lname = '';
        $uname = '';

        $address = '';
        $email = '';
        $pfn = '';
        $pln = '';
        $pph= '';

        if (isset($_GET['fname'])) $fname = $_GET['fname'];
        if (isset($_GET['lname'])) $lname = $_GET['lname'];
        if (isset($_GET['uname'])) $uname = $_GET['uname'];
        if (isset($_GET['address'])) $address = $_GET['address'];
        if (isset($_GET['email'])) $email = $_GET['email'];
        if (isset($_GET['pfn'])) $pfn = $_GET['pfn'];
        if (isset($_GET['pln'])) $pln = $_GET['pln'];
        if (isset($_GET['pph'])) $pph = $_GET['pph'];
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
            <title>Admin - Add Student</title>

        </head>

        <body class="">
            <!-- Navbar -->
            <?php include "inc/navbar.php";
            ?>

            <div class="container mt-5">
                <a href="student.php" class="btn btn-dark">Go - Back</a>

                <form method="post" class="shadow p-3 my-5 form-w" action="req/student-add.php">
                    <h3>Add New Student</h3>
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
                        <input type="text" class="form-control" name="fname" value="<?= $fname ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lname" value="<?= $lname ?>">
                    </div>



                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?= $address ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="text" class="form-control" name="email_address" value="<?= $email ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date of birth</label>
                        <input type="date" class="form-control" name="date_of_birth" >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label><br />
                        <input type="radio" name="gender" value="Male"> Male &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" value="Female"> Female
                    </div>
                    <br />
                    <hr />

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $uname ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="pass" id="passInput">
                            <button class="btn btn-secondary" id="gBtn">Random</button>
                        </div>
                    </div>
                    <br />
                    <hr />

                    <div class="mb-3">
                        <label class="form-label">Parent first name</label>
                        <input type="text" class="form-control" name="parent_fname" value="<?= $pfn ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Parent last name</label>
                        <input type="text" class="form-control" name="parent_lname" value="<?= $pln ?>">
                    </div>

                    <div class=" mb-3">
                        <label class="form-label">Parent phone number</label>
                        <input type="text" class="form-control" name="parent_phone_number" value="<?= $pph ?>">
                    </div>
                    <br />
                    <hr />


                    <div class="mb-3">
                        <label class="form-label">Grade</label>
                        <div class="row row-cols-5">
                            <?php foreach ($grades as $grade) : ?>
                                <div class="col">
                                    <input type="radio" name="grade" value="<?= $grade['grade_id'] ?>">
                                    <?= $grade['grade_code'] ?>-<?= $grade['grade'] ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Section</label>
                        <div class="row row-cols-5">
                            <?php foreach ($sections as $section) : ?>
                                <div class="col">
                                    <input type="radio" name="section" value="<?= $section['section_id'] ?>">
                                    <?= $section['section'] ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary">Register</button>
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
                    passInput.value = result;

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
        header("Location:../login.php");
        exit;
    }
} else {
    header("Location:../login.php");
    exit;
} ?>