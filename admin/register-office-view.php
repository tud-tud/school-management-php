<?php session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '1') {
        include "../DB_connection.php";
        include "data/register_office.php";


        if (isset($_GET['r_user_id'])) {

            $r_user_id = $_GET['r_user_id'];

            $r_user = getR_userByID($r_user_id, $conn);


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

                <title>Admin - Register Office</title>
            </head>

            <body>
                <!-- Navbar -->
                <?php include "inc/navbar.php";
                if ($r_user != 0) { ?>

                    <div class="container my-5">
                        <div class="card" style="width: 28rem;">
                            <img src="../img/R-<?= $r_user['gender'] ?>.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">@<?= $r_user['username'] ?></h5>

                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">First name: <?= $r_user['fname'] ?></li>
                                <li class="list-group-item">Last name: <?= $r_user['lname'] ?></li>
                                <li class="list-group-item">Username: <?= $r_user['username'] ?></li>

                                <li class="list-group-item">Employee number: <?= $r_user['employee_number'] ?></li>
                                <li class="list-group-item">Address: <?= $r_user['address'] ?></li>
                                <li class="list-group-item">Date of birth: <?= $r_user['date_of_birth'] ?></li>
                                <li class="list-group-item">Phone number: <?= $r_user['phone_number'] ?></li>
                                <li class="list-group-item">Qualification: <?= $r_user['qualification'] ?></li>
                                <li class="list-group-item">Email address: <?= $r_user['email_address'] ?></li>
                                <li class="list-group-item">Date of joined: <?= $r_user['date_of_joine'] ?></li>
                                <li class="list-group-item">Gender: <?= $r_user['gender'] ?></li>
                                

                            </ul>
                            <div class="card-body">
                                <a href="register-office.php" class="card-link">Go Back</a>
                            </div>
                        </div>
                    </div>

                <?php
                } else {
                    header("Location: register-office.php");
                    exit;
                } ?>



                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                <!-- jquery -->
                <script>
                    $(document).ready(function() {
                        $("#navLinks li:nth-child(7) a").addClass('active')
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
        header("Location:../login.php");
        exit;
    }
} else {
    header("Location:../login.php");
    exit;
} ?>