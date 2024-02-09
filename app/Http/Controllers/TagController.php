<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\AddCategoryRequest;
use App\Models\Tag;

class TagController extends Controller
{   
   public function __construct()
   {
      $this->middleware(['auth:web']);
   }
   
   /**
    * Show the form for creating a new resource
    *
    * @return mixed
    */
   public function create() :mixed
   {
      $tags = Tag::all();

      if(request()->expectsJson())
         return $tags;

      return view('add-category', compact('tags'));
   }
     
   /**
    * Store a newly created resource in storage
    *
    * @param \App\Http\Requests\Category\AddCategoryRequest $request
    * @return mixed
    */
   public function store(AddCategoryRequest $request) :mixed
   {
      Tag::create($request->validated());

      return response()->json(['message' => 'Tag added successfully']);
   }
   
   /**
    * Remove the specified resource from storage
    * 
    * @param int $tag_id
    * @return mixed
    */
   public function destroy(int $tag_id) :mixed
   {
      Tag::destroy($tag_id);

      return response()->json(['message' => 'Tag deleted successfully']);
   }

}
