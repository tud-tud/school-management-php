<?php session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && isset($_GET['class_id'])) {
    if ($_SESSION['role'] == '1') {
        include "../DB_connection.php";
        include "data/class.php";

        $id = $_GET['class_id'];

        if (removeClass($id, $conn)) {
            $sm = "Successfully deleted";
            header("Location: class.php?success=$sm");
            exit;
        } else {
            $em = "Unknow error occured";
            header("Location: class.php?error=$em");
            exit;
        }
    } else {
        header("Location:class.php");
        exit;
    }
} else {
    header("Location:class.php");
    exit;
}