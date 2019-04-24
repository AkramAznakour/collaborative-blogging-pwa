<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";
    protected $fillable = ['content','user_id','post_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
