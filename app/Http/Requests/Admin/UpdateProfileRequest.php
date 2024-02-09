<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
         'username' => ['bail', 'required', 'string', 'max:100'],
         'email' => ['bail', 'required', Rule::excludeIf(fn() => request()->email == auth()->user()->email), 
         'email:rfc,dns', 'max:100', 'unique:admins,email'],
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
         'username' => 'Username',
         'email' => 'Email',
      ];
   }

   /**
    * Stopping validation on first failure
    *
    * @var bool
    */
   protected $stopOnFirstFailure = true;
}
