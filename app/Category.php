<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function post(){
      return $this->hasMany(Post::class);
    }
}
