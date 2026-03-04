<?php
require_once 'app/models/ProductModel.php';

class CartController {
    private $productModel;

    public function __construct() {
        // --- CHẶN BẢO MẬT: CHƯA ĐĂNG NHẬP THÌ KHÔNG CHO DÙNG GIỎ HÀNG ---
        if (!isset($_SESSION['user'])) {
            // Lưu lại câu thông báo để truyền sang trang Đăng nhập
            $_SESSION['error_msg'] = "Bạn cần đăng nhập tài khoản để tiếp tục mua sắm!";
            header("Location: /STORELYMINHKHANG/auth/login");
            exit();
        }

        $this->productModel = new ProductModel();
        // Khởi tạo giỏ hàng rỗng nếu chưa có
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // 1. Hiển thị trang giỏ hàng
    public function index() {
        $cart = $_SESSION['cart'];
        require_once 'app/views/shares/header.php';
        require_once 'app/views/cart/index.php';
        require_once 'app/views/shares/footer.php';
    }

    // 2. Thêm sản phẩm vào giỏ
    public function add() {
        $url = isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/')) : [];
        $id = isset($url[2]) ? $url[2] : null;

        if ($id) {
            $product = $this->productModel->getProductById($id);
            if ($product) {
                if (isset($_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id]['quantity'] += 1;
                } else {
                    $_SESSION['cart'][$id] = [
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'image' => $product['image'],
                        'quantity' => 1
                    ];
                }
            }
        }
        header("Location: /STORELYMINHKHANG/cart");
        exit();
    }

    // 3. Cập nhật số lượng
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['qty'])) {
            foreach ($_POST['qty'] as $id => $quantity) {
                if ($quantity <= 0) {
                    unset($_SESSION['cart'][$id]); 
                } elseif (isset($_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id]['quantity'] = $quantity; 
                }
            }
        }
        header("Location: /STORELYMINHKHANG/cart");
        exit();
    }

    // 4. Xóa 1 sản phẩm
    public function remove() {
        $url = isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/')) : [];
        $id = isset($url[2]) ? $url[2] : null;

        if ($id && isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header("Location: /STORELYMINHKHANG/cart");
        exit();
    }

    // 5. Thanh toán
    public function checkout() {
        if (empty($_SESSION['cart'])) {
            header("Location: /STORELYMINHKHANG");
            exit();
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once 'app/models/OrderModel.php';
            $orderModel = new OrderModel();

            $fullname = trim($_POST['fullname']);
            $phone = trim($_POST['phone']);
            $address = trim($_POST['address']);
            $user_id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : null;

            $total_money = 0;
            foreach ($_SESSION['cart'] as $item) {
                $total_money += $item['price'] * $item['quantity'];
            }

            if ($orderModel->createOrder($user_id, $fullname, $phone, $address, $total_money, $_SESSION['cart'])) {
                unset($_SESSION['cart']);
                require_once 'app/views/shares/header.php';
                echo "<div class='container mt-5 text-center'>
                        <h2 class='text-success fw-bold'><i class='fa-solid fa-circle-check mb-3' style='font-size: 4rem;'></i><br>ĐẶT HÀNG THÀNH CÔNG!</h2>
                        <p class='fs-5 mt-3'>Cảm ơn bạn đã mua sắm tại Store Lý Minh Khang.</p>
                        <p>Chúng tôi sẽ sớm liên hệ qua số điện thoại <b>$phone</b> để xác nhận đơn hàng.</p>
                        <a href='/STORELYMINHKHANG' class='btn btn-lg text-white mt-4 rounded-pill px-5' style='background-color: #d70018;'>Tiếp tục mua sắm</a>
                      </div>";
                require_once 'app/views/shares/footer.php';
                exit();
            } else {
                $error = "Có lỗi xảy ra trong quá trình đặt hàng. Vui lòng thử lại!";
            }
        }

        require_once 'app/views/shares/header.php';
        require_once 'app/views/cart/checkout.php';
        require_once 'app/views/shares/footer.php';
    }
}
?>