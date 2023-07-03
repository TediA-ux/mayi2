@extends('layouts.master')
@section('title')Dashboard @endsection
@section('body-start') <body id="body" class="dark-sidebar" data-layout="horizontal"> @endsection
    @section('content')
    <!-- page title-->
    @section('breadcrumb')
    @component('components.breadcrumb')
    @slot('li_1') Dashboard @endslot
    @slot('title') Analysis @endslot
    @endcomponent
    @endsection
    <!--end page title-->

    <div class="row">

        {{-- <div class="col-lg-12 order-lg-2 order-md-1 order-sm-1">

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div  class="card  overflow-hidden">
                        <div style="height: 200px" class="card-body">
                            <canvas id="myChart" width="360" height="140"></canvas>

                            <div class="col-12 ms-auto align-self-center">

                                <p class="text-muted mb-0 fw-semibold">TopUps</p>
                            </div>

                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                <div class="col-lg-4 col-md-6">
                    <div  class="card  overflow-hidden">
                        <div style="height: 200px" class="card-body">
                            <canvas id="myChart1" width="360" height="140"></canvas>

                            <div class="col-12 ms-auto align-self-center">

                                <p class="text-muted mb-0 fw-semibold">Givings</p>
                            </div>

                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                <div class="col-lg-4 col-md-6">
                    <div  class="card  overflow-hidden">
                        <div style="height: 200px" class="card-body">
                            <canvas id="myChart2" width="360" height="140"></canvas>

                            <div class="col-12 ms-auto align-self-center">

                                <p class="text-muted mb-0 fw-semibold">Bills</p>
                            </div>

                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->


                <!--end col-->
            </div> --}}

            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row d-flex">
                                <div class="col-3">
                                    <i class="ti ti-users font-36 align-self-center text-dark"></i>
                                </div>
                                <!--end col-->
                                <div class="col-auto ms-auto align-self-center">
                                    <span class="badge badge-soft-success px-2 py-1 font-11">Active</span>
                                </div>
                                <!--end col-->
                                <!--end col-->
                                <div class="col-12 ms-auto align-self-center">
                                    <div id="dash_spark_1" class="mb-3"></div>
                                </div>
                                <!--end col-->
                                <div class="col-12 ms-auto align-self-center">
                                    <h3 class="text-dark my-0 font-22 fw-bold">{{ $usersCount }}</h3>
                                    <p class="text-muted mb-0 fw-semibold">Users</p>
                                </div>
                                <!--end col-->

                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                <div class="col-lg-3 col-md-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row d-flex">
                                <div class="col-3">
                                    <i class="ti ti-activity font-36 align-self-center text-dark"></i>
                                </div>
                                <!--end col-->
                                <div class="col-12 ms-auto align-self-center">
                                    <div id="dash_spark_3" class="mb-3"></div>
                                </div>
                                <!--end col-->
                                <div class="col-12 ms-auto align-self-center">
                                    <h3 class="text-dark my-0 font-22 fw-bold">{{ $membersCount }}</h3>
                                    <p class="text-muted mb-0 fw-semibold">Total MPs</p>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                <div class="col-lg-3 col-md-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row d-flex">
                                <div class="col-3">
                                    <i class="ti ti-cash font-36 align-self-center text-dark"></i>
                                </div>

                                <div class="col-12 ms-auto align-self-center">
                                    <div id="dash_spark_2" class="mb-3"></div>
                                </div>
                                <!--end col-->
                                <div class="col-12 ms-auto align-self-center">
                                    <h3 class="text-dark my-0 font-22 fw-bold">{{ $districtsSum }}</h3>
                                    <p class="text-muted mb-0 fw-semibold">Total Districts</p>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->

                <div class="col-lg-3 col-md-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row d-flex">
                                <div class="col-3">
                                    <i class="ti ti-confetti font-36 align-self-center text-dark"></i>
                                </div>
                                <!--end col-->
                                <div class="col-auto ms-auto align-self-center">
                                    <span class="badge badge-soft-success px-2 py-1 font-11"></span>
                                </div>
                                <!--end col-->
                                <!--end col-->
                                <div class="col-auto ms-auto align-self-center">
                                </div>
                                <!--end col-->
                                <div class="col-12 ms-auto align-self-center">
                                    <div id="dash_spark_4" class="mb-3"></div>
                                </div>
                                <!--end col-->
                                <div class="col-12 ms-auto align-self-center">
                                    <h3 class="text-dark my-0 font-22 fw-bold">{{ $constituenciesSum }}</h3>
                                    <p class="text-muted mb-0 fw-semibold">Total Constituencies</p>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Percentage of Male and Female MPs</h4>
                                </div>
                                <!--end col-->
                                <div class="container">
   
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                        </div>
                                        <div class="panel-body" align="center">
                                        <div id="pie_chart" style="width:750px; height:450px;">

                                        </div>
                                        </div>
                                    </div>
                                    
                                    </div>

                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <div  class="">
                                <canvas ></canvas>

                                
                                

                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->



    @endsection
    @section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

    </style>
    <script type="text/javascript">
    var analytics = <?php echo $gender; ?>

    google.charts.load('current', {'packages':['corechart']});

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(analytics);
        var options = {
            legend: 'none', // Hide the legend
            slices: {
                0: { color: '#3490dc' }, // Color for Male
                1: { color: '#9561e2' }  // Color for Female
            }
        };
        var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
        chart.draw(data, options);
    }
</script>

<script type="text/javascript">




var ctx = document.getElementById("lineChart").getContext('2d');


var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Transactions', // Name the series
            data: users, // Specify the data values array
            fill: false,
            borderColor: '#2196f3', // Add custom color border (Line)
            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
            borderWidth: 1 // Specify bar border width
        }]},
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
    }
});

</script>

    <!-- apexcharts -->
    <script src="{{ URL::asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <!-- polarareacharts init -->
    <script src="{{ URL::asset('assets/pages/analytics-index.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    @endsection
    @section('body-end')</body> @endsection
