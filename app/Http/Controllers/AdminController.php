<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{   
   public function __construct()
   {
      $this->middleware(['auth:web']);
   }

   /**
    * Display the specified resource
    *
    * @param \App\Models\Admin $admin
    * @return mixed
    */
   public function show(Admin $admin) :mixed
   {
      return view('profile', compact('admin'));
   }
   
   /**
    * Show the form for editing the specified resource
    *
    * @param \App\Models\Admin $admin
    * @return mixed
    */
   public function edit(Admin $admin) :mixed
   {
      return view('edit-profile', compact('admin'));
   }
      
   /**
    * update
    *
    * @param \App\Http\Requests\Admin\UpdateProfileRequest $request
    * @param  int $id
    * @return mixed
    */
   public function update(UpdateProfileRequest $request, int $id) :mixed
   {
      Admin::where('id', $id)->update($request->validated());

      return to_route('admin.show', [$id]);
   }

}
