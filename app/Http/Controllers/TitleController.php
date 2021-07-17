<?php

namespace App\Http\Controllers;

use App\Models\Title;
use App\Models\TitleUser;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $titles= Title::with('author','category','users')->paginate(15);
                
        return view('titles.index', compact('titles'));
    }
    
    /**
     * Display the specified Title.
     *
     * @param  App\Models\Title $title
     * @return \Illuminate\Http\Response
     */
    public function show(Title $title)
    {
        //ev nur auth. User ?
        
        // alle items eines Titels, inkl. Status (f. Buchung)
        $books= TitleUser::where('title_id', $title->id)->with('title', 'user', 'status')->paginate(10);
        //dd($title, $books);
        
        // $title->with('author','category','users')->get();
        //$books = TitleUser::with('users', 'status')->get();
    
        return view('titles.show', compact('title','books'));
    }
}