<div class="bg-white p-4 shadow rounded-xl">
    <h2 class="text-lg font-semibold mb-4">Pendapatan Bulanan</h2>
    <canvas id="pendapatan-bulanan" height="75"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @script
    <script>
        const labels = @json($labels);
        const data = @json($data);
        const ctx = document.getElementById('pendapatan-bulanan');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Bayar (Rp)',
                    data: data,
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    @endscript
</div>
