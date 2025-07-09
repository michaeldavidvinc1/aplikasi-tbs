<div class="bg-white p-4 shadow rounded-xl w-full">
    <h2 class="text-lg font-semibold mb-4">Total Tonase</h2>
    <canvas id="pimpinan-tonase-masuk" height="100"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @script
    <script>
        const labels = @json($labels);
        const data = @json($data);
        const ctx = document.getElementById('pimpinan-tonase-masuk');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tonase Masuk (Kg)',
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
