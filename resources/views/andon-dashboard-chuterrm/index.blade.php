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

    .custom-table2 {
        font-size: 14px;
        font-weight: bold;
        border-collapse: collapse;
        background-color: transparent;
    }

    .custom-table {
        font-size: 14px;
        font: bold;
        font-weight: bold;
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

    /* .custom-table3 {
        width: 100%;
        border-collapse: collapse;
        display: block;
        overflow-y: hidden;
    }


    .custom-table3 {
        font-size: 14px;
        font: bold;
        font-weight: bold;
        border-collapse: collapse;
        background-color: transparent;
    }

    .custom-table3 th,
    .custom-table3 td {
        padding: 2px 5px;
        border: 2px solid black;
        background-color: transparent;
    }

    .custom-table3 th:first-child,
    .custom-table3 td:first-child {
        width: 100px;
    }

    .custom-table3 th:nth-child(2),
    .custom-table3 td:nth-child(2) {
        width: 100px;
    }

    .custom-table3 th:last-child,
    .custom-table3 td:last-child {
        width: 100px;
    }

    .custom-table3 tbody tr {
        border-bottom: 2px solid black;
    } */

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

    /*
    .card {
        overflow: hidden;
        border: 1px solid #ddd;
    } */

    .table-responsive {
        overflow-x: hidden;
        overflow-y: hidden;
    }

    .chart-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, #d0e7ff, #e9ebf0, #ffffff);
        /* Gradien biru ke putih */
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 6px 20px rgba(0, 0, 0, 0.1);
        /* Memberikan bayangan */
        position: relative;
        overflow: hidden;
    }

    /* Corak Awan Menggunakan Gradient */
    .chart-container::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle, rgba(166, 201, 218, 0.3) 10%, rgba(255, 255, 255, 0.1) 30%, rgba(255, 255, 255, 0) 50%);
        /* Pola awan statis dengan gradasi melingkar */
        opacity: 0.2;
        /* Membuat pola awan lebih transparan agar tidak mengganggu konten */
        pointer-events: none;
        z-index: 0;
    }

    /* Styling untuk div dalam chart-container */
    .chart-container div {
        text-align: center;
        font-size: 15px;
        font-weight: bold;
        color: #333;
        /* Warna teks lebih gelap untuk keterbacaan */
    }

    /* Styling untuk span dalam chart-container */
    .chart-container span {
        font-size: 14px;
        font-weight: bold;
        color: #555;
        /* Warna teks tambahan sedikit lebih terang */
        margin-top: 5px;
        display: block;
    }

    /* Optional: Tambahkan efek hover pada chart-container */
    .chart-container:hover {
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
        /* Memberikan bayangan lebih besar saat hover */
        transform: translateY(-5px);
        /* Efek mengangkat saat hover */
        transition: all 0.3s ease;
        /* Transisi yang halus */
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

            <div class="col">
                <!-- Your heading -->
                <span class="ml-4 mt-0 mb-0"><b> PT TRIMITRA CHITRAHASTA - DASHBOARD MONITORING STOCK RAW
                        MATERIAL</b></span>
            </div>
            <div class="col">
                <span class="ml-4 mt-0 mb-0"><b>UPDATE MASTER MIN MAX : {{ strtoupper($formattedPeriod) }} </b></span>
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
                        <span>KRITIS | {{ $percentKritis }}</span>
                    </button>
                </div>

                <!-- OVER Button -->
                <div class="position-relative me-3">
                    <button type="button" class="btn btn-warning btn-sm" id="getOver"
                        style=" background-color: rgb(255, 205, 86); border: none;">
                        <span>OVER | {{ $percentOver }}</span>
                    </button>
                </div>

                <!-- OK Button -->
                <div class="position-relative">
                    <button type="button" class="btn btn-success btn-sm text-dark"
                        style="pointer-events: none; background-color: rgba(121, 214, 126, 1); border: none;">
                        <span>OK | {{ $percentOk }}</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Tombol untuk memanipulasi elemen -->

        {{-- carousel --}}

        <!-- Elemen CardCarousel -->
        <div id="cardCarousel" class="carousel slide mt-3" data-ride="carousel" data-interval="6000">
            <div class="carousel-inner">
                @foreach ($carouselPages as $index => $carouselPage)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="row">
                            @foreach ($carouselPage as $table)
                                <div class="col-md-3 d-flex justify-content-center">
                                    <div class="card"
                                        style="width: 100%; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); background-color: #f8f9fa;">
                                        <!-- Chart Section -->
                                        <div class="chart-container p-2"
                                            style="display: flex; align-items: center; justify-content: space-between; background-color: #e9ebf0; height: 250px; border-radius: 8px;">

                                            <!-- Chart Section (Kiri) -->
                                            <div
                                                style="display: flex; flex-direction: column; align-items: center; justify-content: center; flex: 1; height: 100%;">
                                                <canvas id="pieChart-{{ $table['type'] }}"
                                                    style="max-width: 200px; max-height: 200px;"></canvas>
                                            </div>
                                            {{-- <canvas id="barChart" style="max-height: 400px;"></canvas> --}}
                                            <!-- Image dan Tombol Section (Kanan) -->
                                            @if (isset($table['type']))
                                                @php
                                                    $logoSrc = '';
                                                    $logoWidth = 150; // Ubah ukuran lebar logo jika perlu
                                                    $logoHeight = 100; // Ubah ukuran tinggi logo jika perlu
                                                    switch ($table['type']) {
                                                        case 'PIPE':
                                                            $logoSrc = asset('assets/img/pipa.png');
                                                            $value = 'PIPE';
                                                            break;
                                                        case 'PLATE':
                                                            $logoSrc = asset('assets/img/plat.png');
                                                            $value = 'PLATE';
                                                            break;
                                                        case 'COIL':
                                                            $logoSrc = asset('assets/img/coil.png');
                                                            $value = 'COIL';
                                                            break;
                                                        case 'BAR':
                                                            $logoSrc = asset('assets/img/bar.png');
                                                            $value = 'BAR';
                                                            break;
                                                        default:
                                                            $logoSrc = ''; // Jika tidak ada logo default
                                                            $value = '';
                                                            break;
                                                    }
                                                @endphp

                                                @if ($logoSrc)
                                                    <div
                                                        style="flex: 1; text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center;">

                                                        <!-- Logo -->
                                                        <img src="{{ $logoSrc }}"
                                                            alt="{{ $table['type'] }} Logo"
                                                            style="width: {{ $logoWidth }}px; height: {{ $logoHeight }}px; border-radius: 8px;">

                                                        <!-- Input Hidden -->
                                                        <input name="type" id="typeInput-{{ $table['type'] }}"
                                                            value="{{ $value }}" hidden>

                                                        <!-- Tombol Detail -->
                                                        <div style="display: flex; justify-content: center; width: 100%; margin-top: 10px;"
                                                            class="mt-5">
                                                            <button type="button" class="btn btn-secondary"
                                                                onclick="getValue('{{ $value }}')"
                                                                style="padding: 5px 10px; font-size: 12px; border-radius: 4px;">
                                                                <i class="ri-drag-move-fill"></i>&nbsp;Detail
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>


                                        <div
                                            style="display: flex; align-items: center; justify-content: center;background: rgb(9,86,121);
                                            background: linear-gradient(90deg, rgba(9,86,121,1) 28%, rgba(2,0,36,1) 63%, rgba(0,164,255,1) 100%); height: 20px;">
                                            <h4
                                                style="margin: 0; font-size: 15px; font-weight: bold; color: #fff; text-align: center;">
                                                RAW MATERIAL STOCK
                                            </h4>
                                        </div>

                                        <!-- Table Section -->
                                        <div class="table-responsive p-2">
                                            <table class="table custom-table2 mb-1">
                                                <thead>
                                                    <tr>
                                                        <td width="25%" class="text-center" rowspan="2"
                                                            style="padding:3pt; vertical-align: middle; font-weight: bold;">
                                                            ITEMCODE
                                                        </td>
                                                        <td width="30%" class="text-center" rowspan="2"
                                                            style="padding:3pt; vertical-align: middle; font-weight: bold;">
                                                            PART NO - PART NAME
                                                        </td>
                                                        <td width="10%" class="text-center"
                                                            style="font-weight: bold;">MIN</td>
                                                        <td width="15%" class="text-center" rowspan="2"
                                                            style="vertical-align: middle; font-weight: bold;">
                                                            RM STOCK
                                                        </td>
                                                        <td width="15%" class="text-center" rowspan="2"
                                                            style="vertical-align: middle; font-weight: bold;">
                                                            ALL STOCK
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" style="font-weight: bold;">MAX</td>
                                                    </tr>
                                                </thead>
                                            </table>
                                            {{-- <div> --}}
                                            <table class="table mt-1 custom-table" style="max-height: 600px;"
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
                                            {{-- </div> --}}


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <!-- Elemen CardCarousel2 -->
        <div id="cardCarousel2" class="carousel slide mt-3" data-ride="carousel" data-interval="6000"
            style="display: none;">


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
    {{-- @include('andon-dashboard-chuterfg.modal.get_kritis')
    @include('andon-dashboard-chuterfg.modal.get_over') --}}
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
    @include('andon-dashboard-chuterrm.ajax')


</body>
