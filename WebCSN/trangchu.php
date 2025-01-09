<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
     body {
    font-family: 'Montserrat', sans-serif;
    margin: 0;
    padding: 0;
    background: #fff5f7;
}

/* Header styles - Enhanced */
header {
    position: relative;
    padding: 0;
    height: 60vh;
    min-height: 400px;
    background: linear-gradient(135deg, #ff69b4, #ff1493);
}

/* Logo container styles - Updated */
.logo-container {
    margin: 20px auto;
    text-align: center;
}

.logo-container img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 4px solid white;
}

/* Header content positioning - Updated */
.header-content {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 40px 20px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
}

/* Enhanced header title */
header h1 {
    color: white;
    font-size: 2.8em;
    margin: 15px 0;
}

/* Enhanced tagline */
.tagline {
    color: white;
    font-size: 1.6em;
    margin: 10px 0 20px;
}

/* Remove unused animations */
@keyframes logoFloat {
    /* Remove this animation */
}

@keyframes logoGlow {
    /* Remove this animation */
}

/* Add decorative pattern overlay */
header::before {
    display: none;
}

/* Add floating bubbles effect */
header::after {
    display: none;
}

/* Header content positioning */
.logo-container, h1, .tagline {
    position: relative;
    z-index: 2;
}

/* Enhanced logo container */
.logo-container {
    margin-bottom: 20px;
    animation: logoFloat 6s ease-in-out infinite;
}

.logo-container img {
    border: 6px solid rgba(255, 255, 255, 0.95);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3),
                0 0 0 15px rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
}

@keyframes logoFloat {
    0%, 100% { transform: translateY(0) rotate(0); }
    50% { transform: translateY(-10px) rotate(5deg); }
}

/* Enhanced sliding text in header */
.sliding-text {
    background: rgba(255, 255, 255, 0.15);
    color: white;
    padding: 15px 30px;
    border-radius: 30px;
    margin: 25px auto 0;
    max-width: 80%;
    text-align: center;
}

@keyframes slideGlow {
    0%, 100% { box-shadow: 0 0 20px rgba(255, 255, 255, 0.3); }
    50% { box-shadow: 0 0 30px rgba(255, 255, 255, 0.5); }
}

/* Navigation styles - Enhanced */
.nav-links {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.5);
    padding: 30px 50px;
    border-radius: 60px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    margin: 20px auto;
    max-width: 900px;
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.nav-links a {
    color: #333;
    text-decoration: none;
    padding: 15px 30px;
    border-radius: 25px;
    transition: all 0.3s ease;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 1.15em;
    letter-spacing: 0.5px;
    position: relative;
    overflow: hidden;
}

.nav-links a::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: 0.5s;
    z-index: -1;
}

.nav-links a:hover::before {
    left: 100%;
}

.nav-links a i {
    font-size: 1.1em;
}

.nav-links a:hover {
    background: linear-gradient(45deg, #ff69b4, #ff1493);
    color: white;
    transform: translateY(-2px);
}

/* Benefits section */
.benefits {
    display: flex;
    justify-content: center;
    gap: 30px;
    padding: 20px;
    margin: 0 auto;
    max-width: 1400px;
}

.benefit {
    flex: 0 0 auto;
    width: 600px;
    height: 400px;
    margin: 10px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 105, 180, 0.2);
}

.benefit::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 6px;
    background: linear-gradient(45deg, #ff69b4, #ff1493, #ff69b4);
    background-size: 200% 200%;
    animation: gradientMove 3s ease infinite;
}

.benefit:hover {
    transform: translateY(-15px) scale(1.03);
    box-shadow: 0 20px 40px rgba(255, 105, 180, 0.3);
}

.benefit h2 {
    color: #ff1493;
    font-size: 1em;
    margin: 8px 0;
    text-align: center;
    font-weight: 600;
    transition: all 0.3s ease;
}

