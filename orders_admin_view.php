<?php

session_start();

if(!isset($_SESSION['adminId']))
{
    header('Location: admin_login.php');
    exit();
}

include 'Database.php';
include 'orders.php';

$database = new Database();
$db = $database->getConnection();

$orders = new Orders($db);
$result = $orders->getOrders();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders</title>
</head>

<body>
    <h1>All Orders</h1>
    <a href="admin_home.php">Home</a>
    <table border="1">
        <tr>
            <th>Customer Phone No</th>
            <th>Order Id</th>
            <th>Order Time</th>
            <th>Service</th>
            <th>Files</th>
            <th>No. Copies</th>
            <th>No. Pages</th>
            <th>Total (RM)</th>
            <th>Payment Method</th>
            <th>Order Status</th>
            <th>Payment Status</th>
            <th>Pick Up Time</th>
            <th>Notes</th>
            <th>Order</th>
            <th>Payment</th>

        </tr>
        <?php
        if ($result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['cusHp']?></td>
                    <td><?php echo $row["orderId"]; ?></td>
                    <td><?php echo $row["orderTime"];?></td>
                    <td><?php echo $row["Service"]; ?></td>
                    <td>
                        <?php 
                            $path = 'upload/';
                            $filePath = $path . $row['cusFile'];
                            $downloadExtensions = ['doc', 'ppt', 'txt']; 
                        ?>
         
                        <?php if (file_exists($filePath)): ?>
                                <?php $extension = pathinfo($filePath, PATHINFO_EXTENSION); ?>

                                <?php if (in_array($extension, $downloadExtensions)): ?>
                                <a href="download.php?cusFile=<?php echo $row['cusFile']; ?>"><?php echo $row['cusFile']; ?></a><br>
                                <?php else: ?>
                                    <a href="<?php echo $filePath; ?>"></a>
                                <?php endif; ?>
                        <?php endif; ?> 
                    </td>
                    <td><?php echo $row["noCopies"]; ?></td>
                    <td><?php echo $row["noPages"]; ?></td>
                    <td><?php echo $row["total"]; ?></td>
                    <td><?php echo $row["payMethod"]; ?></td>
                    <td><?php echo $row["orderStatus"]; ?></td>
                    <td><?php echo $row["payStatus"]; ?></td>
                    <td><?php echo $row["pickupTime"]; ?></td>
                    <td><?php echo $row["notes"]; ?></td>
                    <td><a href="orders_update_form.php?orderId=<?php echo $row["orderId"]; ?>">Update Status</a></td>
                    <td><a href="payment_update_form.php?orderId=<?php echo $row["orderId"]; ?>">Update Status</a></td>         
                </tr>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='3'>No users found</td></tr>";
        }
        
        $db->close();
        ?>
    </table>
</body>

</html>