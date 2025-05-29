<?php

class Admin{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function createAdmin($adminId, $adminName, $position, $adminPw){
        
        $adminPw = password_hash($adminPw, PASSWORD_DEFAULT);

        $sql = "INSERT INTO admins (adminId, adminName, position, adminPw) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if($stmt){
            $stmt->bind_param("ssss", $adminId, $adminName, $position, $adminPw);
            $result = $stmt->execute();

            if($result){
                header('Location:admin_home.php');
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

    public function getAdmin($adminId){
        $sql = "SELECT * FROM admins WHERE adminId = ?";
        $stmt = $this->conn->prepare($sql);

        if($stmt){
            $stmt->bind_param("s", $adminId);
            $stmt->execute();
            $result = $stmt->get_result();
            $admin = $result->fetch_assoc();

            $stmt->close();
            return $admin;
        }
        else{
            return "Error: ".$this->conn->error;
        }
    }

    
    public function getAdmins()
    {
        $sql = "SELECT adminId, adminName, position FROM admins";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function countAdmins(){
        $sql = "SELECT COUNT(*) as total FROM admins";
        $result = $this->conn->query($sql);
        return $result;
    }

}
?>