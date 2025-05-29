<?php

    session_start();

    if(!isset($_SESSION['adminId']))
{
    header('Location: admin_login.php');
    exit();
}
    include 'Database.php';
    include 'Orders.php';
    include 'Payment.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        $orderId = $_GET['orderId'];
        $database = new Database();
        $db = $database->getConnection();

        $orders = new Orders($db);
        $orderDetails = $orders->getOrder($orderId);

        $pay = new Payment($db);
        $payDetails = $pay->getPayment($orderId);

        $db->close();

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Payment</title>
        
    </head>

    <body>
        <h1>Update Payment Status</h1>
        <a href="admin_home.php">Home</a>
        <form action="payment_update.php" method="post" >

            <br>
            <?php echo "Order Id: ".$orderDetails["orderId"];?><br>
            <?php echo "Order Name: ".$orderDetails["serviceName"]; ?><br>
            <?php echo "Service Colour: ".$orderDetails["serviceColour"]; ?><br>
            <?php echo "Service Side: ".$orderDetails["serviceSide"]; ?><br>
            <?php echo "Service Price:".$orderDetails["servicePrice"]; ?><br>
            
            <label for="cusFile">File:</label>
            <?php 
                $path = 'upload/';
                $filePath = $path . $orderDetails['cusFile'];
                $downloadExtensions = ['doc', 'ppt', 'txt']; 
            ?>
         
            <?php if (file_exists($filePath)): ?>
                <?php $extension = pathinfo($filePath, PATHINFO_EXTENSION); ?>

                <?php if (in_array($extension, $downloadExtensions)): ?>
                        <a href="download.php?cusFile=<?php echo $orderDetails['cusFile']; ?>"><?php echo $orderDetails['cusFile']; ?></a><br>
                <?php else: ?>
                        <a href="<?php echo $filePath; ?>"></a>
                <?php endif; ?>
            <?php endif; ?> 
            
            <?php echo "Number of Copies:".$orderDetails["noCopies"]; ?><br>
            <?php echo "Number of Pages (per file):".$orderDetails["noPages"]; ?><br>
            <?php echo "Notes:".$orderDetails["notes"]; ?><br>
            <?php echo "Pick up time: ".$orderDetails["pickupTime"]?><br><br>

            <input type="hidden" name="orderId" value="<?php echo $orderDetails['orderId'];?>">

            <label for="payStatus">Payment Status</label>
            <select name="payStatus" id="payStatus" required>
                <option value="">Please select</option>
                <option value="Pending" <?php if ($payDetails['payStatus'] == 'Pending') echo "selected";?>>Pending</option>
                <option value="Completed" <?php if ($payDetails['payStatus'] == 'Completed') echo "selected";?>>Completed</option>
            </select><br><br>
             
            <input type="submit" value="Update Payment Status">
        </form>
    </body>
    </html>

    <?php
    }
?>