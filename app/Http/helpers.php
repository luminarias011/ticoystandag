<?php

function bookedRooms()
{
    $roomCount = DB::table('occupied_room')
        ->where('htO_active', 1)
        ->where('htO_status', 0)
        ->get();
    $allCount = $roomCount->count();

    return $allCount;
}

