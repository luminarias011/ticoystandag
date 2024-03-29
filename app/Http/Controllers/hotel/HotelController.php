<?php

namespace App\Http\Controllers\hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class HotelController extends Controller
{
    public function main()
    {
        $rooms = DB::table('hotel')
            ->where('ht_isActive', 1)
            ->get();

        $occupied = DB::table('occupied_room')
            ->where('htO_active', 1)
            ->where('htO_status', 0)
            ->get();

        $histories = DB::table('occupied_room')
            ->where('htO_active', 1)
            ->where('htO_status', '!=', 0)
            ->get();

        // session()->flash('success', 'Status Updated.');
        return view('content.hotel.main', compact('rooms', 'occupied', 'histories'));
    }

    public function addOccupant(Request $request)
    {
        $htO_occupant_name = $request->htO_occupant_name;
        $htO_NumOccupants = $request->htO_NumOccupants;
        $htO_total_price = $request->htO_total_price;
        $htO_roomNum = $request->htO_roomNum;
        $htO_id = $request->htO_id;

        DB::table('occupied_room')
            ->insert([
                'htO_ht_id' => $htO_id,
                'htO_roomNum' => $htO_roomNum,
                'htO_NumOccupants' => $htO_NumOccupants,
                'htO_occupant_name' => $htO_occupant_name,
                'htO_total_price' => $htO_total_price,
                'htO_date' => DB::raw('CURRENT_TIMESTAMP'),
            ]);

        DB::table('hotel')
            ->where('ht_id', $htO_id)
            ->update([
                'ht_occupied' => 1,
            ]);

        session()->flash('success', 'Room #' . $htO_roomNum . ' Occupied!');
        return redirect()->route('hotel-book');
        // return view('content.hotel.main', compact('rooms'));
    }

    function addPayment(Request $request)
    {
        $htO_occupant_name = $request->htO_occupant_name;
        $htO_total_price = $request->htO_total_price;
        $htO_pay_amount = $request->htO_pay_amount;
        $htO_roomNum = $request->htO_roomNum;
        $htO_paid = $request->htO_paid;
        $htO_date = $request->htO_date;
        $htO_id = $request->htO_id;
        $ht_id = $request->ht_id;
        // dd($htO_occupant_name);

        $total_paid = $htO_pay_amount + $htO_paid;
        // dd($total_paid, $htO_total_price);

        if ($total_paid > $htO_total_price) {
            session()->flash('error', 'Amount Exceeded!');
            return redirect()->route('hotel-book');
        } else {
            DB::table('occupied_room')
                ->where('htO_id', $htO_id)
                ->increment('htO_amount_paid', $htO_pay_amount, [
                    'htO_date_paid' => DB::raw('CURRENT_TIMESTAMP'),
                ]);

            // ? PAYMENT LOGs

            DB::table('log_hotel_payments')
                ->insert([
                    'log_htO_id' => $htO_id,
                    'log_htO_roomNum' => $htO_roomNum,
                    'log_htO_date' => $htO_date,
                    'log_htO_occupant_name' => $htO_occupant_name,
                    'log_payment_amount' => $htO_pay_amount,
                    'log_payment_date' => DB::raw('CURRENT_TIMESTAMP'),
                ]);

            session()->flash('success', 'Amount Added!');
            return redirect()->route('hotel-book');
        }
    }

    // ! STATUS:
    // ? 0: Ongoing
    // ? 1: Completed
    // ? 2: Cancelled

    // ! Occupied
    // ? 0: Not
    // ? 1: Occupied

    function checkout($htO_id, $ht_id)
    {
        DB::table('occupied_room')
            ->where('htO_id', $htO_id)
            ->update([
                'htO_status' => 1,
                'htO_date_modified' => DB::raw('CURRENT_TIMESTAMP'),
            ]);

        DB::table('hotel')
            ->where('ht_id', $ht_id)
            ->update([
                'ht_occupied' => 0,
                'ht_date_modified' => DB::raw('CURRENT_TIMESTAMP')
            ]);

        session()->flash('success', 'Completed!');
        return redirect()->route('hotel-book');
    }

    function cancelCheckIn($htO_id, $ht_id)
    {
        DB::table('occupied_room')
            ->where('htO_id', $htO_id)
            ->update([
                'htO_status' => 2,
                'htO_date_modified' => DB::raw('CURRENT_TIMESTAMP'),
            ]);

        DB::table('hotel')
            ->where('ht_id', $ht_id)
            ->update([
                'ht_occupied' => 0,
                'ht_date_modified' => DB::raw('CURRENT_TIMESTAMP')
            ]);


        session()->flash('success', 'Cancelled!');
        return redirect()->route('hotel-book');
    }

}