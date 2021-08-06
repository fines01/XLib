<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Title;
use App\Models\TitleUser;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('search');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $titles= Title::with('author','category','users')->orderBy('title')->paginate(10);
                
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
        $searches=explode(" ", $request->input('search')); // besser noch mit preg_replace() bereinigen
        
        foreach($searches as $search){
            
                $data1= Title::where( function($query) use($search){
                    $query->orWhere('title','like','%'.$search.'%')->orWhere('subtitle','like', '%'.$search.'%');
                });
                if ($data1->exists() ){
                    $title= $data1->with('author')->get();//paginate(10);
                    $titleSearch[]=$title;
                };
                
                $data2= Author::where( function($query) use ($search){
                    $query->orWhere('first_name','like', '%'.$search.'%')->orWhere('last_name','like','%'.$search.'%');
                });
                if ($data2->exists()){
                    $author = $data2->with('titles')->get();
                    $authorSearch[]=$author;
                };       
        }
        // SELECT * from titles WHERE 'title' LIKE %$query%' OR 'subtitle' LIKE %$query% // oder so // '%'.$search.'%'
        
        //return $authorSearch;
        if (isset($titleSearch) && isset($authorSearch)){ return view('searches.index', compact('titleSearch','authorSearch'));}
        if (isset($titleSearch))  {return view('searches.index', compact('titleSearch'));}
        if (isset($authorSearch)) {return view('searches.index', compact('authorSearch'));}
        if(!isset($authorearchS) && !isset($titleSearch)){ return view('searches.index');}
    }
}