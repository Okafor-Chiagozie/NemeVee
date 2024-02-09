<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
   use HasFactory, Notifiable, SoftDeletes;

   /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
      'nano_id', 'title', 'content', 'type',
      'views', 'deleted_at', 'published_at',
   ];

   /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
   protected $casts = [
      'published_at' => 'datetime',
   ];

   /**
    * Get the route key for the model
    *
    * @return string
    */
   public function getRouteKeyName(): string
   {
      return 'nano_id';
   }

   /**
    * Get the value of the model's route key
    *
    * @return mixed
    */
   public function getRouteKey(): mixed
   {
      return $this->nano_id;
   }

   /**
    * Get's the tag that belongs to the post
    *
    * @return BelongsToMany
    */
   public function tags(): BelongsToMany
   {
      return $this->belongsToMany(Tag::class, 'post_tags')
         ->using(PostTag::class)->withPivot('id');
   }
   
   /**
    * Get's the tag that belongs to the post
    *
    * @return BelongsToMany
    */
   public function related_tags(): BelongsToMany
   {
      return $this->belongsToMany(Tag::class, 'post_tags')
         ->using(PostTag::class)->withPivot('id')->wherePivotIn('tag_id', session()->get('related_ids'));
   }
}
