@extends('admin.layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6" id="medicinesCount">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3></h3>

                            <p>Medicines</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-capsules"></i>
                        </div>
                        <a href="{{ route('admin.medicines.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6" id="pharmaciesCount">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3></h3>

                            <p>Pharmacies</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-ambulance"></i>
                        </div>
                        <a href="{{ route('admin.pharmacies.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6" id="doctorsCount">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3></h3>

                            <p>Doctors</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <a href="{{ route('admin.doctors.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6" id="usersCount">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3></h3>

                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <div class="col-md-6">
                    <!-- DONUT CHART -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Medicines categories</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="medicinesDonutChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- PIE CHART -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Doctors</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="doctorsPieChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col (LEFT) -->
                <div class="col-md-6">
                    <!-- BAR CHART -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Pharmacies doctors</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="pharmaciesBarChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- STACKED BAR CHART -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Users</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="usersBarChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col (RIGHT) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('extra-js')
    <!-- Chroma JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chroma-js/2.4.2/chroma.min.js"
        integrity="sha512-zInFF17qBFVvvvFpIfeBzo7Tj7+rQxLeTJDmbxjBz5/zIr89YVbTNelNhdTT+/DCrxoVzBeUPVFJsczKbB7sew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- ChartJS -->
    <script src={{ asset('admins/plugins/chart.js/Chart.min.js') }}></script>

    <!-- Page specific script -->
    <script>
        $(function() {
            // Get statistics
            $(document).ready(function() {
                @hasrole('admin')
                    $.ajax({
                        url: '{{ route('admin.dashboard.getAdminStats') }}',
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            $('#medicinesCount h3').html(response.medicinesCount);
                            $('#pharmaciesCount h3').html(response.pharmaciesCount);
                            $('#doctorsCount h3').html(response.doctorsCount);
                            $('#usersCount h3').html(response.usersCount);
                        }
                    });
                @endhasrole
                $.ajax({
                    url: '{{ route('admin.dashboard.getMedicinesStats') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const colorScale = chroma.scale(['#4D4D4D', '#5DA5DA', '#FAA43A', '#60BD68', '#F17CB0', '#B2912F', '#B276B2', '#DECF3F', '#F15854'])
                        .colors(Object.keys(response).length);
                        //-------------
                        //- DONUT CHART -
                        //-------------
                        var donutChartCanvas = $('#medicinesDonutChart').get(0).getContext('2d')
                        var donutData = {
                            labels: Object.keys(response),
                            datasets: [{
                                data: Object.values(response),
                                backgroundColor: colorScale
                            }]
                        }
                        var donutOptions = {
                            maintainAspectRatio: false,
                            responsive: true,
                        }
                        new Chart(donutChartCanvas, {
                            type: 'doughnut',
                            data: donutData,
                            options: donutOptions
                        })
                    }
                });
                $.ajax({
                    url: '{{ route('admin.dashboard.getPharmaciesStats') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var areaChartData = {
                        labels: Object.keys(response),
                        datasets: [{
                                label: 'Pharmacy',
                                backgroundColor: 'rgba(40, 167, 69, 0.9)',
                                borderColor: 'rgba(40, 167, 69, 0.8)',
                                pointRadius: false,
                                pointColor: '#3b8bba',
                                pointStrokeColor: 'rgba(40, 167, 69, 1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(40, 167, 69, 1)',
                                data: Object.values(response)
                                }
                            ]
                        }
                        var barChartData = $.extend(true, {}, areaChartData);

                        //---------------------
                        //- BAR CHART -
                        //---------------------
                        var stackedBarChartCanvas = $('#pharmaciesBarChart').get(0).getContext('2d')
                        var stackedBarChartData = $.extend(true, {}, barChartData)

                        var stackedBarChartOptions = {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                xAxes: [{
                                    stacked: true,
                                }],
                                yAxes: [{
                                    stacked: true
                                }]
                            }
                        }

                        new Chart(stackedBarChartCanvas, {
                            type: 'bar',
                            data: stackedBarChartData,
                            options: stackedBarChartOptions
                        })
                    }
                });
                $.ajax({
                    url: '{{ route('admin.dashboard.getDoctorsStats') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var donutData = {
                            labels: Object.keys(response),
                            datasets: [{
                                data: Object.values(response),
                                backgroundColor: ['#28a745', '#dc3545'],
                            }]
                        }
                        var donutOptions = {
                            maintainAspectRatio: false,
                            responsive: true,
                        }

                        //-------------
                        //- PIE CHART -
                        //-------------
                        var pieChartCanvas = $('#doctorsPieChart').get(0).getContext('2d')
                        var pieData = donutData;
                        var pieOptions = {
                            maintainAspectRatio: false,
                            responsive: true,
                        }
                        new Chart(pieChartCanvas, {
                            type: 'pie',
                            data: pieData,
                            options: pieOptions
                        })
                    }
                });
                $.ajax({
                    url: '{{ route('admin.dashboard.getUsersStats') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var areaChartData = {
                        labels: Object.keys(response),
                        datasets: [{
                                label: 'Users',
                                backgroundColor: 'rgba(220, 53, 69, 0.9)',
                                borderColor: 'rgba(220, 53, 69, 0.8)',
                                pointRadius: false,
                                pointColor: '#3b8bba',
                                pointStrokeColor: 'rgba(220, 53, 69, 1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(220, 53, 69, 1)',
                                data: Object.values(response)
                                }
                            ]
                        }
                        var barChartData = $.extend(true, {}, areaChartData);

                        //---------------------
                        //- BAR CHART -
                        //---------------------
                        var stackedBarChartCanvas = $('#usersBarChart').get(0).getContext('2d')
                        var stackedBarChartData = $.extend(true, {}, barChartData)

                        var stackedBarChartOptions = {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                xAxes: [{
                                    stacked: true,
                                }],
                                yAxes: [{
                                    stacked: true
                                }]
                            }
                        }

                        new Chart(stackedBarChartCanvas, {
                            type: 'bar',
                            data: stackedBarChartData,
                            options: stackedBarChartOptions
                        })
                    }
                });
            });
        })
    </script>
@endsection
