<?php
session_start();
if (isset($_SESSION['student_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '3') {

        if (isset($_POST['old_pass']) && isset($_POST['new_pass']) && isset($_POST['c_new_pass'])) {

            // connect data
            include "../../DB_connection.php";
            include "../data/student.php";

            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];
            $c_new_pass = $_POST['c_new_pass'];
            $student_id = $_SESSION['student_id'];


            if (empty($old_pass)) {
                $em = "Old password is required";
                header("Location:../pass.php?perror=$em");
                exit;
            } else if (empty($new_pass)) {
                $em = "New password is required";
                header("Location:../pass.php?perror=$em");
                exit;
            } else if (empty($c_new_pass)) {
                $em = "Confirm new password is required";
                header("Location:../pass.php?perror=$em");
                exit;
            } else if ($new_pass !== $c_new_pass) {
                $em = "New password and confirm password is required";
                header("Location:../pass.php?perror=$em");
                exit;
            }else if (!studentasswordVerify($old_pass,$conn,$student_id)) {
                $em = "Incorrect old password";
                header("Location:../pass.php?perror=$em");
                exit;
            } else {
                // hasing the password
                $new_pass = password_hash($new_pass,PASSWORD_DEFAULT);

                $sql = "UPDATE students SET password= ? WHERE student_id=? ";

                $stmt = $conn->prepare($sql);
                $stmt->execute([$new_pass, $student_id]);

                $sm = "The password has been change successfully!";
                header("Location:../pass.php?psuccess=$sm");
                exit;
            }
        } else {
            $em = "An error occurred";
            header("Location:../pass.php?error=$em");
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
