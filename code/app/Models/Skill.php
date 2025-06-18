<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ["name" , "content" , "module_id"];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
