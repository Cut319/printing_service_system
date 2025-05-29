<?php

class Payment{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function createPayment($total, $payMethod, $orderId){

        $sql = "INSERT INTO payments (total, payMethod, orderId) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if($stmt){
            $stmt->bind_param("dsi", $total, $payMethod, $orderId);
            $result = $stmt->execute();

            if($result){
                return true;
            }
            else{
                return "Error: ".$stmt->error;
            }
            $stmt->close();
        }
        else{
            return "Error: ".$this->conn->error;
        }
    }

    public function getPayment($orderId){
        $sql = "SELECT total, payMethod, payStatus FROM payments WHERE orderId = ?";
        $stmt = $this->conn->prepare($sql);

        if($stmt){
            $stmt->bind_param("s", $orderId);
            $stmt->execute();
            $result = $stmt->get_result();
            $customer = $result->fetch_assoc();

            $stmt->close();
            return $customer;
        }
        else{
            return "Error: ".$this->conn->error;
        }
    }

      public function updatePayment($orderId, $payStatus)
      {
          $sql = "UPDATE payments SET payStatus = ? WHERE orderId = ?";
          $stmt = $this->conn->prepare($sql);
  
          if ($stmt) {
  
              $stmt->bind_param("si", $payStatus, $orderId);
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

    }   
?>