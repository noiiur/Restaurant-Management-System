<?php
require_once 'connection.php';

if(isset($_POST['upload'])) {
    // جلب البيانات من النموذج
    $title = mysqli_real_escape_string($con, $_POST['Title']);
    $description = mysqli_real_escape_string($con, $_POST['Description']);
    $org_price = floatval($_POST['org_price']);
    $discount = intval($_POST['Discount']);
    $cat_id = intval($_POST['cat_id']);
    $quantity = intval($_POST['Quantity']);
    $user_id = 1; // كما هو مطلوب في المشروع
    
    // معالجة ملف الصورة
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_error = $_FILES['image']['error'];
    
    // إنشاء مجلد uploads إذا لم يكن موجوداً
    $upload_dir = __DIR__ . '/uploads/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $image_upload_path = '';
    if($image_error === 0) {
        $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        
        if(in_array($image_extension, $allowed_extensions)) {
            $image_new_name = uniqid('offer_', true).'.'.$image_extension;
            $image_upload_path = 'uploads/'.$image_new_name;
            
            if(!move_uploaded_file($image_tmp, __DIR__.'/'.$image_upload_path)) {
                die("<script>alert('حدث خطأ في حفظ الصورة')</script>");
            }
        } else {
            die("<script>alert('نوع الملف غير مسموح به')</script>");
        }
    } else {
        die("<script>alert('حدث خطأ في رفع الملف')</script>");
    }
    
    // إدراج البيانات في قاعدة البيانات
    $insert_query = "INSERT INTO `offer` 
    (`Title`, `image`, `description`, `org_price`, `discount`, `cat_id`, `quantity`) 
    VALUES 
    (?, ?, ?, ?, ?, ?, ?)"; // 7 علامات استفهام فقط

    $stmt = mysqli_prepare($con, $insert_query);

    if ($stmt === false) {
    die("<script>alert('خطأ في إعداد الاستعلام: " . mysqli_error($con) . "')</script>");
}

// 7 متغيرات فقط تتناسب مع 7 علامات استفهام
$bind_result = mysqli_stmt_bind_param($stmt, "sssdiii", 
    $title, 
    $image_upload_path, 
    $description, 
    $org_price, 
    $discount, 
    $cat_id, 
    $quantity);

if(!$bind_result) {
    die("<script>alert('خطأ في ربط المعاملات: " . mysqli_stmt_error($stmt) . "')</script>");
}
    
    $execute_result = mysqli_stmt_execute($stmt);
    
    if($execute_result) {
        echo "<script>
                alert('تم إضافة العرض بنجاح');
                window.location.href = 'MyOffers.php';
              </script>";
    } else {
        echo "<script>alert('خطأ في التنفيذ: " . mysqli_stmt_error($stmt) . "')</script>";
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>