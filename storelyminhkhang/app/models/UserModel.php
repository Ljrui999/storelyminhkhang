<?php
require_once 'app/config/database.php';

class UserModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Hàm kiểm tra đăng nhập
    public function login($username, $password) {
        $query = "SELECT * FROM user WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về thông tin user nếu đúng, false nếu sai
    }
    // Kiểm tra xem username đã tồn tại chưa
    public function checkUserExists($username) {
        $query = "SELECT id FROM user WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->rowCount() > 0; // Trả về true nếu đã có người dùng
    }

    // Đăng ký người dùng mới (Mặc định quyền 'khach')
    public function register($username, $password) {
        $query = "INSERT INTO user (username, password, role) VALUES (:username, :password, 'khach')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }
}
?>