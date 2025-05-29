<?php
session_start();

if(!isset($_SESSION['adminId']))
{
header('Location: admin_login.php');
exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Services </title>
</head>
<body>
    <h1>Add Photocopy and Printing Services</h1>

    <a href="admin_home.php">Home</a>

    <form action="service_insert.php" method="post">
            <label for="serviceId">Service Id</label>
            <input type="text" name="serviceId" id="serviceId" required><br>

            <label for="serviceName">Service Name</label>
            <input type="text" name="serviceName" id="serviceName" required><br>

            <label for="serviceSide">Service Side</label>
            <select name="serviceSide" id="serviceSide" required>
                <option value="">Please select</option>
                <option value="One-sided">One-sided</option>
                <option value="Double-sided">Double-sided</option>
            </select><br>

            <label for="serviceColour">Service Colour</label>
            <select name="serviceColour" id="serviceColour" required>
                <option value="">Please select</option>
                <option value="Black and White">Black and White</option>
                <option value="Colour">Colour</option>
            </select><br>

            <label for="servicePrice">Service Price</label>
            <input type="number" name="servicePrice" id="servicePrice" min="0" max="100" step="any"><br>

            <input type="reset" name="reset" value="Reset">
            <input type="submit" name="submit" value="Add Service">
    </form>
    
</body>
</html>