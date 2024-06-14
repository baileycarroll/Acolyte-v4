<?php

if(isset($_POST['login-submit'])) {
    require 'dbh.inc.php';

    $uid = $_POST['username'];
    $password = $_POST['pass'];

    if (empty($uid) || empty($password)) {
        header("Location: ../login.php?error=emptyfields");
        exit();  
    }
    else {
        $sql = "SELECT accounts.student_id, accounts.username, accounts.password, accounts.admin, students.membership FROM accounts JOIN students ON accounts.student_id = students.student_id WHERE accounts.username=?;";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();     
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $uid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['password']);
                if ($pwdCheck == false){
                    header("Location: ../login.php?error=invalidpassword");
                    exit(); 
                }
                else if ($pwdCheck == true) {
                    session_start();
                    
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['admin'] = $row['admin'];
                    $_SESSION['student_id'] = $row['student_id'];
                    $_SESSION['membership'] = $row['membership'];
                   

                    header("Location: ../home.php?login=success");
                    exit();

                }
                else {
                    header("Location: ../login.php?error=invalidpassword");
                    exit(); 
                }
            }
            else {
                header("Location: ../login.php?error=invaliduser");
            exit(); 
            }
        }
    }
}
else {
    header("Location: ../../index.php");
        exit();
}
?>