<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public $rules = [
        'type' =>'required',
        'category' => 'min:2|unique:categories,category_name'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('type')->orderBy('category_name')->get();
        //dd($categories)
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id','type','category_name')->get();
        return view('categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->rules;
       
        //dd($request->category, $request->type);
        $request->validate($rules);

        $category= Category::create([
            'type' => $request->type,
            'category_name' => $request->category,
        ]); //create($request->all());
        //$category->save();
        //dd($category);
        
        return redirect()->route('categories.index')->with('success', 'New category '.$request->category_name.' was saved successfully.'); // zweisprachig: msg. wo nochmal?
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = $this->rules;
        $request->validate($rules);
        
        //$category->update([
        //     'type' => $request->type,
        //     'category_name' => $request->category
        // ]);
        $category->update($request->all());
        
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        
        if (!$category){
            $status= 404;
            $msg= 'Category not found';
            $status = 'error';
        }
        else{
            $category->delete(); //Category::destroy($category->id);
            $status=200;
            $key='success';
            $msg='Category '.$category->category_name. ' '.'successfully deleted.';
        }

        // Modalboxen noch einfügen!
        if( request()->ajax() ){
            return response()->json([
                'status' => $status,
                'msg' =>$msg
            ]);
        }

        return redirect()->route('categories.index')->with([$key=>$msg]);
    }
}