<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && isset($_GET['r_user_id'])) {

    if ($_SESSION['role'] == '1') {
        include "../DB_connection.php";
        include "data/register_office.php";
        

        

        $r_user_id = $_GET['r_user_id'];
        $r_user = getR_userByID($r_user_id, $conn);
        if ($r_user == 0) {
            header("Location: register-office.php");
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
            <title>Admin - Edit Registrer Office</title>

        </head>

        <body class="">
            <!-- Navbar -->
            <?php include "inc/navbar.php";
            ?>

            <div class="container mt-5">
                <a href="register-office.php" class="btn btn-dark">Go - Back</a>

                <form method="post" class="shadow p-3 mt-5 form-w" action="req/register-office-edit.php">
                    <h3>Edit Registrer Office User</h3>
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
                        <input type="text" class="form-control" name="fname" value="<?= $r_user['fname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lname" value="<?= $r_user['lname'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $r_user['username'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?= $r_user['address'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Employee Numbe</label>
                        <input type="text" class="form-control" name="employee_number" value="<?= $r_user['employee_number'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" value="<?= $r_user['phone_number'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Qualification</label>
                        <input type="text" class="form-control" name="qualification" value="<?= $r_user['qualification'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="text" class="form-control" name="email_address" value="<?= $r_user['email_address']  ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label><br />
                        <input type="radio" name="gender" value="Male"
                        <?php if($r_user['gender'] == 'Male') echo 'checked'  ?>
                        > Male &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" value="Female"
                        <?php if($r_user['gender'] == 'Female') echo 'checked'  ?>
                        > Female
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="date_of_birth" value="<?= $r_user['date_of_birth']  ?>">
                    </div>


                    <input type="text" value="<?= $r_user['r_user_id'] ?>" name="r_user_id" hidden>


                    <button type="submit" class="btn btn-primary">Update</button>

                </form>

                <!-- Change Password -->
                <form method="post" class="shadow p-3 mt-5 mb-5 form-w" action="req/register-office-change.php" id="change_password">
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

                    <input type="text" value="<?= $r_user['r_user_id'] ?>" name="r_user_id" hidden>

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
                    $("#navLinks li:nth-child(7) a").addClass('active')
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
        header("Location: register-office.php");
        exit;
    }
} else {
    header("Location: register-office.php");
    exit;
} ?>