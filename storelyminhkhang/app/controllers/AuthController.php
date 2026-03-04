<?php
require_once 'app/models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        $error = '';

        // --- BẮT THÔNG BÁO LỖI TỪ GIỎ HÀNG TRUYỀN SANG ---
        if (isset($_SESSION['error_msg'])) {
            $error = $_SESSION['error_msg'];
            unset($_SESSION['error_msg']); // Hiển thị xong thì xóa đi để không bị hiện lại mãi
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            $user = $this->userModel->login($username, $password);

            if ($user) {
                // Đăng nhập thành công
                $_SESSION['user'] = $user;
                header("Location: /STORELYMINHKHANG"); 
                exit();
            } else {
                $error = "Sai tài khoản hoặc mật khẩu!";
            }
        }

        // Hiển thị form đăng nhập
        require_once 'app/views/shares/header.php';
        require_once 'app/views/auth/login.php';
        require_once 'app/views/shares/footer.php';
    }

    public function logout() {
        session_destroy(); // Xóa phiên đăng nhập
        header("Location: /STORELYMINHKHANG");
        exit();
    }
    // Xử lý đăng ký
    public function register() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $re_password = $_POST['re_password'];

            if ($password !== $re_password) {
                $error = "Mật khẩu nhập lại không khớp!";
            } elseif ($this->userModel->checkUserExists($username)) {
                $error = "Tài khoản này đã có người sử dụng. Vui lòng chọn tên khác!";
            } else {
                // Thực hiện lưu
                if ($this->userModel->register($username, $password)) {
                    $success = "Đăng ký thành công! Bạn có thể đăng nhập ngay.";
                } else {
                    $error = "Có lỗi xảy ra, vui lòng thử lại sau.";
                }
            }
        }

        require_once 'app/views/shares/header.php';
        require_once 'app/views/auth/register.php';
        require_once 'app/views/shares/footer.php';
    }
}
?>