<?php

namespace Package\Tasks\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Package\Tasks\Models\Task;
class Team extends Model
{
    //
    protected $fillable = ['name','description'];
    public function members(){
        return $this->belongsToMany(User::class,'team_users')
        ->withPivot('is_manger');
    }
    public function tasks(){
        return $this->hasMany(Task::class);
    }

}