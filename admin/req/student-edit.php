<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '1') {

        if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['username']) && isset($_POST['student_id']) && isset($_POST['grade'])) {

            // connect data
            include "../../DB_connection.php";
            include "../data/student.php";

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $uname = $_POST['username'];
            $student_id = $_POST['student_id'];
            $grade = $_POST['grade'];

            $address = $_POST['address'];
            $gender = $_POST['gender'];
            $email_address = $_POST['email_address'];
            $date_of_birth = $_POST['date_of_birth'];
            $parent_fname = $_POST['parent_fname'];
            $parent_lname = $_POST['parent_lname'];
            $parent_phone_number = $_POST['parent_phone_number'];
            $section = $_POST['section'];

            $data = 'student_id=' . $student_id;

            if (empty($fname)) {
                $em = "First name is required";
                header("Location:../student-edit.php?error=$em&$data");
                exit;
            } else if (empty($lname)) {
                $em = "Last name is required";
                header("Location:../student-edit.php?error=$em&$data");
                exit;
            } else if (empty($uname)) {
                $em = "Usernamae is required";
                header("Location:../student-edit.php?error=$em&$data");
                exit;
            } else if (!unameIsUnique($uname, $conn, $student_id)) {
                $em = "Usernamae is taken! try auother";
                header("Location:../student-edit.php?error=$em&$data");
                exit;
            } else if (empty($address)) {
                $em = "Address is required";
                header("Location:../student-edit.php?error=$em&$data");
                exit;
            } else if (empty($email_address)) {
                $em = "Email address is required";
                header("Location:../student-edit.php?error=$em&$data");
                exit;
            } else if (empty($date_of_birth)) {
                $em = "Date of birthis required";
                header("Location:../student-edit.php?error=$em&$data");
                exit;
            } else if (empty($parent_fname)) {
                $em = "Parent first name is required";
                header("Location:../student-edit.php?error=$em&$data");
                exit;
            } else if (empty($parent_lname)) {
                $em = "Parent last name is required";
                header("Location:../student-edit.php?error=$em&$data");
                exit;
            } else if (empty($parent_phone_number)) {
                $em = "Parent phone number is required";
                header("Location:../student-edit.php?error=$em&$data");
                exit;
            } else if (empty($section)) {
                $em = "Section is required";
                header("Location:../student-edit.php?error=$em&$data");
                exit;
            } else if (empty($gender)) {
                $em = "Gender is required";
                header("Location:../student-edit.php?error=$em&$data");
                exit;
            } else {
                $sql = "UPDATE students SET username= ?, fname=?, lname=?, grade=?, section=?,address= ?,gender=?,email_address=?,date_of_birth=?,parent_fname=?,parent_lname=?,parent_phone_number=? WHERE student_id=? ";

                $stmt = $conn->prepare($sql);
                $stmt->execute([$uname, $fname, $lname, $grade, $section, $address, $gender, $email_address, $date_of_birth, $parent_fname, $parent_lname, $parent_phone_number, $student_id]);

                $sm = "Successfully updated!";
                header("Location:../student-edit.php?success=$sm&$data");
                exit;

                

            }
        } else {
            $em = "An error occurred";
            header("Location:../student-edit.php?error=$em");
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
