<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    const ADMIN = 1;
    const USER = 0;

    public static $allRole = [
        self::USER => 'User',
        self::ADMIN => 'Admin',
    ];

    public static function  getRoles()
    {
        return self::$allRole;
    }


    public static function  getRoleId($id)
    {
        return !empty(self::$allRole[$id]) ? self::$allRole[$id] : '';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin($role){
        if($role == self::ADMIN){
            return true;
        }
        return false;
    }

    public function isUser($role){
        if($role == self::USER){
            return true;
        }
        return false;
    }
}
