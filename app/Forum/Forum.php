<?php

namespace App\Forum;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
  protected $fillable = [
    'title', 'description', 'order'
  ];

  public function category(){
    return $this->belongsTo(Category::class);
  }

  public function topics(){
    return $this->hasMany(Topic::class);
  }

  public function posts(){
    return $this->hasManyThrough(Post::class, Topic::class);
  }

  public function forum(){
    return $this->belongsTo(Forum::class);
  }

  public function getUrl(){
    return route('forum-forum-show', ['forum' => $this]);
  }
}
