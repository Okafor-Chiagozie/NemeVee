<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
         'q' => ['bail', 'required', 'string', 'max:255'],
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
         'q' => 'Search',
      ];
   }

   /**
    * Stopping validation on first failure
    *
    * @var bool
    */
   protected $stopOnFirstFailure = true;
}
