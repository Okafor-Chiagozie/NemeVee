<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyPasscodeRequest extends FormRequest
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
         'original_passcode' => ['bail', 'required', 'integer', 'between:1000,9999'],
         'passcode' => ['bail', 'required', 'integer', 'same:original_passcode'],
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
         'original_passcode' => 'Original code',
         'passcode' => 'Your Passcode',
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
         'passcode.same' => 'The passcode dosen\'t match with the original',
      ];
   }

   /**
    * Gets the data to be validated
    *
    * @return void
    */
   public function validationData()
   {
      return array_merge($this->all(), [
         'original_passcode' => (string) session('original_passcode'),
      ]);
   }

   /**
    * Stopping validation on first failure
    *
    * @var bool
    */
   protected $stopOnFirstFailure = true;
}
