<?php

namespace App\Forum;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = [
    'contents'
  ];

  public function forum(){
    return $this->belongsTo(Forum::class);
  }

  public function topic(){
    return $this->belongsTo(Topic::class);
  }

  public function user(){
    return $this->belongsTo(User::class);
  }
}
