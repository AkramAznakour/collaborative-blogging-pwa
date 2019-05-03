<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;
use willvincent\Rateable\Rating;

class Post extends Model
{

    use Rateable;

    protected $table = 'posts';
    protected $fillable = ['title', 'image', 'content', 'user_id', 'topic_id',];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }


    public function comments()
    {
        return $this->hasMany('App\Comment',"post_id");
    }


}
