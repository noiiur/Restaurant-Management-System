<?php
require_once 'connection.php';

// استعلام لجلب العروض من قاعدة البيانات
 $query = "SELECT * FROM `offer` ORDER BY `creation_date` DESC LIMIT 4"; // عرض آخر 4 عروض
$result = mysqli_query($con, $query);

// التحقق من وجود نتائج
if (!$result) {
    die("فشل في جلب العروض: " . mysqli_error($con));
}

// جلب البيانات كمصفوفة ارتباطية
$offers = [];
if (mysqli_num_rows($result) > 0) {
    $offers = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

mysqli_free_result($result);
mysqli_close($con);
?>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyOffers Website</title>
    <link rel="stylesheet" href="MyOffers.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,
	800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyOffers Website</title>

  </head>

  <body>

    <!-- header start -->
    <header>
        <div class="logo">
            <h2>MyOffers</h2>
        </div>
		<div class="search-box">
        <input type="text" placeholder="search here...">
        <i class="bx bx-search"></i>
    </div>
		<div class="account">
		    <i class='bx bxs-user'></i> 
            <a href="MyOffersRegester.html">My Account</a>
             <a href="MyOffersCreateOffer.html">add offer</a>

        </div>
        <div class="bx bx-menu active" id="menu-icon"></div>
    </header>
    <!-- header End -->

    <nav>
        <nav>
            <ul class="navbar">
              <li><a href="#home">Home</a></li>
              <li><a href="MyOffersdescription.php">Food</a></li>
              <li><a href="#auto">Auto</a></li>           
              <li><a href="#contact">Contact</a></li>
            </ul>
          </nav>
    </nav>
  
    <!-- home Start -->
    <section class="home" id="home">
        <div class="home-text">
            <h1>Discover!</h1>
            <h2>The Best Food & Auto Service In Your City</h2>
        </div>
  





        <div class="home-img">
            <img src="logo.jpg" width="100" height="500" alt="logo" >
        </div>
    </section>
    
    <section class="offers">
        <h2>Latest Offers</h2>
        <div class="offers-container">
            <div class="offer-cards">
                <?php if (!empty($offers)): ?>
                    <?php foreach ($offers as $offer): ?>
                        <div class="offer-card">
                            <img src="<?php echo htmlspecialchars($offer['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($offer['Title']); ?>">
                            <h3 class="offer-title"><?php echo htmlspecialchars($offer['Title']); ?></h3>
                            <p class="offer-description"><?php echo htmlspecialchars($offer['description']); ?></p>
                            
                            <div class="offer-price">
                                <span class="original-price"><?php echo htmlspecialchars($offer['org_price']); ?> ر.س</span>
                                <?php if ($offer['discount'] > 0): ?>
                                    <span class="discounted-price">
                                        <?php echo htmlspecialchars($offer['org_price'] - ($offer['org_price'] * $offer['discount'] / 100)); ?> ر.س
                                    </span>
                                    <span class="discount"><?php echo htmlspecialchars($offer['discount']); ?>% خصم</span>
                                <?php endif; ?>
                            </div>
                            
                            <a href="offer_details.php?id=<?php echo $offer['id']; ?>" class="offer-link">عرض التفاصيل</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-offers">
                        <p>لا توجد عروض متاحة حالياً</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- home End -->


  
    <!-- content End -->

    <section id="contact">
        <div class="footer">
            <div class="main">
				<div class="col">
                    <ul>
                        <h4>Information</h4>
                        <li><a href="https://www.example.com/faq">FAQ</a></li>
                        <li><a href="https://www.example.com/about">About Us</a></li>
                        <li><a href="https://www.example.com/terms">Terms & Conditions</a></li>
                        <li><a href="https://www.example.com/privacy">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="col">
                    <h4>Our Service Area</h4>
                    <ul>
					    <li><a href="https://maps.app.goo.gl/TwiquH1CKWSYRPwy9">Taif</a></li>
						<li><a href="https://maps.app.goo.gl/bnE7dLH98ZDMSxVg9">Riyadh</a></li>
                        <li><a href="https://maps.app.goo.gl/fKzcXyV3VC3wZ6Qo9">Makkah</a></li>
                        <li><a href="https://maps.app.goo.gl/GMVBNQ2RKkFsq5oU7">Jeddah</a></li>
                    </ul>
                </div>

                <div class="col">
                    <h4>Contact Us</h4>
                    <div class="social">
                        <a href="https://web.whatsapp.com/"><i class='bx bxl-whatsapp'></i></a>
                        <a href="https://www.instagram.com/"><i class='bx bxl-instagram'></i></a>
						<a href="https://www.youtube.com/"><i class='bx bxl-youtube'></i></a>
                        <a href="https://x.com/?lang=en"><i class='bx bxl-twitter'></i></a>
						<a href="https://www.snapchat.com/"><i class='bx bxl-snapchat'></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>

   <script src="MyOffers.js"></script>
  </body>
