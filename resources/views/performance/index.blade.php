@extends('adminlte::page')
@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Vessel Performance: Speed vs Engine RPM</h2>
    <div class="card shadow" style="max-width: 900px; margin: 0 auto;">
        <div class="card-body">
            <form method="GET" action="{{ route('performance.index') }}" class="mb-4">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="vessel_id" class="col-form-label">Select Vessel:</label>
                    </div>
                    <div class="col-auto">
                        <select name="vessel_id" id="vessel_id" class="form-control" onchange="this.form.submit()">
                            @foreach($vessels as $vessel)
                                <option value="{{ $vessel->id }}" {{ $selectedVessel == $vessel->id ? 'selected' : '' }}>{{ $vessel->vessel_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <div>
                <canvas id="performanceChart" height="150"></canvas>
            </div>
             <div>
                <canvas id="powerChart" height="150"></canvas>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const graphData = @json($graphData);
    const sortedNoonReports = [...graphData.noon_reports].sort((a, b) => Number(a.average_engine_rpm_since_last_noon_report) - Number(b.average_engine_rpm_since_last_noon_report));

    // Scatter plot for Speed vs Engine RPM
    const ctx = document.getElementById('performanceChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'Speed (knots)',
                data: sortedNoonReports.map(d => ({ x: Number(d.average_engine_rpm_since_last_noon_report), y: Number(d.avg_speed_since_last_noon_report_log), report_date: d.report_date })),
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                showLine: false,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                title: { display: true, text: 'Speed vs Engine RPM (Scatter)' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const d = context.raw;
                            let label = `Speed: ${d.y} knots, RPM: ${d.x}`;
                            if (d.report_date) {
                                const date = new Date(d.report_date);
                                const day = String(date.getDate()).padStart(2, '0');
                                const month = String(date.getMonth() + 1).padStart(2, '0');
                                const year = date.getFullYear();
                                label += `\nDate: ${day}/${month}/${year}`;
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                x: { title: { display: true, text: 'Engine RPM' }, type: 'linear' },
                y: { title: { display: true, text: 'Speed (knots)' } }
            }
        }
    });

    // Scatter plot for Engine Power vs Engine RPM
    const ctx2 = document.getElementById('powerChart').getContext('2d');
    const chart2 = new Chart(ctx2, {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'Engine Power',
                data: sortedNoonReports.map(d => ({ x: Number(d.average_engine_rpm_since_last_noon_report), y: Number(d.engine_power), report_date: d.report_date })),
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                showLine: false,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                title: { display: true, text: 'Engine Power vs Engine RPM (Scatter)' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const d = context.raw;
                            let label = `Power: ${d.y}, RPM: ${d.x}`;
                            if (d.report_date) {
                                const date = new Date(d.report_date);
                                const day = String(date.getDate()).padStart(2, '0');
                                const month = String(date.getMonth() + 1).padStart(2, '0');
                                const year = date.getFullYear();
                                label += `\nDate: ${day}/${month}/${year}`;
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                x: { title: { display: true, text: 'Engine RPM' }, type: 'linear' },
                y: { title: { display: true, text: 'Engine Power' } }
            }
        }
    });
</script>
@endsection
