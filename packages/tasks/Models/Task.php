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
    public function proirity(){
        return $this->belongsTo(Proirity::class);
    }

    public function member(){
    return $this->belongsTo(User::class,'user_id');
    }
    public function team(){
    return $this->belongsTo(Team::class);
    }
}