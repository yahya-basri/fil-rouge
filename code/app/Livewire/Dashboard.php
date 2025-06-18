<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Module;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard');
    }

    public $totalUsers;
    public $totalModules;

    public function mount()
    {
        $this->totalUsers = User::count();
        $this->totalModules = Module::count();
    }
}
