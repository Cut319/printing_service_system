<?php
include 'Database.php';
include 'Service.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $serviceId = $_POST['serviceId'];
    $serviceName = $_POST['serviceName'];
    $servicePrice = $_POST['servicePrice'];
    $serviceSide = $_POST['serviceSide'];
    $serviceColour = $_POST['serviceColour'];

    $database = new Database();
    $db = $database->getConnection();

    $service = new Service($db);
    $service->updateService($serviceId, $serviceName, $servicePrice, $serviceSide, $serviceColour);

    header('Location:service_view.php');
    exit();

    $db->close();
}
?>
