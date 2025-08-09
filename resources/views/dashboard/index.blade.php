@extends('adminlte::page')
@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-center">System Overview</h2>
        <div class="row justify-content-center mb-5">
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3 shadow">
                    <div class="card-body text-center">
                        <h3 class="card-title">Total Organizations</h3>
                        <h1 class="display-4 countup" data-count="{{ $totalOrganizations }}">0</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3 shadow">
                    <div class="card-body text-center">
                        <h3 class="card-title">Total Vessels</h3>
                        <h1 class="display-4 countup" data-count="{{ $totalVessels }}">0</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3 shadow">
                    <div class="card-body text-center">
                        <h3 class="card-title">Total Voyages</h3>
                        <h1 class="display-4 countup" data-count="{{ $totalVoyages }}">0</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3 shadow">
                    <div class="card-body text-center">
                        <h3 class="card-title">Total Noon Reports</h3>
                        <h1 class="display-4 countup" data-count="{{ $totalNoonReports }}">0</h1>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header bg-gradient-primary text-white">
                        <h4 class="mb-0">Vessels</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="vesselsLineChart" height="100"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header bg-gradient-success text-white">
                        <h4 class="mb-0">Organizations</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="organizationsLineChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // CountUp effect for cards
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.countup').forEach(function(el) {
                const target = parseInt(el.getAttribute('data-count'));
                let count = 0;
                const duration = 800;
                const stepTime = Math.max(Math.floor(duration / target), 20);
                const increment = Math.ceil(target / (duration / stepTime));
                const counter = setInterval(function() {
                    count += increment;
                    if (count >= target) {
                        count = target;
                        clearInterval(counter);
                    }
                    el.textContent = count;
                }, stepTime);
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Vessels Bar Graph
            new Chart(document.getElementById('vesselsLineChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Total Vessels'],
                    datasets: [{
                        label: 'Vessels',
                        data: [{{ $totalVessels }}],
                        fill: false,
                        borderColor: 'rgba(0, 123, 255, 1)',
                        backgroundColor: 'rgba(0, 123, 255, 0.2)',
                        tension: 0.4,
                        pointRadius: 6,
                        pointBackgroundColor: 'rgba(0, 123, 255, 1)'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
            // Organizations Bar Graph
            new Chart(document.getElementById('organizationsLineChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Total Organizations'],
                    datasets: [{
                        label: 'Organizations',
                        data: [{{ $totalOrganizations }}],
                        fill: false,
                        borderColor: 'rgba(40, 167, 69, 1)',
                        backgroundColor: 'rgba(40, 167, 69, 0.2)',
                        tension: 0.4,
                        pointRadius: 6,
                        pointBackgroundColor: 'rgba(40, 167, 69, 1)'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
