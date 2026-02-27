<?php
session_start();

// التحقق من وجود عناصر في السلة
$cartItems = $_SESSION['cart'] ?? [];
?>






<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="صفحة سلة المشتريات - عرض العناصر المضافة إلى السلة وإتمام عملية الشراء">
    <meta name="keywords" content="سلة مشتريات, تسوق, شراء, طلبات">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
</head>
<body>
    <div class="header">
        <h1><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'ضيف'; ?></h1>
        <div>سلة المشتريات</div>
    </div>

    <div class="cart-container">
        <?php if (!empty($cartItems)): ?>
            <div class="cart-header">
                <h2><i class="fas fa-shopping-basket"></i> سلة مشترياتك</h2>
                <span class="items-count"><?php echo count($cartItems); ?> عنصر</span>
            </div>
            
            <div class="cart-items">
                <?php 
                $total = 0;
                foreach ($cartItems as $id => $item): 
                    // تعيين قيم افتراضية للبيانات المفقودة
                    $item['sku'] = $item['sku'] ?? 'N/A';
                    $item['image'] = $item['image'] ?? 'images/default-product.jpg';
                    $item['description'] = $item['description'] ?? '';
                    
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                    <div class="cart-item" data-id="<?php echo $id; ?>">
                        <div class="product-image">
    <?php
    // المسار النسبي لمجلد الرفع
    $uploadDir = 'uploads/';
    $defaultImage = 'images/default-product.jpg';
    
    // التحقق من وجود الصورة
    $imagePath = $uploadDir . basename($item['image']);
    
    if (!empty($item['image']) && file_exists($imagePath) && is_file($imagePath)) {
        echo '<img src="'.htmlspecialchars($imagePath).'" 
              alt="'.htmlspecialchars($item['title'] ?? 'صورة المنتج').'"
              onerror="this.src=\''.$defaultImage.'\'">';
    } else {
        // استخدام الصورة الافتراضية مع تسجيل الخطأ
        error_log("صورة المنتج غير موجودة: " . $imagePath);
        echo '<img src="'.$defaultImage.'" alt="صورة افتراضية">';
    }
    ?>
</div>
                        
                        <div class="product-details">
                            <h3 class="product-title"><?php echo htmlspecialchars($item['title']); ?></h3>
                            
                            <?php if(!empty($item['description'])): ?>
                            <p class="product-description"><?php echo substr(htmlspecialchars($item['description']), 0, 100); ?>...</p>
                            <?php endif; ?>
                            
                            <div class="product-meta">
                                <span class="product-sku">رقم المنتج: <?php echo htmlspecialchars($item['sku']); ?></span>
                                <span class="availability in-stock">متوفر في المخزن</span>
                            </div>
                        </div>
                        
                        <div class="product-actions">
                            <div class="price-quantity">
                                <div class="product-price"><?php echo number_format($item['price'], 2); ?> ر.س</div>
                                
                                <div class="quantity-control">
                                    <button class="quantity-btn minus"><i class="fas fa-minus"></i></button>
                                    <input type="number" value="<?php echo $item['quantity']; ?>" min="1" class="quantity-input">
                                    <button class="quantity-btn plus"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            
                            <div class="subtotal-remove">
                                <div class="product-subtotal"><?php echo number_format($subtotal, 2); ?> ر.س</div>
                                <button class="remove-btn" title="إزالة من السلة">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="cart-summary">
                <div class="summary-card">
                    <h3>ملخص الطلب</h3>
                    
                    <div class="summary-row">
                        <span>عدد العناصر</span>
                        <span><?php echo count($cartItems); ?></span>
                    </div>
                    
                    <div class="summary-row">
                        <span>الشحن</span>
                        <span class="free-shipping">مجاني</span>
                    </div>
                    
                    <div class="summary-row total-row">
                        <span>المجموع النهائي</span>
                        <span class="total-amount"><?php echo number_format($total, 2); ?> ر.س</span>
                    </div>
                    
                    <button class="checkout-btn pulse-animation">
                        <i class="fas fa-lock"></i> إتمام الشراء الآمن
                    </button>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-cart-state">
                <div class="empty-cart-icon">
                    <i class="fas fa-shopping-basket"></i>
                </div>
                <h3>سلة المشتريات فارغة</h3>
                <p>لم تقم بإضافة أي منتجات إلى سلة التسوق بعد</p>
                <a href="MyOffers.php" class="browse-products">
                    <i class="fas fa-store-alt"></i> تصفح المنتجات
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="footer">
        <a href="MyOffers.php" class="back-link">
            <i class="fas fa-arrow-right"></i> عودة إلى التسوق
        </a>
    </div>

    <!-- إضافة JavaScript هنا -->
    <script>
