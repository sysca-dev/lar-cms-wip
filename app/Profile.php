<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'dob', 'first_name', 'last_name', 'gender', 'location'
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
    'dob', 'created_at', 'updated_at', 'deleted_at'
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }
}
