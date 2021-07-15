<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Title;
use App\Models\TitleUser;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of all Authors.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::with('titles')->orderBy('last_name')->paginate(10);
        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->data);
        $authors = Author::firstOrCreate([
            'first_name' => $request->fname,
            'last_name' => $request->lname
        ]);
        return back()->with('success', __('New Author registered') );
    }
    
    /**
    * Display the specified Author.
    *
    * @param  App\Models\Author $author
    * @return \Illuminate\Http\Response
    */
    
    public function show(Author $author)
    {
        $titles = Title::with('users')->where('author_id',$author->id)->get(); //with users ->us leer
        //$books = TitleUser::with('users')->get();
        //dd($titles, $books);
        return view('authors.show', compact('author','titles'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $request->validate($this->data);
        $author->update([
            'first_name' => $request->fname,
            'last_name' => $request->lname
        ]);
        return redirect('authors.index')->with('success', __('Author updated'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        if (!$author){
            $key=404;
            $status='error';
            $msg='Author not found';
        }
        if( $author->titles->count() > 0 ){
            $key = 409; //??
            $status='warning';
            $msg= "Author can't be deleted";
        }
        else {
            $key=200;
            $status='success';
            $msg='Author '.$author->first()->first_name. ' '. $author->last_name .' deleted';
            $author->delete();
        }
        if( request()->ajax() ){ 
            return response()->json([
                'status' => $status,
                'msg' =>$msg
            ]);
        }
        return redirect()->route('authors.index')->with([$status => $msg]);
    }
    
    public $data = [
        'fname' => 'required',
        'lname' => 'nullable'
    ];

}