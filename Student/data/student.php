<?php

// All Students
function getAllStudents($conn)
{
    $sql = "SELECT * FROM students";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);

    if ($stmt->rowCount() >= 1) {
        $students = $stmt->fetchAll();
        return $students;
    } else {
        return 0;
    }
}

// Get Teacher By ID
function getStudentByID($student_id, $conn)
{
    $sql = "SELECT * FROM students WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$student_id]);

    if ($stmt->rowCount() == 1) {
        $student = $stmt->fetch();
        return $student;
    } else {
        return 0;
    }
}


// Check if the username Unique
function unameIsUnique($uname, $conn, $student_id = 0)
{
    $sql = "SELECT username, student_id FROM students WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$uname]);

    if ($student_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        } else {
            return 1;
        }
    } else {
        if ($stmt->rowCount() >= 1) {
            $student = $stmt->fetch();
            if ($student['student_id'] == $student_id) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 1;
        }
    }
}


// Delete
function removeStudent($id, $conn)
{
    $sql = "DELETE FROM students WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $re = $stmt->execute([$id]);

    if ($re) {
        return 1;
    } else {
        return 0;
    }
}

// Verify
function studentasswordVerify($student_password,$conn,$studen_id)
{
    $sql = "SELECT * FROM students WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$studen_id]);

    if($stmt->rowCount() == 1){
        $admin = $stmt->fetch();
        $pass = $admin['password'];

        if(password_verify($student_password,$pass)){
            return 1;

        }else{
            return 0;
        }
    }else{
        return 0;
    }
}