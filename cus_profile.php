<?php
session_start();

if(!isset($_SESSION['cusHp']))
{
    header('Location: cus_login.php');
    exit();
}


include 'database.php';
include 'customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);
$result = $customer->getCustomer($_SESSION['cusHp']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
</head>
<style>
    table, th, td{
        border: 1px solid black;
    }
</style>
<body>
    <h1>Customer Profile</h1>
    <a href="cus_home.php">Home</a>
    <table>
        <tr>
            <th>Phone Number</th>
            <th>Customer Name</th>
        </tr>
        <tr>
            <td><?php echo $result['cusHp'];?></td>
            <td><?php echo $result['cusName'];?></td>
        </tr>
    </table>
    
</body>
</html>