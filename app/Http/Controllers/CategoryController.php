<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('children')->get();
        
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->title = $request->title;
        $category->content = $request->content;
        $filename = sprintf('thumbnail_%s.jpg', random_int(1, 1000));
        if($request->hasFile('thumbnail'))
        $filename = $request->file('thumbnail')->storeAs('images', $filename , 'public');
        else{
            $filename = 'dummy.jpg';
        }
        $category->thumbnail = $filename;
        $category->parent_id = $request->parent_id;
        $save = $category->save();
        if($save){
            return redirect()->route('categories.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::with('children')->get();
        return view('dashboard.categories.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
       
        $category->title = $request->title;
        $category->content = $request->content;
        $filename = sprintf('thumbnail_%s.jpg', random_int(1, 1000));
        if($request->hasFile('thumbnail'))
        $filename = $request->file('thumbnail')->storeAs('images', $filename , 'public');
        else{
            $filename = $category->thumbnail ;
        }
        $category->thumbnail = $filename;
        $category->parent_id = $request->parent_id;
        $save = $category->update();
        if($save){
            return redirect()->route('categories.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $deleted = $category->delete();
        return redirect()->route('categories.index', compact('deleted'));
    }
}
