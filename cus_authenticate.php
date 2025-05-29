<?php

    session_start();

    include 'database.php';
    include 'customer.php';

    if(isset($_POST['submit'])&&($_SERVER['REQUEST_METHOD'] == 'POST')){
        $database = new Database();
        $db = $database->getConnection();

        $cusHp = $db->real_escape_string($_POST['cusHp']);
        $cusPw = $db->real_escape_string($_POST['cusPw']);

        if(!empty($cusHp) && !empty($cusPw)){
            $customer = new Customer($db);
            $cusDetails = $customer->getCustomer($cusHp);

            if($cusDetails && password_verify($cusPw, $cusDetails['cusPw'])){
                $_SESSION['cusHp'] = $cusDetails['cusHp'];
                header('Location:cus_home.php');
                exit();
            }
            else{
                echo("Failed login. Please try again.");
            }
        }
        else{
            echo("Please fill in all required fields.");
        }
    }




?>