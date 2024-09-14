<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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


    // Local scopes

    public function scopeUsers(Builder $query): void
    {
        $query->where("role", "user");
    }

    public function scopeSubscribers(Builder $query): void
    {
        $query->where("role", "subscriber");
    }

    public function scopeAdmins(Builder $query): void
    {
        $query->where("role", "admin");
    }

    public function scopeSuperAdmins(Builder $query): void
    {
        $query->where("role", "superadmin");
    }



    // Helpers 

    public function hasRole($role): bool
    {
        return $this->role === $role;
    }
}
