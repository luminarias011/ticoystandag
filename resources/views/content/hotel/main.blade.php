@extends('layouts/withoutNavbar')

@section("title', 'Ticoy's Hotel")

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
<script src="{{asset('assets/js/ui-popover.js')}}"></script>
<script src="{{asset('assets/js/ui-modals.js')}}"></script>
@endsection

@section('content')

<style>
    .unclick {
        pointer-events: none !important;
    }
</style>

<h4 class="py-3 fw-bold mt-n1 mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2 mb-0">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted fw-light">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted fw-light">Hotel</a>
            </li>
            <li class="breadcrumb-item active">Hotel Booking</li>
        </ol>
    </nav>
</h4>

{{-- <h4 class="fw-bold py-3 mt-n2">
    <span class="text-muted fw-light">Hotel / </span>
    Hotel Booking
</h4> --}}

<div class="row">
    <div class="col-lg-8 mt-n2 col-md-8 col-sm-7 col-xs-2">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-pills mb-1 nav-fill" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active btn-sm" role="tab" data-bs-toggle="tab"
                        data-bs-target="#room-booking" aria-controls="room-booking" aria-selected="true"><i
                            class="tf-icons bx bx-home mt-n1"></i> Booking

                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link btn-sm" role="tab" data-bs-toggle="tab"
                        data-bs-target="#room-occupied" aria-controls="room-occupied" aria-selected="false"><i
                            class="tf-icons bx bx-pin mt-n1"></i> Occupied
                        @if (bookedRooms() !== 0)
                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ bookedRooms()
                            }}</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link btn-sm" role="tab" data-bs-toggle="tab"
                        data-bs-target="#booking-history" aria-controls="booking-history" aria-selected="false"><i
                            class="tf-icons bx bx-history mt-n1"></i> History
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                @include('content/hotel/roomBooking')
                @include('content/hotel/ongoingBookings')
                @include('content/hotel/bookingHistory')
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-5 mt-n2">
        <div class="nav-link text-center mb-4 text-primary"><i class="tf-icons bx bx-home mt-n1"></i> Booking
        </div>
        <div class="card bg-transparent border mb-2">
            <div class="card-body">
                <p class="card-text text-danger">
                    OCCUPIED
                </p>
                Maintenance. . .
            </div>
        </div>
    </div>
</div>

{{-- <script>
    const dataFromServer = @json($dataFromDatabase);
        // Call a function in your script to handle the data
        handleDataFromServer(dataFromServer);
</script> --}}

<script>
    // function closePopover() {
    //     var popoverTrigger = document.getElementById('popOverComplete');
    //     var popover = new bootstrap.Popover(popoverTrigger);
    //     popover.hide();
    // }

    // document.addEventListener('click', function (event) {
    //     if (event.target.id === 'cancelButton') {
    //         var popoverTrigger = document.getElementById('popOverComplete');
    //         var popover = new bootstrap.Popover(popoverTrigger);
    //         popover.hide();
    //     }
    // });

    // document.getElementById('popOverComplete').addEventListener('click', function () {
    //     var popoverTrigger = document.getElementById('popOverComplete');
    //     var popover = new bootstrap.Popover(popoverTrigger, {
    //         content: function () {
    //             return document.getElementById('completeContent').innerHTML;
    //         },
    //         container: 'body',
    //     });
    //     popover.show();
    // });
</script>

@endsection