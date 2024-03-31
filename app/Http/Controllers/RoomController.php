<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Accommondation;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RoomController extends Controller
{
    public function index(Accommondation $accommondation, Request $request)
    {
        $request->validate([
            'checkin' => 'required',
            'checkout' => 'required',
        ]);

        if($request->checkout <= $request->checkin) {
            throw ValidationException::withMessages(['checkout' => '日付が正しくありません。']);
        }

        $rooms = Room::select('type', 'capacity', DB::raw('COUNT(*) as count'))
                     ->where('accommondation_id', '=', $accommondation->id)
                     ->where(function ($query) use ($request) {
                        $query->whereHas('reservationDetails', function ($query) use ($request) {
                            $query->where('accommondation_date', '<', $request->input('checkin'))
                                  ->where('accommondation_date', '>=', $request->input('checkout'));
                        })->orWhereDoesntHave('reservationDetails');
                     })
                     ->groupBy('type', 'capacity')
                     ->orderBy('capacity')
                     ->get();

        return Inertia::render('Rooms', [
            'accommondation' => $accommondation,
            'rooms' => $rooms,
            'checkin' => $request->input('checkin'),
            'checkout' => $request->input('checkout'),
        ]);
    }
}
