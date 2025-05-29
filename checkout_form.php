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
        <title>Checkout</title>
        
    </head>

    <body>
        <h1>Checkout</h1>
        <a href="cart_view.php">Back to Cart</a>
        <a href="cus_home.php">Home</a>
        <form action="checkout.php" method="post" enctype="multipart/form-data">

            <br><br>
            <?php echo "Service Name: ".$cartDetails["serviceName"]; ?><br>
            <?php echo "Service Colour: ".$cartDetails["serviceColour"]; ?><br>
            <?php echo "Service Side: ".$cartDetails["serviceSide"]; ?><br>
            <?php echo "Service Price:".$cartDetails["servicePrice"]; ?><br><br>
            
            <label for="cusFile">File:</label>
            <input type="file" name="cusFile" id="cusFile" required><br>
            
            <?php echo "Number of Copies:".$cartDetails["noCopies"]; ?><br>
            <?php echo "Number of Pages (per file):".$cartDetails["noPages"]; ?><br>
            <?php echo "Notes:".$cartDetails["notes"]; ?><br>

            <input type="hidden" name="cartId" value="<?php echo $cartDetails['cartId'];?>">
            <input type="hidden" name="serviceId" value="<?php echo $cartDetails['serviceId']; ?>">
            <input type="hidden" name="serviceName" value="<?php echo $cartDetails['serviceName']; ?>">
            <input type="hidden" name="servicePrice" value="<?php echo $cartDetails['servicePrice']; ?>">
            <input type="hidden" name="serviceSide" value="<?php echo $cartDetails['serviceSide']; ?>">
            <input type="hidden" name="serviceColour" value="<?php echo $cartDetails['serviceColour']; ?>">
            <input type="hidden" name="noCopies" value="<?php echo $cartDetails['noCopies']; ?>">
            <input type="hidden" name="noPages" value="<?php echo $cartDetails['noPages']; ?>">
            <input type="hidden" name="notes" value="<?php echo $cartDetails['notes']; ?>">
            <input type="hidden" name="cusHp" value="<?php echo $cartDetails['cusHp']; ?>">

            <?php

                $total = $cartDetails['servicePrice'] * $cartDetails['noCopies'] * $cartDetails['noPages'];
                echo("Total Amount: RM $total <br>");
            ?>

            <br><br>
            <label for="payMethod">Payment Method</label>
            <select name="payMethod" id="payMethod" required>
                <option value="">Please select</option>
                <option value="Cash">Cash</option>
                <option value="TNG">TNG eWallet</option>
                <option value="Online Banking">Online Banking</option>
            </select><br>

            <input type="hidden" id="total" name="total" value="<?php echo $total; ?>">
            
            <label for="pickupTime">Pick up time: </label>
            <input type="datetime-local" id="pickupTime" name="pickupTime"><br><br>

            <input type="submit" value="Place Order">
        </form>
    </body>
    </html>

    <?php
    }
?>