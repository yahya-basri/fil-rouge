<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['name'];

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function badge()
    {
        return $this->hasOne(Badge::class);
    }

    protected static function booted()
    {
        static::created(function ($module) {
            Badge::create([
                'module_id' => $module->id,
                'name' => 'Completed ' . $module->name,
                'description' => 'Awarded for completing all skills in ' . $module->name,
            ]);
        });
    }
}
