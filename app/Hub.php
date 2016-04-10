<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hub extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title', 'server_ip', 'image'
  ];

  public function articles(){
    return $this->hasMany(Article::class);
  }

  public function events(){
    return $this->hasMany(Event::class);
  }

  public function getImageUrl()
  {
    return url('/images/'.$this->image);
  }

  public function getUrl(){
    return route('hub-show', ['hub' => $this]);
  }
}
