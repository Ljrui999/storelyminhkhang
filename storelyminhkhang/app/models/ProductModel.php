<?php
require_once 'app/config/database.php';

class ProductModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // 1. Lấy tất cả sản phẩm
    public function getAllProducts() {
        $query = "SELECT p.*, c.name as category_name 
                  FROM product p 
                  LEFT JOIN category c ON p.category_id = c.id
                  ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Lấy 1 sản phẩm theo ID (Dùng cho trang Sửa)
    public function getProductById($id) {
        $query = "SELECT * FROM product WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 3. Thêm sản phẩm (Đã thêm biến $image)
    public function addProduct($name, $description, $price, $image, $category_id) {
        $query = "INSERT INTO product (name, description, price, image, category_id) 
                  VALUES (:name, :description, :price, :image, :category_id)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category_id', $category_id);
        
        return $stmt->execute();
    }

    // 4. Cập nhật sản phẩm
    public function updateProduct($id, $name, $description, $price, $image, $category_id) {
        $query = "UPDATE product 
                  SET name = :name, description = :description, price = :price, image = :image, category_id = :category_id 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category_id', $category_id);
        
        return $stmt->execute();
    }
    // Hàm tìm kiếm sản phẩm theo tên
    public function searchProducts($keyword) {
        $query = "SELECT p.*, c.name as category_name 
                FROM product p 
                LEFT JOIN category c ON p.category_id = c.id
                WHERE p.name LIKE :keyword
                ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($query);
        
        // Thêm dấu % để tìm kiếm các từ chứa keyword
        $keyword = "%{$keyword}%"; 
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Lấy danh sách sản phẩm theo ID Danh mục
    public function getProductsByCategory($category_id) {
        $query = "SELECT p.*, c.name as category_name 
                FROM product p 
                LEFT JOIN category c ON p.category_id = c.id
                WHERE p.category_id = :category_id
                ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>