// تحديث الكمية
document.querySelectorAll('.quantity-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const input = this.parentElement.querySelector('.quantity-input');
        let value = parseInt(input.value);
        
        if (this.classList.contains('minus') {
            if (value > 1) value--;
        } else {
            value++;
        }
        
        input.value = value;
        updateCartItem(this.closest('.cart-item'), value);
    });
});

// إدخال الكمية يدوياً
document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function() {
        const value = parseInt(this.value) || 1;
        this.value = value;
        updateCartItem(this.closest('.cart-item'), value);
    });
});

// حذف العنصر
document.querySelectorAll('.remove-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const cartItem = this.closest('.cart-item');
        if (confirm('هل أنت متأكد من إزالة هذا المنتج من السلة؟')) {
            removeCartItem(cartItem);
        }
    });
});

// وظيفة تحديث العنصر (AJAX)
function updateCartItem(item, quantity) {
    const itemId = item.dataset.id;
    
    fetch('update_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id: itemId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // تحديث السعر الفرعي
            const price = parseFloat(item.querySelector('.product-price').textContent);
            item.querySelector('.product-subtotal').textContent = (price * quantity).toFixed(2) + ' ر.س';
            
            // تحديث المجموع الكلي
            updateCartTotal();
        }
    })
    .catch(error => console.error('Error:', error));
}

// وظيفة حذف العنصر (AJAX)
function removeCartItem(item) {
    const itemId = item.dataset.id;
    
    fetch('remove_from_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id: itemId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            item.style.animation = 'fadeOut 0.3s ease forwards';
            setTimeout(() => {
                item.remove();
                updateCartTotal();
                
                // إذا كانت السلة فارغة الآن، عرض الحالة الفارغة
                if (document.querySelectorAll('.cart-item').length === 0) {
                    showEmptyCart();
                }
            }, 300);
        }
    })
    .catch(error => console.error('Error:', error));
}

// تحديث المجموع الكلي
function updateCartTotal() {
    let total = 0;
    
    document.querySelectorAll('.cart-item').forEach(item => {
        const subtotal = parseFloat(item.querySelector('.product-subtotal').textContent);
        total += subtotal;
    });
    
    document.querySelector('.total-amount').textContent = total.toFixed(2) + ' ر.س';
    document.querySelector('.items-count').textContent = document.querySelectorAll('.cart-item').length + ' عنصر';
}

// عرض الحالة الفارغة
function showEmptyCart() {
    const emptyCartHTML = `
        <div class="empty-cart-state">
            <div class="empty-cart-icon">
                <i class="fas fa-shopping-basket"></i>
            </div>
            <h3>سلة المشتريات فارغة</h3>
            <p>لم تقم بإضافة أي منتجات إلى سلة التسوق بعد</p>
            <a href="products.php" class="browse-products">
                <i class="fas fa-store-alt"></i> تصفح المنتجات
            </a>
        </div>
    `;
    
    document.querySelector('.cart-container').innerHTML = emptyCartHTML;
}

// تأثيرات الحركة
document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.cart-item');
    items.forEach((item, index) => {
        item.style.animationDelay = `${index * 0.1}s`;
    });
});

// إضافة تأثير الخروج
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(20px); }
    }
`;
document.head.appendChild(style);
</script>
</body>
</html>