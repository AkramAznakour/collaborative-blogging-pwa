<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePicture extends Model
{
    protected $table = 'proflie_pictures';
    protected $fillable = ['userId', 'path'];
}
