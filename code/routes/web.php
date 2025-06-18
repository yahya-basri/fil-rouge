<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
// Users logic
use App\Livewire\Users\UserIndex;
use App\Livewire\Users\UserCreate;
use App\Livewire\Users\UserEdit;
use App\Livewire\Users\UserShow;
// Dashboard logic
use App\Http\Controllers\DashboardController;
// Module logic
use App\Livewire\Module\ModuleIndex;
use App\Livewire\Module\ModuleCreate;
use App\Livewire\Module\ModuleEdit;
use App\Livewire\Module\ModuleShow;
// ROLES LOGIC
use App\Livewire\Roles\RolesIndex;
use App\Livewire\Roles\RolesCreate;
use App\Livewire\Roles\RolesEdit;
use App\Livewire\Roles\RolesShow;
// SKILLS LOGIC
use App\Livewire\Skills\SkillShow;
use App\Livewire\Skills\SkillCreate;
use App\Livewire\Skills\SkillEdit;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // USER CRUD
    Route::get('users', UserIndex::class)->name('users.index');
    Route::get('users/create', UserCreate::class)->name('users.create');
    Route::get('users/{id}/edit', UserEdit::class)->name('users.edit');
    Route::get('users/{id}', UserShow::class)->name('users.show');

    // MODULE CRUD
    Route::get('module', ModuleIndex::class)->name('module.index');
    Route::get('module/create', ModuleCreate::class)->name('module.create');
    Route::get('module/{id}/edit', ModuleEdit::class)->name('module.edit');
    Route::get('module/{id}', ModuleShow::class)->name('module.show');

    // ROLES
    Route::get("roles" , RolesIndex::class)->name("roles.index");
    Route::get("roles/create" , RolesCreate::class)->name("roles.create");
    Route::get("roles/{id}/edit" , RolesEdit::class)->name("roles.edit");
    Route::get("roles/{id}" , RolesShow::class)->name("roles.show");

    // SKILLS
    Route::get("skill/{id}" , SkillShow::class)->name("skill.show");
    Route::get("skills/{id}/create" , SkillCreate::class)->name("skills.create");
    Route::get("skills/{id}/edit" , SkillEdit::class)->name("skills.edit");
});

require __DIR__.'/auth.php';
