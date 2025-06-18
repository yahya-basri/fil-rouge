<?php

namespace App\Livewire\Module;

use Livewire\Component;
use App\Models\Module;

class ModuleEdit extends Component
{
    public $module , $name;

    public function render()
    {
        return view('livewire.module.module-edit');
    }

    public function mount($id){
        $this->module = Module::find($id);
        $this->name = $this->module->name;
    }

    public function submit(){
        $this->validate([
            "name" => "required",
        ]);

        $this->module->name = $this->name;
        $this->module->save();

        return to_route("module.index")->with("success");
    }
}
