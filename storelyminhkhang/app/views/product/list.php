<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <h3 class="fw-bold text-uppercase mb-0" style="color: #444;">Sản phẩm nổi bật</h3>
    
    <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
        <a href="/STORELYMINHKHANG/product/add" class="btn rounded-pill fw-bold shadow-sm text-white" style="background-color: #d70018;">
            <i class="fa-solid fa-plus me-1"></i> Thêm sản phẩm
        </a>
    <?php endif; ?>
</div>

<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $row): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-0 rounded-3 product-card">
                    <div class="p-3 text-center">
                        <img src="<?= !empty($row['image']) ? $row['image'] : 'https://via.placeholder.com/200x200/ffffff/d70018?text=No+Image' ?>" 
                             class="card-img-top rounded" 
                             alt="<?= htmlspecialchars($row['name']) ?>" 
                             style="object-fit: contain; height: 180px;">
                    </div>
                    
                    <div class="card-body d-flex flex-column pt-0">
                        <h6 class="card-title fw-bold text-dark mb-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            <?= htmlspecialchars($row['name']) ?>
                        </h6>
                        <p class="text-muted small mb-2"><i class="fa-solid fa-tag me-1"></i> <?= htmlspecialchars($row['category_name']) ?></p>
                        
                        <div class="mt-auto">
                            <h5 class="fw-bold mb-3" style="color: #d70018;">
                                <?= number_format($row['price'], 0, ',', '.') ?> ₫
                            </h5>
                            
                            <div class="d-flex justify-content-between gap-2 mt-2">
                                <a href="/STORELYMINHKHANG/product/show/<?= $row['id'] ?>" class="btn btn-outline-secondary btn-sm w-100 rounded-pill">Chi tiết</a>
                                
                                <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                                    <a href="/STORELYMINHKHANG/product/edit/<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm w-100 rounded-pill">Sửa</a>
                                <?php else: ?>
                                    <a href="/STORELYMINHKHANG/cart/add/<?= $row['id'] ?>" class="btn btn-sm w-100 rounded-pill text-white fw-bold shadow-sm" style="background-color: #d70018;">
                                        <i class="fa-solid fa-cart-plus"></i> Giỏ hàng
                                    </a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <h5 class="text-muted mt-3">Hiện chưa có sản phẩm nào trên kệ.</h5>
            <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a href="/STORELYMINHKHANG/product/add" class="btn btn-outline-danger mt-2 rounded-pill">Thêm ngay</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>