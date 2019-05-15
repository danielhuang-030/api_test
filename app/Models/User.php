<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * todos
     *
     * @return void
     */
    public function todos()
    {
        return $this->hasMany(Todos::class);
    }

    /**
     * get API token
     *
     * @param integer $length
     * @return string
     */
    public static function getApiToken(int $length = 60)
    {
        return Str::random($length);
    }

    /**
     * update api token
     */
    public function updateApiToken(){
        do {
            $this->api_token = static::getApiToken();
        } while ($this->where('api_token', $this->api_token)->exists());
        $this->save();
    }
}
