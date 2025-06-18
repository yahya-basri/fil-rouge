<?php

namespace App\Livewire\Module;

use Livewire\Component;
use App\Models\Module;

class ModuleIndex extends Component
{
    public function render()
    {
        $modules = Module::get();
        return view('livewire.module.module-index', compact('modules'));
    }
}
