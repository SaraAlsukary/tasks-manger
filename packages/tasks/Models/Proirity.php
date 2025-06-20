<?php

namespace Package\Tasks\Models;

use Illuminate\Database\Eloquent\Model;
use Package\Tasks\Models\Task;

class Proirity extends Model
{
    //
    protected $fillable = ['name'];
    public function tasks(){
    return $this->hasMany(Task::class);
    }
}