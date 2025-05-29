<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
</head>
<body>

<h1>Mirza Mart Customer Login Page</h1>
<form action="cus_authenticate.php" method="POST">
    <label for="cusHp">Customer Phone Number</label><br>
    <input type="text" name="cusHp" id="cusHp" required><br>
    <label for="cusPw">Password</label><br>
    <input type="password" name="cusPw" id="cusPw" required><br><br>
    <input type="reset" name="reset" value="Reset">
    <input type="submit" name="submit" value="Login"><br><br>

    No account? Please <a href="customer_register.php">register</a>.

</form>
    
</body>
</html>