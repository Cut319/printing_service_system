<?php

    session_start();

    if(!isset($_SESSION['cusHp']))
    {
        header('Location: cus_login.php');
        exit();
    }
    include 'Database.php';
    include 'Service.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        $serviceId = $_GET['serviceId'];
        
        $database = new Database();
        $db = $database->getConnection();

        $service = new Service($db);
        $serviceDetails = $service->getService($serviceId);

        $db->close();
       
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add to Cart</title>
    </head>

    <body>
        <h1>Add to Cart</h1>
        <a href="cus_home.php">Home</a>
        <form action="cart_add.php" method="post" enctype="multipart/form-data">

            <br>
            <input type="hidden" name="serviceId" value="<?php echo $serviceDetails['serviceId']; ?>">
            <input type="hidden" name="serviceName" value="<?php echo $serviceDetails['serviceName']; ?>">
            <input type="hidden" name="serviceColour" value="<?php echo $serviceDetails['serviceColour']; ?>">
            <input type="hidden" name="serviceSide" value="<?php echo $serviceDetails['serviceSide']; ?>">
            <input type="hidden" name="servicePrice" value="<?php echo $serviceDetails['servicePrice']; ?>">
            <input type="hidden" name="cusHp" value="<?php echo $_SESSION['cusHp']; ?>">
            <?php 
                echo("Service Name: $serviceDetails[serviceName] <br>"); 
                echo("Service Colour: $serviceDetails[serviceColour] <br>"); 
                echo("Service Side: $serviceDetails[serviceSide] <br>"); 
                echo("Service Price: $serviceDetails[servicePrice] <br>"); 
            ?>
            <br>
            <label for="cusFile">Files:</label>
            <input type="file" name="cusFile" id="cusFile" required><br><br>

            <label for="noCopies">Number of Copies:</label><br>
            <input type="number" name="noCopies" id="noCopies" min="1" required><br>

            <label for="noPages">Number of Pages (per file):</label><br>
            <input type="number" name="noPages" id="noPages" min="1" required><br>

            <label for="notes">Notes:</label><br>
            <textarea name="notes" id="notes" rows="3" cols="25"></textarea><br>

            <input type="submit" value="Add to Cart">
            </form>
        </body>

        </html>
    <?php
    }
?>