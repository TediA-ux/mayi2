@extends('layouts.master')
@section('title')Dashboard @endsection
@section('body-start') <body id="body" class="dark-sidebar" data-layout="horizontal"> @endsection
    @section('content')
    
    @section('breadcrumb')
    @component('components.breadcrumb')
    @slot('li_1') Dashboard @endslot
    @slot('title') Analysis @endslot
    @endcomponent
    @endsection
    <!--end page title-->

    <div class="row">

        

            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <div class="card overflow-hidden index-card">
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
                                    <h3 class="text-dark my-0 font-22 fw-bold"></h3>
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
                    <div class="card overflow-hidden index-card">
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
                                    <h3 class="text-dark my-0 font-22 fw-bold"></h3>
                                    <p class="text-muted mb-0 fw-semibold">Total Projects</p>
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
                
                <!--end col-->

                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header index-card">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Graphical Representation</h4>
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
    



    <!-- apexcharts -->
    <script src="{{ URL::asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <!-- polarareacharts init -->
    <script src="{{ URL::asset('assets/pages/analytics-index.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    @endsection
    @section('body-end')</body> @endsection
