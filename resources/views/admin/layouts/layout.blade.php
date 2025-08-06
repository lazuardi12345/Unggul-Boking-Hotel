<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Unggul Booking Hotel</title>
    <link rel="stylesheet" href="/assets/css/admin_dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Cropper.js CDN -->
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
</head>
<body>
    <div class="admin-container">
        @include('admin.sidebar.sidebar-main')
        <!-- <aside class="sidebar">
            <div class="sidebar-header">
                <span class="sidebar-title">Menu Admin</span>
            </div>
            <nav class="sidebar-menu">
                <ul>
                    <li class="active"><a href="{{route('admin-dashboard')}}" style="color:inherit;text-decoration:none;display:block;width:100%;height:100%"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="has-submenu">
                        <span><i class="fa fa-building"></i> Property Selection <i class="fa fa-chevron-down submenu-arrow"></i></span>
                        <ul class="submenu">
                            <li><a href="{{route('admin-location')}}" style="color:inherit;text-decoration:none;display:block;width:100%;height:100%">Location</a></li>
                            <li><a href="{{route('admin-properties')}}" style="color:inherit;text-decoration:none;display:block;width:100%;height:100%">Property</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('admin-website-setting')}}" style="color:inherit;text-decoration:none;display:block;width:100%;height:100%"><i class="fa fa-cog"></i> Website Setting</a></li>
                    <li><a href="{{route('admin-orders')}}" style="color:inherit;text-decoration:none;display:block;width:100%;height:100%"><i class="fa fa-shopping-cart"></i> Orders</a></li>
                    <li><a href="{{route('admin-agents')}}" style="color:inherit;text-decoration:none;display:block;width:100%;height:100%"><i class="fa fa-user"></i> Agent</a></li>
                </ul>
            </nav>
        </aside> -->
        <main class="main-content">
            @include('admin.header.layout')
            @include('admin.sidebar.sidebar-admin-dashboard')
        </main>
    </div>
    <!-- Back to Home Button -->
    <div style="width:100%;text-align:center;margin:30px 0 10px 0;">
        <a href="index.php" style="display:inline-block;padding:12px 32px;background:#007bff;color:#fff;border-radius:6px;text-decoration:none;font-size:1.1em;font-weight:600;box-shadow:0 2px 8px rgba(0,0,0,0.08);transition:background 0.2s;">Kembali ke Halaman Utama</a>
    </div>
    <!-- Chart.js Mini Graphs Script -->
    <script>
    window.onload = function() {
    // Data awal dari PHP (untuk inisialisasi)
    let locData = [<?php echo $totalLocations; ?>];
    let propData = [<?php echo $totalProperty; ?>];
    let ordersData = [<?php echo $totalOrders; ?>];
    let agentData = [<?php echo $totalAgent; ?>];
    let kamarData = [<?php echo $totalKamar; ?>];
    // Data untuk grafik kamar tersedia/dipakai
    let kamarTersedia = 0;
    let kamarDipakai = 0;

    function makeMiniChart(ctx, data, color) {
        return new Chart(ctx, {
            type: 'line',
            data: {
                labels: Array(data.length).fill(''),
                datasets: [{
                    data: data,
                    borderColor: color,
                    backgroundColor: 'rgba(0,0,0,0)',
                    pointRadius: 0,
                    borderWidth: 2,
                    tension: 0.4
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { x: { display: false }, y: { display: false } },
                elements: { line: { borderJoinStyle: 'round' } },
                animation: false,
                responsive: false,
                maintainAspectRatio: false
            }
        });
    }

    // Inisialisasi chart
    const chartLoc = makeMiniChart(document.getElementById('chart-locations').getContext('2d'), locData, '#007bff');
    const chartProp = makeMiniChart(document.getElementById('chart-property').getContext('2d'), propData, '#28a745');
    const chartOrders = makeMiniChart(document.getElementById('chart-orders').getContext('2d'), ordersData, '#ffc107');
    const chartAgent = makeMiniChart(document.getElementById('chart-agent').getContext('2d'), agentData, '#dc3545');
    const chartKamar = makeMiniChart(document.getElementById('chart-kamar').getContext('2d'), kamarData, '#6f42c1');

    // Grafik batang kamar tersedia/dipakai
    const ctxBar = document.getElementById('chart-kamar-bar').getContext('2d');
    let kamarBarChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Tersedia', 'Dipakai'],
            datasets: [{
                label: 'Jumlah Kamar',
                data: [0, 0],
                backgroundColor: ['#28a745', '#dc3545'],
                borderRadius: 8,
            }]
        },
        options: {
            pli{ legend: { display: false } },
            scales: {
                x: { display: true },
                y: { display: true, beginAtZero: true, precision:0 }
            },
            responsive: false,
            maintainAspectRatio: false,
            animation: false
        }
    });

    // Grafik batang kamar tersedia/dipakai per hotel
    const ctxKamarPerHotel = document.getElementById('chart-kamar-per-hotel').getContext('2d');
    let kamarPerHotelChart = new Chart(ctxKamarPerHotel, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'Tersedia',
                    data: [],
                    backgroundColor: '#28a745',
                    borderRadius: 8,
                },
                {
                    label: 'Dipakai',
                    data: [],
                    backgroundColor: '#dc3545',
                    borderRadius: 8,
                }
            ]
        },
        options: {
            plugins: { legend: { display: true } },
            scales: {
                x: { display: true },
                y: { display: true, beginAtZero: true, precision:0 }
            },
            responsive: false,
            maintainAspectRatio: false,
            animation: false
        }
    });

    // Fungsi update data dari server
    function updateDashboardData() {
        fetch('admin_dashboard_data.php')
            .then(res => res.json())
            .then(data => {
                // Push data baru ke array
                locData.push(data.locations);
                propData.push(data.property);
                ordersData.push(data.orders);
                agentData.push(data.agent);
                kamarData.push(data.kamar);
                // Batasi data max 10
                if(locData.length > 10) locData.shift();
                if(propData.length > 10) propData.shift();
                if(ordersData.length > 10) ordersData.shift();
                if(agentData.length > 10) agentData.shift();
                if(kamarData.length > 10) kamarData.shift();
                // Update chart
                chartLoc.data.datasets[0].data = locData;
                chartLoc.update();
                chartProp.data.datasets[0].data = propData;
                chartProp.update();
                chartOrders.data.datasets[0].data = ordersData;
                chartOrders.update();
                chartAgent.data.datasets[0].data = agentData;
                chartAgent.update();
                chartKamar.data.datasets[0].data = kamarData;
                chartKamar.update();
                // Update value di card
                document.getElementById('loc-value').textContent = data.locations;
                document.getElementById('prop-value').textContent = data.property;
                document.getElementById('orders-value').textContent = data.orders;
                document.getElementById('agent-value').textContent = data.agent;
                document.getElementById('kamar-value').textContent = data.kamar;
                // Update grafik kamar tersedia/dipakai
                kamarTersedia = data.kamar_tersedia;
                kamarDipakai = data.kamar_dipakai;
                kamarBarChart.data.datasets[0].data = [kamarTersedia, kamarDipakai];
                kamarBarChart.update();
                // Update label jumlah di bawah chart
                document.getElementById('label-kamar-tersedia').textContent = kamarTersedia;
                document.getElementById('label-kamar-dipakai').textContent = kamarDipakai;
                // Update grafik kamar per hotel
                if (data.kamar_per_hotel) {
                    kamarPerHotelChart.data.labels = data.kamar_per_hotel.map(h => h.hotel);
                    kamarPerHotelChart.data.datasets[0].data = data.kamar_per_hotel.map(h => h.tersedia);
                    kamarPerHotelChart.data.datasets[1].data = data.kamar_per_hotel.map(h => h.dipakai);
                    kamarPerHotelChart.update();
                }
            });
    }

    // Polling setiap 2 detik
    setInterval(updateDashboardData, 2000);
    }
    </script>
    <!-- Modal Upload Profile -->
    @include('admin.header.ubah-poto')
    <script>
    // Modal logic
    const profileImg = document.getElementById('admin-profile-img');
    const profileModal = document.getElementById('profileModal');
    const closeProfileModal = document.getElementById('closeProfileModal');
    const profileUploadForm = document.getElementById('profileUploadForm');
    const profileUploadMsg = document.getElementById('profileUploadMsg');
    const profileFileInput = document.getElementById('profileFileInput');
    const profilePreview = document.getElementById('profilePreview');
    const uploadBtn = document.getElementById('uploadBtn');
    let cropper = null;

    profileImg.onclick = () => { profileModal.style.display = 'flex'; profileUploadMsg.textContent = ''; };
    closeProfileModal.onclick = () => { profileModal.style.display = 'none'; if(cropper) { cropper.destroy(); cropper = null; } profilePreview.style.display = 'none'; };
    window.onclick = (e) => { if(e.target === profileModal) { profileModal.style.display = 'none'; if(cropper) { cropper.destroy(); cropper = null; } profilePreview.style.display = 'none'; } };

    profileFileInput.onchange = function(e) {
      const file = e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = function(evt) {
        profilePreview.src = evt.target.result;
        profilePreview.style.display = 'block';
        if (cropper) cropper.destroy();
        cropper = new Cropper(profilePreview, {
          aspectRatio: 1,
          viewMode: 1,
          dragMode: 'move',
          background: false,
          autoCropArea: 1,
          responsive: true,
          guides: false,
          highlight: false,
          cropBoxResizable: true,
          cropBoxMovable: true,
          minCropBoxWidth: 80,
          minCropBoxHeight: 80,
          ready() {
            // Bulatkan crop box
            const cropBox = this.cropper.cropBox;
            cropBox.classList && cropBox.classList.add('cropper-circular');
          }
        });
      };
      reader.readAsDataURL(file);
    };

    profileUploadForm.onsubmit = function(e) {
      e.preventDefault();
      if (!cropper) {
        profileUploadMsg.textContent = 'Pilih dan crop gambar terlebih dahulu.';
        profileUploadMsg.style.color = '#dc3545';
        return;
      }
      uploadBtn.disabled = true;
      profileUploadMsg.textContent = 'Mengunggah...';
      cropper.getCroppedCanvas({ width: 320, height: 320, imageSmoothingQuality: 'high' }).toBlob(function(blob) {
        const formData = new FormData();
        formData.append('profile_img', blob, 'profile.jpg');
        fetch('/admin/upload-profile', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(res => res.json())
        .then(data => {
          uploadBtn.disabled = false;
          if(data.success) {
            profileUploadMsg.textContent = 'Foto profil berhasil diubah!';
            profileUploadMsg.style.color = '#28a745';
            setTimeout(() => {
              profileModal.style.display = 'none';
              if(cropper) { cropper.destroy(); cropper = null; }
              profilePreview.style.display = 'none';
              // Paksa reload gambar profil (bypass cache)
              profileImg.src = '/assets/img/profil.jpg?' + new Date().getTime();
            }, 1000);
          } else {
            profileUploadMsg.textContent = data.error || 'Gagal upload.';
            profileUploadMsg.style.color = '#dc3545';
          }
        })
        .catch(() => {
          uploadBtn.disabled = false;
          profileUploadMsg.textContent = 'Gagal upload.';
          profileUploadMsg.style.color = '#dc3545';
        });
      }, 'image/jpeg', 0.95);
    };
    </script>
    <style>
    /* Cropper bulat */
    .cropper-circular .cropper-view-box,
    .cropper-circular .cropper-face {
      border-radius: 50% !important;
    }
    </style>
</body>
</html> 