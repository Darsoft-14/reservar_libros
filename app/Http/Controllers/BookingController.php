<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $date =date('Y-m-d');

        $books = DB::table('bookings')
                ->join('books', 'bookings.books_id','books.id')
                ->join('users', 'bookings.users_id','users.id')
                ->select('bookings.id','books.title','books.author','books.pag','bookings.date_delivery')
                ->where('users.id', '=', Auth::user()->id)
                ->where('bookings.date_delivery','>',$date)
                ->get();

        $nbooks = DB::table('bookings')
                ->where('users_id', '=', Auth::user()->id)
                ->where('date_delivery','>',$date)
                ->count();


        // return $nbooks;

        return view('home')->with('books',$books)
                           ->with('date',$date)
                           ->with('nbooks',$nbooks);
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
        $date =date('Y/m/d');
        $newDate =  date('Y/m/d',strtotime($date."+". $request->days. "days"));
        Booking::create([
            'users_id' => Auth::user()->id,
            'books_id' => $request->id,
            'date_departure' => $date,
            'date_delivery' => $newDate
            ]);

        session()->flash('status','Reserva Realizada!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $date =date('Y/m/d');
        $booking = Booking::find($id);
        $booking->date_delivery = $date;
        $booking->save();

        session()->flash('status','Reserva Cancelada!');

        return back();
    }
}
