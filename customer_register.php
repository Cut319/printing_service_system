
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Register</title>
</head>
<body>
    <h1>Customer Register</h1>
    <form action="cus_insert.php" method="post">

        <label for="cusHp">Customer Phone Number</label><br>
        <input type="text" name="cusHp" id="cusHp" placeholder="0123456789" required><br>

        <label for="cusName">Name</label><br>
        <input type="text" name="cusName" id="cusName" required><br>

        <label for="cusPw">Password</label><br>
        <input type="password" name="cusPw" id="cusPw" required><br><br>

        <input type="reset" value="Reset">
        <input type="submit" name="submit" value="Register">    
    </form>
</body>
</html>