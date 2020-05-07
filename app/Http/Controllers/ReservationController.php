<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Customer;
use App\Mail\ReservationConfirmation;
use App\Mail\ReservationConfirmationAdmin;
use App\User;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validation
        $this->validate($request,[
            'name' => 'required|min:3',
            'email'=> 'required|email',
            'phone' => 'required|min:9|max:9',
            'reservation_date' => 'required',
        ]);

        //Create Reservation
        $reservation = Reservation::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'reservation_date' => $request->get('reservation_date')
         ]);

        $reservation->save();

        //Create a new customer if doesn't exist
        if (!Customer::where('email', '=', $request->get('email'))->exists()) {
            // user found
            Customer::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
             ]);

         }


       //Check the available slots
       $NewReservation = New Reservation();
       $slots = [];

       foreach ($NewReservation->enumSlots as $item ){
            array_push($slots, $item );
        }

        $reservation_date_compare = Carbon::parse($request->get('reservation_date'));
        $slotsunavaliable = Reservation::whereDate('reservation_date','=',$reservation_date_compare)->pluck('slot')->toArray();


       return view('confirmreservation', compact('reservation', 'slots', 'slotsunavaliable'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Reservation $reservation, Request $request)
    {


        $reservation->slot = $request->get('slot');
        $reservation->save();

        //Send an email confirmation to the customer
        Mail::to($reservation->email)->send(new ReservationConfirmation($reservation));

        $user_admin = User::find(1);

        //Send an email confirmation to the administrator
        Mail::to($user_admin->email)->send(new ReservationConfirmationAdmin($reservation));

        return view('confirmedreservation',compact('reservation'))->with('flash',trans('global.reservationconfirmed'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
