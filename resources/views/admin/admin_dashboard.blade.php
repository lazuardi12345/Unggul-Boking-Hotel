<?php
// admin_dashboard.php
// Data hotel dan agent (copy dari agents.php)
$hotels = [
    [
        'name' => 'Hotel Santika Prime',
        'location' => 'Harapan Indah Bekasi',
        'price' => 'Rp. 688.750/Night',
        'user' => 'Larry Naves',
        'image' => 'HotelSantika.jpg',
        'rating' => '4.5',
        'description' => 'Luxury hotel with modern amenities',
        'facilities' => ['Free Wi-Fi', 'Swimming Pool', 'Fitness Center', 'Restaurant']
    ],
    [
        'name' => ' Hotel Royal Ambarukmo',
        'location' => 'Jogjakarta',
        'price' => 'Rp. 1.588.755/Night',
        'user' => 'Robert',
        'image' => 'royal-ambarukmo.jpg',
        'rating' => '4.8',
        'description' => 'Historic luxury hotel in Yogyakarta',
        'facilities' => ['Free Wi-Fi', 'Spa', 'Restaurant', 'Meeting Rooms']
    ],
    [
        'name' => 'Hotel Novotel',
        'location' => 'Bandung',
        'price' => 'Rp. 653.801/Night',
        'user' => 'Jessica',
        'image' => 'novotel.jpg',
        'rating' => '4.6',
        'description' => 'Contemporary comfort in Bandung',
        'facilities' => ['Free Wi-Fi', 'Swimming Pool', 'Bar', 'Family Rooms']
    ],
    [
        'name' => 'Hotel Fairfield',
        'location' => 'Bali',
        'price' => 'Rp. 1.131.350/Night',
        'user' => 'Jefri Nichol',
        'image' => 'fairfield.jpg',
        'rating' => '4.7',
        'description' => 'Beachfront paradise in Bali',
        'facilities' => ['Beach Access', 'Outdoor Pool', 'Restaurant', 'Spa']
    ],
    [
        'name' => 'Hotel Kempinski',
        'location' => 'Jakarta Pusat',
        'price' => 'Rp. 688.750/Night',
        'user' => 'Marco Van Basten',
        'image' => 'kempinski.jpg',
        'rating' => '4.9',
        'description' => 'Luxury 5-star hotel in central Jakarta',
        'facilities' => ['Luxury Spa', 'Rooftop Pool', 'Fine Dining', 'Executive Lounge']
    ],
    // More hotels can be added
];

$agents = [
    'Larry Naves' => [
        'name' => 'Larry Naves',
        'image' => 'larrynaves.png',
        'description' => 'Dengan pengalaman lebih dari 5 tahun di industri properti dan perhotelan, Larry Naves merupakan profesional yang berfokus pada penyewaan hotel untuk kebutuhan bisnis dan pariwisata. Sebagai bagian dari agensi properti terkemuka, Larry Naves, ia telah membantu puluhan klien menemukan properti hotel terbaik sesuai kebutuhan dan anggaran.',
        'location' => 'Perumahan Graha Blok J No 21, Bojong Rawa, Bekasi Barat, Kota Bekasi',
        'phone' => '+62-0852-2890-7619',
        'email' => 'navesld@gmail.com',
        'social' => [
            'facebook' => '#',
            'instagram' => '#',
            'x' => '#'
        ]
    ],
    'Robert' => [
        'name' => 'Robert',
        'image' => 'robert.png',
        'description' => 'Seorang agen berpengalaman dengan fokus pada properti komersial.',
        'location' => 'Jakarta',
        'phone' => '+62-812-3456-7890',
        'email' => 'robert@example.com',
        'social' => [
            'facebook' => '#',
            'instagram' => '#',
            'x' => '#'
        ]
    ],
    'Jessica' => [
        'name' => 'Jessica',
        'image' => 'jessica.png',
        'description' => 'Agen properti terkemuka di bidang perumahan mewah.',
        'location' => 'Surabaya',
        'phone' => '+62-812-9876-5432',
        'email' => 'jessica@example.com',
        'social' => [
            'facebook' => '#',
            'instagram' => '#',
            'x' => '#'
        ]
    ],
    'Jefri Nichol' => [
        'name' => 'Jefri Nichol',
        'image' => 'jefrinichol.png',
        'description' => 'Spesialis properti liburan di Bali dan sekitarnya.',
        'location' => 'Bali',
        'phone' => '+62-878-1122-3344',
        'email' => 'jefri@example.com',
        'social' => [
            'facebook' => '#',
            'instagram' => '#',
            'x' => '#'
        ]
    ],
    'Marco Van Basten' => [
        'name' => 'Marco Van Basten',
        'image' => 'marcovanbasten.png',
        'description' => 'Konsultan properti ahli untuk investasi jangka panjang.',
        'location' => 'Bandung',
        'phone' => '+62-896-5544-3322',
        'email' => 'marco@example.com',
        'social' => [
            'facebook' => '#',
            'instagram' => '#',
            'x' => '#'
        ]
    ]
];

// Hitung total otomatis
$totalProperty = count($hotels);
$totalAgent = count($agents);
$totalLocations = count(array_unique(array_map(function($h){ return trim($h['location']); }, $hotels)));
// Total All Hotel mengikuti jumlah hotel di properties.php
$totalAllHotel = 9; // Jumlah hotel di bagian All Hotels pada properties.php
// Total kamar: jumlah seluruh kamar dari data di admin_properties.php
$totalKamar = 36; // Total dari semua kamar hotel yang ada
// Total orders: dummy (0)
$ordersFile = 'orders_data.json';
$orders = file_exists($ordersFile) ? json_decode(file_get_contents($ordersFile), true) : [];
$totalOrders = is_array($orders) ? count($orders) : 0;
?>
@include('admin.layouts.layout')