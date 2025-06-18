<?php

namespace App\Livewire\Skills;

use Livewire\Component;
use App\Models\Module;
use App\Models\Skill;

class SkillCreate extends Component
{
    public $module, $skillName, $skillContent;
    public $skills = [];

    public function render()
    {
        return view('livewire.skills.skill-create');
    }

    public function mount($id){
        $this->module = Module::find($id); 
        $this->skills = $this->module->skills;
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

        return to_route("module.show" , $this->module->id)->with("success");
    }
}
