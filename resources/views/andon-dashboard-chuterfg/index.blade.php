<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title> @yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!-- Favicon and Apple Touch Icon -->
    <link href="{{ asset('assets/img/logo3.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo4.png') }}" rel="apple-touch-icon">

    <link rel="stylesheet" href="{{ asset('assets\fontawesome-free-6.2.1\css\all.css') }}">



    <link href="{{ asset('assets/css/family.css') }}" rel="stylesheet">
    {{-- <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet"> --}}

    <!-- Vendor CSS Files -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> --}}
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">


    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- DataTables -->
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery1.dataTables.min.css') }}" rel="stylesheet">
    <!-- Header bagian lainnya -->
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/css.css') }}">

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<style>
    .custom-container {
        margin-left: 20px;
        /* Adjust the left margin as needed */
        margin-right: 20px;
        /* Adjust the right margin as needed */
    }

    /* Dropdown item styles */
    .dropdown-item {
        position: relative;
        overflow: hidden;
        transition: color 0.3s ease;
        padding: 0.5rem 1rem;
        /* Adjusted padding for items */
    }

    /* Underline effect on hover/focus */
    .dropdown-item:before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 0.2rem;
        background-color: #007bff;
        transform: scaleX(0);
        transform-origin: bottom right;
        transition: transform 0.3s ease;
    }

    /* Expand underline effect on hover/focus */
    .dropdown-item:hover:before,
    .dropdown-item:focus:before {
        transform: scaleX(1);
        transform-origin: bottom left;
    }

    /* Change text color on hover/focus */
    .dropdown-item:hover,
    .dropdown-item:focus {
        color: #007bff;
    }

    /* Active item background and text color */
    .dropdown-item.active {
        background-color: #0056b3;
        color: #fff;
    }

    /* Display dropdown menu on hover */
    .dropdown:hover .dropdown-menu {
        display: block;
    }

    /* Adjust dropdown button size */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    /* Adjust dropdown menu width */
    .dropdown-menu {
        min-width: 150px;
        /* Optional: Increase the width of the dropdown menu */
    }


    .btn,
    .badge {
        font-size: 0.75rem;
        /* Set font size to 0.75rem for both buttons and badges */
    }

    .badge {
        padding: 0.25rem 0.5rem;
        /* Adjust badge padding for better appearance */
    }

    .custom-table {
        font-size: 16px;
        font: bold;
        font-weight: bold;
        border-collapse: collapse;
        background-color: transparent;
    }

    .custom-table2 {
        font-size: 16px;
        font: bold;
        border-collapse: collapse;
        background-color: transparent;
    }

    .custom-table th,
    .custom-table td {
        padding: 2px 5px;
        border: 2px solid black;
        background-color: transparent;
    }

    .custom-table th:first-child,
    .custom-table td:first-child {
        width: 100px;
    }

    .custom-table th:nth-child(2),
    .custom-table td:nth-child(2) {
        width: 150px;
    }

    .custom-table th:last-child,
    .custom-table td:last-child {
        width: 100px;
    }

    .custom-table tbody tr {
        border-bottom: 2px solid black;
    }

    /* .table-container {
        position: relative;
        max-height: 200px;
        overflow: hidden;
        border: 1px solid #ddd;
    } */

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        display: block;
        overflow-y: hidden;
    }



    .chart-container {
        margin-bottom: 10px;
        text-align: center;
    }

    .carousel-item {
        margin-bottom: 15px;
    }


    .chart-container {
        width: 50%;
        padding: 10px;
    }

    #scrollingFooter {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .blur-text {
        color: white;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    .logo-container img {
        opacity: 0.1;
    }

    .watermark-container {
        pointer-events: none;
        /* Agar watermark tidak terpengaruh oleh elemen lainnya */
    }
</style>

