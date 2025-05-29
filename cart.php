<?php
class Cart
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

     public function createCart($serviceId, $serviceName, $servicePrice, $serviceSide, $serviceColour, $cusFile, $noCopies, $noPages, $notes, $cusHp)
     {
 
         $sql = "INSERT INTO carts (serviceId, serviceName, servicePrice, serviceSide, serviceColour, cusFile, noCopies, noPages, notes, cusHp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
 
             $stmt->bind_param("ssdsssiiss", $serviceId, $serviceName, $servicePrice, $serviceSide, $serviceColour, $cusFile, $noCopies, $noPages, $notes, $cusHp);
             $result = $stmt->execute();
 
             if ($result) {
                 header('Location:cus_home.php');
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
 

   
    public function getCarts()
    {
        $sql = "SELECT * FROM carts";
        $result = $this->conn->query($sql);
        return $result;
    }

 
    public function getCart($cartId)
    {
        $sql = "SELECT * FROM carts WHERE cartId = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $cartId);
            $stmt->execute();
            $result = $stmt->get_result();
            $cart = $result->fetch_assoc();

            $stmt->close();
            return $cart;
        } else {
            return "Error: " . $this->conn->error;
        }
    }


    public function updateCart($cartId, $noCopies, $noPages, $notes)
    {
        $sql = "UPDATE carts SET noCopies = ?, noPages = ?, notes = ? WHERE cartId = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {

            $stmt->bind_param("iisi", $noCopies, $noPages, $notes, $cartId);
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


    public function deleteCart($cartId)
    {
        $sql = "DELETE FROM carts WHERE cartId = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $cartId);
            $result = $stmt->execute();

            if ($result) {
                header('Location:cart_view.php');
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