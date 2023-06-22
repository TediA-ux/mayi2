@extends('layouts.master')
@section('title')Dashboard @endsection
@section('body-start') <body id="body" class="dark-sidebar"> @endsection
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
                                    <h3 class="text-dark my-0 font-22 fw-bold">{{ number_format($usersCount) }}</h3>
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
                                    <h3 class="text-dark my-0 font-22 fw-bold">{{ number_format($transactionsCount) }}</h3>
                                    <p class="text-muted mb-0 fw-semibold">Total Transactions</p>
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
                                    <h3 class="text-dark my-0 font-22 fw-bold">UGX {{ number_format($GivingsSum) }}</h3>
                                    <p class="text-muted mb-0 fw-semibold">Total Amount Given</p>
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
                                    <span class="badge badge-soft-success px-2 py-1 font-11">Successful</span>
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
                                    <h3 class="text-dark my-0 font-22 fw-bold">UGX {{ number_format($topUpsSum) }}</h3>
                                    <p class="text-muted mb-0 fw-semibold">Total Amount Topped up</p>
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
                                    <h4 class="card-title">Transactions Overview</h4>
                                </div>
                                <!--end col-->

                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <div style="height: 400px" class="">
                                <canvas id="lineChart"></canvas>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

<script type="text/javascript">


var labels =  {{ Js::from($dates) }};
var users =  {{ Js::from($counts) }};

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
