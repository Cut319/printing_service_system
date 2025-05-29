<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
</head>
<body>

<h1>Register Admin</h1>
<a href="admin_home.php">Home</a>

<form action="insert.php" method="post">
    
    <label for="adminId">Admin Id</label><br>
    <input type="text" name="adminId" id="adminId" required><br>

    <label for="adminName">Name</label><br>
    <input type="text" name="adminName" id="adminName" required><br>

    <label for="position">Position</label><br>
    <input type="text" name="position" id="position" required><br>

    <label for="adminPw">Password</label><br>
    <input type="password" name="adminPw" id="adminPw" required><br><br>

    <input type="reset" value="Reset">
    <input type="submit" name="submit" value="Register">

</form>
    
</body>
</html>