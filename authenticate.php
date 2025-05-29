<?php

    session_start();

    include 'database.php';
    include 'admin.php';

    if(isset($_POST['submit'])&&($_SERVER['REQUEST_METHOD'] == 'POST')){
        $database = new Database();
        $db = $database->getConnection();

        $adminId = $db->real_escape_string($_POST['adminId']);
        $adminPw = $db->real_escape_string($_POST['adminPw']);

        if(!empty($adminId) && !empty($adminPw)){
            $admin = new Admin($db);
            $adminDetails = $admin->getAdmin($adminId);

            if($adminDetails && password_verify($adminPw, $adminDetails['adminPw'])){
                $_SESSION['adminId'] = $adminDetails['adminId'];
                header('Location:admin_home.php');
                exit();
            }
            else{
                echo("Failed login. Please try again");
            }
        }
        else{
            echo("Please fill in all required fields.");
        }
    }




?>