<?php session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role']) && isset($_GET['r_user_id'])) {
    if ($_SESSION['role'] == '1') {
        include "../DB_connection.php";
        include "data/register_office.php";

        $id = $_GET['r_user_id'];

        if (removeR_user($id, $conn)) {
            $sm = "Successfully deleted";
            header("Location: register-office.php?success=$sm");
            exit;
        } else {
            $em = "Unknow error occured";
            header("Location: register-office.php?error=$em");
            exit;
        }
    } else {
        header("Location:register-office.php");
        exit;
    }
} else {
    header("Location:register-office.php");
    exit;
}
