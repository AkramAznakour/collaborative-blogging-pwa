<?php

namespace App;

use Illuminate\Database\Query\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
<<<<<<< HEAD
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
=======
use App\Notifications\VerifyEmail;

class User extends AuthenticatableForUser implements MustVerifyEmail
>>>>>>> a01cb6023bb4bc31977ed4e2d572324e34603dff
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','avatar'
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * By name
     *
     * @param $query
     * @param $name
     * @return Builder
     */
    public function scopeOfName($query, $name)
    {
        return $query->where('name', $name);
    }

    /**
     * By email
     *
     * @param $query
     * @param $email
     * @return Builder
     */
<<<<<<< HEAD
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
=======
    public function scopeOfEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
>>>>>>> a01cb6023bb4bc31977ed4e2d572324e34603dff
    }
}
