<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Status;
use App\Models\Title;
use App\Models\TitleUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TitleUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    /**
     * Get the current year.
     *
     * @return \Carbon\Carbon 
     */
    public function currentYear()
    {
        return Carbon::tomorrow()->year; // Zeitdifferenzen berücksichtigen
    } 
    
    /**
     * Get the currently authenticated User.
     *
     * @return int 
     */
    public function userId() // haha, geht wsl. auch einfach über Request --> $request->user()->id 
    {
        return auth()->user()->id; 
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(auth()->user()->id); //user-id des jew auth users.
        //$userId = auth()->user()->id;
        //all items des jew. auth. User anzeigen
        $books= TitleUser::with('status','title')->where('user_id' ,$this->userId() )->paginate(10);
        
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
        //besser in eigene Funktion auslagern? eigene Validator Instanz? andere bessere Lösung? (2x ,auch in update)
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
            'year' => ['required','min:0001', 'max:'.$this->currentYear()], // TEST
            'edition'=> 'min:1|integer',
            'format' => 'required',
            'condition' => 'nullable|min:2|string',
            'delivery' => 'required' ////todo: postal nur wenn adr hinterlegt.
        ]);
        
        //dd($request->all());
        
        // nur wenn der Datensatz in der Datenbank noch nicht existiert (firstOrCreate, updateOrCreate, upsert ...?)
        $authors= Author::firstOrCreate([
            'first_name' => $request->fname,
            'last_name' => $request->lname
        ]);
        
        // oder mit upsert falls unvollständige db- einträge (fehlende isbn etc) -> n. derweil nicht, später ev durch api ergänzt?
        $titles= Title::firstOrCreate([ //umständlich? 
            'title' => $request->title, //in Funktionen auslagern?
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
        
        //momentan kann ein User so nur ein gl. Buch registrieren, ev ändern? Od. counter in tabelle?
        //ToDo: alert wenn buch bereits registriert einfügen --> zB wasRecentlyCreated attribut
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title= Title::where('id',$id)->with('author', 'category', 'users')->get();
        $item= TitleUser::with('status')->where('title_id',$id)->where('user_id',$this->userId())->get();
        // dd($title, $title[0]->author->first_name);
        return view('books.show', compact('title','item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //title_id
    {
        //dd($id);
        $book= TitleUser::where('title_id',$id)->where('user_id',$this->userId())->with('status','title')->get();
        $categories= Category::orderBy('type')->orderBy('category_name')->get();
        //dd($book);
        return view('books.edit', compact('book','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //
    {
        //dd($id, $request->all());
        
        $request->validate([
            'title' => 'required|min:1',
            'subtitle' => 'nullable|min:1',
            'fname' => 'required|min:1',
            'lname' => 'nullable|min:1',
            'isbn10' => 'nullable|regex:',
            'isbn13' => 'nullable|regex:',
            'category' => 'required',
            'publisher' => 'required',
            'year' => ['required','min:0001', 'max:'.$this->currentYear()],
            'edition'=> 'min:1|integer',
            'format' => 'required',
            'condition' => 'nullable|min:2|string',
            'delivery' => 'required'
        ]);

        //update Models, $authors, $titles, $books
        //******************

        //$author: wenn existiert->updaten! Betrifft dann aber alle Bücher in DB (bsp. User schreibt namen falsch etc). Wenn nicht: neuen Autor speichern??? nein
        
        //$authorId = Title::where('id',$id)->select('author_id')->first()->author_id; //umständlich? notwendig?
        $authorId= Title::find($id)->select('author_id')->first()->author_id; //umständlich? notwendig?
        //ddd($authorId);
        
        // $author = Author::find($authorId); 
        // dd($author);
        $author = Author::find($authorId)->update([ //achtung wenn Autor geändert, orig. DB verändert mit allen Tabellen
            'first_name' => $request->fname,
            'last_name' => $request->lname
        ]);
        
        // $title= Title::find($id); 
        // dd($title);  
            
        $title = Title::find($id)->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'edition' => $request->edition,
            'publisher' => $request->publisher,
            'publication_year'=> $request->year,
            'publication_format' => $request->format,
            'isbn_10' => $request->isbn10,
            'isbn_13' => $request->isbn13,
            
            //'author_id' => $author->id,
            'category_id' => $request->category
        ]);
        
        TitleUser::where('title_id',$id)->where('user_id', $this->userId())->update([ 
            'condition' => $request->condition,
            'possible_delivery_methods' => $request->delivery,
            //'title_id' => $title->id,
        ]);
        
        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete TitleUser ($book)
    }
}