{{-- ? --}}
<div class="tab-pane fade show active" id="room-booking" role="tabpanel">
    <div class="col-lg-12">
        @foreach ($rooms as $room)
        <div class="card card-pullup bg-transparent border mb-2
        @if ($room->ht_occupied !== 1)
            border-success
        @else
            border-danger unclick
        @endif ">
            <div class="card-body" data-bs-toggle="modal" data-bs-target="#backDropModal-{{ $room->ht_id }}">
                <h5 class="card-title mt-2">Room #{{ $room->ht_roomNum }}</h5>
                @if ($room->ht_occupied !== 1)
                <p class="card-text text-success">
                    AVAILABLE
                </p>
                @else
                <p class="card-text text-danger">
                    OCCUPIED
                </p>
                Complete transaction from...
                @endif
            </div>
        </div>

        {{-- ? Modal Backdrop --> --}}
        <div class="modal fade" id="backDropModal-{{ $room->ht_id }}" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <form class="modal-content" method="post" action="{{ route('addOccupant') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="backDropModalTitle">ROOM #{{ $room->ht_roomNum }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBackdrop" class="form-label">Name</label>
                                <input type="text" id="nameBackdrop" class="form-control" value="" name="htO_occupant_name" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="" class="form-label">Number of Occupants</label>
                                <input type="number" id="" class="form-control" placeholder="00" value="1" name="htO_NumOccupants">
                            </div>
                            <div class="col mb-0">
                                <label for="" class="form-label">Amount per Day/Night</label>
                                <input type="text" id="" class="form-control" value="500" placeholder="500.00">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                {{-- <label for="" class="form-label">Number of Occupants</label>
                                <input type="number" id="" class="form-control" placeholder="00"> --}}
                            </div>
                            <div class="col mb-0">
                                <label for="" class="form-label">Total Amount</label>
                                <input type="text" id="" class="form-control" placeholder="Total" name="htO_total_price">
                            </div>
                        </div>
                        {{-- ! HIIDEN --}}
                        <input type="text" id="" name="htO_roomNum" value="{{ $room->ht_roomNum }}" hidden>
                        <input type="text" id="" name="htO_id" value="{{ $room->ht_id }}" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
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
