<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['module_id', 'name', 'content'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function completedByUsers()
    {
        return $this->belongsToMany(User::class, 'completed_skills');
    }
}
