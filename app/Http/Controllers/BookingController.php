<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Booking;
use App\Models\TitleUser;
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
        $books = TitleUser::where('status_id', $bookings->statuses->id)->with('title', 'users')->get();
        $authors = Author::where('id', $books->title->author_id)->get();
        dd($bookings, $books, $authors);
        
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$book= TitleUser::where()->with('titles','users')->get();
        dd('booking form');
        return view('bookings.create', compact('book'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        // store new booking (bookings, statuses), send confirmation mail to user and notice mail to owner.
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
    
}