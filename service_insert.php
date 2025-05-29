<?php
include 'database.php';
include 'service.php';

$database = new Database();
$db = $database->getConnection();

$service = new Service($db);

$service->createService($_POST['serviceId'], $_POST['serviceName'], $_POST['servicePrice'], $_POST['serviceSide'], $_POST['serviceColour']);

$db->close();

?>