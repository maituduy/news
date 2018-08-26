@extends('layouts.admin.master')

@section('dashboard', 'active')
@section('title', 'Bảng Điều Khiển')
@section('fa-class', 'fa-dashboard')
@section('page', 'Bảng Điều Khiển')
@section('url', 'dashboard')
@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-user fa-3x"></i>
                <div class="info">
                    <h4>Người dùng</h4>
                    <p><b>{{\App\User::count()}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Nhân viên</h4>
                    <p><b>{{\App\Admin::count()}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fas fa-newspaper  fa-3x"></i>
                <div class="info">
                    <h4>Bài viết hôm nay</h4>
                    <p><b>{{ getStoriesToday() }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-credit-card fa-3x"></i>
                <div class="info">
                    <h4>Lượt xem hôm nay</h4>
                    <p><b>{{ getAllViewsToday() }}</b></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Bài Viết</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="lineChartDemo1"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Lượt xem</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="lineChartDemo2"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page specific javascripts-->
    <script src="{{asset('js/admin/plugins/chart.js')}}"></script>
    <script type="text/javascript">
        var result = [];
            for (var i=1; i<8; i++) {
                var d = new Date();
                d.setDate(d.getDate() - i);
                result.push(d.toLocaleDateString("vi-VN"));
            }
        var data1 = {
            labels: result.reverse(),
            datasets: [
                {
                    label: "Số Bài Viết",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: {{ $count_stories }}
                }
            ]
        };
        
        var data2 = {
            labels: result.reverse(),
            datasets: [
                {
                    label: "Số Lượt Xem",
                    fillColor: "rgba(151,187,205,0.6)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: {{ $count_views }}
                }
            ]
        };
        
        var ctxl = $("#lineChartDemo1").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data1);

        var ctxl = $("#lineChartDemo2").get(0).getContext("2d");
        var barChart = new Chart(ctxl).Bar(data2);

    </script>
    

@endpush