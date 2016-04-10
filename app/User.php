<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
  use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

  public function profile(){
    return $this->hasOne(Profile::class);
  }

  public function articles(){
    return $this->hasMany(Article::class);
  }

  public function events(){
    return $this->hasMany(Event::class);
  }

  public function roles(){
    return $this->belongsToMany(Role::class, 'role_user');
  }

  public function getUrl(){
    return route('user-show', ['user' => $this]);
  }
}
