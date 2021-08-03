<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Booking;
use App\Models\Status;
use App\Models\Title;
use App\Models\TitleUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // bookings made by user, past and present. Booking date, end date (return), status, title.
        
        $bookings= Booking::where('user_id', Auth::id() )->with('statuses')->orderBy('created_at')->paginate(10);
        // & books w. titles, authors
        dd($bookings);
        
        return view('bookings.index');
    }

    /**
     * Show the form for creating a new booking.
     *
     * @param int $title
     * @param int $user
     * @return \Illuminate\Http\Response
     */
    public function makeBooking($title, $user) //same create() AB Konv ohne Param???
    {
        if ($user != auth()->user()->id){
            $book = TitleUser::where('title_id',$title)->where('user_id',$user)->with('title','user')->get();
            //dd($methods);
            return view('bookings.create', compact('book'));
        }
    }
    
    /**
     * Store a newly created booking in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $title @param int $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
                
        $request->validate([
            'delivery' => 'required',
            'address' => 'min:2' // ADDRESS (for now)
        ]);
        
        // send confirmation mail to user and notice mail to owner. If successful ->DB:
            
        // DB: new bookings, update statuses.
        $booking = Booking::create([
            'user_id' => auth()->user()->id,
            'status' => 1
        ]);
        
        // 
        $delivery='';
        if($request->delivery == 'in-person'){$delivery='personal';}; // ACHTUNG DB title_user? alues heissen anders
        if($request->delivery == 'postal'){$delivery='mail';}; 
        //
        //dd($delivery, $request->delivery);
        
        $status = Status::join('title_user','title_user.status_id','=','statuses.id')
        ->where('title_user.title_id',$request->title)->where('title_user.user_id',$request->user) //wie bekomme ich jetzt richtiges Buch??? 
        ->update([
            'available' => 0,
            'booking_id' => $booking->id,
            'booking_date' => Carbon::now(),
            'return_date' => Carbon::now()->addSeconds(60),//->addMonths(2),
            'delivery_method' => $delivery, //$request->delivery,
            'notification_sent' => 1
        ]);

        return redirect()->route('titles.show', [$request->title, $request->user])->with('success', __('You reserved a book, congratulations. The owner will be notified immediately.'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }
    
    /**
     * Remove the specified booking from storage.
     *
     * @param  int  $id
     * @param bool $returnConfirmed
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $returnConfirmed=false)
    {
        // besser soft-delete um verg Buchungen sehen zu können, später?
        // Bei storno (später), wenn nicht vom Besitzer bestätigt (später) &
        // Nach Ablauf der 2 Monate (momentan, sollte später vom owner bestätigt werden) bzw bei bestätigter Rückgabe (später?)
        
        //$returnConfirmed= false;
        $returnDate = Status::where('booking_id',$id)->select('return_date');
        $booking= Booking::find($id);
        $bookStatus= Status::where('booking_id',$id);
        dd($id, $returnDate,$booking,$bookStatus);
        
        if( $returnConfirmed ){
            $booking->delete();
            $bookStatus->update([
                'available' => true
            ]);
            $key=200;
            $status='success';
            $msg='Return confirmed';
        }
        else if (!$booking){
            $key=404;
            $status='error';
            $msg='Booking not found';
        }
        else if ($returnDate <= Carbon::now()){
            $booking->delete(); // besser notification an user senden und Buchung nicht automatisch löschen.
            $bookStatus->update([
                'available' => 1
            ]);
            $key=200;
            $status='warning';
            $msg='Booking expired.';
        }
        
        return redirect()->route('books.index')->with([$status =$msg]);
        
    }
    
}