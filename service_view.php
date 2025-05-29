<?php

session_start();

    if(!isset($_SESSION['adminId']))
{
    header('Location: admin_login.php');
    exit();
}
include 'Database.php';
include 'Service.php';

$database = new Database();
$db = $database->getConnection();

$service = new Service($db);
$result = $service->getServices();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services List</title>
</head>

<body>
    <h1>All Services</h1>
    <a href="admin_home.php">Home</a>
    <table border="1">
        <tr>
            <th>Service Id</th>
            <th>Name</th>
            <th>Number of sides</th>
            <th>Colour</th>
            <th>Price</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
      
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["serviceId"]; ?></td>
                    <td><?php echo $row["serviceName"]; ?></td>
                    <td><?php echo $row["serviceSide"]; ?></td>
                    <td><?php echo $row["serviceColour"]; ?></td>
                    <td><?php echo $row["servicePrice"]; ?></td>
                    
                    <td><a href="service_update_form.php?serviceId=<?php echo $row["serviceId"]; ?>">Update</a></td>
                    <td><a href="service_delete.php?serviceId=<?php echo $row["serviceId"]; ?>">Delete</a></td>

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