@extends('layouts.back.app')

@section('content')
    <!-- Dashboard -->
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Hello, {{ Auth::user()->NamaDepan }}</h3>
                <div class="text">Ready to jump back in?</div>
            </div>
            <div class="row">
                <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="ui-item">
                        <div class="left">
                            <i class="icon fas fa-check-circle"></i>
                        </div>
                        <div class="right">
                            <h4>{{ $userCountAktif }}</h4>
                            <p>Jumlah Pengguna Aktif</p>
                        </div>
                    </div>
                </div>
                <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="ui-item">
                        <div class="left">
                            <i class="icon fas fa-users"></i>
                        </div>
                        <div class="right">
                            <h4>{{ $userCount }}</h4>
                            <p>Jumlah Users</p>
                        </div>
                    </div>
                </div>


                <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="ui-item ui-red">
                        <div class="left">
                            <i class="icon fas fa-file-invoice"></i>
                        </div>
                        <div class="right">
                            <h4>{{ $beasiswaCount }}</h4>
                            <p>Jumlah Beasiswa</p>
                        </div>
                    </div>
                </div>

                <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="ui-item">
                        <div class="left">
                            <i class="icon fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="right">
                            <h4>{{ $pendingUserCount }}</h4>
                            <p>Pending Users</p>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row">


                <div class="col-xl-7 col-lg-12">
                    <!-- Graph widget -->
                    <div class="graph-widget ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>Jumlah Daftar Users Per Bulan</h4>
                                <div class="chosen-outer">
                                    <!--Tabs Box-->
                                    <form id="redirectForm" method="get">
                                        <select id="selectOption" class="chosen-select" name="months"
                                            onchange="redirectToSelectedOption()">
                                            <option value="6" @if (isset($_GET['months']) && $_GET['months'] == '6') selected @endif>6 Bulan
                                                Terakhir</option>
                                            <option value="12" @if (isset($_GET['months']) && $_GET['months'] == '12') selected @endif>12
                                                Bulan Terakhir</option>
                                            <option value="16" @if (isset($_GET['months']) && $_GET['months'] == '16') selected @endif>16
                                                Bulan Terakhir</option>
                                            <option value="24" @if (isset($_GET['months']) && $_GET['months'] == '24') selected @endif>24
                                                Bulan Terakhir</option>

                                        </select>


                                    </form>
                                </div>
                            </div>



                            <div class="widget-content">
                                <canvas id="chart" width="100" height="45"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-lg-12">
                    <!-- Notification Widget -->
                    <div class="notification-widget ls-widget">
                        <div class="widget-title">
                            <h4>Pemberitahuan</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="notification-list">
                                @foreach ($verifikasi as $item)
                                    <li>
                                        <span
                                            class="icon {{ $item->status === 'approved' ? 'fas fa-check text-green' : 'fas fa-clock text-yellow' }}"></span>
                                        <strong>{{ $item->user->NamaDepan }} {{ $item->user->NamaBelakang }}</strong>
                                        {{ $item->catatan }} <span
                                            class="colored{{ $item->status === 'approved' ? ' text-green' : ' text-yellow' }}">{{ $item->status }}</span>
                                    </li>
                                @endforeach



                            </ul>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- End Dashboard -->
@endsection


@section('js')
    <script src="{{ url('/js/chart.min.js') }}"></script>
    <script>
        Chart.defaults.global.defaultFontFamily = "Sofia Pro";
        Chart.defaults.global.defaultFontColor = '#888';
        Chart.defaults.global.defaultFontSize = '14';

        var ctx = document.getElementById('chart').getContext('2d');

        // Generate labels for the last 6 months
        @php
            // Determine the number of months to retrieve data for
            $months = isset($_GET['months']) ? $_GET['months'] : 6;
            $months = is_numeric($months) ? intval($months) : 6;
            $months = max($months, 1);
            
            // Generate labels for the specified number of months
            $labels = [];
            $currentDate = new \DateTime();
            for ($i = $months - 1; $i >= 0; $i--) {
                $date = clone $currentDate;
                $date->modify("-$i months");
                $month = $date->format('n');
                $year = $date->format('Y');
                $labels[] = $month . '/' . $year;
            }
            
            // Retrieve data for the specified number of months from the database
            $data = [];
            for ($i = $months - 1; $i >= 0; $i--) {
                $date = date('Y-m', strtotime("-$i months"));
                $count = DB::table('users')
                    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$date'")
                    ->count();
                $data[] = $count;
            }
        @endphp

        // Use the $labels and $data variables in your JavaScript code as needed
        var labels = {!! json_encode($labels) !!};
        var data = {!! json_encode($data) !!};

        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: "Registrations",
                    backgroundColor: 'transparent',
                    borderColor: '#1967D2',
                    borderWidth: "1",
                    data: data,
                    pointRadius: 3,
                    pointHoverRadius: 3,
                    pointHitRadius: 10,
                    pointBackgroundColor: "#1967D2",
                    pointHoverBackgroundColor: "#1967D2",
                    pointBorderWidth: "2",
                }]
            },
            options: {
                layout: {
                    padding: 10,
                },
                legend: {
                    display: false
                },
                title: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: false
                        },
                        gridLines: {
                            borderDash: [6, 10],
                            color: "#d8d8d8",
                            lineWidth: 1,
                        },
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        },
                    }],
                },
                tooltips: {
                    backgroundColor: '#333',
                    titleFontSize: 13,
                    titleFontColor: '#fff',
                    bodyFontColor: '#fff',
                    bodyFontSize: 13,
                    displayColors: false,
                    xPadding: 10,
                    yPadding: 10,
                    intersect: false
                }
            },
        });
    </script>

    <script>
        function redirectToSelectedOption() {
            var selectElement = document.getElementById('selectOption');
            var selectedOption = selectElement.value;

            var url;
            if (selectedOption === '6') {
                url = '/dashboard?months=6';
            } else if (selectedOption === '12') {
                url = '/dashboard?months=12';
            } else if (selectedOption === '16') {
                url = '/dashboard?months=16';
            } else if (selectedOption === '24') {
                url = '/dashboard?months=24';
            }

            var redirectForm = document.getElementById('redirectForm');
            redirectForm.action = url;
            redirectForm.submit();
        }
    </script>
@endsection
