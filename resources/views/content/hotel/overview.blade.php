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
            <li class="breadcrumb-item active">Hotel Sales Overview</li>
        </ol>
    </nav>
</h4>

<h4>Daily (7 Days Preview)</h4>
<div class="col-md mt-n1">
    <div class="demo-inline-spacing">
        <div class="list-group list-group-horizontal-sm text-sm-left">
            @foreach ($dailyOverview as $index => $dailyOverviewed)
            <a class="list-group-item list-group-item-action {{ $index === 0 ? ' active' : '' }}" id="home-list-item" data-bs-toggle="list"
                href="#daily-{{ $dailyOverviewed['dateID'] }}">{{ $dailyOverviewed['date'] }}</a>
            @endforeach
        </div>
        <div class="tab-content px-0 pt-0 pb-5">
            @foreach ($dailyOverview as $index => $dOverview)
            <div class="tab-pane fade show {{ $index === 0 ? ' show active' : '' }}" id="daily-{{ $dOverview['dateID'] }}">
                <p>{{ $dOverview['salesDailyInfo'] }} <strong>₱{{ number_format($dOverview['dailyAmount'],2, '.', ',') }} pesos</strong></p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<h4>Monthly (12 Month Preview )</h4>
<div class="col-md mt-n1">
    <div class="demo-inline-spacing">
        <div class="list-group list-group-horizontal-sm text-sm-left">
            @foreach ($monthlyOverview as $index => $monthlyOverviewed)
            <a class="list-group-item list-group-item-action {{ $index === 0 ? ' active' : '' }}" id="home-list-item"
                data-bs-toggle="list" href="#monthly-{{ $monthlyOverviewed['monthID'] }}">{{ $monthlyOverviewed['month'] }}</a>
            @endforeach
        </div>
        <div class="tab-content px-0 pt-0 pb-5">
            @foreach ($monthlyOverview as $index => $mOverview)
            <div class="tab-pane fade show {{ $index === 0 ? ' show active' : '' }}"
                id="monthly-{{ $mOverview['monthID'] }}">
                <p>{{ $mOverview['salesMonthlyInfo'] }} <strong>₱{{ number_format($mOverview['monthlyAmount'],2, '.', ',') }} pesos</strong></p>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- <div class="row">
    <div class="col-lg-12">
        <h5>Sales Overview</h5>
        <div>
            <h2>Daily Overview</h2>
            @foreach ($dailyOverview as $dailyOverview)
            <p>{{ $dailyOverview['dateID'] }}</p>
            <p>{{ $dailyOverview['date'] }}</p>
            <p>{{ $dailyOverview['salesDailyInfo'] }}</p>
            @endforeach
        </div>

        <div>
            <h2>Monthly Overview</h2>
            @foreach ($monthlyOverview as $monthlyOverview)
            <p>{{ $monthlyOverview['month'] }}</p>
            <p>{{ $monthlyOverview['salesMonthlyInfo'] }}</p>
            @endforeach
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
</div> --}}

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