<?php
/*namespace App\Livewire\Module;

use Livewire\Component;
use App\Models\Module;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class ModuleShow extends Component
{
    public Module $module;
    public int $moduleId;
    public string $skillName = '';
    public ?string $skillContent = null;
    public $skills = [];
    

    public function mount(int $id)
    {
        $this->moduleId = $id;
        $this->module   = Module::with('skills')->findOrFail($id);
        $this->skills   = $this->module->skills;
    }

    public function render()
    {
        return view('livewire.module.module-show');
    }

    public function deleteModule()
    {
        $this->module->delete();
        return to_route('module.index');
    }

    public function createSkill()
    {
        $this->validate([
            'skillName'    => 'required|string|max:255',
            'skillContent' => 'nullable|string',
        ]);

        Skill::create([
            'module_id' => $this->module->id,
            'name'      => $this->skillName,
            'content'   => $this->skillContent,
        ]);

        $this->skillName = '';
        $this->skillContent = null;
    }

    public function deleteSkill(int $skillId)
    {
        Skill::findOrFail($skillId)->delete();
        return to_route("module.show",$this->module->id);
    }
}*/

namespace App\Livewire\Module;

use Livewire\Component;
use App\Models\Module;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class ModuleShow extends Component
{
    public Module $module;
    public int $moduleId;
    public string $skillName = '';
    public ?string $skillContent = null;
    public $skills = [];
    public $skillCompleted = [];
    public $completionPercentage = 0;

    public function mount(int $id)
    {
        $this->moduleId = $id;
        $this->module = Module::with('skills')->findOrFail($id);
        $this->skills = $this->module->skills;

        // Ensure user is authenticated before attempting to access Auth::user()
        if (Auth::check()) {
            $completedSkillIds = Auth::user()->completedSkills()->pluck('skill_id')->toArray();
            foreach ($this->skills as $skill) {
                $this->skillCompleted[$skill->id] = in_array($skill->id, $completedSkillIds);
            }
        } else {
            // If user is not authenticated, no skills are considered completed
            foreach ($this->skills as $skill) {
                $this->skillCompleted[$skill->id] = false;
            }
        }
        $this->updateCompletionPercentage();
    }

    public function render()
    {
        return view('livewire.module.module-show');
    }

    public function deleteModule()
    {
        $this->module->delete();
        // Redirect after deleting the module since the module itself is gone
        return to_route('module.index');
    }

    public function createSkill()
    {
        $this->validate([
            'skillName' => 'required|string|max:255',
            'skillContent' => 'nullable|string',
        ]);

        $newSkill = Skill::create([
            'module_id' => $this->module->id,
            'name' => $this->skillName,
            'content' => $this->skillContent,
        ]);

        // Add the new skill to the collection and initialize its completion status
        // Use `fresh()` to get the model with its default attributes and relationships if needed
        $this->skills->push($newSkill->fresh());
        $this->skillCompleted[$newSkill->id] = false; // A newly created skill is not completed
        $this->updateCompletionPercentage();

        // Reset form fields
        $this->skillName = '';
        $this->skillContent = null;

        // Emit a flash message or notification if you have a system for that
        // $this->dispatch('notify', 'Skill created successfully!');
    }

    public function deleteSkill(int $skillId)
    {
        Skill::findOrFail($skillId)->delete();

        // Remove the skill from the component's state without a full page reload
        // Filter out the deleted skill from the Livewire component's $skills collection
        $this->skills = $this->skills->where('id', '!=', $skillId);
        // Remove the completion status for the deleted skill
        unset($this->skillCompleted[$skillId]);

        // Update percentage
        $this->updateCompletionPercentage();

        // Emit a flash message or notification
        // $this->dispatch('notify', 'Skill deleted successfully!');
    }

    public function updatedSkillCompleted($value, $skillId)
    {
        // Only proceed if a user is authenticated
        if (!Auth::check()) {
            return;
        }

        if ($value) {
            // Attach the skill to the user's completed skills, preventing duplicates
            Auth::user()->completedSkills()->syncWithoutDetaching([$skillId]);
        } else {
            // Detach the skill from the user's completed skills
            Auth::user()->completedSkills()->detach($skillId);
        }

        $this->updateCompletionPercentage();

        // Check if the module is 100% complete and grant badge
        if ($this->completionPercentage >= 100) { // Use >= in case of floating point inaccuracies
            $badge = $this->module->badge;
            if ($badge) {
                // Attach the badge to the user, preventing duplicates
                Auth::user()->badges()->syncWithoutDetaching([$badge->id]);
                // Emit a flash message for badge achievement
                // $this->dispatch('notify', 'Congratulations! You earned a badge!');
            }
        } else {
            // Optional: If completion drops below 100%, you might want to detach the badge
            // depending on your application's logic (e.g., if re-completion is required)
            // This part is commented out as it's less common, but consider if applicable.
            $badge = $this->module->badge;
            if ($badge && Auth::user()->badges->contains($badge->id)) {
                Auth::user()->badges()->detach($badge->id);
            }
        }
    }

    private function updateCompletionPercentage()
    {
        $totalSkills = count($this->skills);
        if ($totalSkills === 0) {
            $this->completionPercentage = 0;
        } else {
            // Filter skillCompleted for true values (completed skills)
            $completedSkills = count(array_filter($this->skillCompleted));
            $this->completionPercentage = ($completedSkills / $totalSkills) * 100;
        }
    }
}