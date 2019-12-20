<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

protected $guarded =['file'];
  public function category(){
    return $this->belongsTo(Category::class);
  }

  public function user(){
    return $this->belongsTo(User::class);
  }
  public function photo(){
    return $this->belongsTo(Photo::class);
  }
}
