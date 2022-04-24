@extends('layouts.master')
@section('title')
    Halaman Utama
@endsection
@section('header')
    Halaman Utama
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Halaman Utama</a></li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Grafik Pengajuan SPJ Tahun {{date('Y')}}
            </h3>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="myChart" style="height:230px"></canvas>
                </div>
            </div>
        </div><!-- /.card-body -->
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#80b6f4');
        gradientStroke.addColorStop(1, '#ffc9c1');
        var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
        gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
        gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
                datasets: [{
                    label: 'Total Pengajuan Per Periode',
                    data: [
                        {{$bar}}
                    ],
                    borderColor: '#1d20ee',
                    pointBorderColor: '#1d20ee',
                    pointBackgroundColor: "#c7ddf5",
                    pointHoverBackgroundColor: "#1e3d60",
                    pointHoverBorderColor: '#1d20ee',
                    borderCapStyle: 'square',
                    borderDash: [], // try [5, 15] for instance
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderWidth: 1,
                    pointHoverRadius: 7,
                    pointHoverBorderWidth: 2,
                    pointRadius: 5,
                    fill: true,
                    backgroundColor: gradientFill,
                    borderWidth: 2,
                }]
            },
            options: {
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 0,
                        bottom: 0
                    }
                },
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: '#fff',
                    titleFontColor: '#333',
                    bodyFontColor: '#666',
                    bodySpacing: 4,
                    xPadding: 12,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest"
                },
                legend: {
                    position: "top",
                    fillStyle: "#FFF",
                    display: true,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "rgb(129,129,129)",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 5,
                        },
                        gridLines: {
                            drawTicks: true,
                            drawBorder: true,
                            display: true,
                            color: "rgba(255,255,255,0.1)",
                            zeroLineColor: "transparent"
                        },
                    }],
                }
            }
        });
    </script>
@endpush
