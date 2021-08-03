<?php

namespace App\Http\Controllers;

use App\Models\Author;
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
    
        return view('titles.show', compact('title','books'));
    }

    public function search( Request $request)
    {

        //dd ($request->input('search'));
        $searches=explode(" ", $request->input('search'));
        
        // suche korrigieren !
        foreach ($searches as $search){
            //ACHTUNG ev. SQL Injection mögl. bei Raw Eingabe: schützen
            $data1= Title::
            //where(Title::raw('title + subtitle'), 'like', "%{$search}%")-> 
            where( function($query) use($search){
                $query->orWhere('title','like', "%{$search}%")->orWhere('subtitle','like', "%{$search}%");
            });
            
            // SELECT * from titles WHERE 'title' LIKE %$query%' OR 'subtitle' LIKE %$query% 
            
            //Version 2 fkt auch n. für ganzen Namen:
            $data2= Author::
            where([
                ['first_name','like',"%{$search}%"],
                ['last_name', 'like', "%{$search}%"],
                ])->
                orWhere('first_name','like', "%{$search}%")->orWhere('last_name','like',"%{$search}%");
        }
        
        if ($data1->exists()){
            return $data1->get();//paginate(10);
            dd($data1);
        }
        else if ($data2->exists()){
            return $data2->get();
            dd($data2);
        }
        else {
            dd('no results found');
        }

        // return: view mit Tabelle & Links zu den Titeln (titles.show oder authors.show).

    }
}