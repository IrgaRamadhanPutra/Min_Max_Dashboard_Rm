@extends('admin.layout')
@section('title')
    DASHBOARD CHUTTER
@endsection

@section('breadcrumb')
    <nav>
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item">Home</li> --}}
            <li class="breadcrumb-item">PORTAL</li>
        </ol>
    </nav>
@endsection('breadcrumb')
<style>
    .card-square {
        width: 100%;
        /* Ensure the card takes full width of its container */
        max-width: 350px;
        /* Adjust max-width to fit your design */
        aspect-ratio: 1 / 1;
        /* Ensures the card is square */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-radius: 0.75rem;
        /* Rounded corners */
        overflow: hidden;
        /* Ensures content doesn't overflow */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Subtle shadow for depth */
    }

    .card-body {
        padding: 1.5rem;
        /* Add padding inside the card */
    }

    .btn-primary-custom {
        background-color: rgb(8, 50, 129);
        /* Custom background color */
        border: none;
        /* Remove default border */
        border-radius: 0.5rem;
        /* Rounded corners */
        padding: 0.75rem 1.5rem;
        /* Increase padding for better touch */
        font-size: 1rem;
        /* Larger font size for better readability */
        text-transform: uppercase;
        /* Uppercase text for emphasis */
        letter-spacing: 0.05em;
        /* Slightly spaced letters */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Subtle shadow */
        transition: background-color 0.3s, box-shadow 0.3s;
        /* Smooth transition */
    }

    .btn-primary-custom:hover {
        background-color: rgb(10, 60, 150);
        /* Darker shade on hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        /* Enhanced shadow on hover */
    }

    .btn-primary-custom:active {
        background-color: rgb(8, 50, 129);
        /* Maintain the background color on click */
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
        /* Inset shadow on click */
    }
</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row justify-content-center">

                    <div class="col-xxl-3 col-md-4 mb-5">
                        <div class="card card-square shadow">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title text-center mb-3">WMS CHUTER FINISH GOOD</h5>
                                <div class="d-flex align-items-center justify-content-start mb-3">
                                    <!-- Text elements styled like images with added margin -->
                                    <div class="w-9 h-9 d-flex align-items-center justify-center rounded-circle bg-light text-dark font-weight-bold shadow-sm mr-2">
                                        ADM
                                    </div>
                                    <div class="w-9 h-9 d-flex align-items-center justify-center rounded-circle bg-light text-dark font-weight-bold shadow-sm mr-2">
                                        YIMM
                                    </div>
                                    <div class="w-9 h-9 d-flex align-items-center justify-center rounded-circle bg-light text-dark font-weight-bold shadow-sm">
                                        HPM
                                    </div>
                                    <span class="bg-white rounded-pill px-2 py-1 text-primary text-xs shadow-sm ml-2">
                                        +5 more
                                    </span>
                                </div>

                                <!-- KRITIS Progress Bar -->
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-danger font-weight-bold" style="font-size: 0.875rem;">KRITIS</span>
                                        <span id="kritis-percentage" class="text-danger" style="font-size: 0.75rem;">{{ $percentKritis }}%</span>
                                    </div>
                                    <div class="progress">
                                        <div id="kritis-progress-bar" class="progress-bar bg-danger" role="progressbar"
                                            aria-valuenow="{{ $percentKritis }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <!-- OVER Progress Bar -->
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-warning font-weight-bold" style="font-size: 0.875rem;">OVER</span>
                                        <span id="over-percentage" class="text-warning" style="font-size: 0.75rem;">{{ $percentOver }}%</span>
                                    </div>
                                    <div class="progress">
                                        <div id="over-progress-bar" class="progress-bar bg-warning" role="progressbar"
                                            aria-valuenow="{{ $percentOver }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <!-- OK Progress Bar -->
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-success font-weight-bold" style="font-size: 0.875rem;">OK</span>
                                        <span id="ok-percentage" class="text-success" style="font-size: 0.75rem;">{{ $percentOk }}%</span>
                                    </div>
                                    <div class="progress">
                                        <div id="ok-progress-bar" class="progress-bar bg-success" role="progressbar"
                                            aria-valuenow="{{ $percentOk }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <!-- New Span for Total and 100% -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-dark font-weight-bold" style="font-size: 0.875rem;">Total</span>
                                    <span class="text-dark font-weight-bold" style="font-size: 0.875rem;">100%</span>
                                </div>

                                <!-- Centered Button closer to the middle -->
                                <div class="text-center">
                                    <a href="{{ route('andon_chuterfg') }}" class="btn btn-primary-custom">
                                        <span>Klik Disini</span>
                                        <i class="bi bi-hand-index-thumb-fill"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        function updateProgressBars() {
             $.getJSON('{{ route('fetchStockLimitData') }}', function(data) {
                $('#kritis-progress-bar').css('width', data.percentKritis + '%').attr('aria-valuenow', data.percentKritis);
                $('#over-progress-bar').css('width', data.percentOver + '%').attr('aria-valuenow', data.percentOver);
                $('#ok-progress-bar').css('width', data.percentOk + '%').attr('aria-valuenow', data.percentOk);

                $('#kritis-percentage').text(data.percentKritis + '%');
                $('#over-percentage').text(data.percentOver + '%');
                $('#ok-percentage').text(data.percentOk + '%');
            });
        }

        // Update progress bars every 1 seconds
        setInterval(updateProgressBars, 1000);

        // Initial call to populate progress bars on page load
        $(document).ready(updateProgressBars);
    </script>
@endsection('content')

{{-- @endsection --}}
