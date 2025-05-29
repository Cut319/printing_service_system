<?php

    session_start();

    if(!isset($_SESSION['cusHp']))
    {
        header('Location: cus_login.php');
        exit();
    }

    include 'Database.php';
    include 'Cart.php';

    
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        $cartId = $_GET['cartId'];
        
        $database = new Database();
        $db = $database->getConnection();

        $cart = new Cart($db);
        $cartDetails = $cart->getCart($cartId);
        $db->close();
        
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Cart</title>
    </head>

    <body>
        <h1>Update Cart</h1>
        <a href="cart_view.php">Back to Cart</a>
        <a href="cus_home.php">Home</a>
        <form action="cart_update.php" method="post" enctype="multipart/form-data">
            <br>
            <?php echo "Service Name: ".$cartDetails["serviceName"]; ?><br>
            <?php echo "Service Colour: ".$cartDetails["serviceColour"]; ?><br>
            <?php echo "Service Side: ".$cartDetails["serviceSide"]; ?><br>
            <?php echo "Service Price:".$cartDetails["servicePrice"]; ?><br>
            
            <input type="hidden" name="cartId" value="<?php echo $cartDetails['cartId']; ?>">

            <label for="cusFile">File:</label>
            <?php 
                $path = 'upload/';
                $filePath = $path . $cartDetails['cusFile'];
                $downloadExtensions = ['doc', 'ppt', 'txt']; 
            ?>
         
            <?php if (file_exists($filePath)): ?>
                    <?php $extension = pathinfo($filePath, PATHINFO_EXTENSION); ?>

                    <?php if (in_array($extension, $downloadExtensions)): ?>
                    <a href="download.php?cusFile=<?php echo $cartDetails['cusFile']; ?>"><?php echo $cartDetails['cusFile']; ?></a><br>
                    <?php else: ?>
                        <a href="<?php echo $filePath; ?>"></a>
                    <?php endif; ?>
            <?php endif; ?> <br>
        
            <label for="noCopies">Number of Copies:</label>
            <input type="number" id="noCopies" name="noCopies" value="<?php echo $cartDetails['noCopies']; ?>" min="1" max="100" required><br>

            <label for="noPages">Number of Pages:</label>
            <input type="number" id="noPages" name="noPages" value="<?php echo $cartDetails['noPages']; ?>" min="1" max="100" required><br>

            <label for="notes">Notes:</label><br>
            <textarea name="notes" id="notes"><?php echo $cartDetails['notes'];?></textarea><br>

            <input type="submit" value="Update">
        </form>
    </body>

        </html>
    <?php
    }
?>