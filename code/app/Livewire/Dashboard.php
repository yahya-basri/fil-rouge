<?php

/*namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', compact('badges'));
    }

    public $totalUsers;
    public $totalModules;
    
    public function mount()
    {
        $this->totalUsers = User::count();
        $this->totalModules = Module::count();
    }
}*/


namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $totalUsers;
    public $totalModules;
    public $badges;

    public function mount()
    {
        $this->totalUsers = User::count();
        $this->totalModules = Module::count();

        // Ensure user is authenticated before attempting to access Auth::user()
        if (Auth::check()) {
            // Eager load badges to prevent N+1 issues if displaying details of badges
            $this->badges = Auth::user()->badges;
        } else {
            // If not authenticated, ensure $badges is an empty collection
            $this->badges = collect();
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}