<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Accommondation;
use App\Models\Reservation;
use App\Models\ReservationDetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Room;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    public function create(Accommondation $accommondation)
    {
        return Inertia::render('Reservation', [
            'accommondation' => $accommondation,
        ]);
    }

    public function store(Request $request, Accommondation $accommondation) {

        if($request->number_of_people == 0) {
            throw ValidationException::withMessages(['number_of_people' => '部屋を選択してください。']);
        }

        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->number_of_people = $request->number_of_people;
        $reservation->check_in = $request->checkin;
        $reservation->check_out = $request->checkout;
        $reservation->save();

        $checkin = Carbon::parse($request->checkin);
        $checkout = Carbon::parse($request->checkout);

        $datesInRange = $checkin->toPeriod($checkout->subDay())->toArray();

        $singleCount = 0;
        $doubleCount = 0;
        $twinCount = 0;
        $twoCount = 0;
        $fourCount = 0;


        if($request->single) {
            $singleCount = $request->single;
        }
        if($request->double) {
            $doubleCount = $request->double;
        }
        if($request->twin) {
            $twinCount = $request->twin;
        }
        if($request->two) {
            $twoCount = $request->two;
        }
        if($request->four) {
            $fourCount = $request->four;
        }

        $roomsTypeArray = array_merge(
            array_fill(0, $singleCount, 'single'),
            array_fill(0, $doubleCount, 'double'),
            array_fill(0, $twinCount, 'twin'),
            array_fill(0, $twoCount, 'tow'),
            array_fill(0, $fourCount, 'four'),
        );

        $rooms = Room::where('accommondation_id', '=', $accommondation->id)
                    ->where(function ($query) use ($request) {
                    $query->whereHas('reservationDetails', function ($query) use ($request) {
                        $query->where('accommondation_date', '<', $request->input('checkin'))
                                ->where('accommondation_date', '>=', $request->input('checkout'));
                    })->orWhereDoesntHave('reservationDetails');
                    })->get();

        foreach($roomsTypeArray as $roomType) {

            $room = $rooms->where('type', $roomType)->first();
            $accommondation_fee = $room->capacity * 1000;

            foreach($datesInRange as $date) {

                $reservationDetail = new ReservationDetail();
                $reservationDetail->reservation_id = $reservation->id;
                $reservationDetail->accommondation_date = $date;
                $reservationDetail->accommondation_fee = $accommondation_fee;
                $reservationDetail->room_id = $room->id;
                $reservationDetail->save();
            }

        }

        return Inertia::render('Completion');
    }
}