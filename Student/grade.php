<?php session_start();
if (isset($_SESSION['student_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '3') {
        include "../DB_connection.php";

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

            <title>Student - Grade Summary</title>
        </head>

        <body>
            <!-- Navbar -->
            <?php include "inc/navbar.php" ?>

            <div class="d-flex flex-column justify-content-center align-items-center pt-4">
                <h4>Yesr 2024 -Semester I</h4>
                <div class="table-responsive">
                    <table class="table table-bordered mt-3 n-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Course Code</th>
                                <th scope="col">Course Title</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Results</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Phy01</td>
                                    <td>Physiscs</td>
                                    <th>B+</th>
                                    <td>
                                        <small class="border p-1">10/10</small> &nbsp;
                                        <small class="border p-1">20/20</small> &nbsp;
                                        <small class="border p-1">15/30</small> &nbsp;
                                        <small class="border p-1">40/40</small> 
                                    </td>
                                    <th>85</th>
                                    
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Phy01</td>
                                    <td>Physiscs</td>
                                    <th>B+</th>
                                    <td>
                                        <small class="border p-1">10/10</small> &nbsp;
                                        <small class="border p-1">20/20</small> &nbsp;
                                        <small class="border p-1">15/30</small> &nbsp;
                                        <small class="border p-1">40/40</small> 
                                    </td>
                                    <th>85</th>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Phy01</td>
                                    <td>Physiscs</td>
                                    <th>B+</th>
                                    <td>
                                        <small class="border p-1">10/10</small> &nbsp;
                                        <small class="border p-1">20/20</small> &nbsp;
                                        <small class="border p-1">15/30</small> &nbsp;
                                        <small class="border p-1">40/40</small> 
                                    </td>
                                    <th>85</th>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Phy01</td>
                                    <td>Physiscs</td>
                                    <th>B+</th>
                                    <td>
                                        <small class="border p-1">10/10</small> &nbsp;
                                        <small class="border p-1">20/20</small> &nbsp;
                                        <small class="border p-1">15/30</small> &nbsp;
                                        <small class="border p-1">40/40</small> 
                                    </td>
                                    <th>85</th>
                                </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <!-- jquery -->
            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(2) a").addClass('active')
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