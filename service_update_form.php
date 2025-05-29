<?php

    session_start();

    if(!isset($_SESSION['adminId']))
{
    header('Location: admin_login.php');
    exit();
}
    include 'Database.php';
    include 'Service.php';

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Retrieve the matric value from the GET request
        $serviceId = $_GET['serviceId'];
        // Process the update using the matric value
        // For example, you can fetch the user data using the matric value and display it in a form for updating
        // Create an instance of the Database class and get the connection
        $database = new Database();
        $db = $database->getConnection();

        $service = new Service($db);
        $serviceDetails = $service->getService($serviceId);
        $db->close();
        
        // Display the update form with the fetched user data
        // Example:
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Service</title>
    </head>

    <body>
        <h1>Update Services</h1>
        <a href="admin_home.php">Home</a>
        <form action="service_update.php" method="post">

            <input type="hidden" name="serviceId" value="<?php echo $serviceDetails['serviceId']; ?>">

            <label for="serviceName">Name:</label>
            <input type="text" id="serviceName" name="serviceName" value="<?php echo $serviceDetails['serviceName']; ?>"><br>

            <label for="serviceSide">Side:</label>
            <select name="serviceSide" id="serviceSide" required>
                <option value="">Please select</option>
                <option value="One-sided" <?php if ($serviceDetails['serviceSide'] == 'One-sided') echo "selected"; ?>>One-sided</option>
                <option value="Double-sided" <?php if ($serviceDetails['serviceSide'] == 'Double-sided') echo "selected"; ?> >Double-sided</option>
            </select><br>

            <label for="serviceColour">Colour:</label>
            <select name="serviceColour" id="serviceColour" required>
                <option value="">Please select</option>
                <option value="Black and White" <?php if ($serviceDetails['serviceColour'] == 'Black and White') echo "selected"; ?>>Black and White</option>
                <option value="Colour" <?php if ($serviceDetails['serviceColour'] == 'Colour') echo "selected"; ?>>Colour</option>
            </select><br>

            <label for="servicePrice">Price:</label>
            <input type="number" id="servicePrice" name="servicePrice" value="<?php echo $serviceDetails['servicePrice']; ?>" min="0" max="100" step="any"><br>

            <input type="submit" value="Update">
            </form>
        </body>

        </html>
    <?php
    }
?>