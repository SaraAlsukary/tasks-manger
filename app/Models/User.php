<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use Laravel\Sanctum\HasApiTokens;
use Package\Tasks\Models\Task;
use Package\Tasks\Models\Team;
class User extends Authenticatable
{
   use HasApiTokens,HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     **/
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
         return $this->role === 'user';
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */

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
    public function teams(){
        return $this->belongsToMany(Team::class,'team_users')
         ->withPivot('is_manger');
    }
    public function tasks(){

        return $this->hasMany(Task::class);
    }


}
