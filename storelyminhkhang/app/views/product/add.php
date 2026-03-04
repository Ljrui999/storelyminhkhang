<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-header text-white text-center py-3" style="background-color: #d70018;">
                <h4 class="mb-0 fw-bold"><i class="fa-solid fa-box-open me-2"></i>Thêm sản phẩm mới</h4>
            </div>
            <div class="card-body p-4 p-md-5 bg-white">
                <form method="POST" action="/STORELYMINHKHANG/product/add">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control form-control-lg bg-light" placeholder="VD: iPhone 15 Pro Max 256GB" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary">Danh mục</label>
                            <select name="category_id" class="form-select form-select-lg bg-light" required>
                                <option value="">-- Chọn danh mục --</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary">Giá bán (VNĐ)</label>
                            <input type="number" name="price" class="form-control form-control-lg bg-light" placeholder="VD: 29990000" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Link hình ảnh (URL)</label>
                        <input type="url" name="image" class="form-control form-control-lg bg-light" placeholder="Nhập đường dẫn ảnh đuôi .jpg, .png... (Copy từ web khác)">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Mô tả chi tiết</label>
                        <textarea name="description" class="form-control bg-light" rows="4" placeholder="Nhập cấu hình, tính năng nổi bật..."></textarea>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="/STORELYMINHKHANG/product/list" class="btn btn-light btn-lg border px-4 rounded-pill">Hủy bỏ</a>
                        <button type="submit" class="btn text-white btn-lg px-5 rounded-pill shadow-sm" style="background-color: #d70018;">Lưu sản phẩm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>