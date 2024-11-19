<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '1') {

        if (isset($_POST['section'])) {

            // connect data
            include "../../DB_connection.php";

            $section = $_POST['section'];
            $data = 'section=' . $section;


            if (empty($section)) {
                $em = "Section is required";
                header("Location:../section-add.php?error=$em&$data");
                exit;
            } else {
                $sql = "INSERT INTO section(section) VALUES(?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$section]);

                $sm = "New section create successfully";
                header("Location:../section-add.php?success=$sm");
                exit;

                // echo "Okey";

            }
        } else {
            $em = "An error occurred";
            header("Location:../section-add.php?error=$em");
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
