<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Title;
use App\Models\TitleUser;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
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
        //
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
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
}