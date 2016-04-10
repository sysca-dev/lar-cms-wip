<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title', 'start_time', 'length', 'description', 'twitch_url', 'hub_id', 'image'
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [

  ];

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = [
    'start_time', 'created_at', 'updated_at', 'deleted_at'
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function hub(){
    return $this->belongsTo(Hub::class);
  }

  public function getImageUrl()
  {
    return url('/images/'.$this->image);
  }

  public function getUrl(){
    return route('event-show', ['event' => $this]);
  }
}
