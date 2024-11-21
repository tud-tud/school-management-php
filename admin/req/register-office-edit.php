<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '1') {

        if (
            isset($_POST['fname'])
            && isset($_POST['lname'])
            && isset($_POST['username'])
            && isset($_POST['address'])
            && isset($_POST['employee_number'])
            && isset($_POST['phone_number'])
            && isset($_POST['qualification'])
            && isset($_POST['email_address'])
            && isset($_POST['gender'])
            && isset($_POST['r_user_id'])
            && isset($_POST['date_of_birth'])
        ) {

        //     // connect data
            include "../../DB_connection.php";
            include "../data/register_office.php";

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $uname = $_POST['username'];
            $r_user_id = $_POST['r_user_id'];
            $address = $_POST['address'];
            $employee_number = $_POST['employee_number'];
            $phone_number = $_POST['phone_number'];
            $qualification = $_POST['qualification'];
            $email_address = $_POST['email_address'];
            $gender = $_POST['gender'];
            $date_of_birth = $_POST['date_of_birth'];
            
            $data = 'r_user_id=' . $r_user_id;

            if (empty($fname)) {
                $em = "First name is required";
                header("Location:../register-office-edit.php?error=$em&$data");
                exit;
            } else if (empty($lname)) {
                $em = "Last name is required";
                header("Location:../register-office-edit.php?error=$em&$data");
                exit;
            } else if (empty($uname)) {
                $em = "Usernamae is required";
                header("Location:../register-office-edit.php?error=$em&$data");
                exit;
            } else if (!unameIsUnique($uname, $conn,$r_user_id)) {
                $em = "Usernamae is taken! try auother";
                header("Location:../register-office-edit.php?error=$em&$data");
                exit;
            } else if (empty($address)) {
                $em = "Address is required";
                header("Location:../register-office-edit.php?error=$em&$data");
                exit;
            } else if (empty($employee_number)) {
                $em = "Employee Number is required";
                header("Location:../register-office-edit.php?error=$em&$data");
                exit;
            } else if (empty($phone_number)) {
                $em = "Phone number is required";
                header("Location:../register-office-edit.php?error=$em&$data");
                exit;
            } else if (empty($qualification)) {
                $em = "Qualification is required";
                header("Location:../register-office-edit.php?error=$em&$data");
                exit;
            } else if (empty($email_address)) {
                $em = "Email address is required";
                header("Location:../register-office-edit.php?error=$em&$data");
                exit;
            } else if (empty($gender)) {
                $em = "gender is required";
                header("Location:../register-office-edit.php?error=$em&$data");
                exit;
            } else if (empty($date_of_birth)) {
                $em = "Date of bitth is required";
                header("Location:../register-office-edit.php?error=$em&$data");
                exit;
            } else {
                // hashing the password
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "UPDATE register_office SET username=?,fname=?,lname=?,address=?,employee_number=?,date_of_birth=?,phone_number=?,qualification=?,gender=?,email_address=? WHERE r_user_id=? ";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$uname, $fname, $lname, $address, $employee_number, $date_of_birth, $phone_number, $qualification, $gender, $email_address, $r_user_id]);

                $sm = "Update register office  successfully";
                header("Location:../register-office-edit.php?success=$sm&$data");
                exit;

            }
        } else {
            $em = "An error occurred";
            header("Location:../register-office-edit.php?error=$em");
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
