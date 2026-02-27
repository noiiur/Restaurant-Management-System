<?php
require_once 'connection.php';

// استعلام لجلب العروض من قاعدة البيانات
$query = "SELECT * FROM `offer` ORDER BY `creation_date` DESC";
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
    <!--<link rel="stylesheet" href="style.css">-->

  </head>

  <body>
    <style>
        /* أنماط إضافية مكملة للتصميم */
        .offer-details-container {
            max-width: 1200px;
            margin: 150px auto 50px;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }
        
        .offer-image-container img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .offer-info {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .offer-title {
            color: #416125;
            font-size: 2rem;
            margin-bottom: 20px;
            border-bottom: 2px solid #de252a;
            padding-bottom: 10px;
        }
        
        .offer-description {
            color: #666;
            line-height: 1.8;
            margin-bottom: 25px;
        }
        
        .offer-meta {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .meta-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }
        
        .meta-label {
            color: #de252a;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }
        
        .price-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        
        .original-price {
            text-decoration: line-through;
            color: #999;
            font-size: 1.2rem;
        }
        
        .discounted-price {
            color: #de252a;
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .discount-badge {
            background: #de252a;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.9rem;
            display: inline-block;
            margin-left: 10px;
        }
        
        .quantity-selector {
            margin: 20px 0;
        }
        
        .quantity-selector label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        
        .quantity-selector input {
            width: 80px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .add-to-cart-btn {
            background: #de252a;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.1rem;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s;
        }
        
        .add-to-cart-btn:hover {
            background: #8f0d18;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #de252a;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .back-link:hover {
            color: #8f0d18;
        }
        
        @media (max-width: 768px) {
            .offer-details-container {
                grid-template-columns: 1fr;
                margin-top: 120px;
            }
            
            .offer-meta {
                grid-template-columns: 1fr;
            }
        }
    </style>

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
              <li><a href="MyOffers.php">Home</a></li>
              <li><a href="MyOffersdescription.php">Food</a></li>
              <li><a href="#auto">Auto</a></li>           
              <li><a href="#contact">Contact</a></li>
            </ul>
          </nav>
    </nav>
  
    <!-- home Start -->
    <section class="home" id="home">
    <div class="home-text menu-header">
        <h1 class="menu-title">the menu</h1>
        <img src="menu.jpg" alt="menu icon" class="menu-icon">
    </div>
    </section>
    
    <section class="offers">
        <div class="offers-container">
            <div class="offers-container">
                <div class="offer-cards">



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