
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h1>Mirza Mart Admin Login Page</h1>
<form action="authenticate.php" method="POST">
    <label for="adminId">Admin Id</label><br>
    <input type="text" name="adminId" id="adminId" required><br>
    <label for="password">Password</label><br>
    <input type="password" name="adminPw" id="adminPw" required><br><br>
    <input type="reset" name="reset" value="Reset">
    <input type="submit" name="submit" value="Login">
</form>
    
</body>
</html>