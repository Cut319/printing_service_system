<?php
session_start();

if(!isset($_SESSION['adminId']))
    {
        header('Location: admin_login.php');
        exit();
    }

include 'database.php';
include 'admin.php';

$database = new Database();
$db = $database->getConnection();

$admin = new Admin($db);
$result = $admin->getAdmin($_SESSION['adminId']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
</head>
<style>
    table, th, td{
        border: 1px solid black;
    }
</style>
<body>

    <h1>Admin Profile</h1>
    <a href="admin_home.php">Home</a>
    <table>
        <tr>
            <th>Admin Id</th>
            <th>Admin Name</th>
            <th>Admin position</th>
        </tr>
        <tr>
            <td><?php echo $result['adminId'];?></td>
            <td><?php echo $result['adminName'];?></td>
            <td><?php echo $result['position'];?></td>
        </tr>
    </table>
    
</body>
</html>