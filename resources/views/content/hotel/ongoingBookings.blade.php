{{-- ? --}}
<div class="tab-pane fade" id="room-occupied" role="tabpanel">
    <div class="row">
        @foreach ($occupied as $occupied)
        <div class="col-md">
            <div class="card bg-transparent border mb-2">
                <div class="card-body">
                    <div class="d-flex">
                        <h5 class="card-title mt-2">Room #{{ $occupied->htO_roomNum }}</h5>
                        <p class="ms-auto mt-2">{{ $occupied->htO_occupant_name }}</p>
                    </div>
                    <p>
                        @if ($occupied->htO_amount_paid === $occupied->htO_total_price)
                        <span class="badge bg-label-success text-start">Fully Paid</span>
                        @else
                        <span class="badge bg-label-warning text-start">Not Fully Paid</span>
                        @endif
                    </p>
                    {{-- <div class="d-flex">
                        <p>Total amount: ₱{{ number_format($occupied->htO_total_price, 2, '.', ',') }}</p>
                        <p class="ms-auto"> Amount paid: ₱{{ number_format($occupied->htO_amount_paid, 2, '.', ',') }}
                        </p>
                    </div> --}}
                    <p>Total amount: ₱{{ number_format($occupied->htO_total_price, 2, '.', ',') }}</p>
                    <p class="ms-auto"> Amount paid: <span
                            class="@if($occupied->htO_amount_paid !== $occupied->htO_total_price) text-warning @else text-success @endif">
                            ₱{{ number_format($occupied->htO_amount_paid, 2, '.', ',') }}</span></p>
                </div>
                <div class="card-footer mb-n1 d-flex">
                    @if ($occupied->htO_amount_paid === $occupied->htO_total_price)
                    {{-- ? POPOVER --> --}}
                    <button type="button" class="btn rounded-pill btn-success mb-2 mx-auto ms-1 text-nowrap" >Checkout</button>
                    {{-- <button type="button" class="btn rounded-pill btn-success mb-2 mx-auto ms-1 text-nowrap"
                        data-bs-toggle="popover" data-bs-offset="0,14" data-bs-placement="top" data-bs-html="true"
                        data-bs-content="
                        <p>Complete Booking? this will make the room available for the next check-in</p> 
                        <div class='d-flex justify-content-between'>
                            <button type='button' class='btn btn-sm btn-outline-secondary' id='cancelButton'>Cancel</button>
                            <button type='button' class='btn btn-sm btn-primary'>Checkout</button>
                        </div>" id="popOverComplete">Checkout</button> --}}
                        {{-- ? POPOVER --> --}}
                    @else
                    <button type="button" class="btn rounded-pill btn-info mb-2 mx-auto me-1" data-bs-toggle="modal"
                        data-bs-target="#addPaymentModal-{{ $occupied->htO_id }}">Add Payment</button>
                    <button type="button" class="btn rounded-pill btn-dark mb-2 mx-auto ms-1">Cancel Booking</button>
                    @endif
                </div>
            </div>
            {{-- ? Modal ADD PAYMENT --> --}}
            <div class="modal fade" id="addPaymentModal-{{ $occupied->htO_id }}" data-bs-backdrop="static"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <form class="modal-content" method="post" action="{{ route('addPayment') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="backDropModalTitle">ROOM #{{ $occupied->htO_roomNum }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBackdrop" class="form-label">Name</label>
                                    <input type="text" id="nameBackdrop" class="form-control"
                                        value="{{ $occupied->htO_occupant_name }}" name="htO_occupant_name" readonly>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="" class="form-label">Enter Amount</label>
                                    ₱<input type="text" id="" class="form-control" placeholder="*500"
                                        name="htO_pay_amount">
                                </div>
                                <div class="col mb-0">
                                    <label for="" class="form-label">Total Amount</label>
                                    <input type="text" id="" class="form-control" placeholder="Total"
                                        value="{{ number_format($occupied->htO_total_price, 2, '.', ',') }}" readonly>
                                </div>
                            </div>
                            <input type="text" id="" name="htO_total_price" value="{{ $occupied->htO_total_price }}"
                                hidden>
                            <input type="text" id="" name="htO_paid" value="{{ $occupied->htO_amount_paid }}" hidden>
                            <input type="text" id="" name="htO_roomNum" value="{{ $occupied->htO_roomNum }}" hidden>
                            <input type="text" id="" name="ht_id" value="{{ $occupied->htO_ht_id }}" hidden>
                            <input type="text" id="" name="htO_id" value="{{ $occupied->htO_id }}" hidden>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- ? Modal CHECKOUT --> --}}
            <div class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">Confirm Checkout</h5>
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        </div>
                        <div class="modal-body">
                            <p>Complete Booking? this will make the room available for the next check-in</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
    {{-- <p class="mb-0">
        Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet roll
        icing
        sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly jelly-o tart
        brownie
        jelly.
    </p> --}}

</div>