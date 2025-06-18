<?php

namespace App\Livewire\Module;

use Livewire\Component;
use App\Models\Module;

class ModuleCreate extends Component
{
    public $name;

    public function render()
    {
        return view('livewire.module.module-create');
    }

    public function submit(){
        $this->validate([
            "name" => "required",
        ]);

        Module::create([
            "name" => $this->name,
        ]);

        return to_route("module.index")->with("success");
    } 
}
