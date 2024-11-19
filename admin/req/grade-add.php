<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '1') {

        if (isset($_POST['grade_code']) && isset($_POST['grade'])) {

            // connect data
            include "../../DB_connection.php";

            $grade_code = $_POST['grade_code'];
            $grade = $_POST['grade'];
            
            $data = 'grade_code=' . $grade_code . '&grade=' . $grade;

            if (empty($grade_code)) {
                $em = "Grade code is required";
                header("Location:../grade-add.php?error=$em&$data");
                exit;
            } else if (empty($grade)) {
                $em = "Grade is required";
                header("Location:../grade-add.php?error=$em&$data");
                exit;
            } else {
                $sql = "INSERT INTO grades(grade, grade_code) VALUES(?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$grade,$grade_code]);

                $sm = "New grade create successfully";
                header("Location:../grade-add.php?success=$sm");
                exit;

            }
        } else {
            $em = "An error occurred";
            header("Location:../grade-add.php?error=$em");
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
