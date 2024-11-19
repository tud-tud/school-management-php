<?php session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && isset($_GET['student_id'])) {
    if ($_SESSION['role'] == '1') {
        include "../DB_connection.php";
        include "data/student.php";

        $id = $_GET['student_id'];

        if (removeStudent($id, $conn)) {
            $sm = "Successfully deleted";
            header("Location: student.php?success=$sm");
            exit;
        } else {
            $em = "Unknow error occured";
            header("Location: student.php?error=$em");
            exit;
        }
    } else {
        header("Location:student.php");
        exit;
    }
} else {
    header("Location:student.php");
    exit;
}
