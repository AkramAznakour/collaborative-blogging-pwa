<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title', 'image', 'content', 'user_id', 'topic_id',];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }


    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function getShotFormat()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'excerpt' => $this->content,
            'topic_id' => $this->topic_id,
            'topic' => $this->topic()->name,

        ];
    }
}
