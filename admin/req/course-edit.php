<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '1') {

        if (isset($_POST['grade']) && isset($_POST['course_name']) && isset($_POST['course_code']) && isset($_POST['course_id'])) {

            // connect data
            include "../../DB_connection.php";

            $course_name = $_POST['course_name'];
            $course_code = $_POST['course_code'];
            $grade = $_POST['grade'];
            $course_id = $_POST['course_id'];



            $data = 'course_id=' . $course_id;

            if (empty($course_name)) {
                $em = "Course name is required";
                header("Location:../course-edit.php?error=$em&$data ");
                exit;
            } else if (empty($course_code)) {
                $em = "Course code is required";
                header("Location:../course-edit.php?error=$em&$data");
                exit;
            } else if (empty($grade)) {
                $em = "Grade is required";
                header("Location:../course-edit.php?error=$em&$data");
                exit;
            } else {

                // check the class already exists
                $sql_check = "SELECT * FROM courses WHERE grade=? AND course_code=?";
                $stmt_check = $conn->prepare($sql_check);
                $stmt_check->execute([$grade, $course_code]);
                if ($stmt_check->rowCount() > 0) {
                    $courses = $stmt_check->fetch();
                    if ($courses['course_id'] == $course_id) {
                        $sql = "UPDATE courses SET grade= ?, course_name=?,course_code=? WHERE course_id=? ";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([$grade, $course_name, $course_code, $course_id]);

                        $sm = "Successfully updated!";
                        header("Location:../course-edit.php?success=$sm&$data");
                        exit;
                    } else {
                        $em = "The Course already exists";
                        header("Location:../course-add.php?error=$em&$data");
                        exit;
                    }
                } else {
                    $sql = "UPDATE courses SET grade= ?, course_name=?,course_code=? WHERE course_id=? ";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$grade, $course_name, $course_code, $course_id]);

                    $sm = "Successfully updated!";
                    header("Location:../course-edit.php?success=$sm&$data");
                    exit;
                }
            }
        } else {
            $em = "An error occurred";
            header("Location:../course-edit.php?error=$em");
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
