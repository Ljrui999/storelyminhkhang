<div class="row justify-content-center mt-4 mb-5">
    <div class="col-md-8">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header text-white text-center py-3" style="background-color: #d70018;">
                <h4 class="mb-0 fw-bold"><i class="fa-solid fa-truck-fast me-2"></i>Thông tin giao hàng</h4>
            </div>
            <div class="card-body p-4 p-md-5">
                
                <?php if(!empty($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <div class="alert alert-info text-center mb-4 rounded-3">
                    <?php 
                        $total = 0;
                        foreach($_SESSION['cart'] as $item) {
                            $total += $item['price'] * $item['quantity'];
                        }
                    ?>
                    <h5 class="mb-0">Tổng thanh toán: <span class="fw-bold text-danger fs-4"><?= number_format($total, 0, ',', '.') ?> VNĐ</span></h5>
                </div>

                <form method="POST" action="/STORELYMINHKHANG/cart/checkout">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Họ và tên người nhận</label>
                        <input type="text" name="fullname" class="form-control form-control-lg bg-light" placeholder="Nhập họ và tên..." value="<?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['username']) : '' ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control form-control-lg bg-light" placeholder="Nhập số điện thoại liên hệ..." required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Địa chỉ nhận hàng chi tiết</label>
                        <textarea name="address" class="form-control bg-light" rows="3" placeholder="Số nhà, Tên đường, Phường/Xã, Quận/Huyện, Tỉnh/Thành phố..." required></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn text-white btn-lg fw-bold rounded-pill shadow-sm py-3" style="background-color: #d70018;">
                            XÁC NHẬN ĐẶT HÀNG
                        </button>
                        <a href="/STORELYMINHKHANG/cart" class="btn btn-light btn-lg rounded-pill mt-2">Quay lại giỏ hàng</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>