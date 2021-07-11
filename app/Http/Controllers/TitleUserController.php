<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Status;
use App\Models\Title;
use App\Models\TitleUser;
use Carbon\Carbon;
use Illuminate\Http\Request;


class TitleUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(auth()->user()->id); //user-id des jew auth users.
        $userId = auth()->user()->id;
        //all items des jew. auth. User anzeigen
        $books= TitleUser::with('status','title')->where('user_id' ,$userId)->paginate(10);
        
        //dd($books);
        
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books= TitleUser::select()->with('status','title')->get();
        $categories= Category::orderBy('type')->orderBy('category_name')->get();
        return view('books.create', compact('books','categories')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentYear = Carbon::tomorrow()->year; // Zeitdifferenzen berücksichtigen
        
        //dd($request->all());
        
        //besser eigene Validator instanz? 
        $request->validate([
            'title' => 'required|min:1',
            'subtitle' => 'nullable|min:1',
            'fname' => 'required|min:1',
            'lname' => 'nullable|min:1',
            'isbn10' => 'nullable|regex:',
            'isbn13' => 'nullable|regex:',
            'category' => 'required',
            'publisher' => 'required',
            //'year'=> ['required', 'integer','digits:4','min: 0001' , 'max:'.$currentYear], //SQLSTATE[22003]: Numeric value out of range: 1264 Out of range value for column 'publication_year' at row 1 für Daten von zB 1900 !!!
            'year' => ['required','max:'.$currentYear],
            'edition'=> 'min:1|integer',
            'format' => 'required',
            'condition' => 'nullable|min:2|string',
            'delivery' => 'required'
        ]);
        
        //dd($request->all());
        
        // nur wenn der Datensatz in der Datenbank noch nicht existiert (firstOrCreate, updateOrCreate, upsert ...?)
        $authors= Author::firstOrCreate([
            'first_name' => $request->fname,
            'last_name' => $request->lname
        ]);
        
        // oder mit upsert falls unvollständige db- einträge (fehlende isbn etc) -> n. derweil nicht, später ev durch api ergänzt?
        $titles= Title::firstOrCreate([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'edition' => $request->edition,
            'publisher' => $request->publisher,
            'publication_year'=> $request->year,
            'publication_format' => $request->format,
            'isbn_10' => $request->isbn10,
            'isbn_13' => $request->isbn13,
            
            'author_id' => $authors->id,
            'category_id' => $request->category
        ]);
        
        $statuses = Status::create();
        //dd($statuses->id);
        
        //mom kann ein User so nur ein gl Buch registrieren, ändern?
        //alert wenn buch bereits registriert einfügen, oder counter in tabelle --> zB wasRecentlyCreated attribut
        $books= TitleUser::firstOrCreate([ 
            'condition' => $request->condition,
            'possible_delivery_methods' => $request->delivery,
            
            'title_id' => $titles->id,
            'user_id' => $request->user()->id,
            'status_id' => $statuses->id
        ]);
        // dd oder var_dump($books->wasRecentlyCreated);
        
        return redirect()->route('books.index')->with('success', 'New book registered successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book= TitleUser::find($id)->with('title', 'status')->get();
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book= TitleUser::find($id)->with('status','title')->get();
        $categories= Category::orderBy('type')->orderBy('category_name')->get();
        return view('books.edit', compact('books','categories'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}