<?php

session_start();

if(!isset($_SESSION['adminId']))
    {
        header('Location: admin_login.php');
        exit();
    }

include 'database.php';
include 'customer.php';
include 'service.php';
include 'Admin.php';
include 'Orders.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);
$result = $customer->countCustomers();

$service = new Service($db);
$result2 = $service->countServices();

$admin = new Admin($db);
$result3 = $admin->countAdmins();

$orders = new Orders($db);
$result4 = $orders->countOrders();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>

    <a href="admin_profile.php">Profile</a>
    <a href="service_add_form.php">Add Service</a>
    <a href="admin_register.php">Add Admin</a>

    <br><br>

    <?php 
        $totalCus = $result->fetch_assoc();
        $totalSv = $result2->fetch_assoc();
        $totalAdmin = $result3->fetch_assoc();
        $totalOrder = $result4->fetch_assoc();
    ?>

    Total Registered Admins:
    <a href="admins.php"><?php  echo $totalAdmin['total']; ?></a> <br>

    Total Registered Customers: 
    <a href="admin_cus.php"><?php  echo $totalCus['total']; ?></a> <br>

    Total Offered Services:
    <a href="service_view.php"><?php echo $totalSv['total'];?></a><br>

    Total Orders:
    <a href="orders_admin_view.php"><?php echo $totalOrder['total'];?></a><br>

    <br>
    <input type="button" value="Logout" onclick="window.location.href='admin_logout.php'"/>

</body>
</html>