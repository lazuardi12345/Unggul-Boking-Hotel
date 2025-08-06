<?php
// admin_properties.php
// Dummy data for demonstration (replace with DB in production)
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Property Management</title>
    <link rel="stylesheet" href="/assets/css/admin_properties.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-properties-container">
        <a href="admin_dashboard.php" class="back-btn" style="display:inline-block;margin-bottom:18px;background:#1e3c72;color:#fff;padding:8px 20px;border-radius:5px;text-decoration:none;font-weight:600;transition:background 0.2s;"><i class="fa fa-arrow-left"></i> Kembali</a>
        <h1>Admin Property Management</h1>
        <?php if (!empty($msg)): ?>
            <div class="admin-msg"><?php echo $msg; ?></div>
        <?php endif; ?>
        <table class="property-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Price/Night</th>
                    <th>Rating</th>
                    <th>Facilities</th>
                    <th>Rooms</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($hotels)): ?>
                        <?php foreach ($hotels as $hotel): ?>
                            <tr>
                                <td>
                                    <img src="images/<?php echo htmlspecialchars($hotel['image']); ?>" alt="<?php echo htmlspecialchars($hotel['name']); ?>" class="hotel-thumb">
                                </td>
                                <td><?php echo htmlspecialchars($hotel['name']); ?></td>
                                <td><?php echo htmlspecialchars($hotel['location']); ?></td>
                                <td>Rp. <?php echo number_format($hotel['price'] ?? 0, 0, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($hotel['rating']); ?></td>
                                <td>
                                    <ul>
                                        <?php if (!empty($hotel['facilities']) && is_array($hotel['facilities'])): ?>
                                            <?php foreach ($hotel['facilities'] as $f): ?>
                                                <li><?php echo htmlspecialchars($f); ?></li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li>Tidak ada fasilitas</li>
                                        <?php endif; ?>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <?php if (!empty($hotel['rooms']) && is_array($hotel['rooms'])): ?>
                                            <?php foreach ($hotel['rooms'] as $idx => $room): ?>
                                                <li>
                                                    <?php echo htmlspecialchars($room['type']) . ': ' . htmlspecialchars($room['count']); ?>
                                                    <button class="edit-btn" style="margin-left:8px;padding:2px 10px;font-size:0.9em;"
                                                        onclick="showEditForm('<?php echo $hotel['id']; ?>', <?php echo $idx; ?>, '<?php echo htmlspecialchars($room['type'], ENT_QUOTES); ?>', <?php echo $room['count']; ?>)">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li>Tidak ada kamar</li>
                                        <?php endif; ?>
                                    </ul>
                                </td>
                                <td>
                                    <button class="add-btn" onclick="showAddRoomForm('<?php echo $hotel['id']; ?>')">
                                        <i class="fa fa-plus"></i> Add Room
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8">Data hotel belum tersedia.</td></tr>
                    <?php endif; ?>

            </tbody>
        </table>

        <!-- Edit Room Modal -->
        <div id="editRoomModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal('editRoomModal')">&times;</span>
                <h2>Edit Room</h2>
                <form method="POST">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="hotel_id" id="edit_hotel_id">
                    <input type="hidden" name="room_index" id="edit_room_index">
                    <div class="form-group">
                        <label for="edit_room_type">Room Type</label>
                        <input type="text" name="room_type" id="edit_room_type" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_room_count">Room Count</label>
                        <input type="number" name="room_count" id="edit_room_count" min="1" required>
                    </div>
                    <button type="submit" class="save-btn">Save</button>
                </form>
                <div style="margin-top:10px;color:#e67e22;font-size:0.95em;">Fitur edit kamar hanya demo (tidak tersimpan permanen).</div>
            </div>
        </div>
        <!-- Add Room Modal -->
        <div id="addRoomModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal('addRoomModal')">&times;</span>
                <h2>Add Room</h2>
                <form method="POST">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="hotel_id" id="add_hotel_id">
                    <div class="form-group">
                        <label for="add_room_type">Room Type</label>
                        <input type="text" name="room_type" id="add_room_type" required>
                    </div>
                    <div class="form-group">
                        <label for="add_room_count">Room Count</label>
                        <input type="number" name="room_count" id="add_room_count" min="1" required>
                    </div>
                    <button type="submit" class="save-btn">Add</button>
                </form>
            </div>
        </div>

        <h2>Grafik Kamar Tersedia & Dipakai per Hotel (Realtime)</h2>
        <canvas id="roomsStatusChart" width="300" height="120" style="margin-bottom:30px;"></canvas>
        <h2>Grafik Jumlah Kamar Tersedia & Dipakai (Realtime)</h2>
        <canvas id="totalRoomsPie" width="300" height="120" style="margin-bottom:30px;"></canvas>
        <h2>Grafik Jumlah Kamar per Hotel</h2>
        <canvas id="roomsChart" width="300" height="120" style="margin-bottom:30px;"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Grafik Kamar Tersedia & Dipakai per Hotel
    const ctxStatus = document.getElementById('roomsStatusChart').getContext('2d');
    const roomsStatusChart = new Chart(ctxStatus, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($hotel_labels); ?>
            datasets: [
                {
                    label: 'Tersedia',
                    data: <?php echo json_encode($hotel_available_counts); ?>,
                    backgroundColor: 'rgba(46, 204, 113, 0.7)',
                    borderColor: 'rgba(46, 204, 113, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Dipakai',
                    data: <?php echo json_encode($hotel_occupied_counts); ?>,
                    backgroundColor: 'rgba(231, 76, 60, 0.7)',
                    borderColor: 'rgba(231, 76, 60, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
    // Grafik Jumlah Kamar Tersedia & Dipakai (Total)
    const ctxPie = document.getElementById('totalRoomsPie').getContext('2d');
    const totalRoomsPie = new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['Tersedia', 'Dipakai'],
            datasets: [{
                data: [<?php echo $total_available; ?>, <?php echo $total_occupied; ?>],
                backgroundColor: [
                    'rgba(46, 204, 113, 0.7)',
                    'rgba(231, 76, 60, 0.7)'
                ],
                borderColor: [
                    'rgba(46, 204, 113, 1)',
                    'rgba(231, 76, 60, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
    // Grafik Jumlah Kamar per Hotel (lama)
    const ctx = document.getElementById('roomsChart').getContext('2d');
    const roomsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($hotel_labels); ?>,
            datasets: [{
                label: 'Jumlah Kamar',
                data: <?php echo json_encode($hotel_room_counts); ?>,
                backgroundColor: 'rgba(30, 60, 114, 0.7)',
                borderColor: 'rgba(30, 60, 114, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
    function showEditForm(hotelId, roomIndex, roomType, roomCount) {
        document.getElementById('edit_hotel_id').value = hotelId;
        document.getElementById('edit_room_index').value = roomIndex;
        document.getElementById('edit_room_type').value = roomType;
        document.getElementById('edit_room_count').value = roomCount;
        document.getElementById('editRoomModal').style.display = 'block';
    }
    function showAddRoomForm(hotelId) {
        document.getElementById('add_hotel_id').value = hotelId;
        document.getElementById('addRoomModal').style.display = 'block';
    }
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    }
    </script>
</body>
</html> 