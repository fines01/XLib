<?php

namespace App\Http\Controllers;

use App\Models\Title;
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
        // alle items eines Titels, inkl. Status (f. Buchung)
        //ev nur auth. User ?
        
        $title->with('author','category','users')->get();
        //$books = TitleUser::with('users', 'status')->get();
    
        return view('titles.show', compact('title'));
    }
}