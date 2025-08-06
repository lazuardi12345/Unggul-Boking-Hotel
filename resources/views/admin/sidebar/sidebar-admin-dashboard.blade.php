    <section class="dashboard-section">
                    <h2>Dashboard</h2>
                    <div class="dashboard-cards">
                        <div class="dashboard-card">
                            <div class="card-icon"><img src="/assets/img/adminlocation_icon.png" alt="Locations" style="width:36px;height:36px;object-fit:cover;"></div>
                            <div class="card-info">
                                <span class="card-title">Total Locations</span>
                                <span class="card-value" id="loc-value"><?php echo $totalLocations; ?></span>
                                <canvas id="chart-locations" width="80" height="40"></canvas>
                            </div>
                        </div>
                        <div class="dashboard-card">
                            <div class="card-icon"><img src="/assets/img/adminproperty_icon.png" alt="Property" style="width:36px;height:36px;object-fit:cover;"></div>
                            <div class="card-info">
                                <span class="card-title">Total Property</span>
                                <span class="card-value" id="prop-value"><?php echo $totalProperty; ?></span>
                                <canvas id="chart-property" width="80" height="40"></canvas>
                            </div>
                        </div>
                        <div class="dashboard-card">
                            <div class="card-icon"><img src="/assets/img/adminorder_icon.png" alt="Orders" style="width:36px;height:36px;object-fit:cover;"></div>
                            <div class="card-info">
                                <span class="card-title">Total Orders</span>
                                <span class="card-value" id="orders-value"><?php echo $totalOrders; ?></span>
                                <canvas id="chart-orders" width="80" height="40"></canvas>
                            </div>
                        </div>
                        <div class="dashboard-card">
                            <div class="card-icon"><img src="/assets/img/adminagent_icon.png" alt="Agent" style="width:36px;height:36px;object-fit:cover;border-radius:50%;"></div>
                            <div class="card-info">
                                <span class="card-title">Total Agent</span>
                                <span class="card-value" id="agent-value"><?php echo $totalAgent; ?></span>
                                <canvas id="chart-agent" width="80" height="40"></canvas>
                            </div>
                        </div>
                        <div class="dashboard-card">
                            <div class="card-icon"><img src="/assets/img/AdminAllHotel_icon.png" alt="Locations" style="width:36px;height:36px;object-fit:cover;"></div>
                            <div class="card-info">
                                <span class="card-title">Total All Hotel</span>
                                <span class="card-value"><?php echo $totalAllHotel; ?></span>
                                <canvas style="display:none;"></canvas>
                            </div>
                        </div>
                        <div class="dashboard-card">
                            <div class="card-icon"><img src="/assets/img/adminkamar_icon.png" alt="Kamar" style="width:36px;height:36px;object-fit:cover;"></div>
                            <div class="card-info">
                                <span class="card-title">Total Kamar</span>
                                <span class="card-value" id="kamar-value"><?php echo $totalKamar; ?></span>
                                <canvas id="chart-kamar" width="80" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Grafik Kamar Tersedia/Dipakai per Hotel -->
                    <div class="kamar-bar-container">
                        <h3>Grafik Kamar Tersedia & Dipakai per Hotel (Realtime)</h3>
                        <canvas id="chart-kamar-per-hotel" width="420" height="220"></canvas>
                    </div>
                    <!-- Grafik Jumlah Kamar Tersedia & Dipakai -->
                    <div class="kamar-bar-container">
                        <h3>Grafik Jumlah Kamar Tersedia & Dipakai (Realtime)</h3>
                        <canvas id="chart-kamar-bar" width="360" height="180">Browser Anda tidak mendukung canvas.</canvas>
                        <div class="kamar-bar-labels">
                            <span class="tersedia">Tersedia: <span id="label-kamar-tersedia">0</span></span>
                            <span class="dipakai">Dipakai: <span id="label-kamar-dipakai">0</span></span>
                        </div>
                    </div>
    </section>