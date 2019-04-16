<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['path', 'postId'];
    protected $table = 'pictures';
}
