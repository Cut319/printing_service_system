<?php
class Service
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createService($serviceId, $serviceName, $servicePrice, $serviceSide, $serviceColour)
    {

        $sql = "INSERT INTO services (serviceId, serviceName, servicePrice, serviceSide, serviceColour) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssdss", $serviceId, $serviceName, $servicePrice, $serviceSide, $serviceColour);
            $result = $stmt->execute();

            if ($result) {
                header('Location:admin_home.php');
                exit();
                return true;
            } else {
                return "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    public function getServices()
    {
        $sql = "SELECT * FROM services";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function getService($serviceId)
    {
        $sql = "SELECT * FROM services WHERE serviceId = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $serviceId);
            $stmt->execute();
            $result = $stmt->get_result();
            $service = $result->fetch_assoc();

            $stmt->close();
            return $service;
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    public function updateService($serviceId, $serviceName, $servicePrice, $serviceSide, $serviceColour)
    {
        $sql = "UPDATE services SET serviceName = ?, servicePrice = ?, serviceSide = ?, serviceColour = ? WHERE serviceId = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sdsss", $serviceName, $servicePrice, $serviceSide, $serviceColour, $serviceId);
            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                return "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    public function deleteService($serviceId)
    {
        $sql = "DELETE FROM services WHERE serviceId = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $serviceId);
            $result = $stmt->execute();

            if ($result) {
                header('Location:service_view.php');
                exit();
                return true;
            } else {
                return "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    public function countServices(){
        $sql = "SELECT COUNT(*) as total FROM services";
        $result = $this->conn->query($sql);
        return $result;
    }
}