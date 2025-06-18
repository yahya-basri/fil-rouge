<?php

namespace App\Livewire\Skills;

use Livewire\Component;
use App\Models\Module;
use App\Models\Skill;

class SkillEdit extends Component
{
    public $module, $skill, $name, $content;

    public function render()
    {
        return view('livewire.skills.skill-edit');
    }

    public function mount($id){
        $this->skill = Skill::find($id);
        $this->module = $this->skill->module;
        $this->name = $this->skill->name;
        $this->content = $this->skill->content;
    }
    public function editSkill(){
        $this->validate([
            "name" => "required",
            "content" => "required"
        ]);

        $this->skill->name = $this->name;
        $this->skill->content = $this->content;
        $this->skill->save();

        return to_route("module.show", $this->module->id)->with("success");
    }
}
