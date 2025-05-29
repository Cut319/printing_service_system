<?php
session_start();

if(!isset($_SESSION['adminId']))
    {
        header('Location: admin_login.php');
        exit();
    }

include 'database.php';
include 'Admin.php';

$database = new Database();
$db = $database->getConnection();

$admin = new Admin($db);
$result = $admin->getAdmins();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Admins</title>

    <style>
        table, th, tr, td{
            border: 1px solid black;
        }   
    </style>
</head>
<body>
    <h1>All Admins</h1>
    <a href="admin_home.php">Home</a>
    <table>
        <tr>
            <th>Admin Id</th>
            <th>Name</th>
            <th>Position</th>
        </tr>
        <?php
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['adminId'];?></td>
            <td><?php echo $row['adminName'];?></td>
            <td><?php echo $row['position'];?></td>
        </tr>
        <?php
                }
            } else {
                echo "<tr><td colspan='3'>No admins found</td></tr>";
            }
        ?>
    </table>
    
</body>
</html>