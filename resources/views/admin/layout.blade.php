<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>Dashboard - NiceAdmin Bootstrap Template</title> --}}
    <title> @yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!-- Favicon and Apple Touch Icon -->
    <link href="{{ asset('assets/img/logo3.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo4.png') }}" rel="apple-touch-icon">

    <link rel="stylesheet" href="{{ asset('assets\fontawesome-free-6.2.1\css\all.css') }}">


    <!-- Google Fonts -->
    {{-- <link href="https://fonts.gstatic.com" rel="preconnect"> --}}

    {{-- C:\xampp\dashboard_niceAdmin\dashboard\public\assets\css\family.css --}}
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
    {{-- <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">



    {{-- penempatan jqeury harus di atas jquery datatables --}}
    <!-- jQuery -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}
    {{-- <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet"> --}}
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>


    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}
    {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
    {{--  --}}
    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> --}}

    {{-- yang ke dua script  --}}


    <!-- Vendor CSS Files -->
    {{-- ini cdn  --}}
    {{-- <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet"> --}}
    {{-- ini public --}}
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
    .card-header.hoverable:hover {
        background-color: #000000;

        cursor: pointer;
    }

    html,
    body {
        height: 100%;
    }

    /* Create a flex container for the page layout */
    #page-container {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        /* Use vh (viewport height) to ensure min-height covers the whole viewport */
    }

    /* Push the footer to the bottom */
    #main {
        flex: 1;
        /* Flex to take up remaining space */
    }

    /* Style your footer as needed */
    #footer {
        /* Your footer styling */
    }



    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* loading */
    .loading-spinner-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none;
        z-index: 9999;
    }

    .loading-spinner {
        border: 10px solid rgba(0, 0, 0, 0.3);
        border-top: 10px solid #1371af;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }



    /* css untuk sideber */
    .nav-item.active .nav-link.collapsed {
        background: rgb(19, 95, 135);
        background: linear-gradient(90deg, rgba(19, 95, 135, 0) 0%, rgba(0, 22, 142, 0.32816876750700286) 100%);

    }

    .nav-item.active .nav-link.collapsed span {



        display: inline-block;

        padding: 5px;

        border-radius: 4px;

    }

    /* home */
    .card-button {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .card-button .btn {
        font-size: 1.5em;
        /* Adjust the font size as needed */
        padding: 20px 30px;
        /* Adjust the padding as needed */
        transition: transform 0.3s;
    }

    .card-button:hover .btn {
        transform: scale(1.1);
    }

    /* wapes pada card chuter lantai 1 */



    .chuter-card {
        border: 2px solid #3498db;
        border-radius: 15px;
        /* padding: 20px; */
        margin: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-card h5 {
        color: #3498db;
    }

    .custom-card p {
        color: #555;
    }
</style>

<body>
    <div id="page-container">
        <!-- Header -->
        <header id="header" class="header fixed-top d-flex align-items-center"
        style="background: linear-gradient(90deg, rgb(64, 63, 87) 0%, rgbrgb(199, 202, 211), rgba(163, 169, 199, 0.858) 30%, rgb(207, 207, 207) 65%, rgb(167, 183, 189) 72%);">
        {{-- style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(2,15,51,1) 7%, rgba(163, 169, 199, 0.858) 30%, rgb(45, 54, 58) 65%, rgb(54, 64, 68) 72%);"> --}}
            <nav class="header-nav ms-auto">
                {{-- @include('admin.navbar') --}}
                <ul class="d-flex align-items-center">
                    {{-- <br> --}}
                    <li class="nav-item d-block d-lg-none hidden" style="background: rgba(1,107,147,1">
                        <a class="nav-link nav-icon search-bar-toggle " href="#">
                            {{-- <i class="bi bi-search" style="background: rgba(1,107,147,1"></i> --}}
                        </a>
                    </li><!-- End Search Icon-->


                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            {{-- <img src="assets/img/user2.png" alt="Profile" class="rounded-circle"> --}}
                            {{-- <span class="d-none d-md-block dropdown-toggle ps-2 text-white"> {{ Auth::user()->name }}</span> --}}
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                {{-- <h6> {{ Auth::user()->user }}</h6> --}}
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-left"></i>
                                    <span>Sign Out</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>


                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->
                </ul>

            </nav><!-- End Icons Navigation -->
        </header>

        <!-- Main Content -->
        <main id="main" class="main" style="margin-left: 0; width: 100%;">
            <!-- Page title and breadcrumb -->
            <div class="pagetitle">
                @yield('breadcrumb')
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">
                    @yield('content')
                </div>
            </section>
        </main>

        {{-- <!-- Footer -->
        <footer id="footer" class="footer d-flex flex-column justify-content-center align-items-center">
            <div class="copyright">
                &copy; Copyright <strong><span></span>{{ date('Y') }}</strong> All Rights Reserved
            </div>
            <div class="credits">
                Developed by IT Dept <a href="">PT Trimitra Chitrahasta.</a>
            </div>
        </footer> --}}
        {{-- @include('admin.footer') --}}

    </div>

    <!-- Your scripts -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>



</html>
