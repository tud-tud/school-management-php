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
            && isset($_POST['subject'])
            && isset($_POST['classes'])
        ) {

            // connect data
            include "../../DB_connection.php";
            include "../data/teacher.php";

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
            $date_of_bitth = $_POST['date_of_birth'];


            $classes = "";
            foreach ($_POST['classes'] as $class) {
                $classes .= $class;
            }

            $subjects = "";
            foreach ($_POST['subject'] as $subject) {
                $subjects .= $subject;
            }

            $data = 'uname=' . $uname . '&fname=' . $fname . '&lname=' . $lname . '&address=' . $address . '&emn=' . $employee_number . '&ph=' . $phone_number . '&qf=' . $qualification . '&email=' . $email_address;

            if (empty($fname)) {
                $em = "First name is required";
                header("Location:../teacher-add.php?error=$em&$data");
                exit;
            } else if (empty($lname)) {
                $em = "Last name is required";
                header("Location:../teacher-add.php?error=$em&$data");
                exit;
            } else if (empty($uname)) {
                $em = "Usernamae is required";
                header("Location:../teacher-add.php?error=$em&$data");
                exit;
            } else if (!unameIsUnique($uname, $conn)) {
                $em = "Usernamae is taken! try auother";
                header("Location:../teacher-add.php?error=$em&$data");
                exit;
            } else if (empty($pass)) {
                $em = "Password is required";
                header("Location:../teacher-add.php?error=$em&$data");
                exit;
            } else if (empty($address)) {
                $em = "Address is required";
                header("Location:../teacher-add.php?error=$em&$data");
                exit;
            } else if (empty($employee_number)) {
                $em = "Employee Number is required";
                header("Location:../teacher-add.php?error=$em&$data");
                exit;
            } else if (empty($phone_number)) {
                $em = "Phone number is required";
                header("Location:../teacher-add.php?error=$em&$data");
                exit;
            } else if (empty($qualification)) {
                $em = "Qualification is required";
                header("Location:../teacher-add.php?error=$em&$data");
                exit;
            } else if (empty($email_address)) {
                $em = "Email address is required";
                header("Location:../teacher-add.php?error=$em&$data");
                exit;
            } else if (empty($gender)) {
                $em = "gender is required";
                header("Location:../teacher-add.php?error=$em&$data");
                exit;
            } else if (empty($date_of_bitth)) {
                $em = "Date of bitth is required";
                header("Location:../teacher-add.php?error=$em&$data");
                exit;
            } else {
                // hashing the password
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO teachers(username, password,class,fname,lname,subjects,address,employee_number,date_of_birth,phone_number,qualification,gender,email_address) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$uname, $pass, $classes, $fname, $lname, $subjects, $address, $employee_number, $date_of_bitth, $phone_number, $qualification, $gender, $email_address]);

                $sm = "New teacher registered successfully";
                header("Location:../teacher-add.php?success=$sm");
                exit;
            }
        } else {
            $em = "An error occurred";
            header("Location:../teacher-add.php?error=$em");
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
