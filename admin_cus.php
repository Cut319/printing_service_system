<?php
session_start();

if(!isset($_SESSION['adminId']))
    {
        header('Location: admin_login.php');
        exit();
    }

include 'database.php';
include 'customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);
$result = $customer->getCustomers();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Customers</title>

    <style>
        table, th, tr, td{
            border: 1px solid black;
        }   
    </style>
</head>
<body>

<h1>All Customers</h1>
<a href="admin_home.php">Home</a>
    <table>
        <tr>
            <th>Customer Name</th>
            <th>Customer Phone Number</th>
        </tr>
        <?php
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['cusName'];?></td>
            <td><?php echo $row['cusHp'];?></td>
        </tr>
        <?php
                }
            } else {
                echo "<tr><td colspan='3'>No customers found</td></tr>";
            }
        ?>
    </table>
    
</body>
</html>