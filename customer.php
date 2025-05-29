<?php

class Customer{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function createCustomer($cusHp, $cusName, $cusPw){
        
        $cusPw = password_hash($cusPw, PASSWORD_DEFAULT);

        $sql = "INSERT INTO customers (cusHp, cusName, cusPw) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if($stmt){
            $stmt->bind_param("sss", $cusHp, $cusName, $cusPw);
            $result = $stmt->execute();

            if($result){
                header('Location:cus_login.php');
                exit();
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

    public function getCustomer($cusHp){
        $sql = "SELECT * FROM customers WHERE cusHp = ?";
        $stmt = $this->conn->prepare($sql);

        if($stmt){
            $stmt->bind_param("s", $cusHp);
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

    public function getCustomers()
    {
        $sql = "SELECT cusHp, cusName FROM customers";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function countCustomers(){
        $sql = "SELECT COUNT(*) as total FROM customers";
        $result = $this->conn->query($sql);
        return $result;
    }
}
?>