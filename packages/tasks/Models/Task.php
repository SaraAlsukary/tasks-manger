<?php

namespace Package\Tasks\Models;

use Illuminate\Database\Eloquent\Model;
use Package\Tasks\Models\Proirity;

use App\Models\User;
use Package\Tasks\Models\Team;
use Package\Tasks\Models\TeamMember;
class Task extends Model
{
    // protected $fillable = ['title','description','proirity_id','team_id','user_id','statue'];
protected $guarded = ['id'];
    protected $casts = [
    'title' => 'array',
    'description' => 'array',
    'statue' => 'array',
    ];
    public function proirity(){
        return $this->belongsTo(Proirity::class);
    }
    public function title():Attribute{
        return Attribute::make(
        get: function ($value) {
        $decoded = json_decode($value, true);
        if (Route::currentRouteName() === 'tasks.show') {
        return $decoded;
        }
        $locale = App::getLocale();
        return $decoded[$locale] ?? null;
        },
        set: fn ($value) => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value
        );
    }
    public function description():Attribute{
            return Attribute::make(
            get: function ($value) {
            $decoded = json_decode($value, true);
            if (Route::currentRouteName() === 'tasks.show') {
            return $decoded;
            }
            $locale = App::getLocale();
            return $decoded[$locale] ?? null;
            },
            set: fn ($value) => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value
            );
    }
    public function statue():Attribute{

        return Attribute::make(
                get: function ($value) {
                $decoded = json_decode($value, true);
                if (Route::currentRouteName() === 'tasks.show') {
                return $decoded;
                }
                $locale = App::getLocale();
                return $decoded[$locale] ?? null;
                },
                set: fn ($value) => is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value
                );
    }
    public function member(){
    return $this->belongsTo(User::class,'user_id');
    }
    public function team(){
    return $this->belongsTo(Team::class);
    }
}