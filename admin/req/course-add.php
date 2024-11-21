<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '1') {

        if (isset($_POST['grade']) && isset($_POST['course_name']) && isset($_POST['course_code'])) {

            // connect data
            include "../../DB_connection.php";

            $course_name = $_POST['course_name'];
            $course_code = $_POST['course_code'];
            $grade = $_POST['grade'];


            if (empty($course_name)) {
                $em = "Course name is required";
                header("Location:../course-add.php?error=$em");
                exit;
            } else if (empty($course_code)) {
                $em = "Course code is required";
                header("Location:../course-add.php?error=$em");
                exit;
            } else if (empty($grade)) {
                $em = "Grade is required";
                header("Location:../course-add.php?error=$em");
                exit;
            } else {
                // check the course already exists
                $sql_check = "SELECT * FROM courses WHERE grade=? AND course_code=?";
                $stmt_check = $conn->prepare($sql_check);
                $stmt_check->execute([$grade, $course_code]);
                if ($stmt_check->rowCount() > 0) {
                    $em = "The Course already exists";
                    header("Location:../course-add.php?error=$em");
                    exit;
                } else {
                    $sql = "INSERT INTO courses(grade, course_name,course_code) VALUES(?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$grade, $course_name, $course_code]);

                    $sm = "New course create successfully";
                    header("Location:../course-add.php?success=$sm");
                    exit;
                }
                echo "Okey";
            }
        } else {
            $em = "An error occurred";
            header("Location:../course-add.php?error=$em");
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
