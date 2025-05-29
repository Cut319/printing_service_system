<?php

session_start();

if(!isset($_SESSION['cusHp']))
{
    header('Location: cus_login.php');
    exit();
}


include 'Database.php';
include 'Cart.php';

$database = new Database();
$db = $database->getConnection();

$cart = new Cart($db);
$result = $cart->getCarts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carts</title>
</head>

<body>
    <h1>Carts</h1>
    <a href="cus_home.php">Home</a>
    <table border="1">
        <tr>
            <th>Service Name</th>
            <th>Colour</th>
            <th>Number of sides</th>
            <th>Price</th>
            <th>Files</th>
            <th>Number of Copies</th>
            <th>Number of Pages</th>
            <th>Notes</th>
            <th colspan="3">Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
          
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["serviceName"]; ?></td>
                    <td><?php echo $row["serviceColour"]; ?></td>
                    <td><?php echo $row["serviceSide"]; ?></td>
                    <td><?php echo $row["servicePrice"]; ?></td>
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
                    <td><?php echo $row["notes"]; ?></td>
                   
                    <td><a href="cart_update_form.php?cartId=<?php echo $row["cartId"]; ?>">Update</a></td>
                    <td><a href="cart_delete.php?cartId=<?php echo $row["cartId"]; ?>">Delete</a></td>
                    <td><a href="checkout_form.php?cartId=<?php echo $row["cartId"]; ?>">Checkout</a></td>

                </tr>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='3'>No cart found</td></tr>";
        }
      
        $db->close();
        ?>
    </table>
</body>

</html>