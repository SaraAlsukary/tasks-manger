<?php

namespace Package\Tasks\Models;

use Illuminate\Database\Eloquent\Model;
use Package\Tasks\Models\Task;

class Proirity extends Model
{
    //
    protected $fillable = ['name'];
     protected $casts = [
     'name' => 'array',
     ];
     public function name():Attribute{
        return Attribute::make(
        get: function ($value) {
        $decoded = json_decode($value, true);
        if (Route::currentRouteName() === 'proirities.show') {
        return $decoded;
        }
        $locale = App::getLocale();
        return $decoded[$locale] ?? null;
        },
        set: fn ($value) => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value
        );
     }
    public function tasks(){
    return $this->hasMany(Task::class);
    }
}