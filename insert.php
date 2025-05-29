<?php
include 'database.php';
include 'admin.php';

$database = new Database();
$db = $database->getConnection();

$admin = new Admin($db);

$admin->createAdmin($_POST['adminId'], $_POST['adminName'], $_POST['position'], $_POST['adminPw']);

$db->close();

?>