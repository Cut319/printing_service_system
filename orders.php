<?php
class Orders
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

     public function createOrder($cartId, $serviceId, $serviceName, $servicePrice, $serviceSide, $serviceColour, $cusFile, $noCopies, $noPages, $notes, $cusHp, $pickupTime)
     {
 
         $sql = "INSERT INTO orders (cartId, serviceId, serviceName, servicePrice, serviceSide, serviceColour, cusFile, noCopies, noPages, notes, cusHp, pickupTime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         $stmt = $this->conn->prepare($sql);
         
         if ($stmt) {
 
            $cusFile = $_FILES['cusFile']['name'];
            $cusFile_size = $_FILES['cusFile']['size'];
            $cusFile_tmp_name = $_FILES['cusFile']['tmp_name'];
            $cusFile_folder = 'upload/'.$cusFile;

            if($cusFile_size > 2000000){
                echo("File size is too large");
             }else{
                move_uploaded_file($cusFile_tmp_name, $cusFile_folder);
             }
 
             $stmt->bind_param("issdsssiisss", $cartId, $serviceId, $serviceName, $servicePrice, $serviceSide, $serviceColour, $cusFile, $noCopies, $noPages, $notes, $cusHp, $pickupTime);
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
 
    public function getOrders()
    {
        $sql = "SELECT orders.orderId, cusHp, orderTime, CONCAT(serviceName, ' ', serviceColour, ' ', serviceSide, ' (RM ', servicePrice, ')') AS Service, cusFile, noCopies, noPages, notes, orderStatus, total, payMethod, payStatus, pickupTime FROM orders INNER JOIN payments WHERE orders.orderId = payments.orderId;";
        $result = $this->conn->query($sql);
        return $result;
    }


    public function getCusOrder($cusHp)
    {
        $sql = "SELECT orders.orderId, cusHp, orderTime, CONCAT(serviceName, ' ', serviceColour, ' ', serviceSide, ' (RM ', servicePrice, ')') AS Service, cusFile, noCopies, noPages, notes, orderStatus, total, payMethod, payStatus, pickupTime FROM orders INNER JOIN payments WHERE orders.orderId = payments.orderId AND cusHp = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $cusHp);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    public function getOrder($orderId)
    {
        $sql = "SELECT * FROM orders where orderId = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $orderId);
            $stmt->execute();
            $result = $stmt->get_result();
            $orders = $result->fetch_assoc();

            $stmt->close();
            return $orders;
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    public function getOrderId($cartId)
    {
        $sql = "SELECT orderId FROM orders WHERE cartId = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $cartId);
            $stmt->execute();
            $result = $stmt->get_result();
            $orders = $result->fetch_assoc();

            $stmt->close();
            return $orders;
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    public function updateOrder($orderStatus, $orderId)
    {
        $sql = "UPDATE orders SET orderStatus = ? WHERE orderId = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {

            $stmt->bind_param("si", $orderStatus, $orderId);
            $result = $stmt->execute();

            if ($result) {
                header('Location: orders_admin_view.php');
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

    public function countOrders(){
        $sql = "SELECT COUNT(*) as total FROM orders";
        $result = $this->conn->query($sql);
        return $result;
    }

}