<?php
    session_start();

    if(!isset($_SESSION['cusHp']))
    {
        header('Location: cus_login.php');
        exit();
    }


    include 'database.php';
    include 'service.php';
    include 'customer.php';

    $database = new Database();
    $db = $database->getConnection();

    $service = new Service($db);
    $result = $service->getServices();

    $customer = new Customer($db);
    $result2 = $customer->getCustomer($_SESSION['cusHp']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">                      
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>Mirza Mart Printing Service</h1>

    <a href="cus_profile.php">Profile</a>
    <a href="cart_view.php">Cart</a>
    <a href="orders_cus_view.php">Order</a>
    <input type="button" value="Logout" onclick="window.location.href='cus_logout.php'"/>

    <h4>Select to Add to Cart</h4>

    <table border="1">
        <tr>
            <th colspan="2">Name</th>
            <th>Number of sides</th>
            <th>Colour</th>
            <th>Price</th>
            <th>Action</th> 
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

                    <td><a href="cart_add_form.php?serviceId=<?php echo $row["serviceId"]; ?>">Select</a></td>

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