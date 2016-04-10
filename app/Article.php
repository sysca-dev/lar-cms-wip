<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title', 'contents', 'image', 'hub_id'
  ];

  public function plainContents($len){
    if($len !== null){
      if(strlen(str_replace("\n", ' ', strip_tags($this->contents))) > $len){
        return substr(str_replace("\n", ' ', strip_tags($this->contents)), 0, $len);
      }
    }
    return str_replace("\n", ' ', strip_tags($this->contents));
  }

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
    return route('article-show', ['article' => $this]);
  }
}
