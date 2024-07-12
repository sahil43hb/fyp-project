@extends('admin.layouts.master')

@section('title')
    Footcase - Admin
@endsection

@section('css')
@endsection

@section('content')
    <div class="pagetitle d-flex justify-content-between align-items-center my-4">
        <h1>Dashboard</h1>
        <form action="{{ route('report_generate') }}" method="POST">
            @csrf
            <button class="btn btn-primary">Generate Report</button>
        </form>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-5">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Customers</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $users }}</h6> <span class="text-muted small pt-2 ps-1">Total
                                            Users</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->


                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-7">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Sales</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>Rs. {{ $orders->sum('total') }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Total Sale</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    {{-- Orders Cart --}}
                    <div class="col-xxl-4 col-md-5">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Orders</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $orders->count() }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Total Orders</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Customers Card -->
                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-7">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Revenue</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>Rs. {{ intVal($orders->sum('total')) * (15 / 100) }}</h6>
                                        <span class="text-muted small pt-2 ps-1">Total Revenue</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->



                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Reports</h5>
                                <!-- Line Chart -->
                                <div id="reportsChart"></div>
                                <script>
                                    var monthlyTotals = {!! json_encode($monthlyTotals) !!};
                                    var monthLabels = {!! json_encode($monthLabels) !!};

                                    var monthlyUserCounts = {!! json_encode($monthlyUserCounts) !!};


                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                    name: 'Sales',
                                                    data: monthlyTotals
                                                },
                                                {
                                                    name: 'Customers',
                                                    data: monthlyUserCounts
                                                }
                                            ],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#ff771d', '#2eca6a'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: monthLabels
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->
                            </div>

                        </div>
                    </div><!-- End Reports -->
                </div>
            </div><!-- End Left side columns -->
            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recent Activity</h5>
                        <div class="activity">
                            @foreach ($login_activities as $login_activity)
                                <div class="activity-item d-flex">
                                    <div class="activite-label">
                                        {{ $login_activity->created_at->diffForHumans() }}</div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        {{ $login_activity->user->email }}
                                    </div>
                                </div><!-- End activity item-->
                            @endforeach
                        </div>

                    </div>
                </div><!-- End Recent Activity -->

                {{-- <!-- Budget Report -->
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Budget Report</h5>
                        <div id="budgetChart" style="min-height: 400px;" class="echart"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                                    legend: {
                                        data: ['Allocated Budget', 'Actual Spending']
                                    },
                                    radar: {
                                        // shape: 'circle',
                                        indicator: [{
                                                name: 'Sales',
                                                max: 6500
                                            },
                                            {
                                                name: 'Administration',
                                                max: 16000
                                            },
                                            {
                                                name: 'Information Technology',
                                                max: 30000
                                            },
                                            {
                                                name: 'Customer Support',
                                                max: 38000
                                            },
                                            {
                                                name: 'Development',
                                                max: 52000
                                            },
                                            {
                                                name: 'Marketing',
                                                max: 25000
                                            }
                                        ]
                                    },
                                    series: [{
                                        name: 'Budget vs spending',
                                        type: 'radar',
                                        data: [{
                                                value: [4200, 3000, 20000, 35000, 50000, 18000],
                                                name: 'Allocated Budget'
                                            },
                                            {
                                                value: [5000, 14000, 28000, 26000, 42000, 21000],
                                                name: 'Actual Spending'
                                            }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div><!-- End Budget Report --> --}}

            </div><!-- End Right side columns -->

        </div>
    </section>
@endsection

@section('script')
@endsection
