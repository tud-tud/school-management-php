<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == '1') {

        if (isset($_POST['grade_code']) && isset($_POST['grade'])&& isset($_POST['grade_id'])) {

            // connect data
            include "../../DB_connection.php";

            $grade_code = $_POST['grade_code'];
            $grade = $_POST['grade'];
            $grade_id = $_POST['grade_id'];
          


            $data = 'grade_id=' . $grade_id;

            if (empty($grade_code)) {
                $em = "Grade codei s required";
                header("Location:../grade-edit.php?error=$em&$data");
                exit;
            } else if (empty($grade)) {
                $em = "Grade is required";
                header("Location:../grade-edit.php?error=$em&$data");
                exit;
            }  else {
                $sql = "UPDATE grades SET grade= ?, grade_code=? WHERE grade_id=? ";

                $stmt = $conn->prepare($sql);
                $stmt->execute([$grade,$grade_code,$grade_id]);

                $sm = "Successfully updated!";
                header("Location:../grade-edit.php?success=$sm&$data");
                exit;

                // echo "Okey!!";
                
                

            }
        } else {
            $em = "An error occurred";
            header("Location:../grade-edit.php?error=$em");
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