.benefit video {
    width: 600px;
    height: 400px;
    object-fit: cover;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.benefit:hover video {
    transform: scale(1.05);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
}

.benefit:hover h2 {
    transform: scale(1.05);
    color: #ff69b4;
}

/* Button styles */
.button-container {
    text-align: center;
    margin-top: 15px;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.4s ease;
}

.benefit:hover .button-container {
    opacity: 1;
    transform: translateY(0);
}

.button-container a {
    display: inline-block;
    background: linear-gradient(45deg, #ff69b4, #ff1493);Y
    color: white;
    padding: 10px 25px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.button-container a:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(255, 20, 147, 0.4);
    background: linear-gradient(45deg, #ff1493, #ff69b4);
}

/* Sliding text enhancement */
.sliding-text {
    background: linear-gradient(45deg, #ff69b4, #ff1493, #ff69b4);
    color: white;
    padding: 15px 30px;
    border-radius: 30px;
    margin: 25px auto 0;
    max-width: 80%;
    text-align: center;
    font-weight: 500;
    box-shadow: 0 5px 20px rgba(255, 105, 180, 0.3);
    position: relative;
    overflow: hidden;
    white-space: nowrap;
    animation: slideText 20s linear infinite;
    font-size: 1.2em;
    border: 1px solid rgba(255, 255, 255, 0.3);
    background-size: 200% 200%;
    animation: gradientMove 3s ease infinite, float 3s ease-in-out infinite;
    border: 2px solid rgba(255, 255, 255, 0.5);
}

.sliding-text::before {
    content: '✨';
    margin-right: 10px;
    animation: sparkle 1.5s infinite;
}

.sliding-text::after {
    content: '✨';
    margin-left: 10px;
    animation: sparkle 1.5s infinite;
}

@keyframes sparkle {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

/* Footer styles - Enhanced */
footer {
    background: linear-gradient(45deg, #ff69b4, #ff1493, #ff69b4);
    background-size: 200% 200%;
    animation: gradientMove 3s ease infinite;
    color: white;
    padding: 70px 20px;
    margin-top: 50px;
    text-align: center;
    position: relative;
}

.contact-info {
    max-width: 700px;
    margin: 0 auto;
    padding: 45px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 40px;
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.contact-info h3 {
    font-size: 1.6em;
    margin-bottom: 20px;
    font-weight: 600;
}

/* Responsive design */
@media (max-width: 1400px), (max-width: 992px), (max-width: 576px) {
    .benefits {
        flex-wrap: nowrap;
    }
    .benefit {
        flex: 0 0 calc(16.666% - 10px);
    }
}


/* Tùy chỉnh thanh cuộn cho đẹp hơn */
.benefits::-webkit-scrollbar {
    height: 8px;
}

.benefits::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.benefits::-webkit-scrollbar-thumb {
    background: #ff69b4;
    border-radius: 10px;
}

.featured-title {
    text-align: center;
    color: #ff1493;
    font-size: 2.8em;
    margin: 45px 0;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 3px;
    text-shadow: 4px 4px 8px rgba(255, 105, 180, 0.4);
    position: relative;
    padding-bottom: 20px;
    font-family: 'Comic Sans MS', cursive;
    background: linear-gradient(45deg, #ff69b4, #ff1493, #ff69b4);
    background-size: 200% 200%;
    animation: gradientMove 3s ease infinite;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    position: relative;
    transform-style: preserve-3d;
    perspective: 1000px;
}

.featured-title::before {
    content: '✨';
    position: absolute;
    left: 50%;
    top: -30px;
    transform: translateX(-50%);
    font-size: 1.5em;
    animation: sparkle 1.5s infinite;
}

.featured-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 200px;
    height: 6px;
    background: linear-gradient(45deg, #ff69b4, #ff1493, #ff69b4);
    box-shadow: 0 5px 15px rgba(255, 20, 147, 0.5);
    border-radius: 10px;
    animation: gradient 3s ease infinite;
    background-size: 200% 200%;
}

@keyframes sparkle {
    0% { transform: translateX(-50%) scale(1); opacity: 1; }
    50% { transform: translateX(-50%) scale(1.2); opacity: 0.8; }
    100% { transform: translateX(-50%) scale(1); opacity: 1; }
}

@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes titlePulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.product-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    filter: brightness(0.95);
}

.product-image:hover {
    transform: scale(1.08) translateY(-10px);
    filter: brightness(1.1);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 12px;
}

::-webkit-scrollbar-track {
    background: rgba(255, 105, 180, 0.1);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(45deg, #ff69b4, #ff1493);
    border-radius: 10px;
    border: 3px solid rgba(255, 255, 255, 0.8);
}

/* Container riêng cho phần hình ảnh */
.image-benefits {
    display: flex;
    justify-content: center;
    gap: 15px;
    padding: 20px;
    margin: 0 auto;
    max-width: 1200px;
}

/* Giữ nguyên style cho các hình ảnh */
.image-benefits .benefit {
    flex: 0 0 calc(25% - 15px);
    min-width: 200px;
    height: 250px;
    margin: 5px;
    background: #fff;
    border-radius: 10px;
}

.image-benefits .product-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
}
    </style>
</head>
<body>
<header>
    
        <div class="logo-container">
            <img src="img/logo.jpg" alt="Logo" style="max-width:350px;">
        </div>
        <h1>Shop Thời Trang Phương Phương</h1>
        <p class="tagline">Nơi phong cách gặp gỡ đẳng cấp</p>
        <div class="sliding-text">
            ✨ Khuyến mãi đặc biệt - Giảm giá đến 50% cho tất cả các mặt hàng mới! ✨
        </div>
    </div>
    <div class="slide-nav">
        <div class="slide-dot active" style="background: rgba(255, 192, 203, 0.5)"></div>
        <div class="slide-dot" style="background: rgba(255, 192, 203, 0.5)"></div>
        <div class="slide-dot" style="background: rgba(255, 192, 203, 0.5)"></div>
    </div>
</header>
        

        <div class="nav-links">
            <a href="trangchu.php" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
            <a href="gioithieu.php" class="nav-item"><i class="fas fa-info-circle"></i> Giới thiệu</a>
            <a href="sanpham.php" class="nav-item"><i class="fas fa-shopping-bag"></i> Sản phẩm</a>
            <a href="lienhe.php" class="nav-item"><i class="fas fa-envelope"></i> Liên hệ</a>
            <a href="dangnhap.php" class="nav-item"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
            <a href="dangky.php" class="nav-item"><i class="fas fa-user-plus"></i> Đăng ký</a>
        </div>
    
    <!-- Phần video hiển thị -->
    <div class="container">
        <h2 class="featured-title">Sản Phẩm Nổi Bật</h2>
        <div class="benefits">
          
            
        </div>
    </div>

    <!-- Phần hình ảnh -->
    <div class="container">
        <div class="benefits">
            <!-- Hình 1 -->
            <div class="benefit" style="--i:1">
            <img src="img/1.jpg" alt="Áo hoodie" class="product-image">
                <div class="button-container">
                    
                </div>
            </div>

            <!-- Hình 2 -->
            <div class="benefit" style="--i:2">
            <img src="img/8.jpg" alt="váy trễ vay Tafla" class="product-image">
                <div class="button-container">
                    
                </div>
            </div>

          

            <!-- Hình 5 -->
            <div class="benefit" style="--i:5">
            <img src="img/11.jpg" alt="Áo croptop" class="product-image">
                <div class="button-container">
                   
                </div>
            </div>

            <!-- Hình 6 -->
            <div class="benefit" style="--i:6">
            <img src="img/12.jpg" alt="Đầm lụa" class="product-image">
                <div class="button-container">
                   
                </div>
            </div>
            <!-- Hình 6 -->
            <div class="benefit" style="--i:6">
            <img src="img/18.jpg" alt="Áo thun cổ v" class="product-image">
                <div class="button-container">
                    
                </div>
            </div>

        </div>
    </div>

    <footer>
        <div class="contact-info">
        <p>© 2024 Shop Thời Trang Phương Phương. All rights reserved.</p>
        </div>
      
    </footer>

    <script src="js/search.js"></script>
    <script>
        // Hiệu ứng scroll mượt cho các liên kết
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Animation khi scroll
        window.addEventListener('scroll', function() {
            const benefits = document.querySelectorAll('.benefit');
            benefits.forEach(benefit => {
                const position = benefit.getBoundingClientRect();
                if(position.top < window.innerHeight) {
                    benefit.style.opacity = '1';
                    benefit.style.transform = 'translateY(0)';
                }
            });
        });

        // Thêm Intersection Observer để xử lý animation khi scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeInUp 1s forwards';
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.benefit').forEach(benefit => {
            observer.observe(benefit);
        });

        function applyFilters() {
            const priceFilter = document.getElementById('priceFilter').value;
            const nameFilter = document.getElementById('nameFilter').value.toLowerCase();
            const products = document.querySelectorAll('.product-container');

            products.forEach(product => {
                let showProduct = true;
                const productName = product.querySelector('h3').textContent.toLowerCase();
                const priceText = product.querySelector('.product-price').textContent;
                const price = parseInt(priceText.replace(/[^\d]/g, ''));

                // Lọc theo tên
                if (nameFilter && !productName.includes(nameFilter)) {
                    showProduct = false;
                }

                // Lọc theo giá
                if (priceFilter) {
                    const [min, max] = priceFilter.split('-').map(Number);
                    if (max) {
                        if (price < min || price > max) {
                            showProduct = false;
                        }
                    } else {
                        if (price < min) {
                            showProduct = false;
                        }
                    }
                }

                product.style.display = showProduct ? 'flex' : 'none';
            });
        }

        // Thêm sự kiện để lọc khi nhập
        document.getElementById('nameFilter').addEventListener('input', applyFilters);
        document.getElementById('priceFilter').addEventListener('change', applyFilters);

        let slideIndex = 0;
        const slides = document.getElementsByClassName("slide");
        const dots = document.getElementsByClassName("slide-dot");

        function showSlides() {
            // Ẩn tất cả slides
            for (let i = 0; i < slides.length; i++) {
                slides[i].classList.remove("active");
                dots[i].classList.remove("active");
            }
            
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }
            
            // Hiển thị slide hiện tại
            slides[slideIndex - 1].classList.add("active");
            dots[slideIndex - 1].classList.add("active");
            
            setTimeout(showSlides, 5000); // Chuyển slide sau 5 giây
        }

        // Thêm sự kiện click cho các nút điều hướng
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                slideIndex = index;
                for (let i = 0; i < slides.length; i++) {
                    slides[i].classList.remove("active");
                    dots[i].classList.remove("active");
                }
                slides[index].classList.add("active");
                dots[index].classList.add("active");
            });
        });

        // Khởi chạy slideshow
        document.addEventListener("DOMContentLoaded", function() {
            slides[0].classList.add("active");
            showSlides();
        });
    </script>
</body>
</html>
