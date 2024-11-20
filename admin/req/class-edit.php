<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '1') {

        if (isset($_POST['section']) && isset($_POST['grade']) && isset($_POST['class_id'])) {

            // connect data
            include "../../DB_connection.php";

            $section = $_POST['section'];
            $grade = $_POST['grade'];
            $class_id = $_POST['class_id'];



            $data = 'class_id=' . $class_id;

            if (empty($section)) {
                $em = "Sectionis required";
                header("Location:../class-edit.php?error=$em");
                exit;
            } else if (empty($grade)) {
                $em = "Grade is required";
                header("Location:../class-edit.php?error=$em");
                exit;
            } else {

                // check the class already exists
                $sql_check = "SELECT * FROM class WHERE grade=? AND section=?";
                $stmt_check = $conn->prepare($sql_check);
                $stmt_check->execute([$grade, $section]);
                if ($stmt_check->rowCount() > 0) {
                    $em = "The class already exists";
                    header("Location:../class-edit.php?error=$em&$data");
                    exit;
                } else {
                    $sql = "UPDATE class SET grade= ?, section=? WHERE class_id=? ";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$grade, $section, $class_id]);

                    $sm = "Successfully updated!";
                    header("Location:../class-edit.php?success=$sm&$data");
                    exit;
                }
                // echo "Okey!!";



            }
        } else {
            $em = "An error occurred";
            header("Location:../class-edit.php?error=$em");
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
