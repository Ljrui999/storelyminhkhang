<?php
require_once 'app/config/database.php';

class OrderModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Hàm lưu đơn hàng
    public function createOrder($user_id, $fullname, $phone, $address, $total_money, $cart) {
        try {
            // Bắt đầu transaction (đảm bảo an toàn dữ liệu, nếu lỗi sẽ hoàn tác)
            $this->conn->beginTransaction();

            // 1. Lưu vào bảng orders trước
            $queryOrder = "INSERT INTO orders (user_id, fullname, phone, address, total_money) 
                           VALUES (:user_id, :fullname, :phone, :address, :total_money)";
            $stmt = $this->conn->prepare($queryOrder);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':total_money', $total_money);
            $stmt->execute();

            // Lấy ID của đơn hàng vừa tạo xong
            $order_id = $this->conn->lastInsertId();

            // 2. Lưu từng sản phẩm vào bảng order_details
            $queryDetail = "INSERT INTO order_details (order_id, product_id, price, quantity) 
                            VALUES (:order_id, :product_id, :price, :quantity)";
            $stmtDetail = $this->conn->prepare($queryDetail);

            foreach ($cart as $item) {
                $stmtDetail->bindParam(':order_id', $order_id);
                $stmtDetail->bindParam(':product_id', $item['id']);
                $stmtDetail->bindParam(':price', $item['price']);
                $stmtDetail->bindParam(':quantity', $item['quantity']);
                $stmtDetail->execute();
            }

            // Hoàn tất transaction
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack(); // Lỗi thì hủy bỏ toàn bộ
            return false;
        }
    }
    // BỔ SUNG 1: Lấy danh sách toàn bộ đơn hàng (Sắp xếp mới nhất lên đầu)
    public function getAllOrders() {
        $query = "SELECT * FROM orders ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // BỔ SUNG 2: Lấy thông tin chung của 1 đơn hàng cụ thể
    public function getOrderById($id) {
        $query = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // BỔ SUNG 3: Lấy chi tiết các sản phẩm trong 1 đơn hàng
    public function getOrderDetails($order_id) {
        $query = "SELECT od.*, p.name as product_name, p.image 
                FROM order_details od 
                JOIN product p ON od.product_id = p.id 
                WHERE od.order_id = :order_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>