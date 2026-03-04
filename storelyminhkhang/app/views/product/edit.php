<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-header text-white text-center py-3" style="background-color: #0d6efd;">
                <h4 class="mb-0 fw-bold"><i class="fa-solid fa-pen-to-square me-2"></i>Cập nhật sản phẩm</h4>
            </div>
            <div class="card-body p-4 p-md-5 bg-white">
                <form method="POST" action="/STORELYMINHKHANG/product/edit/<?= $product['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Tên sản phẩm</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" class="form-control form-control-lg bg-light" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary">Danh mục</label>
                            <select name="category_id" class="form-select form-select-lg bg-light" required>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $product['category_id']) ? 'selected' : '' ?>>
                                        <?= $cat['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary">Giá bán (VNĐ)</label>
                            <input type="number" name="price" value="<?= $product['price'] ?>" class="form-control form-control-lg bg-light" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Link hình ảnh (URL)</label>
                        <input type="url" name="image" value="<?= htmlspecialchars($product['image'] ?? '') ?>" class="form-control form-control-lg bg-light" placeholder="Nhập đường dẫn ảnh mới nếu muốn thay đổi...">
                        
                        <?php if(!empty($product['image'])): ?>
                            <div class="mt-2 p-2 border rounded d-inline-block bg-light">
                                <span class="d-block small text-muted mb-1">Ảnh hiện tại:</span>
                                <img src="<?= $product['image'] ?>" alt="Preview" style="height: 80px; object-fit: contain;">
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Mô tả chi tiết</label>
                        <textarea name="description" class="form-control bg-light" rows="4"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="/STORELYMINHKHANG/product/list" class="btn btn-light btn-lg border px-4 rounded-pill">Hủy bỏ</a>
                        <button type="submit" class="btn btn-primary text-white btn-lg px-5 rounded-pill shadow-sm">Lưu cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>