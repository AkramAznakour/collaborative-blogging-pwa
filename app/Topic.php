<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Topic extends Model
{
    use Rateable;

    protected $table = "topics";
    protected $fillable = ['name'];


    public function posts()
    {
        return $this->
        hasMany('App\Post');
    }
}
