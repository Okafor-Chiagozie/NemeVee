<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Notifications\Notifiable;

class PostTag extends Pivot
{
   use HasFactory, Notifiable;

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'post_id', 'tag_id',
   ];

   /**
    * Indicates if the IDs are auto-incrementing.
    *
    * @var bool
    */
   public $incrementing = true;

   /**
    * Indicates if a model should be timestamped.
    *
    * @var bool
    */
   public $timestamps = false;
   
   /**
    * Get's the posts assoiciated with the tag
    *
    * @return BelongsTo
    */
   public function posts() :BelongsTo
   {
      return $this->belongsTo(Post::class, 'post_id', 'id');
   }
   
   /**
    * Get's the tags associated with the post
    *
    * @return BelongsTo
    */
   public function tags() :BelongsTo
   {
      return $this->belongsTo(Tag::class, 'tag_id', 'id');
   }
}
