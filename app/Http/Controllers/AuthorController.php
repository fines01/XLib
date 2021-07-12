<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Title;
use App\Models\TitleUser;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::with('titles')->orderBy('last_name')->paginate(10);
        return view('authors.index', compact('authors'));
    }

     /**
     * Display the specified resource.
     *
     * @param  App\Models\Author $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        $titles = Title::with('users')->where('author_id',$author->id)->get(); //with users ->us leer
        //$books = TitleUser::with('users')->get();
        //dd($author, $titles);
        return view('authors.show', compact('author','titles'));
    }
}