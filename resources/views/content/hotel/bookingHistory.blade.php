{{-- ? --}}
<div class="tab-pane fade" id="booking-history" role="tabpanel">
    <div class="col-lg-12">
        @foreach ($histories as $history)
        <div class="card bg-transparent border mb-2
                @if ($history->htO_status !== 1)
                    border-dark
                @else
                    border-success
                @endif">
            <div class="card-body">
                <div class="d-flex">
                    <h5 class="card-title mt-2">Room #{{ $history->htO_roomNum }}</h5>
                    <p class="ms-auto mt-2">{{ $history->htO_occupant_name }}</p>
                </div>
                <p class="d-flex">
                    @if ($history->htO_status === 1)
                    <span class="badge bg-label-success text-start">COMPLETED</span>
                    @else
                    <span class="badge bg-label-dark text-start">CANCELLED</span>
                    @endif
                    <span class="ms-auto">₱{{ number_format($history->htO_amount_paid, 2, '.', ',') }}</span>
                </p>
            </div>
        </div>
        @endforeach
    </div>
</div>