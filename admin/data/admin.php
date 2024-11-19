<?php

// All Grades
function adminPasswordVerify($admin_password,$conn,$admin_id)
{
    $sql = "SELECT * FROM admin WHERE admin_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$admin_id]);

    if($stmt->rowCount() == 1){
        $admin = $stmt->fetch();
        $pass = $admin['password'];

        if(password_verify($admin_password,$pass)){
            return 1;

        }else{
            return 0;
        }
    }else{
        return 0;
    }
}