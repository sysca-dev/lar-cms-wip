<?php

namespace App\Forum;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable = [
    'title', 'order'
  ];

  public function forums(){
    return $this->hasMany(Forum::class);
  }

  public function topics(){
    return $this->hasManyThrough(Topic::class, Forum::class);
  }
}
