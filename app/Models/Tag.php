<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class Tag extends Model
{
   use HasFactory, Notifiable;
   
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'name',
   ];
   
   /**
    * Get's the post that belongs to the tag
    *
    * @return BelongsToMany
    */
   public function posts() :BelongsToMany
   {
      return $this->belongsToMany(Post::class, 'post_tags')
      ->using(PostTag::class)->withPivot('id');
   }


}
