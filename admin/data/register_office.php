<?php

// All r_user
function getAllR_users($conn)
{
    $sql = "SELECT * FROM register_office";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);

    if ($stmt->rowCount() >= 1) {
        $r_users = $stmt->fetchAll();
        return $r_users;
    } else {
        return 0;
    }
}

// Get r_user By ID
function getR_userByID($r_user_id, $conn)
{
    $sql = "SELECT * FROM register_office WHERE r_user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$r_user_id]);

    if ($stmt->rowCount() == 1) {
        $r_user = $stmt->fetch();
        return $r_user;
    } else {
        return 0;
    }
}

// Check if the username Unique
function unameIsUnique($uname, $conn, $teacher_id = 0)
{
    $sql = "SELECT username, teacher_id FROM teachers WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$uname]);

    if ($teacher_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        } else {
            return 1;
        }
    } else {
        if ($stmt->rowCount() >= 1) {
            $teacher = $stmt->fetch();
            if ($teacher['teacher_id'] == $teacher_id) {
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
function removeTeacher($id, $conn)
{
    $sql = "DELETE FROM teachers WHERE teacher_id=?";
    $stmt = $conn->prepare($sql);
    $re = $stmt->execute([$id]);

    if ($re) {
        return 1;
    } else {
        return 0;
    }
}

// Search
function searchTeachers($key, $conn)
{
  
    $key = preg_replace('/(?<!\\\)([%_])/', '\\\$1',$key);
    
    $sql = "SELECT * FROM teachers WHERE 
    teacher_id LIKE ? OR
    username LIKE ? OR
    fname LIKE ? OR
    lname LIKE ? OR
    address LIKE ? OR
    gender LIKE ? 
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$key,$key,$key,$key,$key,$key]);

    if ($stmt->rowCount() == 1) {
        $teachers = $stmt->fetchAll();
        return $teachers;
    } else {
        return 0;
    }
}