<?php

namespace Package\Tasks\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Package\Tasks\Models\Task;
class Team extends Model
{
    //
    protected $fillable = ['name','description'];
    protected $casts = [
        'name' => 'array',
        'description' => 'array',
    ];
    public function members(){
        return $this->belongsToMany(User::class,'team_users')
        ->withPivot('is_manger');
    }
        // public function name():Attribute{
        // return Attribute::make(
        // get: function ($value) {
        // $decoded = json_decode($value, true);
        // if (Route::currentRouteName() === 'teams.show') {
        // return $decoded;
        // }
        // $locale = App::getLocale();
        // return $decoded[$locale] ?? null;
        // },
        // set: fn ($value) => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value
        // );
        // }
        // public function description():Attribute{
        // return Attribute::make(
        // get: function ($value) {
        // $decoded = json_decode($value, true);
        // if (Route::currentRouteName() === 'teams.show') {
        // return $decoded;
        // }
        // $locale = App::getLocale();
        // return $decoded[$locale] ?? null;
        // },
        // set: fn ($value) => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value
        // );
        // }
        protected function name(): Attribute
        {
        return Attribute::make(
        get: function ($value) {
        if (Route::currentRouteName() === 'teams.show') {
        return $value;
        }
        return $value[App::getLocale()] ?? $value['en'] ?? null;
        },
        set: function ($value) {
        if (is_array($value)) return $value;

        try {
        return json_decode($value, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
        return [App::getFallbackLocale() => $value];
        }
        }
        );
        }
               protected function description(): Attribute
               {
               return Attribute::make(
               get: function ($value) {
               if (Route::currentRouteName() === 'teams.show') {
               return $value;
               }
               return $value[App::getLocale()] ?? $value['en'] ?? null;
               },
               set: function ($value) {
               if (is_array($value)) return $value;

               try {
               return json_decode($value, true, 512, JSON_THROW_ON_ERROR);
               } catch (\JsonException $e) {
               return [App::getFallbackLocale() => $value];
               }
               }
               );
               }
    public function tasks(){
        return $this->hasMany(Task::class);
    }

}