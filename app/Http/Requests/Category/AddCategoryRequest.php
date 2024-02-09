<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
    */
   public function authorize(): bool
   {
      return true;
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    */
   public function rules(): array
   {
      return [
         'name' => ['bail', 'required', 'string', 'unique:tags,name', 'max:30'],
      ];
   }

   /**
    * Customized name for the attributes
    *
    * @return array
    */
   public function attributes(): array
   {
      return [
         'name' => 'Category name',
      ];
   }

   /**
    * Stopping validation on first failure
    *
    * @var bool
    */
   protected $stopOnFirstFailure = true;
}
