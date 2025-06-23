<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    // RELATIONSHIP
    public function skills()
    {
        return $this->belongsToMany(Skill::class)
                    ->withPivot('completed_at')   // expose the field
                    ->withTimestamps();           // still keeps created_at / updated_at
    }

    public function completedSkills()
    {
        return $this->belongsToMany(Skill::class, 'user_completed_skills', 'user_id', 'skill_id')->withTimestamps();
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges', 'user_id', 'badge_id')->withTimestamps();
    }

    public function completedModules()
    {
        return $this->belongsToMany(
            \App\Models\Module::class,
            'module_user',       // <— pivot table name
            'user_id',
            'module_id'
        )
        ->withPivot('completed_at')
        ->withTimestamps();
    }

    // Assuming you have a method to check if the user is a student
    public function isStudent()
    {
        return $this->role === 'student';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
