<div>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        
        <div class="p-6 bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Kendaraan Masuk (Hari Ini)</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $kendaraanMasukHariIni }}</p>
                </div>
                <div class="p-3 text-blue-600 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Pendapatan (Hari Ini)</p>
                    <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
                </div>
                <div class="p-3 text-green-600 bg-green-100 rounded-full">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 11.21 12.768 11 12 11c-.768 0-1.536.21-2.121.579L9 12.25m0 0l-1.06-.796M12 6v12m6-3.182c-1.172-.879-3.07-.879-4.242 0C13.536 15.21 12.768 15.5 12 15.5c-.768 0-1.536-.21-2.121.579L9 14.75m0 0l-1.06-.796" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase">Kendaraan Keluar (Hari Ini)</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $kendaraanKeluarHariIni }}</p>
                </div>
                <div class="p-3 text-yellow-600 bg-yellow-100 rounded-full">
                   <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0110.5 3h6a2.25 2.25 0 012.25 2.25v13.5A2.25 2.25 0 0116.5 21h-6a2.25 2.25 0 01-2.25-2.25V15m-3 0l3-3m0 0l3 3m-3-3v12" />
                    </svg>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 gap-6 mt-8 lg:grid-cols-2">
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h3 class="mb-4 text-lg font-semibold text-gray-800">Grafik Pendapatan Mingguan</h3>
            <div class="h-64">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h3 class="mb-4 text-lg font-semibold text-gray-800">Tipe Kendaraan (Saat Ini Parkir)</h3>
            <div class="flex items-center justify-center h-64">
                <canvas id="vehicleChart" style="max-height: 250px;"></canvas>
            </div>
        </div>
    </div>

    @script
    <script>
        document.addEventListener('livewire:navigated', () => {
            initCharts();
        });

        function initCharts() {
            if (typeof Chart === 'undefined') {
                console.error('Chart.js is not loaded.');
                return;
            }
            
            const revenueCtx = document.getElementById('revenueChart');
            if (revenueCtx) {
                new Chart(revenueCtx, {
                    type: 'line',
                    data: {
                        labels: @json($revenueLabels),
                        datasets: [{
                            label: 'Pendapatan',
                            data: @json($revenueData),
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            tension: 0.3,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }

            const vehicleCtx = document.getElementById('vehicleChart');
            if (vehicleCtx) {
                new Chart(vehicleCtx, {
                    type: 'pie',
                    data: {
                        labels: @json($vehicleLabels),
                        datasets: [{
                            label: 'Jumlah Kendaraan',
                            data: @json($vehicleData),
                            backgroundColor: [
                                'rgb(245, 158, 11)',
                                'rgb(16, 185, 129)',
                                'rgb(59, 130, 246)',
                                'rgb(239, 68, 68)',
                                'rgb(99, 102, 241)'
                            ],
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }
        }
        
        initCharts();
    </script>
    @endscript

</div>