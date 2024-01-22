@extends('layouts/withoutNavbar')

@section("title', 'Ticoy's Hotel")

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')

<h4 class="fw-bold py-3 mt-n2">
    <span class="text-muted fw-light">/ </span> 
    Hotel Service
</h4>

<div class="col-xl-8 mt-n2">
    <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                    data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home"
                    aria-selected="true"><i class="tf-icons bx bx-home"></i> Home
                    
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                    data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile"
                    aria-selected="false"><i class="tf-icons bx bx-user"></i> Profile
                    @if (null === 'gg')
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">3</span>
                    @endif
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                    data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages"
                    aria-selected="false"><i class="tf-icons bx bx-message-square"></i> Messages
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

{{-- <script>
    const dataFromServer = @json($dataFromDatabase);
        // Call a function in your script to handle the data
        handleDataFromServer(dataFromServer);
</script> --}}
@endsection