{{-- <body
    style="background-image: url('/assets/img/dharma.png');
             background-repeat: no-repeat;
             background-position: center;
             background-size: 50%;
             background-attachment: fixed;"> --}}

<body>
    <div
        style="width: 100%; height: 100%; position: absolute; top: 0; left: 0;
                filter: blur(25px); /* Blurs the background image */">
    </div>
    <!-- New overlay layer -->
    <div
        style="width: 100%; height: 100%; position: absolute; top: 0; left: 0;
                background: rgba(255, 255, 255, 0.733); /* Semi-transparent overlay */
                z-index: -1;">
        <!-- Ensures this layer is behind the content -->
    </div>
    <div class="custom-container mt-2">
        <div class="d-flex align-items-center justify-content-between ">
            <!-- <div class="col">
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm" type="button" id="dropdownMenuButton" aria-expanded="false"
                        style="background-color: #007bff; border: none;">
                        <i class="ri-drag-move-2-line"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a class="dropdown-item" href="{{ route('home') }}" title="Dashboard">
                                <i class="bi bi-folder"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item" title="Refresh" onclick="refreshPage()">
                                <i class="bi bi-arrow-repeat"></i> Refresh
                            </button>
                        </li>

                        <li>
                            <button class="dropdown-item" type="button" onclick="$('#cardCarousel').carousel('prev')">
                                <i class="bi bi-arrow-left-circle"></i> Previous
                            </button>
                        </li>
                        <li>
                            <button class="dropdown-item" type="button" onclick="$('#cardCarousel').carousel('next')">
                                <i class="bi bi-arrow-right-circle"></i> Next
                            </button>
                        </li>
                    </ul>
                </div>
            </div> -->

            <div class="col">
                <!-- Your heading -->
                <span class="ml-4 mt-0 mb-0"><b> PT TRIMITRA CHITRAHASTA - DASHBOARD MONITORING STOCK FINISH
                        GOODS</b></span>
            </div>
            <div class="col">
                <span class="ml-4 mt-0 mb-0"><b>UPDATE MASTER MIN MAX : {{ strtoupper($formattedPeriod) }}</b></span>
            </div>

            <div class="d-flex">
                <!-- KRITIS Button -->

                <div class="position-relative me-3">
                    <span class="ml-2 mt-0 mb-0"><b><span id="currentDate"> </span> </b></span>

                </div>
                <!-- KRITIS Button -->

                <div class="position-relative me-3">
                    <button type="button" class="btn btn-danger btn-sm" id="getKritis"
                        style="background-color: rgba(255, 0, 32, 0.8); border: none;">
                        <span>KRITIS | {{ $percentKritis }}%</span>
                    </button>
                </div>

                <!-- OVER Button -->
                <div class="position-relative me-3">
                    <button type="button" class="btn btn-warning btn-sm" id="getOver"
                        style=" background-color: rgb(255, 205, 86); border: none;">
                        <span>OVER | {{ $percentOver }}%</span>
                    </button>
                </div>

                <!-- OK Button -->
                <div class="position-relative">
                    <button type="button" class="btn btn-success btn-sm text-dark"
                        style="pointer-events: none; background-color: rgba(121, 214, 126, 1); border: none;">
                        <span>OK | {{ $percentOk }}%</span>
                    </button>
                </div>
            </div>
        </div>
        {{-- carousel --}}
        <div id="cardCarousel" class="carousel slide mt-3" data-ride="carousel" data-interval="6000">
            <div class="carousel-inner">
                @foreach ($carouselPages as $index => $carouselPage)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="row">
                            @foreach ($carouselPage as $table)
                                @php
                                    // Adjust md size based on item count
                                    $columnClass = 'md-4'; // Default is 3 items (col-md-4)
                                    if ($groupGridpage === 2) {
                                        $columnClass = 'md-6'; // Adjust if there are 2 items
                                    }
                                @endphp
                                <div class="col-12 col-sm-6 col-{{ $columnClass }} d-flex justify-content-center">
                                    {{-- <div class="col-12 col-sm-6 col-md-4 d-flex justify-content-center"> --}}
                                    <div class="d-flex flex-column align-items-center"
                                        style="background-color: rgba(233, 235, 240, 0.918); padding: 10px; border-radius: 8px;">
                                        <!-- Chart Section -->
                                        <div class="chart-container mb-1"
                                            style="display: flex; flex-direction: column; align-items: center;">
                                            <div
                                                style="display: flex; align-items: center; justify-content: center; width: 100%;">
                                                <!-- First Pie Chart -->
                                                <div
                                                    style="display: flex; flex-direction: column; align-items: center;">
                                                    <canvas id="pieChart-{{ $table['cust_code'] }}"
                                                        style="max-width: 200px; max-height: 200px;"></canvas>
                                                    <div
                                                        style="font-size: 15px; margin-top: 5px; text-align: center; font-weight: bold;">
                                                        FG STOCK</div>
                                                </div>

                                                <!-- Second Pie Chart for Qty Plant -->
                                                <div
                                                    style="display: flex; flex-direction: column; align-items: center; margin-left: 20px;">
                                                    <canvas id="pieChartQtyplant-{{ $table['cust_code'] }}"
                                                        style="max-width: 160px; max-height: 150px;"></canvas>
                                                    <div
                                                        style="font-size: 15px; margin-top: 5px; text-align: center; font-weight: bold;">
                                                        ALL STOCK</div>
                                                </div>
                                                @if (isset($table['cust_code']))
                                                    @php
                                                        $logoSrc = '';
                                                        $logoWidth = 185;
                                                        $logoHeight = 100;
                                                        switch ($table['cust_code']) {
                                                            case 'ADM':
                                                                $logoSrc = asset('assets/img/adm.png');
                                                                break;
                                                            case 'HPM':
                                                                $logoSrc = asset('assets/img/hpm.png');
                                                                break;
                                                            case 'YIMM':
                                                                $logoSrc = asset('assets/img/yimm.png');
                                                                break;
                                                            default:
                                                                $logoSrc = ''; // No default image
                                                                break;
                                                        }
                                                    @endphp

                                                    @if ($logoSrc)
                                                        <div
                                                            style="display: flex; flex-direction: column; align-items: center; margin-left: 20px;">
                                                            <img src="{{ $logoSrc }}"
                                                                alt="{{ $table['cust_code'] }} Logo"
                                                                style="width: {{ $logoWidth }}px; height: {{ $logoHeight }}px;">
                                                            <span
                                                                style="font-weight: bold; text-align: center; margin-top: 5px;"></span>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        {{-- <div class="chart-container mb-1"
                                            style="display: flex; flex-direction: column; align-items: center;">
                                            <span>Stock Finish Goods
                                        </div> --}}

                                        <!-- Table Section -->
                                        <div class="table-responsive" style="width: 100%;">
                                            <table class="table custom-table2">

                                                <thead>
                                                    <!-- Header Table -->
                                                    <tr>
                                                        <td width="20%" class="text-center" rowspan="2"
                                                            style="padding: 3pt; vertical-align: middle; font-weight: bold;">
                                                            ITEMCODE
                                                        </td>
                                                        <td width="40%" class="text-center" rowspan="2"
                                                            style="padding: 3pt; vertical-align: middle; font-weight: bold;">
                                                            PART NO - PART NAME
                                                        </td>
                                                        <td width="10%" class="text-center"
                                                            style="padding: 3pt; font-weight: bold;">
                                                            MIN
                                                        </td>
                                                        <td width="15%" class="text-center" rowspan="2"
                                                            style="padding: 3pt; vertical-align: middle; font-weight: bold;">
                                                            FG_STOCK
                                                        </td>
                                                        <td width="15%" class="text-center" rowspan="2"
                                                            style="padding: 3pt; vertical-align: middle; font-weight: bold;">
                                                            ALL_STOCK
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center"
                                                            style="padding: 3pt; font-weight: bold;">
                                                            MAX
                                                        </td>
                                                    </tr>
                                                </thead>
                                            </table>

                                            <table class="table mt-1 custom-table"
                                                id="scrollable-tbody-{{ $loop->index }}">
                                                <tbody>
                                                    @foreach ($table['items'] as $item)
                                                        @if ($item['balance'] < $item['min'])
                                                            <tr>
                                                                <td width="20%" rowspan="2" class="text-center"
                                                                    style="vertical-align: middle;">
                                                                    {{ $item['itemcode'] }}
                                                                </td>
                                                                <td width="40%" rowspan="2"
                                                                    style="vertical-align: middle;">
                                                                    {{ $item['part_number'] }} -
                                                                    {{ $item['part_name'] }}
                                                                </td>
                                                                <td width="10%" class="text-center"
                                                                    style="vertical-align: middle;">
                                                                    {{ $item['min'] }}
                                                                </td>
                                                                <td width="15%" rowspan="2" class="text-center"
                                                                    style="background-color:
                                                            @if ($item['balance'] < $item['min']) rgba(255, 0, 32, 0.8);
                                                            @elseif($item['balance'] > $item['max']) rgb(255, 205, 86);
                                                            @else rgba(121, 214, 126, 1); @endif;
                                                            vertical-align: middle;">
                                                                    @if ($item['balance'] < $item['min'])
                                                                        <i class="ri-arrow-down-line"></i>
                                                                        {{ $item['balance'] }}
                                                                    @elseif($item['balance'] > $item['max'])
                                                                        <i class="ri-arrow-up-line"></i>
                                                                        {{ $item['balance'] }}
                                                                    @else
                                                                        <i class="ri-arrow-up-down-line"></i>
                                                                        {{ $item['balance'] }}
                                                                    @endif
                                                                </td>
                                                                <td width="15%" rowspan="2" class="text-center"
                                                                    style="background-color:
                                                            @if ($item['quantity_plant'] < $item['min']) rgba(255, 0, 32, 0.8);
                                                            @elseif($item['quantity_plant'] > $item['max']) rgb(255, 205, 86);
                                                            @else rgba(121, 214, 126, 1); @endif;
                                                            vertical-align: middle;">
                                                                    {{ $item['quantity_plant'] }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center"
                                                                    style="vertical-align: middle;">
                                                                    {{ $item['max'] }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        {{-- watermark --}}
                        {{-- <div class="watermark-container" style="position: relative; height: 100px;">
                            <!-- Blurred Text Section -->
                            <div
                                style="position: absolute; left: 0; bottom: 0; opacity: 0.1; font-weight: bold; font-size: 2rem;">
                                ALWASY THINK AHEAD
                            </div>
                            <!-- Logo Section -->
                            <div style="position: absolute; right: 0; bottom: 0; opacity: 0.1;">
                                <img src="{{ asset('assets/img/tch-logo.png') }}" alt="TCH Logo"
                                    style="width: auto; height: 70px;">
                            </div>
                        </div> --}}
                    </div>
                @endforeach

            </div>

        </div>


        {{-- watermark --}}
        {{-- <div class="watermark-container" style="position: relative; height: 100px;">
            <!-- Blurred Text Section -->
            <div class="blur-text"
                style="position: absolute; left: 0; bottom: 0; opacity: 0.1; font-weight: bold; font-size: 2rem;">
                ALWASY THINK AHEAD
            </div>
            <!-- Logo Section -->
            <div class="logo-container" style="position: absolute; right: 0; bottom: 0; opacity: 0.1;">
                <img src="{{ asset('assets/img/tch-logo.png') }}" alt="TCH Logo" style="width: auto; height: 50px;">
            </div>
        </div> --}}


        {{-- foooter --}}
        <footer id="scrollingFooter"
            style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #1e2d81; border-top: 1px solid #a38e8e; padding: 10px; box-shadow: 0 -2px 5px rgba(0,0,0,0.1); overflow: hidden;">
            <div id="footerContent"
                style="display: inline-block; padding-left: 100%; color: white; white-space: nowrap;">
                <!-- Running text will be dynamically updated here -->
                <span id="runningText">Your scrolling text goes here...</span>
            </div>
        </footer>

    </div>
    <!-- Modal untuk menampilkan detail -->
    @include('andon-dashboard-chuterfg.modal.get_kritis')
    @include('andon-dashboard-chuterfg.modal.get_over')
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/datatables.js') }}"></script> --}}
    <script src="{{ asset('assets/js/sweetalert2@11.6.15.all.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/datatables.min.js') }}"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> --}}
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Tambahkan DataTables script dan jQuery -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <!-- Template Main JS File -->
    {{-- <script src="assets/js/main.js"></script> --}}

    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script> --}}

    <script src="{{ asset('assets/js/chartjs-plugin-datalabels@2.js') }}"></script>
    <script>
        function refreshPage() {
            // Menggunakan location.reload() untuk me-refresh halaman
            location.reload();
        }
        setTimeout(function() {
            location.reload();
        }, 180000); // 300000 milidetik = 5 menit


        function formatDate(date) {
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                'October', 'November', 'December'
            ];

            const day = days[date.getDay()];
            const dayOfMonth = date.getDate().toString().padStart(2, '0'); // Pad with leading zero if needed
            const month = months[date.getMonth()];
            const year = date.getFullYear();

            return `${day}, ${dayOfMonth} ${month} ${year}`;
        }

        function updateCurrentDateAndDay() {
            const currentDateElement = $('#currentDate');
            const currentDate = new Date();
            const formattedDate = formatDate(currentDate);

            currentDateElement.text(formattedDate);
        }


        // update date
        $(document).ready(function() {
            updateCurrentDateAndDay();
        });

        // function footer
        function updateFooter(percentages) {
            let footerContent = $('#footerContent');
            let scrollingText = Object.keys(percentages).map(group => {
                let data = percentages[group];
                // return `${group}: KRITIS ${data.kritis.toFixed(2)}%, OVER ${data.over.toFixed(2)}%, OK ${data.ok.toFixed(2)}%`;
                return `${group}: KRITIS ${data.kritis.toFixed(2)}%, OVER ${data.over.toFixed(2)}%`;
            }).join(' | ');

            // Add a space after each `|`
            scrollingText = scrollingText.replace(/\s*\|\s*/g, ' | ');

            // Append the static text
            scrollingText +=
                ' | PT TRIMITRA CHITRAHASTA | Always Think Ahead | MARI BERSAMA MENJAGA AKURASI STOCK AKTUAL DENGAN STOCK DI SISTEM | Terapkan 5R di gudang: Ringkas barang yang tidak perlu, Rapi dalam penyimpanan, Resik jaga kebersihan, Rawat fasilitas dengan baik, dan Rajin disiplin menjalankannya setiap hari. Bersama kita wujudkan gudang yang efisien, aman, dan nyaman! | DEVELOPMENT BY IT DEPT PT. TRIMITRA CITRAHASTA';

            footerContent.text(scrollingText);

            // Make the text scroll
            const container = document.getElementById('footerContent');
            const scrollAmount = container.scrollWidth;
            const scrollDuration = 180000; // Duration in milliseconds (e.g., 20 seconds)
            let startTime;

            function animateScroll(timestamp) {
                if (!startTime) startTime = timestamp;
                const elapsed = timestamp - startTime;
                const progress = (elapsed / scrollDuration) % 1;
                container.style.transform = `translateX(${Math.max(-scrollAmount, -scrollAmount * progress)}px)`;
                requestAnimationFrame(animateScroll);
            }

            requestAnimationFrame(animateScroll);
        }

        // Example of how to call the updateFooter function
        $(document).ready(function() {
            // Replace this with the actual data you pass from the server
            const percentages = @json($percentages);

            updateFooter(percentages);
        });

        // chart pie 1
        Chart.register(ChartDataLabels);

        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($percentages as $code => $percentages)
                var ctx = document.getElementById('pieChart-{{ $code }}').getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['KRITIS', 'OVER', 'OK'],
                        datasets: [{
                            label: 'Status Percentages and Counts',
                            data: [
                                {{ $percentages['kritis'] }},
                                {{ $percentages['over'] }},
                                {{ $percentages['ok'] }},
                            ],
                            backgroundColor: [
                                'rgba(255, 0, 32, 0.8)',
                                'rgb(255, 205, 86)',
                                'rgba(121, 214, 126, 1)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgb(255, 205, 86)',
                                'rgba(121, 214, 126, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        let dataIndex = tooltipItem.dataIndex;
                                        let value = tooltipItem.raw;
                                        let label = tooltipItem.label;
                                        let count = [
                                            {{ $chartDataangka[$code]['kritis'] }},
                                            {{ $chartDataangka[$code]['over'] }},
                                            {{ $chartDataangka[$code]['ok'] }}
                                        ][dataIndex];
                                        return `${label}: ${value.toFixed(2)}% (${count} item)`;
                                    }
                                }
                            },
                            datalabels: {
                                display: true, // Ensure datalabels are enabled
                                color: 'rgba(0, 0, 0, 0.8)',
                                formatter: function(value, context) {
                                    let dataIndex = context.dataIndex;
                                    let label = context.chart.data.labels[dataIndex];
                                    let count = [
                                        {{ $chartDataangka[$code]['kritis'] }},
                                        {{ $chartDataangka[$code]['over'] }},
                                        {{ $chartDataangka[$code]['ok'] }}
                                    ][dataIndex];
                                    // Show label, percentage, and count with line breaks
                                    return `${label}\n${value.toFixed(2)}%\n(${count} ITEM)`;
                                },
                                anchor: 'center',
                                align: 'center',
                                font: {
                                    weight: 'bold',
                                    size: 12
                                }
                            }
                        }
                    }
                });
            @endforeach
        });

        // chart pie 2
        Chart.register(ChartDataLabels);
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($data_percent_qty_plant as $code => $percentages)
                var ctx = document.getElementById('pieChartQtyplant-{{ $code }}').getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['KRITIS', 'OVER', 'OK'],
                        datasets: [{
                            label: 'Status Percentages and Counts',
                            data: [
                                {{ $percentages['kritis'] }},
                                {{ $percentages['over'] }},
                                {{ $percentages['ok'] }},
                            ],
                            backgroundColor: [
                                'rgba(255, 0, 32, 0.8)',
                                'rgb(255, 205, 86)',
                                'rgba(121, 214, 126, 1)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgb(255, 205, 86)',
                                'rgba(121, 214, 126, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        let dataIndex = tooltipItem.dataIndex;
                                        let value = tooltipItem.raw;
                                        let label = tooltipItem.label;
                                        let count = [
                                            {{ $chart_number_qty_plant[$code]['kritis'] }},
                                            {{ $chart_number_qty_plant[$code]['over'] }},
                                            {{ $chart_number_qty_plant[$code]['ok'] }}
                                        ][dataIndex];
                                        return `${label}: ${value.toFixed(2)}% (${count} item)`;
                                    }
                                }
                            },
                            datalabels: {
                                display: true, // Ensure datalabels are enabled
                                color: 'rgba(0, 0, 0, 0.8)',
                                formatter: function(value, context) {
                                    let dataIndex = context.dataIndex;
                                    let label = context.chart.data.labels[dataIndex];
                                    let count = [
                                        {{ $chart_number_qty_plant[$code]['kritis'] }},
                                        {{ $chart_number_qty_plant[$code]['over'] }},
                                        {{ $chart_number_qty_plant[$code]['ok'] }}
                                    ][dataIndex];
                                    // Show label, percentage, and count with line breaks
                                    return `${label}\n${value.toFixed(2)}%\n(${count} ITEM)`;
                                },
                                anchor: 'center',
                                align: 'center',
                                font: {
                                    weight: 'bold',
                                    size: 10
                                }
                            }
                        }
                    }
                });
            @endforeach
        });


        // scroll ing fot table
        document.addEventListener('DOMContentLoaded', function() {
            const scrollableTbodies = document.querySelectorAll(
                '[id^="scrollable-tbody-"]'); // Select all elements with IDs starting with 'scrollable-tbody-'

            let scrollSpeed = 60; // Adjust the scroll speed (in milliseconds)
            let scrollStep = 1; // Adjust the number of pixels scrolled per step

            // Function to start the scrolling
            function startScrolling() {
                scrollableTbodies.forEach(function(scrollableTbody) {
                    // Stop the previous interval if it exists
                    if (scrollableTbody.dataset.interval) {
                        clearInterval(scrollableTbody.dataset.interval);
                    }

                    // Set interval to perform scroll
                    let intervalId = setInterval(() => {
                        // Increment the scroll position
                        scrollableTbody.scrollTop += scrollStep;

                        // Check if we have reached the bottom of the tbody
                        if (scrollableTbody.scrollTop + scrollableTbody.clientHeight >=
                            scrollableTbody.scrollHeight) {
                            scrollableTbody.scrollTop = 0; // Reset scroll to the top
                        }
                    }, scrollSpeed);

                    // Save the interval ID in dataset for later removal
                    scrollableTbody.dataset.interval = intervalId;
                });
            }

            // Start scrolling when the DOM is ready
            startScrolling();

            // Handle window resize event
            window.addEventListener('resize', function() {
                // Check if the window width is below 900px
                if (window.innerWidth < 900) {
                    // Stop scrolling if the resolution is less than 900px
                    scrollableTbodies.forEach(function(scrollableTbody) {
                        if (scrollableTbody.dataset.interval) {
                            clearInterval(scrollableTbody.dataset.interval); // Clear the interval
                            delete scrollableTbody.dataset
                                .interval; // Remove the interval from dataset
                        }
                    });
                } else {
                    // Restart scrolling if the window width is 900px or more
                    startScrolling();
                }
            });
        });


        // event click
        $(document).ready(function() {

            ///* Get data kritis */
            $('#getKritis').on('click', function(event) {
                // alert('lanjut');
                // Tampilkan modal dan isi dengan detail itemcode
                $('#detailModalkritis').modal('show');
                var tblKritis = $('#tbl-data-kritis').DataTable();
                tblKritis.destroy();
                var tblKritis = $('#tbl-data-kritis').DataTable({
                    "pagingType": "numbers",
                    ajax: {
                        url: "{{ route('getDatakritis') }}",
                    },
                    serverSide: true,
                    deferRender: true,
                    responsive: true,
                    "bFilter": false,
                    "order": [
                        [1, 'asc']
                    ],
                    searching: true,
                    columns: [

                        {
                            "data": "itemcode"
                        },
                        {
                            "data": "part_number"
                        },
                        {
                            "data": "part_name"
                        },
                        {
                            "data": "balance"
                        },
                        {
                            "data": "min"
                        },
                        {
                            "data": "max"
                        },


                    ],
                });
            });

            /* get data over */
            $('#getOver').on('click', function(event) {
                // alert('lanjut');
                // Tampilkan modal dan isi dengan detail itemcode
                $('#detailModalover').modal('show');
                var tblover = $('#tbl-data-over').DataTable();
                tblover.destroy();
                var tblover = $('#tbl-data-over').DataTable({
                    "pagingType": "numbers",
                    ajax: {
                        url: "{{ route('getaDataover') }}",
                    },
                    serverSide: true,
                    deferRender: true,
                    responsive: true,
                    "bFilter": false,
                    "order": [
                        [1, 'asc']
                    ],
                    searching: true,
                    columns: [

                        {
                            "data": "itemcode"
                        },
                        {
                            "data": "part_number"
                        },
                        {
                            "data": "part_name"
                        },
                        {
                            "data": "balance"
                        },
                        {
                            "data": "min"
                        },
                        {
                            "data": "max"
                        },


                    ],
                });
            });
        });


        /* size table heigth */
        document.addEventListener('DOMContentLoaded', function() {
            const tables = document.querySelectorAll('.custom-table');

            tables.forEach(table => {
                function adjustTableHeight() {
                    const width = window.innerWidth;
                    let height;

                    if (width >= 1200) { // Full screen
                        height = 620;
                    } else if (width >= 768) { // Normal
                        height = 500;
                    } else { // Mobile
                        height = 300; // Sesuaikan nilai ini jika perlu
                    }

                    table.style.height = height + 'px';
                }

                adjustTableHeight(); // Set initial height
                window.addEventListener('resize', adjustTableHeight); // Adjust on resize
            });
        });
    </script>


</body>

</html>
