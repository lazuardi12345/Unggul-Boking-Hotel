document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const floatingMenuBtn = document.getElementById('floatingMenuBtn');
            const closeSidebar = document.getElementById('closeSidebar');
            const mainBg = document.querySelector('.main-bg');
            const overlay = document.querySelector('.sidebar-overlay');
            const menuLinks = document.querySelectorAll('.sidebar-nav-link');
            const hotelCardsRow = document.getElementById('hotelCardsRow');
            const assetPath = "/assets/img";

            // Fungsi render hotel
            function renderHotels(hotels) {
                hotelCardsRow.innerHTML = hotels.map(hotel => `
                    <div class="hotel-card" data-name="${hotel.name.toLowerCase()}" data-location="${hotel.location.toLowerCase()}">
                        <div class="hotel-card-img-wrap">
                            <img src="${assetPath}/${hotel.image}" alt="${hotel.name}" class="hotel-card-img" onerror="this.onerror=null;this.src='${assetPath}/logo.png';">
                            <div class="hotel-rating"><i class="fas fa-star"></i> ${hotel.rating}</div>
                        </div>
                        <div class="hotel-card-body">
                            <h3 class="hotel-card-title">${hotel.name}</h3>
                            <p class="hotel-card-location"><i class="fas fa-map-marker-alt"></i> ${hotel.location}</p>
                            <p class="hotel-card-price">${hotel.price}</p>
                            <div class="hotel-card-user">
                                <img src="${assetPath}/${hotel.user.toLowerCase().replace(/\s/g, '')}.png" alt="${hotel.user}" class="user-avatar" onerror="this.onerror=null;this.src='${assetPath}/logo.png';">
                                <span>${hotel.user}</span>
                            </div>
                            <div class="hotel-card-actions">
                                <a href="booking.php?name=${encodeURIComponent(hotel.name)}&location=${encodeURIComponent(hotel.location)}&price=${encodeURIComponent(hotel.price)}&image=${encodeURIComponent(hotel.image)}&rating=${encodeURIComponent(hotel.rating)}&description=${encodeURIComponent(hotel.description)}" class="pesan-btn">Pesan Kamar</a>
                                <button class="add-to-cart-btn" data-hotel='${JSON.stringify(hotel)}'><i class="fas fa-cart-plus"></i></button>
                            </div>
                        </div>
                    </div>
                `).join('');
                // Re-attach event listener untuk tombol cart
                attachCartButtonListeners();
            }

            // Attach event listener ke tombol cart setelah render
            function attachCartButtonListeners() {
                const cartButtons = document.querySelectorAll('.add-to-cart-btn');
                cartButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const hotelData = this.getAttribute('data-hotel');
                        let cartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');
                        const newHotel = JSON.parse(hotelData);
                        // Cek duplikasi berdasarkan nama dan lokasi
                        const isExist = cartItems.some(item => item.name === newHotel.name && item.location === newHotel.location);
                        if (!isExist) {
                            cartItems.push(newHotel);
                            localStorage.setItem('cartItems', JSON.stringify(cartItems));
                        }
                        // Redirect ke cart
                        window.location.href = 'cart.php';
                    });
                });
            }

            // --- LIVE SEARCH/FILTER HOTEL ---
            const searchInput = document.getElementById('searchInput');
            const locationSelect = document.getElementById('locationSelect');

            function fetchHotels() {
                const searchValue = searchInput.value;
                const locationValue = locationSelect.value;
                fetch(`search_hotels.php?search=${encodeURIComponent(searchValue)}&location=${encodeURIComponent(locationValue)}`)
                    .then(response => response.json())
                    .then(data => {
                        renderHotels(data);
                    });
            }
            searchInput.addEventListener('input', fetchHotels);
            locationSelect.addEventListener('change', fetchHotels);

            // Panggil fetchHotels() saat halaman pertama kali load
            fetchHotels();

            // Add active state to current page link
            const currentPage = window.location.pathname.split('/').pop();
            menuLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href === currentPage || (currentPage === '' && href === '#')) {
                    link.classList.add('active');
                }
            });

            function toggleSidebar() {
                sidebar.classList.toggle('sidebar-closed');
                mainBg.classList.toggle('main-expanded');
                overlay.classList.toggle('active');
                document.body.classList.toggle('sidebar-open');
                // Update aria-expanded state
                const isExpanded = !sidebar.classList.contains('sidebar-closed');
                sidebarToggle.setAttribute('aria-expanded', isExpanded);
                floatingMenuBtn.setAttribute('aria-expanded', isExpanded);
            }

            // Toggle sidebar with buttons
            sidebarToggle.addEventListener('click', toggleSidebar);
            floatingMenuBtn.addEventListener('click', toggleSidebar);
            closeSidebar.addEventListener('click', toggleSidebar);

            // Close sidebar when clicking overlay
            overlay.addEventListener('click', toggleSidebar);

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Close sidebar with Escape key
                if (e.key === 'Escape' && !sidebar.classList.contains('sidebar-closed')) {
                    toggleSidebar();
                }
                // Toggle sidebar with Ctrl + M
                if (e.ctrlKey && e.key === 'm') {
                    e.preventDefault();
                    toggleSidebar();
                }
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && 
                    !sidebar.contains(e.target) && 
                    !sidebarToggle.contains(e.target) && 
                    !floatingMenuBtn.contains(e.target) &&
                    !sidebar.classList.contains('sidebar-closed')) {
                    toggleSidebar();
                }
            });

            // Add loading animation to menu items
            menuLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.getAttribute('href') !== '#') {
                        this.classList.add('loading');
                    }
                });
            });

            // Handle window resize
            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    if (window.innerWidth > 768) {
                        sidebar.classList.remove('sidebar-closed');
                        mainBg.classList.remove('main-expanded');
                        overlay.classList.remove('active');
                        document.body.classList.remove('sidebar-open');
                    }
                }, 250);
            });

            // Show/hide floating button based on scroll position
            let lastScrollTop = 0;
            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                if (scrollTop > lastScrollTop && scrollTop > 100) {
                    // Scrolling down
                    floatingMenuBtn.classList.add('floating-menu-btn-hidden');
                } else {
                    // Scrolling up
                    floatingMenuBtn.classList.remove('floating-menu-btn-hidden');
                }
                lastScrollTop = scrollTop;
            });
        });