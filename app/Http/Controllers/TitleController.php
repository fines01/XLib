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
        $this->middleware('auth');
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
        
        // $data1=null; 
        $titleSearch=array();
        
        for($i=0; $i<count($searches); $i++){
            
                $data1[$i]= Title::where( function($query) use($searches, $i){
                    $query->orWhere('title','like','%'.$searches[$i].'%')->orWhere('subtitle','like', '%'.$searches[$i].'%');
                });
                if ($data1[$i]->exists() ){
                    if ($i !==0 && $data1[$i] !== $data1[$i-1]){ continue;} // exp.: === nicht !== um nicht x gl resultate zu bekommen.
                    $titleSearch[$i] = $data1[$i]->with('author')->get();//paginate(10);
                };
                
                $data2[$i]= Author::where( function($query) use ($searches, $i){
                    $query->orWhere('first_name','like', '%'.$searches[$i].'%')->orWhere('last_name','like','%'.$searches[$i].'%');
                });
                if ($data2[$i]->exists()){
                    if ($i != 0 && $data2[$i] !== $data2[$i-1] ) continue;
                    $authorSearch[$i] = $data2[$i]->with('titles')->get();
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