<?php

namespace App\Forum;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
  protected $fillable = [
    'title', 'contents'
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function forum(){
    return $this->belongsTo(Forum::class);
  }

  public function posts(){
    return $this->hasMany(Post::class);
  }

  public function getUrl(){
    return route('forum-topic-show', ['forum' => $this->forum, 'topic' => $this]);
  }
}
