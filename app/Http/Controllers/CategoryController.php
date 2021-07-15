<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin');
    }

    // public $rules = [
    //     'type' =>'required',
    //     'category' => 'required|min:2|unique:categories,category_name',
    //     // // Kategorienname ev nur unique bei gleichem Typ
        
    //  ];
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('type')->orderBy('category_name')->paginate(10);
        // ... Category::orderBy('type', $request->sort ?? 'asc')->...->get();
        
        //ddd($categories->total()); //or dd() or dump()
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
        //$rules = $this->rules;
        //$request->validate($rules);
       
        //dd($request->category, $request->type);
        
        $request->validate([
             'type' =>'required',
            //'category' => 'required|min:2|unique:categories,category_name',
            // Kategorienname nur unique bei gleichem Typ:
            'category' => 'required|min:2|unique:categories,category_name,NULL,id,type,'.$request->type,
        
            // 'category' => ['required', 'min:2', Rule::unique('categories')->where(function($query) use ($request){
            //     return $query->where('type', $request->type);
            // })],
        ]);

        $category= Category::create([
            'type' => $request->type,
            'category_name' => $request->category,
        ]); //create($request->all());
        //$category->save();
        //dd($category);
        
        return redirect()->route('categories.index')->with('success', 'New category '.$request->category_name.' was saved successfully.'); // msg: zweisprachig de fehlt noch
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
        // $rules = $this->rules;
        // $request->validate($rules);
        
         $request->validate([
             'type' =>'required',
            // Kategorienname nur unique bei gleichem Typ:
            'category' => 'required|min:2|unique:categories,category_name,NULL,id,type,'.$request->type,
            // 'category' => ['required', 'min:2', Rule::unique('categories')->where(function($query) use ($request){
            //     return $query->where('type', $request->type);
            // })],
        ]);
        //dd($request->all());
        $category->update([
            'type' => $request->type,
            'category_name' => $request->category
        ]);
        //$category->update($request->all());
        
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
        //bed einfügen falls kat nicht gelöscht werden kann, status key msg anp.
        $category = Category::find($id);
                
        if (!$category){
            $key= 404;
            $status = 'error';
            $msg= 'Category not found';
        }
        if ($category->titles->count() > 0 ){
            $key = 409; //??
            $status='warning';
            $msg= "Category can't be deleted";
        }
        else{
            $category->delete(); //Category::destroy($category->id);
            $key=200;
            $status='success';
            $msg='Category '.$category->type.': '.$category->category_name.' deleted.';
        }

        // if( request()->ajax() ){
        //     return response()->json([
        //         'status' => $status,
        //         'msg' =>$msg
        //     ]);
        // }

        return redirect()->route('categories.index')->with([$status=>$msg]);
    }
}