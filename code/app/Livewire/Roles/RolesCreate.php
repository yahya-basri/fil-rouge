<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesCreate extends Component
{
    public $name;
    public $permissions = [];
    public $allPermissions = [];

    public function render()
    {
        return view('livewire.roles.roles-create');
    }

    public function mount(){
        $this->allPermissions = Permission::get();
    }

    public function submit(){
        $this->validate([
            "name" => "required|unique:roles,name",
            "permissions" => "required",
        ]);

        $role = Role::create([
            "name" => $this->name,
        ]);

        $role->syncPermissions($this->permissions);

        return to_route("roles.index")->with("success");
    }
}
