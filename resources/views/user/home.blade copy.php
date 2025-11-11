<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Store - Điện Thoại Chính Hãng Giá Tốt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #f59e0b;
            --dark-color: #1f2937;
            --light-color: #f3f4f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white !important;
        }

        .navbar-brand i {
            color: var(--accent-color);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s;
            margin: 0 0.5rem;
        }

        .nav-link:hover {
            color: var(--accent-color) !important;
            transform: translateY(-2px);
        }

        .search-box {
            position: relative;
            max-width: 400px;
        }

        .search-box input {
            border-radius: 25px;
            padding-right: 45px;
            border: none;
        }

        .search-box button {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            border-radius: 50%;
            width: 35px;
            height: 35px;
            border: none;
            background: var(--accent-color);
            color: white;
        }

        .cart-icon {
            position: relative;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 80px 0;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
        }

        @keyframes moveBackground {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(50px, 50px);
            }
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
            animation: fadeInUp 0.8s;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            animation: fadeInUp 1s;
        }

        .btn-hero {
            padding: 12px 40px;
            font-size: 1.1rem;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
            animation: fadeInUp 1.2s;
        }

        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* Features */
        .features-section {
            padding: 60px 0;
            background: var(--light-color);
        }

        .feature-card {
            text-align: center;
            padding: 30px;
            background: white;
            border-radius: 15px;
            transition: all 0.3s;
            height: 100%;
            border: 2px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-color);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        /* Products */
        .products-section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 100px;
            height: 4px;
            background: var(--accent-color);
            margin: 20px auto 0;
            border-radius: 2px;
        }

        .product-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
            background: white;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .product-image {
            position: relative;
            overflow: hidden;
            padding-top: 100%;
            background: var(--light-color);
        }

        .product-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s;
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            z-index: 1;
        }

        .product-body {
            padding: 20px;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
            min-height: 50px;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .product-old-price {
            font-size: 1rem;
            color: #999;
            text-decoration: line-through;
            margin-left: 10px;
        }

        .product-rating {
            color: var(--accent-color);
            margin-bottom: 15px;
        }

        .btn-add-cart {
            width: 100%;
            padding: 10px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-add-cart:hover {
            background: var(--secondary-color);
            transform: scale(1.05);
        }

        /* Brands */
        .brands-section {
            padding: 60px 0;
            background: var(--light-color);
        }

        .brand-logo {
            padding: 20px;
            background: white;
            border-radius: 10px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100px;
            cursor: pointer;
        }

        .brand-logo:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .brand-logo img {
            max-width: 100%;
            max-height: 60px;
            filter: grayscale(100%);
            transition: all 0.3s;
        }

        .brand-logo:hover img {
            filter: grayscale(0%);
        }

        /* Newsletter */
        .newsletter-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .newsletter-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .newsletter-form input {
            border-radius: 30px 0 0 30px;
            border: none;
            padding: 15px 25px;
        }

        .newsletter-form button {
            border-radius: 0 30px 30px 0;
            padding: 15px 35px;
            background: var(--accent-color);
            border: none;
            font-weight: 600;
        }

        /* Footer */
        footer {
            background: var(--dark-color);
            color: white;
            padding: 60px 0 20px;
        }

        .footer-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: var(--accent-color);
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s;
        }

        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin-right: 10px;
            color: white;
            transition: all 0.3s;
        }

        .social-icons a:hover {
            background: var(--accent-color);
            transform: translateY(-3px);
        }

        /* Cart Modal */
        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            margin-bottom: 15px;
            transition: all 0.3s;
        }

        .cart-item:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-title {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 5px;
        }

        .cart-item-price {
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.1rem;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
        }

        .quantity-control button {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
            background: white;
            color: var(--primary-color);
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }

        .quantity-control button:hover {
            background: var(--primary-color);
            color: white;
        }

        .quantity-control span {
            min-width: 30px;
            text-align: center;
            font-weight: 600;
        }

        .remove-item {
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 15px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .remove-item:hover {
            background: #dc2626;
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .section-title h2 {
                font-size: 1.8rem;
            }

            .search-box {
                margin: 10px 0;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-mobile-alt"></i> Mobile Store
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-home"></i> Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products"><i class="fas fa-mobile"></i> Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-fire"></i> Khuyến mãi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-newspaper"></i> Tin tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-phone"></i> Liên hệ</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="search-box d-none d-lg-block me-3">
                        <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                    <a href="#" class="nav-link cart-icon" data-bs-toggle="modal" data-bs-target="#cartModalGioHang">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        <span class="cart-badge" id="cartCount">0</span>
                    </a>
                    <span class="text-white ms-3 fw-bold">
                        {{ Auth::user()->name }}
                    </span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title">Điện Thoại Chính Hãng</h1>
                    <p class="hero-subtitle">Giá tốt nhất thị trường - Bảo hành 12 tháng - Đổi trả miễn phí trong 7 ngày
                    </p>
                    <a href="#products" class="btn btn-warning btn-hero">
                        <i class="fas fa-shopping-bag"></i> Mua ngay
                    </a>
                    <a href="#" class="btn btn-outline-light btn-hero ms-2">
                        <i class="fas fa-info-circle"></i> Tìm hiểu thêm
                    </a>
                </div>
                <div class="col-lg-6 text-center d-none d-lg-block">
                    <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=600" alt="Phones"
                        class="img-fluid" style="max-width: 500px; animation: float 3s ease-in-out infinite;">
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card">
                        <i class="fas fa-shipping-fast feature-icon"></i>
                        <h5>Miễn Phí Vận Chuyển</h5>
                        <p>Giao hàng nhanh toàn quốc</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card">
                        <i class="fas fa-shield-alt feature-icon"></i>
                        <h5>Bảo Hành Chính Hãng</h5>
                        <p>Bảo hành 12 tháng 1 đổi 1</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card">
                        <i class="fas fa-undo feature-icon"></i>
                        <h5>Đổi Trả Dễ Dàng</h5>
                        <p>Đổi trả trong vòng 7 ngày</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card">
                        <i class="fas fa-headset feature-icon"></i>
                        <h5>Hỗ Trợ 24/7</h5>
                        <p>Tư vấn nhiệt tình, chu đáo</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products -->
    <section class="products-section" id="products">
        <div class="container">
            <div class="section-title">
                <h2>Sản Phẩm Nổi Bật</h2>
                <p class="text-muted">Khám phá những mẫu điện thoại hot nhất hiện nay</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card product-card">
                        <div class="product-image">
                            <span class="product-badge">MỚI</span>
                            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400"
                                alt="Google Pixel">
                        </div>
                        <div class="product-body">
                            <h5 class="product-title">Google Pixel 8 Pro</h5>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="text-muted">(92)</span>
                            </div>
                            <div class="product-price">
                                24.990.000đ
                                <span class="product-old-price">27.990.000đ</span>
                            </div>
                            <button class="btn-add-cart">
                                <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card product-card">
                        <div class="product-image">
                            <span class="product-badge">-15%</span>
                            <img src="https://images.unsplash.com/photo-1585060544812-6b45742d762f?w=400" alt="OnePlus">
                        </div>
                        <div class="product-body">
                            <h5 class="product-title">OnePlus 12 Pro</h5>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="text-muted">(88)</span>
                            </div>
                            <div class="product-price">
                                20.990.000đ
                                <span class="product-old-price">24.990.000đ</span>
                            </div>
                            <button class="btn-add-cart">
                                <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card product-card">
                        <div class="product-image">
                            <span class="product-badge">MỚI</span>
                            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400"
                                alt="Google Pixel">
                        </div>
                        <div class="product-body">
                            <h5 class="product-title">Google Pixel 8 Pro</h5>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="text-muted">(92)</span>
                            </div>
                            <div class="product-price">
                                24.990.000đ
                                <span class="product-old-price">27.990.000đ</span>
                            </div>
                            <button class="btn-add-cart">
                                <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card product-card">
                        <div class="product-image">
                            <span class="product-badge">MỚI</span>
                            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400"
                                alt="Google Pixel">
                        </div>
                        <div class="product-body">
                            <h5 class="product-title">Google Pixel 8 Pro</h5>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span class="text-muted">(92)</span>
                            </div>
                            <div class="product-price">
                                24.990.000đ
                                <span class="product-old-price">27.990.000đ</span>
                            </div>
                            <button class="btn-add-cart">
                                <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="#" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus-circle"></i> Xem thêm sản phẩm
                </a>
            </div>
        </div>
    </section>

    <!-- Brands -->
    <section class="brands-section">
        <div class="container">
            <div class="section-title">
                <h2>Thương Hiệu Uy Tín</h2>
                <p class="text-muted">Đối tác chính thức của các thương hiệu hàng đầu</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-2 col-md-3 col-4">
                    <div class="brand-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="Apple">
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-4">
                    <div class="brand-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/Samsung_Logo.svg" alt="Samsung">
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-4">
                    <div class="brand-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/ae/Xiaomi_logo_%282021-%29.svg"
                            alt="Xiaomi">
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-4">
                    <div class="brand-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/8f/OPPO_Logo_wiki.svg" alt="OPPO">
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-4">
                    <div class="brand-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/ee/Vivo_logo_2019.svg" alt="Vivo">
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-4">
                    <div class="brand-logo">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3e/OnePlus_logo.svg" alt="OnePlus">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="newsletter-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h2 class="mb-3">Đăng Ký Nhận Tin</h2>
                    <p class="mb-4">Nhận thông tin khuyến mãi và sản phẩm mới nhất qua email</p>
                    <form class="newsletter-form">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Nhập email của bạn..." required>
                            <button class="btn btn-warning" type="submit">
                                <i class="fas fa-paper-plane"></i> Đăng ký
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h4 class="footer-title">
                        <i class="fas fa-mobile-alt"></i> Mobile Store
                    </h4>
                    <p class="mb-3">Hệ thống bán lẻ điện thoại di động uy tín hàng đầu Việt Nam với hơn 100 cửa hàng
                        trên toàn quốc.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Sản phẩm</h5>
                    <ul class="footer-links">
                        <li><a href="#">iPhone</a></li>
                        <li><a href="#">Samsung</a></li>
                        <li><a href="#">Xiaomi</a></li>
                        <li><a href="#">OPPO</a></li>
                        <li><a href="#">Vivo</a></li>
                        <li><a href="#">Phụ kiện</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Hỗ trợ</h5>
                    <ul class="footer-links">
                        <li><a href="#">Hướng dẫn mua hàng</a></li>
                        <li><a href="#">Chính sách bảo hành</a></li>
                        <li><a href="#">Chính sách đổi trả</a></li>
                        <li><a href="#">Thanh toán</a></li>
                        <li><a href="#">Vận chuyển</a></li>
                        <li><a href="#">FAQs</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-title">Liên hệ</h5>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt me-2"></i> 123 Đường ABC, Quận 1, TP.HCM</li>
                        <li><i class="fas fa-phone me-2"></i> Hotline: 1900 xxxx</li>
                        <li><i class="fas fa-envelope me-2"></i> info@mobilestore.vn</li>
                        <li><i class="fas fa-clock me-2"></i> 8:00 - 22:00 (Tất cả các ngày)</li>
                    </ul>
                    <div class="mt-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/4/42/Logo_Bo_cong_thuong.svg"
                            alt="Bộ Công Thương" style="height: 50px; filter: brightness(0) invert(1);">
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2024 Mobile Store. All rights reserved. Designed with <i
                            class="fas fa-heart text-danger"></i> by Your Team</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="btn btn-primary"
        style="position: fixed; bottom: 30px; right: 30px; display: none; border-radius: 50%; width: 50px; height: 50px; z-index: 1000;">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Cart Modal -->
    <div class="modal fade" id="cartModalGioHang" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white;">
                    <h5 class="modal-title" id="cartModalLabel">
                        <i class="fas fa-shopping-cart"></i> Giỏ Hàng Của Bạn
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="cartBody">
                    <div class="text-center py-5" id="emptyCart">
                        <i class="fas fa-shopping-cart" style="font-size: 4rem; color: #ccc;"></i>
                        <h5 class="mt-3 text-muted">Giỏ hàng trống</h5>
                        <p class="text-muted">Hãy thêm sản phẩm vào giỏ hàng!</p>
                    </div>
                    <div id="cartItems" style="display: none;">
                        <!-- Cart items will be inserted here -->
                    </div>
                </div>
                <div class="modal-footer" style="background: var(--light-color);">
                    <div class="w-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Tổng cộng:</h5>
                            <h4 class="mb-0 text-primary" id="cartTotal">0đ</h4>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary btn-lg" id="checkoutBtn"
                                style="display: none;">
                                <i class="fas fa-credit-card"></i> Thanh Toán
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-shopping-bag"></i> Tiếp Tục Mua Sắm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>