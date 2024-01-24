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

<h4 class="fw-bold py-3 mt-n2">
    <span class="text-muted fw-light">Hotel / </span>
    Hotel Sales Overview
</h4>
<div class="row">
    <div class="col-lg-12">
        <h1>Sales Overview</h1>
        <div>
            <h2>Daily Overview</h2>
            <p>{{ $dailyOverview }}</p>
        </div>

        <div>
            <h2>Monthly Overview</h2>
            <p>{{ $monthlyOverview }}</p>
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