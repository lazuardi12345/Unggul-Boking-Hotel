<?php
$hotels = [
    [
        'name' => 'Hotel Trikora Beach',
        'location' => 'Bintan',
        'price' => 'Rp. 1.200.000/Night',
        'user' => 'Robert',
        'image' => 'Hotel trikora beach.jpg',
        'rating' => '4.7',
        'description' => 'Beachfront resort with stunning views'
    ],
    [
        'name' => 'Hotel Santika Prime',
        'location' => 'Harapan Indah Bekasi',
        'price' => 'Rp. 688.750/Night',
        'user' => 'Larry Naves',
        'image' => 'HotelSantika.jpg',
        'rating' => '4.5',
        'description' => 'Luxury hotel with modern amenities'
    ],
    [
        'name' => ' Hotel Royal Ambarukmo',
        'location' => 'Jogjakarta',
        'price' => 'Rp. 1.588.755/Night',
        'user' => 'Robert',
        'image' => 'royal-ambarukmo.jpg',
        'rating' => '4.8',
        'description' => 'Historic luxury hotel in Yogyakarta'
    ],
    [
        'name' => 'Hotel Novotel',
        'location' => 'Bandung',
        'price' => 'Rp. 653.801/Night',
        'user' => 'Jessica',
        'image' => 'HotelNovotel.jpg',
        'rating' => '4.6',
        'description' => 'Contemporary comfort in Bandung'
    ],
    [
        'name' => 'Hotel Fairfield',
        'location' => 'Bali',
        'price' => 'Rp. 1.131.350/Night',
        'user' => 'Jefri Nichol',
        'image' => 'fairfield.jpg',
        'rating' => '4.7',
        'description' => 'Beachfront paradise in Bali'
    ],
    [
        'name' => 'Hotel Kempinski',
        'location' => 'Jakarta Pusat',
        'price' => 'Rp. 688.750/Night',
        'user' => 'Marco Van Basten',
        'image' => 'HotelKempinski.jpg',
        'rating' => '4.9',
        'description' => 'Luxury 5-star hotel in central Jakarta'
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="main-bg">
        <header class="main-header">
            <div class="header-left">
                <button id="sidebarToggle" class="sidebar-toggle" aria-label="Toggle Menu" title="Toggle Menu (Ctrl + M)">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="company-name">Unggul Booking Hotel</span>
            </div>
            <div class="header-right">
                <a href="{{ route('user-selection') }}" class="register-btn">Registrasi</a>
                <a href="{{ route('user-selection') }}" class="login-btn">Login</a>
            </div>
        </header>

        <div class="search-section">
            <div class="search-bar">
                <input type="text" placeholder="search by Hotel" class="search-input" id="searchInput">
                <select class="location-select" id="locationSelect">
                    <option value="all">All Location</option>
                    <option value="bekasi">Bekasi</option>
                    <option value="jogja">Jogjakarta</option>
                    <option value="bandung">Bandung</option>
                    <option value="bali">Bali</option>
                    <option value="jakarta">Jakarta</option>
                </select>
            </div>
        </div>

        <div class="section">
            <h2 class="section-title">Recommended Hotels</h2>
            <div class="hotel-cards-row" id="hotelCardsRow">
                <!-- Render via JS -->
            </div>
        </div>

        <div class="section">
            <h2 class="section-title">Popular Hotels</h2>
            <div class="populer-hotels-row">
                <div class="populer-hotel-card">
                    <div class="populer-hotel-img-wrap">
                        <img src="/assets/img/ritz-Carlton.jpg" alt="The Ritz-Carlton Jakarta" class="populer-hotel-img">
                    </div>
                    <div class="populer-hotel-body">
                        <h3 class="populer-hotel-title">The Ritz-Carlton Jakarta</h3>
                        <p class="populer-hotel-desc">Located in the dynamic Sudirman Central Business District...</p>
                        <div class="populer-hotel-info">
                            <span><i class="fas fa-map-marker-alt"></i> Jakarta</span>
                            <span class="populer-hotel-price">Price: Rp. 8.000.000</span>
                        </div>
                        <div class="hotel-card-user">
                            <img src="/assets/img/Jessica.png" alt="Jessica" class="user-avatar">
                            <span>Jessica</span>
                        </div>
                        <div class="hotel-card-actions">
                            <a href="booking.php?name=The%20Ritz-Carlton%20Jakarta&location=Jakarta..." class="pesan-btn">Pesan Kamar</a>
                            <button class="add-to-cart-btn" data-hotel='{"name":"The Ritz-Carlton Jakarta", "location":"Jakarta", ...}'><i class="fas fa-cart-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="populer-hotel-card">
                    <div class="populer-hotel-img-wrap">
                        <img src="/assets/img/raffles.jpg" alt="Hotel Raffles" class="populer-hotel-img">
                    </div>
                    <div class="populer-hotel-body">
                        <h3 class="populer-hotel-title">Hotel Raffles</h3>
                        <p class="populer-hotel-desc">Hotel Raffles Jakarta is a luxurious hotel...</p>
                        <div class="populer-hotel-info">
                            <span><i class="fas fa-map-marker-alt"></i> Jakarta</span>
                            <span class="populer-hotel-price">Price: Rp. 4.700.000</span>
                        </div>
                        <div class="hotel-card-user">
                            <img src="/assets/img/jefrinichol.png" alt="Jefri Nichol" class="user-avatar">
                            <span>Jefri Nichol</span>
                        </div>
                        <div class="hotel-card-actions">
                            <a href="booking.php?name=Hotel%20Raffles&location=Jakarta..." class="pesan-btn">Pesan Kamar</a>
                            <button class="add-to-cart-btn" data-hotel='{"name":"Hotel Raffles", "location":"Jakarta", ...}'><i class="fas fa-cart-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <p>&copy; 2024 Hotel Booking. All rights reserved.</p>
        </footer>
    </div>

    <div class="sidebar-overlay"></div>

    <div class="sidebar">
        <div class="sidebar-header">
            <img src="/assets/img/logo.png" alt="Company Logo" class="sidebar-logo-img">
            <span class="sidebar-company-name">Menu</span>
            <button id="closeSidebar" class="close-sidebar"><i class="fas fa-times"></i></button>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('profile') }}" class="sidebar-nav-link"><i class="fas fa-user"></i> Profile</a>
            <a href="{{ route('index') }}" class="sidebar-nav-link"><i class="fas fa-home"></i> Beranda</a>
            <a href="{{ route('cart') }}" class="sidebar-nav-link"><i class="fas fa-cart-plus"></i> Keranjang Saya</a>
            <a href="{{ route('layanan') }}" class="sidebar-nav-link"><i class="fas fa-bell-concierge"></i> Layanan</a>
            <a href="{{route('properties')}}" class="sidebar-nav-link"><i class="fas fa-building"></i> Properties</a>
            <a href="{{route('agents')}}" class="sidebar-nav-link"><i class="fas fa-headset"></i> Agent</a>
            <a href="{{route('contact-admin')}}" class="sidebar-nav-link"><i class="fas fa-question-circle"></i> Contact Admin</a>
            <a href="{{route('setting')}}" class="sidebar-nav-link"><i class="fas fa-screwdriver-wrench"></i> Setting</a>
        </nav>
        <div class="about-us-section">
            <h3 class="about-us-title">TENTANG KAMI</h3>
            <p class="about-us-text">Kami adalah layanan properti modern...</p>
        </div>
        <button id="floatingMenuBtn" class="floating-menu-btn"><i class="fas fa-bars"></i></button>
    </div>

    <!-- Script -->
    <script src="assets/js/index.js"></script> <!-- atau langsung taruh di bawah -->
</body>
</html>
