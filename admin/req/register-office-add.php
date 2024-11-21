<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '1') {

        if (
            isset($_POST['fname'])
            && isset($_POST['lname'])
            && isset($_POST['username'])
            && isset($_POST['pass'])
            && isset($_POST['address'])
            && isset($_POST['employee_number'])
            && isset($_POST['phone_number'])
            && isset($_POST['qualification'])
            && isset($_POST['email_address'])
            && isset($_POST['gender'])
            && isset($_POST['date_of_birth'])
        ) {

            // connect data
            include "../../DB_connection.php";
            include "../data/register_office.php";

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $uname = $_POST['username'];
            $pass = $_POST['pass'];

            $address = $_POST['address'];
            $employee_number = $_POST['employee_number'];
            $phone_number = $_POST['phone_number'];
            $qualification = $_POST['qualification'];
            $email_address = $_POST['email_address'];
            $gender = $_POST['gender'];
            $date_of_birth = $_POST['date_of_birth'];

            $data = 'uname=' . $uname . '&fname=' . $fname . '&lname=' . $lname . '&address=' . $address . '&emn=' . $employee_number . '&ph=' . $phone_number . '&qf=' . $qualification . '&email=' . $email_address;

            // echo "Hello";

            if (empty($fname)) {
                $em = "First name is required";
                header("Location:../register-office-add.php?error=$em&$data");
                exit;
            } else if (empty($lname)) {
                $em = "Last name is required";
                header("Location:../register-office-add.php?error=$em&$data");
                exit;
            } else if (empty($uname)) {
                $em = "Usernamae is required";
                header("Location:../register-office-add.php?error=$em&$data");
                exit;
            } else if (!unameIsUnique($uname, $conn)) {
                $em = "Usernamae is taken! try auother";
                header("Location:../register-office-add.php?error=$em&$data");
                exit;
            } else if (empty($pass)) {
                $em = "Password is required";
                header("Location:../register-office-add.php?error=$em&$data");
                exit;
            } else if (empty($address)) {
                $em = "Address is required";
                header("Location:../register-office-add.php?error=$em&$data");
                exit;
            } else if (empty($employee_number)) {
                $em = "Employee Number is required";
                header("Location:../register-office-add.php?error=$em&$data");
                exit;
            } else if (empty($phone_number)) {
                $em = "Phone number is required";
                header("Location:../register-office-add.php?error=$em&$data");
                exit;
            } else if (empty($qualification)) {
                $em = "Qualification is required";
                header("Location:../register-office-add.php?error=$em&$data");
                exit;
            } else if (empty($email_address)) {
                $em = "Email address is required";
                header("Location:../register-office-add.php?error=$em&$data");
                exit;
            } else if (empty($gender)) {
                $em = "gender is required";
                header("Location:../register-office-add.php?error=$em&$data");
                exit;
            } else if (empty($date_of_birth)) {
                $em = "Date of bitth is required";
                header("Location:../register-office-add.php?error=$em&$data");
                exit;
            } else {
                // hashing the password
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO register_office(username, password,fname,lname,address,employee_number,date_of_birth,phone_number,qualification,gender,email_address) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$uname, $pass,  $fname, $lname, $address, $employee_number, $date_of_birth, $phone_number, $qualification, $gender, $email_address]);

                $sm = "New register office  successfully";
                header("Location:../register-office-add.php?success=$sm");
                exit;

                // echo 'Okey';
            }
        } else {
            $em = "An error occurred";
            header("Location:../register-office-add.php?error=$em");
            exit;
        }
    } else {
        header("Location:../../logout.php");
        exit;
    }
} else {
    header("Location:../../logout.php");
    exit;
}
