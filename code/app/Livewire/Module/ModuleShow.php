<?php

namespace App\Livewire\Module;

use Livewire\Component;
use App\Models\Module;
use App\Models\Skill;

class ModuleShow extends Component
{
    public $module, $name, $content;
    public $skills = [];

    public function render()
    {
        return view('livewire.module.module-show');
    }

    public function mount($id){
        $this->module = Module::find($id); 
        $this->skills = $this->module->skills;
    }

    public function delete($id){
        $module = Module::find($id);
        $module->delete();
        return to_route('module.index');
    }

    public function createSkill()
    {
        $this->validate([
            'skillName' => 'required|string|max:255',
            'skillContent' => 'nullable|string',
        ]);

        $skill = Skill::create([
            'module_id' => $this->module->id,
            'name' => $this->skillName,
            'content' => $this->skillContent,
        ]);

        // Refresh the skills list
        $this->skills = $this->module->skills()->get();

        // Clear the input fields
        $this->skillName = '';
        $this->skillContent = '';
    }
    public function deleteSkill($id){
        $skill = Skill::find($id);
        $skill->delete();
        return to_route("module.show", $this->module->id)->with("success");
    }
}
