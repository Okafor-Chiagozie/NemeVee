<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
         'title' => ['bail', 'nullable', 'string', 'between:1,255'],
         'content' => ['bail', 'nullable', 'string'],
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
         'title' => 'Title',
         'content' => 'Content',
      ];
   }

   /**
    * Stopping validation on first failure
    *
    * @var bool
    */
   protected $stopOnFirstFailure = true;
}
