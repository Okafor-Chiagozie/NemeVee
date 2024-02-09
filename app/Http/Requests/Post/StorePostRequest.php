<?php

namespace App\Http\Requests\Post;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
         'title' => ['bail', 'required', 'string', 'max:255'],
         'content' => ['bail', 'required', 'string'],
         'type' => ['bail', 'required', 'string'],
         'image' => ['bail', 'nullable', 'image', 'max:1024'],
         'tags' => ['bail', 'required', 'array', 'min:1'],
         'tags.*' => ['bail', 'required', 'integer', 'exists:tags,id'],
      ];
   }

   /**
    * Gets the data to be validated
    *
    * @return void
    */
   public function validationData()
   {
      $current_post = Post::select('title', 'content')->where('nano_id', request()->route('nano_id'))->first();

      return array_merge($this->all(), [
         'title' => $current_post->title,
         'content' => $current_post->content,
      ]);
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
         'type' => 'Post Type',
         'tags' => 'Tag',
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
         'tags.required' => 'Select at least one tag for your post',
      ];
   }

   /**
    * Stopping validation on first failure
    *
    * @var bool
    */
   protected $stopOnFirstFailure = true;
}
