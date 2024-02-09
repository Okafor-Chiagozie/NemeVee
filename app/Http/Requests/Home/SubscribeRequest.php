<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
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
         'email' => ['bail', 'required', 'email:rfc,dns', 'max:100', 'unique:subscribes,email'],
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
         'email' => 'Email',
      ];
   }

   /**
    * Customized error messages
    *
    * @return array
    */
   public function messages(): array
   {
      return [
         'email.unique' => 'The Email has already subscribed',
      ];
   }

   /**
    * Stopping validation on first failure
    *
    * @var bool
    */
   protected $stopOnFirstFailure = true;
}
